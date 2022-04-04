<?php

namespace App\Repositories;

use App\Interfaces\ClientRepositoryInterface;
use App\Models\Client;

class ClientRepository implements ClientRepositoryInterface
{
    public function getAllClients()
    {
        $title = trans('main.clients');
        $clients = Client::all();
        return view('admin.clients.index', compact('title', 'clients'));
    }

    public function deleteClient($request)
    {
        Client::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $clients = Client::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.clients');
        return view('admin.clients.index', compact('title', 'clients', 'start_at', 'end_at'));
    }

    public function activeFilter($request)
    {
        $id = $request->id;
        $clients = Client::select('*')->where('is_active', $id)->get();
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
