<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ContactRepositoryInterface;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private $contactRepository;

    public function __construct(ContactRepositoryInterface $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function index()
    {
        return $this->contactRepository->getAllContacts();
    }

    public function show($id)
    {
        return $this->contactRepository->showContact($id);
    }

    public function destroy(Request $request)
    {
        return $this->contactRepository->deleteContact($request);
    }

    public function filter(Request $request)
    {
        return $this->contactRepository->filter($request);
    }
}
