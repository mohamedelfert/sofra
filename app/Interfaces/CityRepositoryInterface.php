<?php

namespace App\Interfaces;

interface CityRepositoryInterface
{
    public function getAllCities();

    public function storeCity($request);

    public function updateCity($request);

    public function deleteCity($request);
}
