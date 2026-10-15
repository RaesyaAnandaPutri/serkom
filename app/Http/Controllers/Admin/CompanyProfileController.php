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
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'vision'      => 'nullable|string',
            'mission'     => 'nullable|string',
            'phone'       => 'required|string|max:50',
            'email'       => 'required|email|max:255',
            'address'     => 'required|string',
            'maps_embed'  => 'nullable|string',
        ]);

        $profile = CompanyProfile::first();

        // Disamakan menggunakan 'telepon' dan 'alamat'
        $data = [
            'name'      => $request->name,
            'deskripsi' => $request->description, 
            'visi'      => $request->vision,      
            'misi'      => $request->mission,     
            'telepon'   => $request->phone,     // Masuk ke kolom 'telepon'
            'email'     => $request->email,
            'alamat'    => $request->address,   // Masuk ke kolom 'alamat'
            'peta'      => $request->maps_embed,      
        ];

        if (!$profile) {
            CompanyProfile::create($data);
        } else {
            $profile->update($data);
        }

        return redirect()->route('admin.profil.edit')->with('success', 'Profil perusahaan berhasil diperbarui!');
    }
}