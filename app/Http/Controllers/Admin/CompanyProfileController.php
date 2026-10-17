<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;

class CompanyProfileController extends Controller
{
    public function edit()
    {
        $profile = CompanyProfile::first() ?? new CompanyProfile();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        // Nama field di form = nama kolom di database
        $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'visi'      => 'nullable|string',
            'misi'      => 'nullable|string',
            'telepon'   => 'required|string|max:50',
            'email'     => 'required|email|max:255',
            'alamat'    => 'required|string',
            'peta'      => 'nullable|string',
        ]);

        $data = $request->only([
            'nama', 'deskripsi', 'visi', 'misi',
            'telepon', 'email', 'alamat', 'peta',
        ]);

        // Kolom visi, misi, dan peta di database tidak boleh NULL,
        // jadi kalau dikosongkan di form, simpan sebagai teks kosong
        foreach (['visi', 'misi', 'peta'] as $kolom) {
            $data[$kolom] = $data[$kolom] ?? '';
        }

        $profile = CompanyProfile::first();

        if ($profile) {
            $profile->update($data);
        } else {
            CompanyProfile::create($data);
        }

        return redirect()->route('admin.profil.edit')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}