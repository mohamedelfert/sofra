<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Contact;
use App\Models\Item;
use App\Models\Offer;
use App\Models\PaymentMethod;
use App\Models\Region;
use App\Models\Restaurant;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function cities(Request $request)
    {
        $cities = City::where(function ($q) use ($request) {
            if ($request->has('name')) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->paginate(10);
        return responseJson(1, 'Success', $cities);
    }

    public function regions(Request $request)
    {
        $regions = Region::where(function ($q) use ($request) {
            if ($request->has('name')) {
                $q->where('name', 'LIKE', '%' . $request->name . '%');
            }
        })->where('city_id', $request->city_id)->paginate(10);
        return responseJson(1, 'Success', $regions);
    }

    public function categories()
    {
        $categories = Category::with('restaurant')->get();
        return responseJson(1, 'Success', $categories);
    }

    public function paymentMethods()
    {
        $payment_methods = PaymentMethod::all();
        return responseJson(1, 'Success', $payment_methods);
    }

    public function restaurants(Request $request)
    {
        $restaurants = Restaurant::where(function ($q) use ($request) {
            if ($request->has('keyword')) {
                $q->where('name', 'LIKE', '%' . $request->keyword . '%');
            }

            if ($request->has('region_id')) {
                $q->where('region_id', $request->region_id);
            }

            if ($request->has('category_id')) {
                $q->where('category_id', $request->category_id);
            }

            if ($request->has('status')) {
                $q->where('status', $request->status);
            }
        })->has('items')->with('region', 'categories')->where('is_active', '1')->paginate(10);
        return responseJson(1, 'Success', $restaurants);
    }

    public function restaurant(Request $request)
    {
        $restaurant = Restaurant::with('region', 'categories', 'items')->where('is_active', '1')
            ->findOrFail($request->restaurant_id);
        return responseJson(1, 'Success', $restaurant);
    }

    public function reviews(Request $request)
    {
        $restaurant = Restaurant::findOrFail($request->restaurant_id);
        if (!$restaurant) {
            return responseJson(1, 'No Data Found');
        }
        $reviews = $restaurant->reviews()->with('restaurant', 'client')->paginate(10);
        return responseJson(1, 'Success', $reviews);
    }

    public function items(Request $request)
    {
        $items = Item::where('restaurant_id', $request->restaurant_id)->where('status', 'enabled')->paginate(10);
        return responseJson(1, 'Success', $items);
    }

    public function offers(Request $request)
    {
        $offers = Offer::where(function ($q) use ($request) {
            if ($request->has('restaurant_id')) {
                $q->where('restaurant_id', $request->restaurant_id);
            }
        })->with('restaurant')->latest()->paginate(10);
        return responseJson(1, 'Success', $offers);
    }

    public function offer(Request $request)
    {
        $offer = Offer::with('restaurant')->findOrFail($request->offer_id);
        if (!$offer) {
            return responseJson(1, 'No Data Found');
        }
        return responseJson(1, 'Success', $offer);
    }

    public function contacts()
    {
        $contacts = Contact::paginate(10);
        return responseJson(1, 'Success', $contacts);
    }

    public function add_contact(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'message' => 'required',
            'type' => 'required|in:complaint,suggestion,inquiry',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        $data = Contact::create($request->all());

        return responseJson(1,'تم الإرسال بنجاح',$data);
    }

    public function settings()
    {
        $settings = Setting::find(1);

        if (!$settings) {
            return responseJson(0, 'عفوا حدث خطأ أثناء عرض الإعدادات');
        }

        return responseJson(1, 'Success', $settings);
    }

}
