<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NilaiSection;
use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class AdminNilaiController extends Controller
{
    /**
     * Tampilkan form pengaturan Nilai-Nilai & Daftar Mitra
     */
    public function index()
    {
        $nilai = NilaiSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text'  => 'NILAI - NILAI KAMI',
                'title'       => 'Berdedikasi pada Keunggulan dalam Layanan Kesehatan melalui Kemitraan Terpercaya',
                'is_active'   => true,
            ]
        );

        $mitras = Mitra::orderBy('order', 'asc')->orderBy('id', 'asc')->get();
        $nextOrder = (Mitra::max('order') ?? 0) + 1;

        return view('admin.nilai.index', compact('nilai', 'mitras', 'nextOrder'));
    }

    /**
     * Simpan perubahan judul & badge banner Nilai-Nilai
     */
    public function updateBanner(Request $request)
    {
        $validated = $request->validate([
            'badge_text' => 'required|string|max:100',
            'title'      => 'required|string|max:500',
        ]);

        $nilai = NilaiSection::firstOrCreate(['id' => 1]);
        $nilai->badge_text = $validated['badge_text'];
        $nilai->title      = $validated['title'];
        $nilai->save();

        return redirect()->route('admin.nilai.index')
                         ->with('success', 'Banner Nilai-Nilai Kami berhasil diperbarui!');
    }

    /**
     * Tambah mitra baru ke database
     */
    public function storeMitra(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'required|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'url'       => 'nullable|url|max:255',
            'order'     => 'nullable|integer|min:1',
            'is_active' => 'nullable',
        ]);

        $uploadPath = public_path('uploads/mitra');
        if (!File::isDirectory($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true, true);
        }

        $file = $request->file('logo');
        $filename = time() . '_mitra_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
        $file->move($uploadPath, $filename);
        $logoPath = 'uploads/mitra/' . $filename;

        $order = $validated['order'] ?? ((Mitra::max('order') ?? 0) + 1);

        Mitra::create([
            'name'      => $validated['name'],
            'logo'      => $logoPath,
            'url'       => $validated['url'] ?? null,
            'order'     => $order,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.nilai.index')
                         ->with('success', 'Mitra baru berhasil ditambahkan!');
    }

    /**
     * Update data mitra
     */
    public function updateMitra(Request $request, $id)
    {
        $mitra = Mitra::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'logo'      => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:3072',
            'url'       => 'nullable|url|max:255',
            'order'     => 'required|integer|min:1',
            'is_active' => 'nullable',
        ]);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada di uploads
            if ($mitra->logo && File::exists(public_path($mitra->logo)) && str_starts_with($mitra->logo, 'uploads/')) {
                File::delete(public_path($mitra->logo));
            }

            $uploadPath = public_path('uploads/mitra');
            if (!File::isDirectory($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true, true);
            }

            $file = $request->file('logo');
            $filename = time() . '_mitra_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);
            $mitra->logo = 'uploads/mitra/' . $filename;
        }

        $mitra->name      = $validated['name'];
        $mitra->url       = $validated['url'] ?? null;
        $mitra->order     = $validated['order'];
        $mitra->is_active = $request->has('is_active');
        $mitra->save();

        return redirect()->route('admin.nilai.index')
                         ->with('success', 'Data mitra "' . $mitra->name . '" berhasil diperbarui!');
    }

    /**
     * Geser urutan mitra naik atau turun
     */
    public function reorderMitra(Request $request, $id)
    {
        $direction = $request->input('direction');
        $current = Mitra::findOrFail($id);

        if ($direction === 'up') {
            $prev = Mitra::where('order', '<', $current->order)
                         ->orderBy('order', 'desc')
                         ->first();
            if ($prev) {
                $temp = $current->order;
                $current->order = $prev->order;
                $prev->order = $temp;
                $current->save();
                $prev->save();
            }
        } elseif ($direction === 'down') {
            $next = Mitra::where('order', '>', $current->order)
                         ->orderBy('order', 'asc')
                         ->first();
            if ($next) {
                $temp = $current->order;
                $current->order = $next->order;
                $next->order = $temp;
                $current->save();
                $next->save();
            }
        }

        return redirect()->route('admin.nilai.index')
                         ->with('success', 'Urutan logo mitra berhasil diubah!');
    }

    /**
     * Toggle status aktif/nonaktif mitra
     */
    public function toggleMitraStatus($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->is_active = !$mitra->is_active;
        $mitra->save();

        $status = $mitra->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('admin.nilai.index')
                         ->with('success', "Mitra \"{$mitra->name}\" berhasil {$status}!");
    }

    /**
     * Hapus data mitra
     */
    public function destroyMitra($id)
    {
        $mitra = Mitra::findOrFail($id);

        if ($mitra->logo && File::exists(public_path($mitra->logo)) && str_starts_with($mitra->logo, 'uploads/')) {
            File::delete(public_path($mitra->logo));
        }

        $name = $mitra->name;
        $mitra->delete();

        return redirect()->route('admin.nilai.index')
                         ->with('success', "Mitra \"{$name}\" berhasil dihapus!");
    }
}
