<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.regions');
        $regions = Region::all();
        $cities = City::all();
        return view('admin.regions.index', compact('title', 'regions', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Region::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
