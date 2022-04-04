<?php

namespace App\Interfaces;

interface ClientRepositoryInterface
{
    public function getAllClients();

    public function deleteClient($request);

    public function filter($request);

    public function activeFilter($request);

    public function activate($id);

    public function deactivate($id);
}
