<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function index()
    {
        return $this->transactionRepository->getAllTransactions();
    }

    public function store(Request $request)
    {
        $rules = [
            'amount' => 'required',
            'restaurant_id' => 'required|exists:restaurants,id',
            'date' => 'required|date',
            'notes' => 'required',
        ];
        $validate_msg = [
            'amount.required' => 'يجب كتابه المبلغ',
            'restaurant_id.required' => 'يجب اختيار المطعم',
            'restaurant_id.exists' => 'المطعم غير موجود',
            'date.required' => 'يجب اختيار التاريخ',
            'date.date' => 'التاريخ غير صحيح',
            'notes.required' => 'يجب كتابه ملاحظات',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->transactionRepository->storeTransaction($request);
    }

    public function update(Request $request)
    {
        $rules = [
            'amount' => 'required',
            'restaurant_id' => 'required|exists:restaurants,id',
            'date' => 'required|date',
            'notes' => 'required',
        ];
        $validate_msg = [
            'amount.required' => 'يجب كتابه المبلغ',
            'restaurant_id.required' => 'يجب اختيار المطعم',
            'restaurant_id.exists' => 'المطعم غير موجود',
            'date.required' => 'يجب اختيار التاريخ',
            'date.date' => 'التاريخ غير صحيح',
            'notes.required' => 'يجب كتابه ملاحظات',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->transactionRepository->updateTransaction($request);
    }

    public function destroy(Request $request)
    {
        return $this->transactionRepository->deleteTransaction($request);
    }

    public function filter(Request $request)
    {
        return $this->transactionRepository->filter($request);
    }
}
