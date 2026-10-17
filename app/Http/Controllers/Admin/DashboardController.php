<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Article;
use App\Models\Gallery;
use App\Models\CompanyProfile;

class DashboardController extends Controller
{
    public function index()
    {
        // Variabel penghitung dan data terbaru menggunakan bahasa Indonesia
        $jumlahLayanan = Service::count();
        $jumlahArtikel = Article::where('status', 'publik')->count();
        $jumlahGaleri = Gallery::count();

        $profil = CompanyProfile::first();
        $layananTerbaru = Service::latest()->take(3)->get();
        $artikelTerbaru = Article::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'jumlahLayanan',
            'jumlahArtikel',
            'jumlahGaleri',
            'profil',
            'layananTerbaru',
            'artikelTerbaru'
        ));
    }
}