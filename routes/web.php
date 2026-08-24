<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CaraKerjaController;
use App\Models\CaraKerja;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::get('/', function () {
    $caraKerja = CaraKerja::orderBy('urutan', 'asc')->get();
    return view('welcome', compact('caraKerja'));
})->name('home');

// Auth Routes (URL Khusus Login: /puskem-min)
Route::get('/puskem-min', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/puskem-login', [AuthController::class, 'login'])->name('login.post');
Route::post('/puskem-logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes (Diproteksi auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Cara Kerja CRUD
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('cara-kerja', CaraKerjaController::class)->except(['show']);
    });
});

Route::get('/layanan', function () {
    return view('layanan');
});

Route::get('/dokter', function () {
    return view('dokter');
});
