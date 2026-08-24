<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    /**
     * Tampilkan form pengaturan Tentang Kami
     */
    public function index()
    {
        $about = About::first();

        if (!$about) {
            $about = About::create([
                'badge_label'  => 'Tentang Kami',
                'title'        => 'Puskesmas CareLink  Menciptakan Pelayanan Aman, Kesehatan Adalah Prioritas Kami',
                'description'  => 'Puskesmas CareLink menyediakan layanan kesehatan berkualitas tinggi dengan dokter berpengalaman, layanan gawat darurat, dan dukungan sepanjang waktu. Mitra tepercaya Anda untuk hidup yang lebih sehat.',
                'image_main'   => null,
                'image_accent' => null,
                'visi_title'   => 'Visi Kami',
                'visi_text'    => 'Menjadi pemimpin tepercaya dalam layanan kesehatan yang berkualitas, mudah diakses, dan penuh kepedulian.',
                'misi_title'   => 'Misi Kami',
                'misi_text'    => 'CareLink menghadirkan layanan ahli yang berfokus pada pasien, didukung oleh teknologi canggih dan layanan 24/7, serta berorientasi pada kesehatan dan kesejahteraan.',
                'is_active'    => true,
            ]);
        }

        return view('admin.about.index', compact('about'));
    }

    /**
     * Simpan pembaruan data Tentang Kami
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'badge_label'   => 'nullable|string|max:100',
            'title'         => 'required|string|max:500',
            'description'   => 'required|string',
            'visi_title'    => 'required|string|max:150',
            'visi_text'     => 'required|string',
            'misi_title'    => 'required|string|max:150',
            'misi_text'     => 'required|string',
            'image_main'    => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
            'image_accent'  => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:4096',
        ], [
            'title.required'       => 'Judul utama Tentang Kami wajib diisi.',
            'description.required' => 'Deskripsi Tentang Kami wajib diisi.',
            'visi_title.required'  => 'Judul Visi wajib diisi.',
            'visi_text.required'   => 'Teks Visi wajib diisi.',
            'misi_title.required'  => 'Judul Misi wajib diisi.',
            'misi_text.required'   => 'Teks Misi wajib diisi.',
            'image_main.image'     => 'File foto utama harus berupa gambar (JPG, PNG, WEBP, SVG).',
            'image_main.max'       => 'Ukuran foto utama maksimal 4MB.',
            'image_accent.image'   => 'File foto aksen harus berupa gambar (JPG, PNG, WEBP, SVG).',
            'image_accent.max'     => 'Ukuran foto aksen maksimal 4MB.',
        ]);

        $about = About::firstOrCreate(['id' => 1]);

        $destinationPath = public_path('uploads/about');
        if (!File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        // Upload Foto Utama (image_main)
        $imageMainPath = $about->image_main;
        if ($request->hasFile('image_main')) {
            $file = $request->file('image_main');
            $filename = 'about_main_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);

            // Hapus file lama jika tersimpan di folder uploads
            if ($about->image_main && Str::startsWith($about->image_main, 'uploads/') && file_exists(public_path($about->image_main))) {
                @unlink(public_path($about->image_main));
            }

            $imageMainPath = 'uploads/about/' . $filename;
        } elseif ($request->boolean('reset_image_main')) {
            if ($about->image_main && Str::startsWith($about->image_main, 'uploads/') && file_exists(public_path($about->image_main))) {
                @unlink(public_path($about->image_main));
            }
            $imageMainPath = null;
        }

        // Upload Foto Aksen (image_accent)
        $imageAccentPath = $about->image_accent;
        if ($request->hasFile('image_accent')) {
            $file = $request->file('image_accent');
            $filename = 'about_accent_' . time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $filename);

            // Hapus file lama jika tersimpan di folder uploads
            if ($about->image_accent && Str::startsWith($about->image_accent, 'uploads/') && file_exists(public_path($about->image_accent))) {
                @unlink(public_path($about->image_accent));
            }

            $imageAccentPath = 'uploads/about/' . $filename;
        } elseif ($request->boolean('reset_image_accent')) {
            if ($about->image_accent && Str::startsWith($about->image_accent, 'uploads/') && file_exists(public_path($about->image_accent))) {
                @unlink(public_path($about->image_accent));
            }
            $imageAccentPath = null;
        }

        $about->update([
            'badge_label'  => $validated['badge_label'] ?? 'Tentang Kami',
            'title'        => $validated['title'],
            'description'  => $validated['description'],
            'image_main'   => $imageMainPath,
            'image_accent' => $imageAccentPath,
            'visi_title'   => $validated['visi_title'],
            'visi_text'    => $validated['visi_text'],
            'misi_title'   => $validated['misi_title'],
            'misi_text'    => $validated['misi_text'],
        ]);

        return redirect()->route('admin.about.index')
                         ->with('success', 'Informasi Tentang Kami (About) berhasil diperbarui!');
    }
}
