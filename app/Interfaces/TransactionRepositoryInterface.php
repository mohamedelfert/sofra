<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function getAllTransactions();

    public function storeTransaction($request);

    public function updateTransaction($request);

    public function deleteTransaction($request);

    public function filter($request);

}
