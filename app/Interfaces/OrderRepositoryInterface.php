<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAllOrders();

    public function showOrder($id);

    public function deleteOrder($request);

    public function filter($request);

    public function filterStatus($request);

    public function print_order($id);
}
