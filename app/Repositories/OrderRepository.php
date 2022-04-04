<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAllOrders()
    {
        $title = trans('main.orders');
        $orders = Order::all();
        return view('admin.orders.index', compact('title', 'orders'));
    }

    public function showOrder($id)
    {
        $order = Order::findOrFail($id);
        $title = trans('main.orders');
        return view('admin.orders.order', compact('title', 'order'));
    }

    public function deleteOrder($request)
    {
        Order::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $orders = Order::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.orders');
        return view('admin.orders.index', compact('title', 'orders', 'start_at', 'end_at'));
    }

    public function filterStatus($request)
    {
        $id = $request->id;
        $orders = Order::select('*')->where('status', $id)->get();
        $title = trans('main.orders');
        return view('admin.orders.index', compact('title', 'orders'));
    }

    public function print_order($id)
    {
        $title = trans('main.orders');
        $order = Order::findOrFail($id);
        return view('admin.orders.show_order', compact('title', 'order'));
    }
}
