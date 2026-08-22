<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login dengan status Gatekeeper
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        $gatePassed = session('gatekeeper_passed', false);

        return view('auth.login', compact('gatePassed'));
    }

    /**
     * Verifikasi Akses Gatekeeper (Security Gate)
     */
    public function verifyGate(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $validUsernames = ['admin', 'puskem', 'puskesmas'];
        $validPasswords = ['admin', 'puskem123', 'puskesmas123', 'password123'];

        $inputUser = strtolower(trim($request->username));
        $inputPass = trim($request->password);

        if (in_array($inputUser, $validUsernames) && in_array($inputPass, $validPasswords)) {
            $request->session()->put('gatekeeper_passed', true);
            return response()->json([
                'success' => true,
                'message' => 'Otorisasi Gatekeeper Berhasil! Membuka panel login...',
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username atau Password Gate tidak valid.',
        ], 403);
    }

    /**
     * Autentikasi Login Database Akun Petugas/Admin
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $throttleKey = 'login:' . Str::lower($request->input('email')) . '|' . $request->ip();

        if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan gagal. Coba lagi dalam {$seconds} detik.",
                'retry_after' => $seconds,
            ], 429);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login berhasil! Mengalihkan...',
                'redirect_url' => route('dashboard'),
            ]);
        }

        RateLimiter::hit($throttleKey, 60);
        $remainingAttempts = RateLimiter::remaining($throttleKey, 5);

        return response()->json([
            'success' => false,
            'message' => "Email atau password yang Anda masukkan tidak sesuai. (Sisa: {$remainingAttempts})",
            'remaining_attempts' => $remainingAttempts,
        ], 401);
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
