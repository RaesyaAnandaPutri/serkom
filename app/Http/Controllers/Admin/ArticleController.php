<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date'   => 'nullable|date',   // <-- tanggal dari form
            'status' => 'required|in:draft,publik',
        ]);

        $data = $request->only(['judul', 'konten', 'status']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        $article = Article::create($data);

        // Tanggal dari form disimpan ke created_at
        if ($request->filled('date')) {
            $article->created_at = $request->date;
            $article->save();
        }

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit(Article $artikel)
    {
        $article = $artikel;
        return view('admin.articles.edit', compact('article', 'artikel'));
    }

    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'judul'  => 'required|string|max:255',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'date'   => 'nullable|date',   // <-- tanggal dari form
            'status' => 'required|in:draft,publik',
        ]);

        $data = $request->only(['judul', 'konten', 'status']);

        if ($request->hasFile('gambar')) {
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('articles', 'public');
        }

        $artikel->update($data);

        // Tanggal dari form disimpan ke created_at
        if ($request->filled('date')) {
            $artikel->created_at = $request->date;
            $artikel->save();
        }

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->gambar) {
            Storage::disk('public')->delete($artikel->gambar);
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}