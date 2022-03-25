<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $title = trans('main.contacts');
        $contacts = Contact::paginate(20);
        return view('admin.contacts.index', compact('title', 'contacts'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $title = trans('main.contacts');
        return view('admin.contacts.contact', compact('title', 'contact'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Request $request)
    {
        Contact::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }

    public function filter(Request $request)
    {
        $start_at = date($request->start_at);
        $end_at = date($request->end_at);
        $contacts = Contact::whereBetween('created_at', [$start_at, $end_at])->get();
        $title = trans('main.contacts');
        return view('admin.contacts.index', compact('title', 'contacts','start_at','end_at'));
    }
}
