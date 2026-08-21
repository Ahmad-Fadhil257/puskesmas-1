<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Models\Article;
use App\Http\Controllers\CaraKerjaController;
use App\Models\CaraKerja;
use Illuminate\Support\Facades\Route;

// Landing Page Utama (dengan passing 3 artikel terbaru)
Route::get('/', function () {
    $latestArticles = Article::published()->take(3)->get();
    $caraKerja = CaraKerja::orderBy('urutan', 'asc')->get();
    return view('welcome', compact('latestArticles', 'caraKerja'));
})->name('home');

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

    // Cara Kerja CRUD
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('cara-kerja', CaraKerjaController::class)->except(['show']);
    });
});
