<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PaymentMethodRepositoryInterface;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    private $paymentMethodRepository;

    public function __construct(PaymentMethodRepositoryInterface $paymentMethodRepository)
    {
        $this->paymentMethodRepository = $paymentMethodRepository;
    }

    public function index()
    {
        return $this->paymentMethodRepository->getAllPaymentMethod();
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:payment_methods'];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم طريقه الدفع',
            'name.unique' => 'اسم طريقه الدفع مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->paymentMethodRepository->storePaymentMethod($request);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules = ['name' => 'required|unique:payment_methods,name,' . $id];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم طريقه الدفع',
            'name.unique' => 'اسم طريقه الدفع مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->paymentMethodRepository->updatePaymentMethod($request);
    }

    public function destroy(Request $request)
    {
        return $this->paymentMethodRepository->deletePaymentMethod($request);
    }
}
