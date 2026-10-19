<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use App\Models\Service;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\Contact;

class FrontController extends Controller
{
    // Halaman Beranda
    public function index()
    {
        $profil  = CompanyProfile::first();
        $layanan = Service::where('status', 'publik')->latest()->get();
        $artikel = Article::where('status', 'publik')->latest()->get();
        $galeri  = Gallery::where('status', 'publik')->latest()->get();
        
        return view('frontend.home', compact('profil', 'layanan', 'artikel', 'galeri'));
    }

    // Halaman Profil Perusahaan
    public function profil()
    {
        $profil = CompanyProfile::first(); 
        return view('frontend.profil', compact('profil'));
    }

    // Halaman Layanan (Dilengkapi Kategori, Search & Pagination)
    public function layanan(Request $request)
    {
        $keyword  = $request->input('cari');
        $kategori = $request->input('kategori');
        
        $layanan = Service::where('status', 'publik')
            // Filter berdasarkan Kategori jika dipilih
            ->when($kategori, function($query, $kategori) {
                return $query->where('kategori', $kategori);
            })
            // Filter berdasarkan Pencarian jika ada
            ->when($keyword, function($query, $keyword) {
                return $query->where(function($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('deskripsi', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('frontend.layanan', compact('layanan'));
    }

    // Halaman Detail Layanan
    public function detailLayanan($id)
    {
        $layanan = Service::where('status', 'publik')->findOrFail($id);
        return view('frontend.layanan-detail', compact('layanan'));
    }

    // Halaman Artikel (Dilengkapi Search & Pagination)
    public function artikel(Request $request)
    {
        $keyword = $request->input('cari');

        $artikel = Article::where('status', 'publik')
            ->when($keyword, function($query, $keyword) {
                return $query->where('judul', 'like', "%{$keyword}%")
                             ->orWhere('konten', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('frontend.artikel', compact('artikel'));
    }

    // Halaman Detail Artikel (Baca Selengkapnya)
    public function detailArtikel($id)
    {
        $artikel = Article::where('status', 'publik')->findOrFail($id);
        return view('frontend.artikel-detail', compact('artikel'));
    }

    // Halaman Galeri (Dilengkapi Search & Pagination)
    public function galeri(Request $request)
    {
        $keyword = $request->input('cari');

        $galeri = Gallery::where('status', 'publik')
            ->when($keyword, function($query, $keyword) {
                return $query->where('judul', 'like', "%{$keyword}%")
                             ->orWhere('deskripsi', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('frontend.galeri', compact('galeri'));
    }

    // Menampilkan Halaman Kontak Kami
    public function kontak()
    {
        return view('frontend.kontak');
    }

    // Menyimpan Pesan & Penilaian dari Kontak Kami
    public function storeKontak(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'email'  => 'required|email|max:255',
            'subjek' => 'required|string|max:255', 
            'pesan'  => 'required|string', // Wajib diisi
        ]);

        Contact::create([
            'nama'   => $request->nama,
            'email'  => $request->email,
            'subjek' => $request->subjek,
            'pesan'  => $request->pesan,
            'status' => 'unread',
        ]);

        return redirect()->route('front.kontak')->with('success', 'Pesan konsultasi layanan Anda berhasil dikirim!');
    }
}