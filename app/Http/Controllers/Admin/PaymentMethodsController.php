<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.payment_methods');
        $paymentMethods = PaymentMethod::all();
        return view('admin.paymentMethods.index', compact('title', 'paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:payment_methods'];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم طريقه الدفع',
            'name.unique' => 'اسم طريقه الدفع مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        try {
            $data['name'] = $request->name;
            PaymentMethod::create($data);

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
        $rules = ['name' => 'required|unique:payment_methods,name,' . $id];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم طريقه الدفع',
            'name.unique' => 'اسم طريقه الدفع مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        try {
            $paymentMethod = PaymentMethod::findOrFail($id);
            $data['name'] = $request->name;
            $paymentMethod->update($data);

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
        PaymentMethod::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
