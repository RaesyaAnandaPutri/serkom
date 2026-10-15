<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $kontak)
    {
        if ($kontak->status == 'unread') {
            $kontak->update(['status' => 'read']);
        }

        $contact = $kontak;
        return view('admin.contacts.show', compact('contact'));
    }

    public function destroy(Contact $kontak)
    {
        $kontak->delete();

        return redirect()->route('admin.kontak.index')->with('success', 'Pesan kontak berhasil dihapus!');
    }
}