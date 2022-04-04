<?php

namespace App\Repositories;

use App\Interfaces\RegionRepositoryInterface;
use App\Models\City;
use App\Models\Region;

class RegionRepository implements RegionRepositoryInterface
{
    public function getAllRegions()
    {
        $title = trans('main.regions');
        $regions = Region::all();
        $cities = City::all();
        return view('admin.regions.index', compact('title', 'regions', 'cities'));
    }

    public function storeRegion($request)
    {
        try {
            $data['name'] = $request->name;
            $data['city_id'] = $request->city_id;
            Region::create($data);

            toastr()->success(trans('messages.success'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function updateRegion($request)
    {
        $id = $request->id;
        try {
            $region = Region::findOrFail($id);
            $data['name'] = $request->name;
            $data['city_id'] = $request->city_id;
            $region->update($data);

            toastr()->success(trans('messages.update'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function deleteRegion($request)
    {
        Region::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
