<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfferController extends Controller
{
    private $offerRepository;

    public function __construct(OfferRepositoryInterface $offerRepository)
    {
        $this->offerRepository = $offerRepository;
    }

    public function index()
    {
        return $this->offerRepository->getAllOffers();
    }

    public function show($id)
    {
        return $this->offerRepository->showOffer($id);
    }

    public function destroy(Request $request)
    {
        return $this->offerRepository->deleteOffer($request);
    }

    public function filter(Request $request)
    {
        return $this->offerRepository->filter($request);
    }
}
