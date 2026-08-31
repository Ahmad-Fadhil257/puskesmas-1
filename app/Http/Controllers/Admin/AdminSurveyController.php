<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survey;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminSurveyController extends Controller
{
    /**
     * Tampilkan rekap data survei & evaluasi kepuasan pasien
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $ratingFilter = $request->query('rating');
        $statusFilter = $request->query('status');
        $poliFilter = $request->query('poli');

        $query = Survey::orderBy('is_featured', 'desc')->orderBy('created_at', 'desc');

        // Filter Pencarian (Nama, No Kontak, Poli, atau Isi Pesan)
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email_or_phone', 'like', "%{$search}%")
                  ->orWhere('poli_name', 'like', "%{$search}%")
                  ->orWhere('pesan', 'like', "%{$search}%");
            });
        }

        // Filter Rating Bintang (1 - 5)
        if ($ratingFilter && in_array($ratingFilter, ['1','2','3','4','5'])) {
            $query->where('rating', (int) $ratingFilter);
        }

        // Filter Status Publikasi / Unggulan
        if ($statusFilter === 'approved') {
            $query->where('is_approved', true);
        } elseif ($statusFilter === 'draft') {
            $query->where('is_approved', false);
        } elseif ($statusFilter === 'featured') {
            $query->where('is_featured', true);
        }

        // Filter Berdasarkan Unit / Poliklinik
        if (!empty($poliFilter)) {
            $query->where('poli_name', $poliFilter);
        }

        $surveys = $query->paginate(15)->withQueryString();

        // Statistik Keseluruhan
        $totalResponden = Survey::count();
        $totalApproved = Survey::where('is_approved', true)->count();
        $totalFeatured = Survey::where('is_featured', true)->count();
        $avgRating = Survey::getAverageRating();
        $satisfactionPct = Survey::getSatisfactionPercentage();

        $ratingCounts = [
            5 => Survey::where('rating', 5)->count(),
            4 => Survey::where('rating', 4)->count(),
            3 => Survey::where('rating', 3)->count(),
            2 => Survey::where('rating', 2)->count(),
            1 => Survey::where('rating', 1)->count(),
        ];

        // Daftar Poli yang tersedia untuk dropdown filter & form modal
        $availablePolis = Survey::select('poli_name')->whereNotNull('poli_name')->distinct()->pluck('poli_name');
        $layanans = Layanan::orderBy('order', 'asc')->get();

        return view('admin.survey.index', compact(
            'surveys',
            'totalResponden',
            'totalApproved',
            'totalFeatured',
            'avgRating',
            'satisfactionPct',
            'ratingCounts',
            'ratingFilter',
            'statusFilter',
            'poliFilter',
            'search',
            'availablePolis',
            'layanans'
        ));
    }

    /**
     * Ambil data JSON untuk Pratinjau / Modal Detail
     */
    public function show($id)
    {
        $survey = Survey::findOrFail($id);

        return response()->json([
            'id'             => $survey->id,
            'name'           => $survey->name,
            'email_or_phone' => $survey->email_or_phone ?? '-',
            'poli_name'      => $survey->poli_name ?? 'Poli Umum',
            'rating'         => $survey->rating,
            'pesan'          => $survey->pesan,
            'avatar_url'     => $survey->avatar_url,
            'is_approved'    => (bool) $survey->is_approved,
            'is_featured'    => (bool) $survey->is_featured,
            'created_at'     => $survey->created_at->format('d F Y, H:i') . ' WIB',
            'time_ago'       => $survey->created_at->diffForHumans(),
        ]);
    }

    /**
     * Tambah data evaluasi / survei manual oleh admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'pesan'          => 'required|string|max:1500',
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
                         ->with('success', 'Data evaluasi survei berhasil ditambahkan!');
    }

    /**
     * Update data survei / ulasan
     */
    public function update(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:100',
            'email_or_phone' => 'nullable|string|max:100',
            'poli_name'      => 'required|string|max:100',
            'rating'         => 'required|integer|min:1|max:5',
            'pesan'          => 'required|string|max:1500',
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
                         ->with('success', 'Data evaluasi survei berhasil diperbarui!');
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
                         ->with('success', "Ulasan dari \"{$survey->name}\" berhasil {$status}!");
    }

    /**
     * Toggle status unggulan (Featured) tampil prioritas pertama
     */
    public function toggleFeatured($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->is_featured = !$survey->is_featured;
        // Jika dijadikan featured, pastikan otomatis disetujui (is_approved = true)
        if ($survey->is_featured) {
            $survey->is_approved = true;
        }
        $survey->save();

        $status = $survey->is_featured ? 'dijadikan ulasan Unggulan (tampil prioritas di beranda)' : 'dihapus dari ulasan unggulan';
        return redirect()->route('admin.surveys.index')
                         ->with('success', "Ulasan dari \"{$survey->name}\" berhasil {$status}!");
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
