<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CityRepositoryInterface;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private $cityRepository;

    public function __construct(CityRepositoryInterface $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        return $this->cityRepository->getAllCities();
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:cities'];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المدينة',
            'name.unique' => 'اسم المدينة مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->cityRepository->storeCity($request);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules = ['name' => 'required|unique:cities,name,' . $id];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المدينه',
            'name.unique' => 'اسم المدينه مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->cityRepository->updateCity($request);
    }

    public function destroy(Request $request)
    {
        return $this->cityRepository->deleteCity($request);
    }
}
