<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\InfoCard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HeroController extends Controller
{
    /**
     * Menampilkan halaman pengaturan Hero Section & Info Cards
     */
    public function index()
    {
        $hero = HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'Selamat Datang Di Puskesmas CareLink',
                'title' => 'Melayani Kesehatan Masyarakat dengan Sepenuh Hati',
                'description' => 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.',
                'btn_primary_text' => 'Janji Temu Online',
                'btn_primary_link' => '#janji-temu',
                'btn_secondary_text' => 'Layanan Kami',
                'btn_secondary_link' => '#layanan',
            ]
        );

        $infoCards = InfoCard::orderBy('urutan', 'asc')->get();

        return view('admin.hero.index', compact('hero', 'infoCards'));
    }

    /**
     * Memperbarui konten teks, link tombol, dan 4 foto grid pada Hero Section
     */
    public function updateHero(Request $request)
    {
        $request->validate([
            'badge_text' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'btn_primary_text' => 'required|string|max:100',
            'btn_primary_link' => 'required|string|max:255',
            'btn_secondary_text' => 'required|string|max:100',
            'btn_secondary_link' => 'required|string|max:255',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ]);

        $hero = HeroSection::firstOrCreate(['id' => 1]);

        $data = $request->only([
            'badge_text',
            'title',
            'description',
            'btn_primary_text',
            'btn_primary_link',
            'btn_secondary_text',
            'btn_secondary_link',
        ]);

        // Upload Direktori
        $uploadPath = public_path('uploads/hero');
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Upload Image 1..4
        for ($i = 1; $i <= 4; $i++) {
            $field = "image_{$i}";
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . "_{$field}_" . Str::random(8) . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $data[$field] = 'uploads/hero/' . $filename;
            }
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Konten Hero Section berhasil diperbarui!');
    }

    /**
     * Memperbarui satu Info Card
     */
    public function updateCard(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'is_featured' => 'nullable|boolean',
            'urutan' => 'required|integer|min:1',
        ]);

        $card = InfoCard::findOrFail($id);

        $card->update([
            'title' => $request->title,
            'description' => $request->description,
            'icon' => $request->icon,
            'is_featured' => $request->has('is_featured') ? true : false,
            'urutan' => $request->urutan,
        ]);

        return redirect()->route('admin.hero.index')
            ->with('success', "Kartu Keunggulan '{$card->title}' berhasil diperbarui!");
    }
}
