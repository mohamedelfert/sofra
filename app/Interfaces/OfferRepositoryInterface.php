<?php

namespace App\Interfaces;

interface OfferRepositoryInterface
{
    public function getAllOffers();

    public function showOffer($id);

    public function deleteOffer($request);

    public function filter($request);
}
