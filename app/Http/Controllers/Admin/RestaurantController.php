<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RestaurantRepositoryInterface;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    private $restaurantRepository;

    public function __construct(RestaurantRepositoryInterface $restaurantRepository)
    {
        $this->restaurantRepository = $restaurantRepository;
    }

    public function index()
    {
        return $this->restaurantRepository->getAllRestaurants();
    }

    public function show($id)
    {
        return $this->restaurantRepository->showRestaurant($id);
    }

    public function destroy(Request $request)
    {
        return $this->restaurantRepository->deleteRestaurant($request);
    }

    public function filter(Request $request)
    {
        return $this->restaurantRepository->filter($request);
    }

    public function statusFilter(Request $request)
    {
        return $this->restaurantRepository->statusFilter($request);
    }

    public function activate($id)
    {
        return $this->restaurantRepository->activate($id);
    }

    public function deactivate($id)
    {
        return $this->restaurantRepository->deactivate($id);
    }
}
