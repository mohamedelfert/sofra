<?php

namespace App\Repositories;

use App\Interfaces\OfferRepositoryInterface;
use App\Models\Offer;

class OfferRepository implements OfferRepositoryInterface
{
    public function getAllOffers()
    {
        $title = trans('main.offers');
        $offers = Offer::paginate(20);
        return view('admin.offers.index', compact('title', 'offers'));
    }

    public function showOffer($id)
    {
        $offer = Offer::findOrFail($id);
        $title = trans('main.offers');
        return view('admin.offers.offer', compact('title', 'offer'));
    }

    public function deleteOffer($request)
    {
        Offer::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $offers = Offer::whereBetween('start_at', [$start_at, $end_at])->get();
        $title = trans('main.offers');
        return view('admin.offers.index', compact('title', 'offers', 'start_at', 'end_at'));
    }
}
