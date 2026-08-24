<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminNilaiController extends Controller
{
    /**
     * Tampilkan form pengaturan Nilai-Nilai & Mitra
     */
    public function index()
    {
        $nilai = NilaiSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text'  => 'NILAI - NILAI KAMI',
                'title'       => 'Berdedikasi pada Keunggulan dalam Layanan Kesehatan melalui Kemitraan Terpercaya',
                'logo_1_name' => 'BPJS Kesehatan',
                'logo_2_name' => 'Kementerian Kesehatan Republik Indonesia',
                'logo_3_name' => 'Mitra Kesehatan Puskesmas',
                'is_active'   => true,
            ]
        );

        return view('admin.nilai.index', compact('nilai'));
    }

    /**
     * Simpan perubahan konten Nilai-Nilai & Mitra
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_text'  => 'required|string|max:100',
            'title'       => 'required|string|max:500',
            'logo_1_name' => 'nullable|string|max:150',
            'logo_2_name' => 'nullable|string|max:150',
            'logo_3_name' => 'nullable|string|max:150',
            'logo_1'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'logo_2'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'logo_3'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'is_active'   => 'nullable',
        ]);

        $nilai = NilaiSection::firstOrCreate(['id' => 1]);

        $uploadPath = public_path('uploads/nilai');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        // Handle Logo 1..3
        for ($i = 1; $i <= 3; $i++) {
            $field = "logo_{$i}";
            $resetField = "reset_logo_{$i}";

            // Jika user memilih reset ke default
            if ($request->has($resetField)) {
                if ($nilai->$field && File::exists(public_path($nilai->$field))) {
                    File::delete(public_path($nilai->$field));
                }
                $nilai->$field = null;
            }

            // Jika ada upload logo baru
            if ($request->hasFile($field)) {
                if ($nilai->$field && File::exists(public_path($nilai->$field))) {
                    File::delete(public_path($nilai->$field));
                }

                $file = $request->file($field);
                $filename = time() . "_{$field}_" . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $nilai->$field = 'uploads/nilai/' . $filename;
            }

            // Update nama / alt teks
            $nameField = "logo_{$i}_name";
            if ($request->has($nameField)) {
                $nilai->$nameField = $validated[$nameField];
            }
        }

        $nilai->badge_text = $validated['badge_text'];
        $nilai->title      = $validated['title'];
        $nilai->save();

        return redirect()->route('admin.nilai.index')
                         ->with('success', 'Konten Nilai-Nilai & Mitra berhasil diperbarui!');
    }
}
