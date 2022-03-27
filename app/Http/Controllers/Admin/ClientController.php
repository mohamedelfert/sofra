<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.clients');
        $clients = Client::all();
        return view('admin.clients.index', compact('title', 'clients'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Client::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $clients = Client::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.clients');
        return view('admin.clients.index', compact('title', 'clients','start_at','end_at'));
    }

    public function activeFilter(Request $request)
    {
        $id = $request->id;
        $clients = Client::select('*')->where('is_active',$id)->get();
        $title = trans('main.clients');
        return view('admin.clients.index', compact('title', 'clients'));
    }

    public function activate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['is_active' => 1]);
        toastr()->warning(trans('messages.update'));
        return back();
    }

    public function deactivate($id)
    {
        $client = Client::findOrFail($id);
        $client->update(['is_active' => 0]);
        toastr()->warning(trans('messages.update'));
        return back();
    }
}
