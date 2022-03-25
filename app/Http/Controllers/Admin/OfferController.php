<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.offers');
        $offers = Offer::paginate(20);
        return view('admin.offers.index', compact('title', 'offers'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        $title = trans('main.offers');
        return view('admin.offers.offer', compact('title', 'offer'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Offer::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $offers = Offer::whereBetween('start_at', [$start_at, $end_at])->get();
        $title = trans('main.offers');
        return view('admin.offers.index', compact('title', 'offers','start_at','end_at'));
    }
}
