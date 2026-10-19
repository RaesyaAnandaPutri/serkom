<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Menampilkan daftar pesan di admin
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }

    // Menampilkan detail pesan masuk
    public function show(Contact $kontak)
    {
        if ($kontak->status == 'unread') {
            $kontak->update(['status' => 'read']);
        }

        $contact = $kontak;
        return view('admin.contacts.show', compact('contact'));
    }

    // Menghapus pesan kontak
    public function destroy(Contact $kontak)
    {
        $kontak->delete();

        return redirect()->route('admin.kontak.index')->with('success', 'Pesan kontak berhasil dihapus!');
    }
}