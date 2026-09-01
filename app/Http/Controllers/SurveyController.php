<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SurveyController extends Controller
{
    /**
     * Halaman Publik Survei Kepuasan Masyarakat (SKM / IKM)
     */
    public function index()
    {
        $avgRating = Survey::getAverageRating();
        $satisfactionPct = Survey::getSatisfactionPercentage();
        $totalResponden = Survey::approved()->count();
        $recentSurveys = Survey::approved()->orderBy('created_at', 'desc')->take(6)->get();
        $layanans = \App\Models\Layanan::orderBy('order', 'asc')->get();

        return view('survei', compact('avgRating', 'satisfactionPct', 'totalResponden', 'recentSurveys', 'layanans'));
    }

    /**
     * Simpan survei kepuasan / testimoni dari masyarakat
     */
    public function store(Request $request)
    {
        $isAnonymous = $request->boolean('is_anonymous');

        $validated = $request->validate([
            'name'           => $isAnonymous ? 'nullable|string|max:100' : 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'quick_tags'     => 'nullable|array',
            'quick_tags.*'   => 'string|max:50',
            'pesan'          => 'required|string|max:1000',
            'g-recaptcha-response' => ['required', function ($attribute, $value, $fail) {
                $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                    'secret'   => env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe'),
                    'response' => $value,
                    'remoteip' => request()->ip()
                ]);

                if (!$response->json('success')) {
                    $fail('Verifikasi reCAPTCHA gagal, silakan centang kembali.');
                }
            }],
        ], [
            'name.required' => 'Nama lengkap wajib diisi atau centang Kirim sebagai Pasien Anonim.',
            'poli_name.required' => 'Silakan pilih layanan atau poliklinik yang Anda kunjungi.',
            'rating.required' => 'Silakan pilih tingkat kepuasan Anda.',
            'pesan.required' => 'Silakan tuliskan masukan atau ulasan Anda.',
            'g-recaptcha-response.required' => 'Silakan centang kotak reCAPTCHA (Saya bukan robot) untuk melanjutkan.'
        ]);

        $name = $isAnonymous || empty($validated['name']) ? 'Pasien Anonim' : $validated['name'];

        $pesan = $validated['pesan'];
        if (!empty($validated['quick_tags'])) {
            $tagString = implode(', ', $validated['quick_tags']);
            $pesan = "[Aspek: {$tagString}]\n\n" . $pesan;
        }

        Survey::create([
            'name'           => $name,
            'email_or_phone' => $isAnonymous ? null : ($validated['email_or_phone'] ?? null),
            'poli_name'      => $validated['poli_name'],
            'rating'         => $validated['rating'],
            'pesan'          => $pesan,
            'is_approved'    => false,
            'is_featured'    => false,
        ]);

        return redirect()->route('survei.index')
                         ->with('survey_success', 'Terima kasih atas partisipasi Anda! Evaluasi Anda sangat berharga bagi peningkatan mutu layanan kami.');
    }
}
