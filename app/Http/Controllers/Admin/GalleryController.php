<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.galleries.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.galleries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date'        => 'nullable|date',
            'status'      => 'required|in:draft,publik',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'status']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        $gallery = Gallery::create($data);

        if ($request->filled('date')) {
            $gallery->created_at = $request->date;
            $gallery->save();
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil ditambahkan!');
    }

    public function edit(Gallery $galeri)
    {
        $gallery = $galeri;
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $galeri)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'date'        => 'nullable|date',
            'status'      => 'required|in:draft,publik',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'status']);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        $galeri->update($data);

        if ($request->filled('date')) {
            $galeri->created_at = $request->date;
            $galeri->save();
        }

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil diperbarui!');
    }

    public function destroy(Gallery $galeri)
    {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Foto galeri berhasil dihapus!');
    }
}