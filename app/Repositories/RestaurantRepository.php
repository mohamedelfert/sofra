<?php

namespace App\Repositories;

use App\Interfaces\RestaurantRepositoryInterface;
use App\Models\Restaurant;

class RestaurantRepository implements RestaurantRepositoryInterface
{
    public function getAllRestaurants()
    {
        $title = trans('main.restaurants');
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('title', 'restaurants'));
    }

    public function showRestaurant($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $items = $restaurant->items()->take(6)->get();
        $orders = $restaurant->orders()->take(6)->get();
        $title = trans('main.restaurants');
        return view('admin.restaurants.restaurant', compact('title', 'restaurant', 'items', 'orders'));
    }

    public function deleteRestaurant($request)
    {
        Restaurant::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $restaurants = Restaurant::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.restaurants');
        return view('admin.restaurants.index', compact('title', 'restaurants', 'start_at', 'end_at'));
    }

    public function statusFilter($request)
    {
        $id = $request->id;
        $restaurants = Restaurant::select('*')->where('status', $id)->get();
        $title = trans('main.restaurants');
        return view('admin.restaurants.index', compact('title', 'restaurants'));
    }

    public function activate($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update(['is_active' => 1]);
        toastr()->warning(trans('messages.update'));
        return back();
    }

    public function deactivate($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->update(['is_active' => 0]);
        toastr()->warning(trans('messages.update'));
        return back();
    }
}
