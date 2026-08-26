<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

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

        return view('survei', compact('avgRating', 'satisfactionPct', 'totalResponden', 'recentSurveys'));
    }

    /**
     * Simpan survei kepuasan / testimoni dari masyarakat
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'pesan'          => 'required|string|max:1000',
        ]);

        Survey::create([
            'name'           => $validated['name'],
            'email_or_phone' => $validated['email_or_phone'] ?? null,
            'poli_name'      => $validated['poli_name'],
            'rating'         => $validated['rating'],
            'pesan'          => $validated['pesan'],
            'is_approved'    => true,
            'is_featured'    => false,
        ]);

        return redirect()->route('survei.index')
                         ->with('survey_success', 'Terima kasih atas partisipasi Anda! Penilaian Anda sangat berharga bagi peningkatan mutu layanan kami.');
    }
}
