<?php

use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

// ===== Halaman Publik (Company Profile & Menu Utama) =====
Route::get('/', [FrontController::class, 'index'])->name('home');
Route::get('/profil-perusahaan', [FrontController::class, 'profil'])->name('front.profil');
Route::get('/layanan', [FrontController::class, 'layanan'])->name('front.layanan');
Route::get('/layanan/{id}', [FrontController::class, 'detailLayanan'])->name('layanan.show'); // Rute Detail Layanan
Route::get('/artikel', [FrontController::class, 'artikel'])->name('front.artikel');
Route::get('/artikel/{id}', [FrontController::class, 'detailArtikel'])->name('artikel.show'); // Rute Detail Artikel
Route::get('/galeri', [FrontController::class, 'galeri'])->name('front.galeri');
Route::get('/kontak', [FrontController::class, 'kontak'])->name('front.kontak');
Route::post('/kontak/store', [FrontController::class, 'storeKontak'])->name('front.kontak.store');

// ===== Rute Login Kustom =====
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ===== Halaman Admin =====
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Profil perusahaan
    Route::get('profil', [CompanyProfileController::class, 'edit'])->name('profil.edit');
    Route::put('profil', [CompanyProfileController::class, 'update'])->name('profil.update');

    // Layanan
    Route::get('layanan', [ServiceController::class, 'index'])->name('layanan.index');
    Route::get('layanan/create', [ServiceController::class, 'create'])->name('layanan.create');
    Route::post('layanan', [ServiceController::class, 'store'])->name('layanan.store');
    Route::get('layanan/{service}/edit', [ServiceController::class, 'edit'])->name('layanan.edit');
    Route::put('layanan/{service}', [ServiceController::class, 'update'])->name('layanan.update');
    Route::delete('layanan/{service}', [ServiceController::class, 'destroy'])->name('layanan.destroy');

    // Artikel
    Route::get('artikel', [ArticleController::class, 'index'])->name('artikel.index');
    Route::get('artikel/create', [ArticleController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArticleController::class, 'store'])->name('artikel.store');
    Route::get('artikel/{artikel}/edit', [ArticleController::class, 'edit'])->name('artikel.edit');
    Route::put('artikel/{artikel}', [ArticleController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{artikel}', [ArticleController::class, 'destroy'])->name('artikel.destroy');

    // Galeri
    Route::get('galeri', [GalleryController::class, 'index'])->name('galeri.index');
    Route::get('galeri/create', [GalleryController::class, 'create'])->name('galeri.create');
    Route::post('galeri', [GalleryController::class, 'store'])->name('galeri.store');
    Route::get('galeri/{galeri}/edit', [GalleryController::class, 'edit'])->name('galeri.edit');
    Route::put('galeri/{galeri}', [GalleryController::class, 'update'])->name('galeri.update');
    Route::delete('galeri/{galeri}', [GalleryController::class, 'destroy'])->name('galeri.destroy');

    // Kontak / Pesan Masuk
    Route::get('kontak', [ContactController::class, 'index'])->name('kontak.index');
    Route::get('kontak/{kontak}', [ContactController::class, 'show'])->name('kontak.show');
    Route::delete('kontak/{kontak}', [ContactController::class, 'destroy'])->name('kontak.destroy');

});