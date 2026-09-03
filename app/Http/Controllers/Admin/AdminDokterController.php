<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminDokterController extends Controller
{
    /**
     * Tampilkan daftar dokter di Dashboard Admin
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Dokter::query()->orderBy('created_at', 'asc');

        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('specialty', 'like', "%{$search}%");
        }

        $dokters = $query->paginate(10)->withQueryString();
        $totalDokter = Dokter::count();

        return view('admin.dokter.index', compact('dokters', 'search', 'totalDokter'));
    }

    /**
     * Daftar pilihan spesialisasi/poli default + dinamis dari database
     */
    public static function getSpecialtyList(): array
    {
        $defaults = [
            'Dokter Umum',
            'Spesialis Gigi dan Mulut',
            'Spesialis Anak',
            'Spesialis Kebidanan & Kandungan',
            'Spesialis Penyakit Dalam',
            'Spesialis Jantung dan Pembuluh Darah',
            'Spesialis Bedah Umum',
            'Spesialis Mata',
            'Spesialis THT-KL',
            'Spesialis Kulit dan Kelamin',
            'Spesialis Saraf',
            'Spesialis Kedokteran Jiwa (Psikiatri)',
            'Konselor Gizi & Dietetik',
        ];

        $fromDb = Dokter::distinct()->pluck('specialty')->filter()->toArray();
        return array_values(array_unique(array_merge($defaults, $fromDb)));
    }

    /**
     * Form tambah dokter baru
     */
    public function create()
    {
        $specialties = self::getSpecialtyList();
        return view('admin.dokter.create', compact('specialties'));
    }

    /**
     * Simpan dokter baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('assets/dokter');

            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);
            $photoPath = 'assets/dokter/' . $filename;
        }

        Dokter::create([
            'name'      => $validated['name'],
            'specialty' => $validated['specialty'],
            'photo'     => $photoPath,
            'is_active' => true,
        ]);

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil ditambahkan!');
    }

    /**
     * Form edit data dokter
     */
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        $specialties = self::getSpecialtyList();
        return view('admin.dokter.edit', compact('dokter', 'specialties'));
    }

    /**
     * Update data dokter
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'photo'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        if ($request->hasFile('photo')) {
            if ($dokter->photo && File::exists(public_path($dokter->photo))) {
                File::delete(public_path($dokter->photo));
            }

            $file = $request->file('photo');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('assets/dokter');

            if (!File::isDirectory($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);
            $dokter->photo = 'assets/dokter/' . $filename;
        }

        $dokter->name      = $validated['name'];
        $dokter->specialty = $validated['specialty'];
        $dokter->save();

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil diperbarui!');
    }

    /**
     * Hapus data dokter
     */
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);

        if ($dokter->photo && File::exists(public_path($dokter->photo))) {
            File::delete(public_path($dokter->photo));
        }

        $dokter->delete();

        return redirect()->route('admin.dokter.index')
                         ->with('success', 'Data dokter berhasil dihapus!');
    }
}
