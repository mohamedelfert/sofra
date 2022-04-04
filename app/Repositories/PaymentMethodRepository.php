<?php

namespace App\Repositories;

use App\Interfaces\PaymentMethodRepositoryInterface;
use App\Models\PaymentMethod;

class PaymentMethodRepository implements PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethod()
    {
        $title = trans('main.payment_methods');
        $paymentMethods = PaymentMethod::all();
        return view('admin.paymentMethods.index', compact('title', 'paymentMethods'));
    }

    public function storePaymentMethod($request)
    {
        try {
            $data['name'] = $request->name;
            PaymentMethod::create($data);

            toastr()->success(trans('messages.success'));
            return back();

        } catch (Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function updatePaymentMethod($request)
    {
        $id = $request->id;
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

    public function deletePaymentMethod($request)
    {
        PaymentMethod::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
