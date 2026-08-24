<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\HeroController as AdminHeroController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminDokterController;
use App\Http\Controllers\Admin\AdminNilaiController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\CaraKerjaController;
use App\Models\About;
use App\Models\Article;
use App\Models\CaraKerja;
use App\Models\Dokter;
use App\Models\HeroSection;
use App\Models\InfoCard;
use App\Models\Layanan;
use App\Models\NilaiSection;
use Illuminate\Support\Facades\Route;

// Landing Page Utama (dengan passing artikel terbaru, cara kerja dinamis, hero & info cards)
Route::get('/', function () {
    $latestArticles = Article::published()->take(3)->get();
    $caraKerja = CaraKerja::orderBy('urutan', 'asc')->get();
    $about = About::getActive();
    $hero = HeroSection::first();
    $infoCards = InfoCard::orderBy('urutan', 'asc')->get();
    $dokters = Dokter::orderBy('created_at', 'asc')->get();
    $nilaiSection = NilaiSection::first();
    $layanans = Layanan::orderBy('created_at', 'asc')->get();
    return view('welcome', compact('latestArticles', 'caraKerja', 'about', 'hero', 'infoCards', 'dokters', 'nilaiSection', 'layanans'));
})->name('home');

// Jadwal Dokter (dari database)
Route::get('/jadwal-dokter', function () {
    $dokters = Dokter::where('is_active', true)->orderBy('created_at', 'asc')->get();
    return view('jadwal-dokter', compact('dokters'));
})->name('jadwal-dokter');

// Portal Publik Berita & Blog
Route::get('/berita', [BlogController::class, 'index'])->name('blog.index');
Route::get('/berita/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Auth Routes (URL Khusus Login: /puskem-min)
Route::get('/puskem-min', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/puskem-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/puskem-logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard & Admin Routes (Diproteksi auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalArticles = Article::count();
        $totalViews = Article::sum('views_count');
        $latestArticles = Article::orderBy('created_at', 'desc')->take(5)->get();
        return view('admin.dashboard', compact('totalArticles', 'totalViews', 'latestArticles'));
    })->name('dashboard');

    // CRUD Manajemen Berita
    Route::resource('admin/articles', AdminArticleController::class)->names('admin.articles');

    // Cara Kerja, Hero, dan Pengguna CRUD
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('cara-kerja', CaraKerjaController::class)->except(['show']);

        // Kelola Hero Section & Info Cards
        Route::get('hero', [AdminHeroController::class, 'index'])->name('hero.index');
        Route::put('hero/update', [AdminHeroController::class, 'updateHero'])->name('hero.update');
        Route::put('hero/info-cards/{id}', [AdminHeroController::class, 'updateCard'])->name('hero.update-card');

        // Kelola Pengguna (Admin & Staf)
        Route::patch('users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
        Route::resource('users', AdminUserController::class)->except(['show']);

        // Kelola Dokter
        Route::resource('dokter', AdminDokterController::class)->except(['show']);

        // Kelola Layanan Kami
        Route::resource('layanan', AdminLayananController::class)->except(['show']);

        // Kelola Nilai-Nilai & Mitra
        Route::get('nilai', [AdminNilaiController::class, 'index'])->name('nilai.index');
        Route::put('nilai', [AdminNilaiController::class, 'update'])->name('nilai.update');

        // Kelola Identitas & Logo Aplikasi
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');
    });

    // Pengaturan & Manajemen Tentang Kami (About)
    Route::get('admin/about', [AdminAboutController::class, 'index'])->name('admin.about.index');
    Route::put('admin/about', [AdminAboutController::class, 'update'])->name('admin.about.update');
});