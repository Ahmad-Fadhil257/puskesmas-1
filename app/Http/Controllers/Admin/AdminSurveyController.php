<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminSurveyController extends Controller
{
    /**
     * Tampilkan rekap data survei & testimoni pasien
     */
    public function index()
    {
        $surveys = Survey::orderBy('created_at', 'desc')->paginate(15);
        $totalResponden = Survey::count();
        $avgRating = Survey::getAverageRating();
        $satisfactionPct = Survey::getSatisfactionPercentage();

        $ratingCounts = [
            5 => Survey::where('rating', 5)->count(),
            4 => Survey::where('rating', 4)->count(),
            3 => Survey::where('rating', 3)->count(),
            2 => Survey::where('rating', 2)->count(),
            1 => Survey::where('rating', 1)->count(),
        ];

        return view('admin.survey.index', compact(
            'surveys',
            'totalResponden',
            'avgRating',
            'satisfactionPct',
            'ratingCounts'
        ));
    }

    /**
     * Tambah testimoni / survei manual oleh admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'pesan'          => 'required|string|max:1000',
            'avatar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_approved'    => 'nullable',
            'is_featured'    => 'nullable',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $uploadPath = public_path('uploads/testimoni');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }
            $file = $request->file('avatar');
            $filename = time() . '_avatar_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $avatarPath = 'uploads/testimoni/' . $filename;
        }

        Survey::create([
            'name'           => $validated['name'],
            'email_or_phone' => $validated['email_or_phone'] ?? null,
            'poli_name'      => $validated['poli_name'],
            'rating'         => $validated['rating'],
            'pesan'          => $validated['pesan'],
            'avatar'         => $avatarPath,
            'is_approved'    => $request->has('is_approved'),
            'is_featured'    => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.surveys.index')
                         ->with('success', 'Testimoni baru berhasil ditambahkan!');
    }

    /**
     * Update data survei / testimoni
     */
    public function update(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'pesan'          => 'required|string|max:1000',
            'avatar'         => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_approved'    => 'nullable',
            'is_featured'    => 'nullable',
        ]);

        if ($request->hasFile('avatar')) {
            if ($survey->avatar && File::exists(public_path($survey->avatar))) {
                File::delete(public_path($survey->avatar));
            }
            $uploadPath = public_path('uploads/testimoni');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }
            $file = $request->file('avatar');
            $filename = time() . '_avatar_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $survey->avatar = 'uploads/testimoni/' . $filename;
        }

        $survey->name           = $validated['name'];
        $survey->email_or_phone = $validated['email_or_phone'] ?? null;
        $survey->poli_name      = $validated['poli_name'];
        $survey->rating         = $validated['rating'];
        $survey->pesan          = $validated['pesan'];
        $survey->is_approved    = $request->has('is_approved');
        $survey->is_featured    = $request->has('is_featured');
        $survey->save();

        return redirect()->route('admin.surveys.index')
                         ->with('success', 'Data survei/testimoni berhasil diperbarui!');
    }

    /**
     * Toggle status persetujuan tampil di landing page
     */
    public function toggleApproval($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->is_approved = !$survey->is_approved;
        $survey->save();

        $status = $survey->is_approved ? 'dipublikasikan ke website' : 'disembunyikan dari website';
        return redirect()->route('admin.surveys.index')
                         ->with('success', "Testimoni dari \"{$survey->name}\" berhasil {$status}!");
    }

    /**
     * Hapus data survei
     */
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        if ($survey->avatar && File::exists(public_path($survey->avatar))) {
            File::delete(public_path($survey->avatar));
        }
        $name = $survey->name;
        $survey->delete();

        return redirect()->route('admin.surveys.index')
                         ->with('success', "Data survei dari \"{$name}\" berhasil dihapus!");
    }
}
