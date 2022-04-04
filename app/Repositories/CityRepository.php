<?php

namespace App\Repositories;

use App\Interfaces\CityRepositoryInterface;
use App\Models\City;
use Exception;

class CityRepository implements CityRepositoryInterface
{
    public function getAllCities()
    {
        $title = trans('main.cities');
        $cities = City::all();
        return view('admin.cities.index', compact('title', 'cities'));
    }

    public function storeCity($request)
    {
        try {
            $data['name'] = $request->name;
            City::create($data);

            toastr()->success(trans('messages.success'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function updateCity($request)
    {
        $id = $request->id;
        try {
            $city = City::findOrFail($id);
            $data['name'] = $request->name;
            $city->update($data);

            toastr()->success(trans('messages.update'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function deleteCity($request)
    {
        City::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
