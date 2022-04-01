<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /****************************************** Items ****************************************************/
    public function myItems(Request $request)
    {
//        $items = $request->user('restaurant')->items()->where('status','enabled')->latest()->paginate(10);
//        return responseJson(1, 'Success', $items);
        $restaurant = Restaurant::find($request->restaurant_id);
        $items = $restaurant->items()->where('status', 'enabled')->latest()->paginate(10);
        return responseJson(1, 'Success', $items);
    }

    public function addItem(Request $request)
    {
        $rules = [
            'name' => 'required|unique:items',
            'description' => 'required',
            'price' => 'required',
            'offer_price' => 'required',
            'preparing_time' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $item = $request->user('restaurant')->items()->create(request()->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/items/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath . $item->name, $file_name);
            $item->update(['image' => 'uploads/items/' . $item->name .'/'. $file_name]);
        }
        return responseJson(1, 'تم ألأضافه بنجاح', ['data' => $item->load('restaurant')]);
    }

    public function updateItem(Request $request)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'offer_price' => 'required',
            'preparing_time' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $item = $request->user('restaurant')->items()->find($request->id);
        if (!$item) {
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }
        $item->update($request->all());
        if ($request->hasFile('image')) {
            $item->where('id', $request->id)->first();
            if (!empty($item->name)) {
                Storage::disk('public_path')->deleteDirectory('items/' . $item->name);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/items/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath . $item->name, $file_name);
            $item->update(['image' => 'uploads/items/' . $item->name .'/'. $file_name]);
        }
        return responseJson(1, 'تم التحديث بنجاح', ['data' => $item->load('restaurant')]);
    }

    public function deleteItem(Request $request)
    {
        $item = $request->user('restaurant')->items()->find($request->id);
        if (!$item) {
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }

        if (count($item->orders) > 0) {
            return responseJson(0, 'يوجد طلب مرتبط به');
        }

        if (!empty($item->name)) {
            Storage::disk('public_path')->deleteDirectory('items/' . $item->name);
        }
        $item->delete();
        return responseJson(1, 'تم الحذف بنجاح');
    }
    /****************************************** Items ****************************************************/

    /****************************************** Offers ****************************************************/
    public function myOffers(Request $request)
    {
        $offers = $request->user('restaurant')->offers()->where('status', 'available')->latest()->paginate(10);
        return responseJson(1, 'Success', $offers);
//        $restaurant = Restaurant::find($request->restaurant_id);
//        $offers = $restaurant->offers()->where('status','available')->latest()->paginate(10);
//        return responseJson(1, 'Success', $offers);
    }

    public function addOffer(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $offer = $request->user('restaurant')->offers()->create(request()->all());
        if ($request->hasFile('image')) {
            $path = public_path();
            $destinationPath = $path . '/uploads/offers/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath . $offer->title, $file_name);
            $offer->update(['image' => 'uploads/offers/' . $offer->title .'/'. $file_name]);
        }
        return responseJson(1, 'تم ألأضافه بنجاح', ['data' => $offer->load('restaurant')]);
    }

    public function updateOffer(Request $request)
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ];
        $validate = Validator::make(request()->all(), $rules);
        if ($validate->fails()) {
            return responseJson(0, $validate->errors());
        }
        $offer = $request->user('restaurant')->offers()->find($request->id);
        if (!$offer) {
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }
        $offer->update($request->all());
        if ($request->hasFile('image')) {
            $offer->where('id', $request->id)->first();
            if (!empty($offer->title)) {
                Storage::disk('public_path')->deleteDirectory('offers/' . $offer->title);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/offers/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath . $offer->title, $file_name);
            $offer->update(['image' => 'uploads/offers/' . $offer->title .'/'. $file_name]);
        }
        return responseJson(1, 'تم التحديث بنجاح', ['data' => $offer->load('restaurant')]);
    }

    public function deleteOffer(Request $request)
    {
        $offer = $request->user('restaurant')->offers()->find($request->id);
        if (!$offer) {
            return responseJson(0, 'تعذر الحصول علي البيانات المطلوبة');
        }

        if (!empty($offer->title)) {
            Storage::disk('public_path')->deleteDirectory('offers/' . $offer->title);
        }
        $offer->delete();
        return responseJson(1, 'تم الحذف بنجاح');
    }
    /****************************************** Offers ****************************************************/

    /****************************************** Orders ****************************************************/
    public function myOrders(Request $request)
    {
        $my_orders = $request->user('restaurant')->orders()->where(function ($order) use ($request) {
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

    public function acceptedOrder(Request $request)
    {
        $order = $request->user('restaurant')->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'عفوا لا يمكن الحصول علي معلومات عن الطلب');
        }
        if ($order->status == 'accepted') {
            return responseJson(1, 'تم قبول الطلب');
        }

        $update = $order->update(['status' => 'accepted']);
        $client = $order->client;

        // notification create for restaurant In Database
        $notification = $client->notifications()->create([
            'title' => 'قبول الطلب',
            'content' => 'تم قبول الطلب رقم ' . $order->id . ' من المطعم ' . $order->restaurant->name,
            'order_id' => $order->id,
        ]);

        // Send Notification To Mobile By Using Firebase ( google FCM )
        $tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
        $title = $notification->title;
        $body = $notification->content;
        $data = [
            'order_id' => $order->id,
            'user_type' => 'client',
        ];
        $send = notifyByFirebase($title, $body, $tokens, $data, true);
        info("firebase result: " . $send);

        $data = ['order' => $order->fresh()->load('items')];
        return responseJson(1, 'تم قبول الطلب', $data);
    }

    public function rejectedOrder(Request $request)
    {
        $order = $request->user('restaurant')->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'عفوا لا يمكن الحصول علي معلومات عن الطلب');
        }
        if ($order->status == 'rejected') {
            return responseJson(1, 'تم رفض هذا الطلب');
        }

        $update = $order->update(['status' => 'rejected']);
        $client = $order->client;

        // notification create for restaurant In Database
        $notification = $client->notifications()->create([
            'title' => 'رفض الطلب',
            'content' => 'تم رفض الطلب رقم ' . $order->id . ' من المطعم ' . $order->restaurant->name,
            'order_id' => $order->id,
        ]);

        // Send Notification To Mobile By Using Firebase ( google FCM )
        $tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
        $title = $notification->title;
        $body = $notification->content;
        $data = [
            'order_id' => $order->id,
            'user_type' => 'client',
        ];
        $send = notifyByFirebase($title, $body, $tokens, $data, true);
        info("firebase result: " . $send);

        $data = ['order' => $order->fresh()->load('items')];
        return responseJson(1, 'تم رفض الطلب', $data);
    }

    public function confirmOrder(Request $request)
    {
        $order = $request->user('restaurant')->orders()->find($request->order_id);

        if (!$order) {
            return responseJson(0, 'عفوا لا يمكن الحصول علي معلومات عن الطلب');
        }
//        if ($order->status != 'accepted') {
//            return responseJson(0, 'عفوا لا يمكن تأكيد استلام الطلب , لم يتم قبول الطلب من المطعم');
//        }
        if ($order->status === 'received') {
            $update = $order->update([
                'status' => 'completed',
                'client_delivery_confirm' => 1,
                'restaurant_delivery_confirm' => 1,
            ]);
            $client = $order->client;

            // notification create for restaurant In Database
            $notification = $client->notifications()->create([
                'title' => 'تأكيد توصيل وانهاء الطلب',
                'content' => 'تم توصيل الطلب رقم ' . $order->id . ' للعميل ' . $order->client->name,
                'order_id' => $order->id,
            ]);

            // Send Notification To Mobile By Using Firebase ( google FCM )
            $tokens = ['0' => 'fSamI-TDQFCmAoZCBaMhmE:APA91bFAo08rPwdMHDNyu7qR2Vyizksg60FsmTtkRgAWyK9mjunqQci8EjLMaQsoMBJHz9xVCcIlccn4wHmw9EZKgz_4Gq_UwumZptGS62YiJJNppuY1kebDZH24MV6j4mqifU6-eoN8'];
            $title = $notification->title;
            $body = $notification->content;
            $data = [
                'order_id' => $order->id,
                'user_type' => 'client',
            ];
            $send = notifyByFirebase($title, $body, $tokens, $data, true);
            info("firebase result: " . $send);

            $data = ['order' => $order->fresh()->load('items')];
            return responseJson(1, 'تم تأكيد الاستلام', $data);
        }
    }

    /****************************************** Orders ****************************************************/
    public function restaurantStatus(Request $request)
    {
        $rules = ['status' => 'required|in:open,close'];
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return responseJson(2, $validate->errors());
        }
        $request->user('restaurant')->update(['status' => $request->status]);
        return responseJson(1, $request->user('restaurant'));
    }

    public function notifications(Request $request)
    {
        $notifications = $request->user('restaurant')->notifications()->with('order.restaurant')
            ->latest()->paginate(10);
        return responseJson(1, $notifications);
    }

    public function commission(Request $request)
    {
        $ordersCompletedCount = $request->user('restaurant')->orders()->where('status', 'completed')->count();
        $ordersCompletedCommission = $request->user('restaurant')->orders()->where('status', 'completed')
            ->sum('commission');
        $ordersCompletedCost = $request->user('restaurant')->orders()->where('status', 'completed')->sum('cost');
        $restaurantTransactions = $request->user('restaurant')->transactions()->sum('amount');
        $remaining = $ordersCompletedCommission - $restaurantTransactions;
        $commission = [
            'orderCount' => $ordersCompletedCount,
            'orderCompletedCommission' => $ordersCompletedCommission,
            'cost' => $ordersCompletedCost,
            'transactions' => $restaurantTransactions,
            'remaining' => $remaining
        ];
        return responseJson(1, 'success', $commission);
    }
}
