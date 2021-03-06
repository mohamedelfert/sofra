<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function newOrder(Request $request)
    {
        $rules = [
            'restaurant_id' => 'required|exists:restaurants,id',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.quantity' => 'required',
            'address' => 'required',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }

        // get restaurant by id
        $restaurant = Restaurant::find($request->restaurant_id);

        // check restaurant status
        if ($restaurant->status === 'close') {
            return responseJson('0', 'عذرا المطعم مغلق لا يمكن تنفيذ طلبك');
        }

        // order create
        $order = $request->user('client')->orders()->create([
            'address' => $request->address,
            'notes' => $request->notes,
            'restaurant_id' => $request->restaurant_id,
            'payment_method_id' => $request->payment_method_id,
            'delivery_at' => '45 minute',
            'status' => 'pending',
        ]);

        $cost = 0;
        $delivery_cost = $restaurant->delivery_fee;

        foreach ($request->items as $i) {
            // get item by id
            $item = Item::find($i['item_id']);
            $readyItem = [
                $i['item_id'] => [
                    'quantity' => $i['quantity'],
                    'price' => $item->price,
                    'notes' => (isset($i['notes'])) ? $i['notes'] : '',
                ]
            ];
            $order->items()->attach($readyItem);
            $cost += ($item->price * $i['quantity']);
        }

        // check if cost for order >= restaurant minimum_order
        if ($cost >= $restaurant->minimum_order) {
            $total = $cost + $delivery_cost;
            $settings = Setting::find(1);
            $commission = $settings->commission * $cost; // commission in settings looks like (0.00)
            $net = $total - $commission;

            // update order details
            $update = $order->update([
                'cost' => $cost,
                'delivery_cost' => $delivery_cost,
                'total' => $total,
                'commission' => $commission,
                'net' => $net,
            ]);

            // notification create for restaurant In Database
            $notification = $restaurant->notifications()->create([
                'title' => 'طلب جديد',
                'content' => 'لديك طلب جديد من العميل ' . $request->user('client')->name,
                'order_id' => $order->id,
            ]);

            // Send Notification To Mobile By Using Firebase ( google FCM )
            $tokens = $restaurant->tokens()->where('token','!=',null)->pluck('token')->toArray();
            //$tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
            $title = $notification->title;
            $body = $notification->content;
            $data = [
                'order_id' => $order->id,
                'user_type' => 'restaurant',
            ];
            $send = notifyByFirebase($title, $body, $tokens, $data, true);
            info("firebase result: " . $send);

            $data = ['order' => $order->fresh()->load('items', 'restaurant.region', 'restaurant.categories', 'client')];
            return responseJson(1, 'تم الطلب بنجاح', $data);
        } else {
//            $order->items()->delete();
            $order->delete();
            return responseJson(0, 'يجب أن يكون الطلب أكثر من ' . $restaurant->minimum_order . ' جنيه');
        }
    }

    public function myOrders(Request $request)
    {
        $my_orders = $request->user('client')->orders()->where(function ($order) use ($request) {
            if ($request->has('status') && $request->status == 'accepted') {
                $order->where('status', '=', 'accepted');
            } elseif ($request->has('status') && $request->status == 'rejected') {
                $order->where('status', '=', 'rejected');
            } elseif ($request->has('status') && $request->status == 'completed') {
                $order->where('status', '=', 'completed');
            } elseif ($request->has('status') && $request->status == 'received') {
                $order->where('status', '=', 'received');
            } elseif ($request->has('status') && $request->status == 'refused') {
                $order->where('status', '=', 'refused');
            } elseif ($request->has('status') && $request->status == 'pending') {
                $order->where('status', '=', 'pending');
            }
        })->with('items', 'restaurant.region', 'restaurant.categories', 'payment_method', 'client')
            ->latest()->paginate(10);
        return responseJson('1', $my_orders);
    }

    public function showOrder(Request $request)
    {
        $order = Order::with('items', 'restaurant.region', 'restaurant.categories', 'payment_method', 'client')
            ->find($request->order_id);
        return responseJson('1', $order);
    }

    public function latestOrder(Request $request)
    {
        $latest_order = $request->user('client')->orders()
            ->with('items', 'restaurant.region', 'restaurant.categories', 'payment_method', 'client')
            ->latest()->first();
        return responseJson('1', $latest_order);
    }

    public function receivedOrder(Request $request)
    {
        $order = $request->user('client')->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'عفوا لا يمكن الحصول علي معلومات عن الطلب');
        }
        if ($order->status != 'accepted') {
            return responseJson(0, 'عفوا لا يمكن تأكيد استلام الطلب , لم يتم قبول الطلب من المطعم');
        }

        $update = $order->update([
            'status' => 'received',
            'client_delivery_confirm' => 1,
        ]);
        $restaurant = $order->restaurant;

        // notification create for restaurant In Database
        $notification = $restaurant->notifications()->create([
            'title' => 'تأكيد توصيل الطلب للعميل',
            'content' => 'تم توصيل الطلب رقم ' . $order->id . ' للعميل ' . $order->client->name,
            'order_id' => $order->id,
        ]);

        // Send Notification To Mobile By Using Firebase ( google FCM )
        $tokens = $restaurant->tokens()->where('token','!=',null)->pluck('token')->toArray();
        //$tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
        $title = $notification->title;
        $body = $notification->content;
        $data = [
            'order_id' => $order->id,
            'user_type' => 'restaurant',
        ];
        $send = notifyByFirebase($title, $body, $tokens, $data, true);
        info("firebase result: " . $send);

        $data = ['order' => $order->fresh()->load('items')];
        return responseJson(1, 'تم تأكيد استلام الطلب بنجاح', $data);
    }

    public function refusedOrder(Request $request)
    {
        $order = $request->user('client')->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'عفوا لا يمكن الحصول علي معلومات عن الطلب');
        }
        if ($order->status != 'accepted') {
            return responseJson(0, 'عفوا لا يمكن رفض استلام الطلب , لم يتم قبول الطلب من المطعم');
        }
        if ($order->client_delivery_confirm === -1) {
            return responseJson(0, 'تم رفض استلام الطلب');
        }

        $update = $order->update([
            'status' => 'refused',
            'client_delivery_confirm' => -1,
        ]);
        $restaurant = $order->restaurant;

        // notification create for restaurant In Database
        $notification = $restaurant->notifications()->create([
            'title' => 'رفض الطلب من العميل',
            'content' => 'تم رفض استلام الطلب رقم ' . $order->id . ' من العميل ' . $order->client->name,
            'order_id' => $order->id,
        ]);

        // Send Notification To Mobile By Using Firebase ( google FCM )
        $tokens = $restaurant->tokens()->where('token','!=',null)->pluck('token')->toArray();
        //$tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
        $title = $notification->title;
        $body = $notification->content;
        $data = [
            'order_id' => $order->id,
            'user_type' => 'restaurant',
        ];
        $send = notifyByFirebase($title, $body, $tokens, $data, true);
        info("firebase result: " . $send);

        $data = ['order' => $order->fresh()->load('items')];
        return responseJson(1, 'تم رفض استلام الطلب', $data);
    }

    public function review(Request $request)
    {
        $rules = [
            'comment' => 'required',
            'rate' => 'required|numeric|min:1|max:5',
            'restaurant_id' => 'required|exists:restaurants,id',
        ];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }

        // get restaurant by id
        $restaurant = Restaurant::find($request->restaurant_id);
        if (!$restaurant) {
            return responseJson(0, 'لا يمكن الحصول علي معلومات');
        }

        $checkClientOrdersCount = $request->user('client')->orders()
            ->where('restaurant_id', $request->restaurant_id)
            ->where('status', 'accepted')->count();
        if ($checkClientOrdersCount == 0) {
            return responseJson(0, 'لا يمكن تقييم المطعم الا بعد تنفيذ عمليه شراء واحده منه علي ألأقل');
        }

        $checkClientOrders = $request->user('client')->orders()->where('restaurant_id', $request->restaurant_id)
            ->where('status', 'received')->orWhere('status', 'refused')->count();
        if ($checkClientOrders < 0) {
            return responseJson(0, 'لا يمكن تقييم المطعم الا بعد معرفه حاله الاستلام');
        }

        $request->merge(['client_id' => $request->user('client')->id]);
        $review = $restaurant->reviews()->create($request->all());
        return responseJson(1, 'تم أضافه المراجعة بنجاح', $review);
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user('client')->notifications()
            ->with('order.restaurant.region.city','order.client.region.city')->latest()->paginate(10);
        return responseJson(1, $notifications);
    }
}
