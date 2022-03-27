<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.restaurants');
        $restaurants = Restaurant::all();
        return view('admin.restaurants.index', compact('title', 'restaurants'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $title = trans('main.restaurants');
        return view('admin.restaurants.restaurant', compact('title', 'restaurant'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Restaurant::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $restaurants = Restaurant::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.restaurants');
        return view('admin.restaurants.index', compact('title', 'restaurants','start_at','end_at'));
    }

    public function statusFilter(Request $request)
    {
        $id = $request->id;
        $restaurants = Restaurant::select('*')->where('status',$id)->get();
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
