<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.cities');
        $cities = City::all();
        return view('admin.cities.index', compact('title', 'cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:cities'];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المدينة',
            'name.unique' => 'اسم المدينة مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        try {
            $data['name'] = $request->name;
            City::create($data);

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
        $rules = ['name' => 'required|unique:cities,name,' . $id];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم المدينه',
            'name.unique' => 'اسم المدينه مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        City::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
