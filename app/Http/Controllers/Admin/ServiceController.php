<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|in:Web Development,Mobile Apps,Sistem Informasi,IT Consulting & Cloud',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date'      => 'nullable|date',
            'status'    => 'required|in:draft,publik',
        ]);

        $data = $request->only(['nama', 'kategori', 'deskripsi', 'status']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('services', 'public');
        }

        $service = Service::create($data);

        if ($request->filled('date')) {
            $service->created_at = $request->date;
            $service->save();
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    // Nama parameter ($service) harus sama dengan {service} di route
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'kategori'  => 'required|in:Web Development,Mobile Apps,Sistem Informasi,IT Consulting & Cloud',
            'deskripsi' => 'required|string',
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date'      => 'nullable|date',
            'status'    => 'required|in:draft,publik',
        ]);

        $data = $request->only(['nama', 'kategori', 'deskripsi', 'status']);

        if ($request->hasFile('gambar')) {
            if ($service->gambar && Storage::disk('public')->exists($service->gambar)) {
                Storage::disk('public')->delete($service->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('services', 'public');
        }

        $service->update($data);

        if ($request->filled('date')) {
            $service->created_at = $request->date;
            $service->save();
        }

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    public function destroy(Service $service)
    {
        if ($service->gambar && Storage::disk('public')->exists($service->gambar)) {
            Storage::disk('public')->delete($service->gambar);
        }

        $service->delete();

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil dihapus!');
    }
}