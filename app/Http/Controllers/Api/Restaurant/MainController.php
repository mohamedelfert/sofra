<?php

namespace App\Http\Controllers\Api\Restaurant;

use App\Http\Controllers\Controller;
use App\Models\Item;
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
        $items = $restaurant->items()->where('status','enabled')->latest()->paginate(10);
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
            $file->move($destinationPath.$item->name, $file_name);
            $item->update(['image' => 'uploads/items/' . $file_name]);
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
        if (!$item){
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }
        $item->update($request->all());
        if ($request->hasFile('image')) {
            $item->where('id',$request->id)->first();
            if (!empty($item->name)){
                Storage::disk('public_path')->deleteDirectory('items/'.$item->name);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/items/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath.$item->name, $file_name);
            $item->update(['image' => 'uploads/items/' . $file_name]);
        }
        return responseJson(1, 'تم التحديث بنجاح', ['data' => $item->load('restaurant')]);
    }

    public function deleteItem(Request $request)
    {
        $item = $request->user('restaurant')->items()->find($request->id);
        if (!$item){
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }

        if (count($item->orders) > 0){
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
        $offers = $request->user('restaurant')->offers()->where('status','available')->latest()->paginate(10);
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
            $file->move($destinationPath.$offer->title, $file_name);
            $offer->update(['image' => 'uploads/offers/' . $file_name]);
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
        if (!$offer){
            return responseJson(0, 'تعذر الحصول علي بيانات المنتج');
        }
        $offer->update($request->all());
        if ($request->hasFile('image')) {
            $offer->where('id',$request->id)->first();
            if (!empty($offer->title)){
                Storage::disk('public_path')->deleteDirectory('offers/'.$offer->title);
            }
            $path = public_path();
            $destinationPath = $path . '/uploads/offers/';
            $file = $request->file('image');
            $file_name = time() . $file->getClientOriginalName();
            $file->move($destinationPath.$offer->title, $file_name);
            $offer->update(['image' => 'uploads/offers/' . $file_name]);
        }
        return responseJson(1, 'تم التحديث بنجاح', ['data' => $offer->load('restaurant')]);
    }

    public function deleteOffer(Request $request)
    {
        $offer = $request->user('restaurant')->offers()->find($request->id);
        if (!$offer){
            return responseJson(0, 'تعذر الحصول علي البيانات المطلوبة');
        }

        if (!empty($offer->title)) {
            Storage::disk('public_path')->deleteDirectory('offers/' . $offer->title);
        }
        $offer->delete();
        return responseJson(1, 'تم الحذف بنجاح');
    }
    /****************************************** Offers ****************************************************/
}
