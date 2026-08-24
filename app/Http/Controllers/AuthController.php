<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login (selalu mulai dari Gatekeeper)
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login', ['gatePassed' => false]);
    }

    /**
     * Verifikasi Akses Gatekeeper (Security Gate & Direct Login Support)
     */
    public function verifyGate(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $validGateUsernames = ['admin', 'puskem', 'puskesmas', 'root', 'gate'];
        $validGatePasswords = ['admin', 'puskem123', 'puskesmas123', 'password123', 'root'];

        $inputUser = strtolower(trim($request->username));
        $inputPass = trim($request->password);

        // 1. Cek apakah cocok dengan kredensial gerbang keamanan (Gate Code)
        if (in_array($inputUser, $validGateUsernames) && in_array($inputPass, $validGatePasswords)) {
            $request->session()->put('gatekeeper_passed', true);
            return response()->json([
                'success' => true,
                'mode' => 'unlock',
                'message' => 'Otorisasi Gatekeeper Berhasil! Membuka panel login...',
            ]);
        }

        // 2. Cek apakah pengguna memasukkan Email & Password database administrator/staf
        $user = User::where('email', $inputUser)->first();
        if ($user && Hash::check($inputPass, $user->password)) {
            if (!$user->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda sedang dinonaktifkan oleh Administrator.',
                ], 403);
            }

            Auth::login($user, true);
            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'mode' => 'direct_login',
                'message' => 'Otorisasi Berhasil! Mengalihkan ke Dashboard...',
                'redirect_url' => route('dashboard'),
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Username/Email atau Password tidak valid.',
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
            $user = Auth::user();
            if (!$user->is_active) {
                Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Akun Anda sedang dinonaktifkan oleh Administrator.',
                ], 403);
            }

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
