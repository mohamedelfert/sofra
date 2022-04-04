<?php

namespace App\Interfaces;

interface ContactRepositoryInterface
{
    public function getAllContacts();

    public function showContact($id);

    public function deleteContact($request);

    public function filter($request);
}
