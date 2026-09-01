<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\StatistikController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\HeroController as AdminHeroController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AdminDokterController;
use App\Http\Controllers\Admin\AdminNilaiController;
use App\Http\Controllers\Admin\AdminLayananController;
use App\Http\Controllers\Admin\AdminInfografisController;
use App\Http\Controllers\Admin\AdminSurveyController;
use App\Http\Controllers\Admin\AdminLokasiController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminStatistikController;
use App\Http\Controllers\CaraKerjaController;
use App\Models\About;
use App\Models\Article;
use App\Models\CaraKerja;
use App\Models\Dokter;
use App\Models\HeroSection;
use App\Models\InfoCard;
use App\Models\Layanan;
use App\Models\Mitra;
use App\Models\NilaiSection;
use App\Models\Survey;
use App\Models\Faq;
use App\Models\Infografis;
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
    $mitras = Mitra::where('is_active', true)->orderBy('order', 'asc')->get();
    $layanans = Layanan::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
    $surveys = Survey::approved()->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();
    $avgRating = Survey::getAverageRating();
    $satisfactionPct = Survey::getSatisfactionPercentage();
    return view('welcome', compact('latestArticles', 'caraKerja', 'about', 'hero', 'infoCards', 'dokters', 'nilaiSection', 'mitras', 'layanans', 'surveys', 'avgRating', 'satisfactionPct'));
})->name('home');

// Halaman Khusus & Formulir Survei Kepuasan Masyarakat (SKM / IKM)
Route::get('/survei', [SurveyController::class, 'index'])->name('survei.index');
Route::post('/survei', [SurveyController::class, 'store'])->name('survei.store');

// Layanan & Poli Puskesmas (Redirect langsung ke layanan pertama)
Route::get('/layanan', function () {
    $firstLayanan = Layanan::where('is_active', true)->orderBy('order', 'asc')->orderBy('id', 'asc')->first();
    if ($firstLayanan && !empty($firstLayanan->slug)) {
        return redirect()->route('layanan.detail', $firstLayanan->slug);
    }
    return redirect()->route('home');
})->name('layanan.index');

// Halaman Detail Layanan Informatif (Slug)
Route::get('/layanan/{slug}', function ($slug) {
    $layanan = \App\Models\Layanan::where('slug', $slug)->first();
    if (!$layanan && is_numeric($slug)) {
        $layanan = \App\Models\Layanan::find($slug);
    }
    if (!$layanan || !$layanan->is_active) {
        abort(404);
    }

    $otherLayanans = \App\Models\Layanan::where('is_active', true)
        ->where('id', '!=', $layanan->id)
        ->orderBy('order', 'asc')
        ->take(4)
        ->get();

    return view('layanan.detail', compact('layanan', 'otherLayanans'));
})->name('layanan.detail');

