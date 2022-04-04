<?php

namespace App\Interfaces;

interface RegionRepositoryInterface
{
    public function getAllRegions();

    public function storeRegion($request);

    public function updateRegion($request);

    public function deleteRegion($request);
}
