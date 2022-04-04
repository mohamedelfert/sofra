<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAllContacts()
    {
        $title = trans('main.contacts');
        $contacts = Contact::paginate(20);
        return view('admin.contacts.index', compact('title', 'contacts'));
    }

    public function showContact($id)
    {
        $contact = Contact::findOrFail($id);
        $title = trans('main.contacts');
        return view('admin.contacts.contact', compact('title', 'contact'));
    }

    public function deleteContact($request)
    {
        Contact::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter($request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $contacts = Contact::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.contacts');
        return view('admin.contacts.index', compact('title', 'contacts', 'start_at', 'end_at'));
    }
}