// Portal Publik Berita & Blog
Route::get('/berita', [BlogController::class, 'index'])->name('blog.index');
Route::get('/berita/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Halaman Infografis Publik
Route::get('/infografis', function () {
    $infografis = \App\Models\Infografis::active()->orderBy('order', 'asc')->orderBy('id', 'desc')->get();
    $kategoris = $infografis->pluck('kategori')->unique()->values();
    return view('infografis', compact('infografis', 'kategoris'));
})->name('infografis');

// Halaman Lokasi & Peta Puskesmas
Route::get('/lokasi', function () {
    return view('lokasi');
})->name('lokasi');

// Halaman Statistik Kesehatan Publik
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');

// Halaman FAQ (Tanya Jawab) Publik
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
// Auth Routes (URL Khusus Login: /puskem-min)
Route::get('/puskem-min', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/puskem-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/puskem-logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard & Admin Routes (Diproteksi auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $totalArticles = Article::count();
        $totalViews = Article::sum('views_count') ?? 0;
        $latestArticles = Article::orderBy('created_at', 'desc')->take(5)->get();
        $totalDokter = Dokter::count();
        $totalLayanan = Layanan::count();
        $totalFaq = Faq::count();
        $totalInfografis = Infografis::count();
        $totalSurveys = Survey::count();
        $avgRating = Survey::getAverageRating() ?? 5.0;
        $latestSurveys = Survey::orderBy('created_at', 'desc')->take(3)->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'totalViews',
            'latestArticles',
            'totalDokter',
            'totalLayanan',
            'totalFaq',
            'totalInfografis',
            'totalSurveys',
            'avgRating',
            'latestSurveys'
        ));
    })->name('dashboard');

    // CRUD Manajemen Berita
    Route::middleware(['page.access'])->group(function () {
        Route::resource('admin/articles', AdminArticleController::class)->names('admin.articles');
    });

    // Cara Kerja, Hero, dan Pengguna CRUD
    Route::prefix('admin')->name('admin.')->middleware(['page.access'])->group(function () {
        Route::resource('cara-kerja', CaraKerjaController::class)->except(['show']);

        // Kelola Hero Section & Info Cards
        Route::get('hero', [AdminHeroController::class, 'index'])->name('hero.index');
        Route::put('hero/update', [AdminHeroController::class, 'updateHero'])->name('hero.update');
        Route::put('hero/info-cards/{id}', [AdminHeroController::class, 'updateCard'])->name('hero.update-card');

        // Kelola Pengguna (Admin Only)
        Route::middleware(['admin.only'])->group(function () {
            Route::patch('users/{id}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle-status');
            Route::resource('users', AdminUserController::class)->except(['show']);
        });

        // Kelola Dokter
        Route::resource('dokter', AdminDokterController::class)->except(['show']);

        // Kelola Layanan Kami
        Route::post('layanan/{id}/reorder', [AdminLayananController::class, 'reorder'])->name('layanan.reorder');
        Route::resource('layanan', AdminLayananController::class)->except(['show']);

        // Kelola Nilai-Nilai & Mitra (Banner & Mitra CRUD)
        Route::get('nilai', [AdminNilaiController::class, 'index'])->name('nilai.index');
        Route::put('nilai/banner', [AdminNilaiController::class, 'updateBanner'])->name('nilai.update-banner');
        Route::post('nilai/mitra', [AdminNilaiController::class, 'storeMitra'])->name('nilai.mitra.store');
        Route::put('nilai/mitra/{id}', [AdminNilaiController::class, 'updateMitra'])->name('nilai.mitra.update');
        Route::post('nilai/mitra/{id}/reorder', [AdminNilaiController::class, 'reorderMitra'])->name('nilai.mitra.reorder');
        Route::patch('nilai/mitra/{id}/toggle-status', [AdminNilaiController::class, 'toggleMitraStatus'])->name('nilai.mitra.toggle-status');
        Route::delete('nilai/mitra/{id}', [AdminNilaiController::class, 'destroyMitra'])->name('nilai.mitra.destroy');

        // Kelola Survei Kepuasan & Testimoni
        Route::patch('surveys/{id}/toggle', [AdminSurveyController::class, 'toggleApproval'])->name('surveys.toggle');
        Route::resource('surveys', AdminSurveyController::class)->except(['show', 'create', 'edit']);

        // Kelola Identitas & Logo Aplikasi
        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [AdminSettingController::class, 'update'])->name('settings.update');

        // Kelola Lokasi, Peta & Kontak Puskesmas
        Route::get('lokasi', [AdminLokasiController::class, 'index'])->name('lokasi.index');
        Route::put('lokasi', [AdminLokasiController::class, 'update'])->name('lokasi.update');

        // Kelola FAQ (Tanya Jawab)
        Route::resource('faq', AdminFaqController::class)->except(['show']);

        // Kelola Infografis
        Route::resource('infografis', AdminInfografisController::class)->except(['show']);

        // Kelola Statistik Kesehatan
        Route::get('statistik', [AdminStatistikController::class, 'index'])->name('statistik.index');
        Route::get('statistik/penyakit/create', [AdminStatistikController::class, 'createPenyakit'])->name('statistik.penyakit.create');
        Route::post('statistik/penyakit', [AdminStatistikController::class, 'storePenyakit'])->name('statistik.penyakit.store');
        Route::get('statistik/penyakit/{id}/edit', [AdminStatistikController::class, 'editPenyakit'])->name('statistik.penyakit.edit');
        Route::put('statistik/penyakit/{id}', [AdminStatistikController::class, 'updatePenyakit'])->name('statistik.penyakit.update');
        Route::delete('statistik/penyakit/{id}', [AdminStatistikController::class, 'destroyPenyakit'])->name('statistik.penyakit.destroy');
        Route::get('statistik/kunjungan/create', [AdminStatistikController::class, 'createKunjungan'])->name('statistik.kunjungan.create');
        Route::post('statistik/kunjungan', [AdminStatistikController::class, 'storeKunjungan'])->name('statistik.kunjungan.store');
        Route::get('statistik/kunjungan/{id}/edit', [AdminStatistikController::class, 'editKunjungan'])->name('statistik.kunjungan.edit');
        Route::put('statistik/kunjungan/{id}', [AdminStatistikController::class, 'updateKunjungan'])->name('statistik.kunjungan.update');
        Route::delete('statistik/kunjungan/{id}', [AdminStatistikController::class, 'destroyKunjungan'])->name('statistik.kunjungan.destroy');
    });

    // Pengaturan & Manajemen Tentang Kami (About)
    Route::middleware(['page.access'])->group(function () {
        Route::get('admin/about', [AdminAboutController::class, 'index'])->name('admin.about.index');
        Route::put('admin/about', [AdminAboutController::class, 'update'])->name('admin.about.update');
    });
});