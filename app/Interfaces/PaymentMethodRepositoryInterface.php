<?php

namespace App\Interfaces;

interface PaymentMethodRepositoryInterface
{
    public function getAllPaymentMethod();

    public function storePaymentMethod($request);

    public function updatePaymentMethod($request);

    public function deletePaymentMethod($request);
}
