<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OrderRepositoryInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function show($id)
    {
        return $this->orderRepository->showOrder($id);
    }

    public function destroy(Request $request)
    {
        return $this->orderRepository->deleteOrder($request);
    }

    public function filter(Request $request)
    {
        return $this->orderRepository->filter($request);
    }

    public function filterStatus(Request $request)
    {
        return $this->orderRepository->filterStatus($request);
    }

    public function print_order($id)
    {
        return $this->orderRepository->print_order($id);
    }
}
