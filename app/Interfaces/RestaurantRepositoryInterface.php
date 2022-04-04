<?php

namespace App\Interfaces;

interface RestaurantRepositoryInterface
{
    public function getAllRestaurants();

    public function showRestaurant($id);

    public function deleteRestaurant($request);

    public function filter($request);

    public function statusFilter($request);

    public function activate($id);

    public function deactivate($id);
}
