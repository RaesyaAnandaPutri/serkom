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
        $serviceCount = Service::count();
        $articleCount = Article::where('status', 'publik')->count();
        $galleryCount = Gallery::count();

        $profile = CompanyProfile::first();
        $latestServices = Service::latest()->take(3)->get();
        $latestArticles = Article::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'serviceCount',
            'articleCount',
            'galleryCount',
            'profile',
            'latestServices',
            'latestArticles'
        ));
    }
}