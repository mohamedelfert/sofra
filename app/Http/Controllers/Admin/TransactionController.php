<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.transactions');
        $transactions = Transaction::all();
        $restaurants = Restaurant::all();
        return view('admin.transactions.index', compact('title', 'transactions', 'restaurants'));
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

        try {
            $data['amount'] = $request->amount;
            $data['restaurant_id'] = $request->restaurant_id;
            $data['date'] = $request->date;
            $data['notes'] = $request->notes;
            Transaction::create($data);

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

        try {
            $transaction = Transaction::findOrFail($id);
            $data['amount'] = $request->amount;
            $data['restaurant_id'] = $request->restaurant_id;
            $data['date'] = $request->date;
            $data['notes'] = $request->notes;
            $transaction->update($data);

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
        Transaction::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $transactions = Transaction::whereBetween('date', [$start_at, $end_at])->get();
        $restaurants = Restaurant::all();
        $title = trans('main.transactions');
        return view('admin.transactions.index', compact('title', 'transactions', 'restaurants', 'start_at', 'end_at'));
    }
}
