<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Restaurant;
use App\Models\Transaction;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function getAllTransactions()
    {
        $title = trans('main.transactions');
        $transactions = Transaction::all();
        $restaurants = Restaurant::all();
        return view('admin.transactions.index', compact('title', 'transactions', 'restaurants'));
    }

    public function storeTransaction($request)
    {
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

    public function updateTransaction($request)
    {
        $id = $request->id;
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

    public function deleteTransaction($request)
    {
        Transaction::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $transactions = Transaction::whereBetween('date', [$start_at, $end_at])->get();
        $restaurants = Restaurant::all();
        $title = trans('main.transactions');
        return view('admin.transactions.index', compact('title', 'transactions', 'restaurants', 'start_at', 'end_at'));
    }
}
