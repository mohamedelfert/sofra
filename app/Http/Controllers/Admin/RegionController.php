<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\RegionRepositoryInterface;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    private $regionRepository;

    public function __construct(RegionRepositoryInterface $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function index()
    {
        return $this->regionRepository->getAllRegions();
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:regions',
            'city_id' => 'required',
        ];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المنطقه',
            'name.unique' => 'اسم المنطقه مسجل مسبقا',
            'city_id.required' => 'يجب اختيار المدينه التابعه لها',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->regionRepository->storeRegion($request);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules = [
            'name' => 'required|unique:regions,name,' . $id,
            'city_id' => 'required',
        ];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المنطقه',
            'name.unique' => 'اسم المنطقه مسجل مسبقا',
            'city_id.required' => 'يجب اختيار المدينه التابعه لها',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->regionRepository->updateRegion($request);
    }

    public function destroy(Request $request)
    {
        return $this->regionRepository->deleteRegion($request);
    }
}
