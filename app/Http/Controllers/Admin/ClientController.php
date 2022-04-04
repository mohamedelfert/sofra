<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ClientRepositoryInterface;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function index()
    {
        return $this->clientRepository->getAllClients();
    }

    public function destroy(Request $request)
    {
        return $this->clientRepository->deleteClient($request);
    }

    public function filter(Request $request)
    {
        return $this->clientRepository->filter($request);
    }

    public function activeFilter(Request $request)
    {
        return $this->clientRepository->activeFilter($request);
    }

    public function activate($id)
    {
        return $this->clientRepository->activate($id);
    }

    public function deactivate($id)
    {
        return $this->clientRepository->deactivate($id);
    }
}
