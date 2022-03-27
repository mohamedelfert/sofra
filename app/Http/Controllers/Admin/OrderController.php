<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.orders');
        $orders = Order::all();
        return view('admin.orders.index', compact('title', 'orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $title = trans('main.orders');
        return view('admin.orders.order', compact('title', 'order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Order::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $orders = Order::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.orders');
        return view('admin.orders.index', compact('title', 'orders', 'start_at', 'end_at'));
    }

    public function filterStatus(Request $request)
    {
        $id = $request->id;
        $orders = Order::select('*')->where('status', $id)->get();
        $title = trans('main.orders');
        return view('admin.orders.index', compact('title', 'orders'));
    }

    public function print_order($id){
        $title = trans('main.orders');
        $order = Order::findOrFail($id);
        return view('admin.orders.show_order',compact('title','order'));
    }
}
