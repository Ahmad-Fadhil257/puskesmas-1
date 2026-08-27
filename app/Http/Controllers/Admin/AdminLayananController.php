<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Dokter;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    /**
     * Tampilkan daftar layanan di Dashboard Admin
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Layanan::query()->orderBy('order', 'asc')->orderBy('id', 'asc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $layanans = $query->paginate(15)->withQueryString();
        $totalLayanan = Layanan::count();

        return view('admin.layanan.index', compact('layanans', 'search', 'totalLayanan'));
    }

    /**
     * Form tambah layanan baru
     */
    public function create()
    {
        $dokters = Dokter::where('is_active', true)->orderBy('name', 'asc')->get();
        $categories = array_keys(Layanan::getKategoriList());
        $nextOrder = (Layanan::max('order') ?? 0) + 1;
        return view('admin.layanan.create', compact('dokters', 'categories', 'nextOrder'));
    }

    /**
     * Simpan layanan baru ke database
     */
    public function store(Request $request)
    {
        $kategoriList = Layanan::getKategoriList();
        $validCategories = implode(',', array_keys($kategoriList));

        $validated = $request->validate([
            'order'              => 'nullable|integer|min:1',
            'title'              => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:layanans,slug',
            'kategori'           => 'required|string|in:' . $validCategories,
            'description'        => 'required|string',
            'icon'               => 'required|string|max:100',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'jam_operasional'    => 'nullable|string|max:255',
            'jadwal_pendaftaran' => 'nullable|string',
            'dokter_ids'         => 'nullable|array',
            'dokter_ids.*'       => 'integer|exists:dokters,id',
            'tindakan_medis'     => 'nullable|string',
            'persyaratan'        => 'nullable|string',
            'btn_text'           => 'nullable|string|max:100',
        ]);

        $order = $validated['order'] ?? ((Layanan::max('order') ?? 0) + 1);
        $kategoriData = $kategoriList[$validated['kategori']] ?? ['variant' => 'default', 'badge' => 'BPJS & UMUM'];

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = 'layanan_' . time() . '_' . \Illuminate\Support\Str::random(6) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/layanan');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $imageName);
        }

        $slug = !empty($validated['slug']) ? \Illuminate\Support\Str::slug($validated['slug']) : \Illuminate\Support\Str::slug($validated['title']);

        Layanan::create([
            'order'              => $order,
            'title'              => $validated['title'],
            'slug'               => $slug,
            'kategori'           => $validated['kategori'],
            'description'        => $validated['description'],
            'image'              => $imageName,
            'icon'               => $validated['icon'],
            'variant'            => $kategoriData['variant'],
            'tipe_jaminan'       => $kategoriData['badge'],
            'jam_operasional'    => $validated['jam_operasional'] ?? 'Senin - Sabtu: 08.00 - 14.00 WIB',
            'jadwal_pendaftaran' => $validated['jadwal_pendaftaran'] ?? null,
            'dokter_ids'         => $validated['dokter_ids'] ?? [],
            'tindakan_medis'     => $validated['tindakan_medis'] ?? null,
            'persyaratan'        => $validated['persyaratan'] ?? null,
            'btn_text'           => $validated['btn_text'] ?? ($kategoriData['variant'] === 'emergency' ? 'Hubungi kami' : 'Janji Temu / Pendaftaran'),
            'btn_link'           => null,
            'is_active'          => true,
        ]);

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Form edit layanan
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $dokters = Dokter::where('is_active', true)->orderBy('name', 'asc')->get();
        $categories = array_keys(Layanan::getKategoriList());
        return view('admin.layanan.edit', compact('layanan', 'dokters', 'categories'));
    }

    /**
     * Update data layanan
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $kategoriList = Layanan::getKategoriList();
        $validCategories = implode(',', array_keys($kategoriList));

        $validated = $request->validate([
            'order'              => 'required|integer|min:1',
            'title'              => 'required|string|max:255',
            'slug'               => 'nullable|string|max:255|unique:layanans,slug,' . $layanan->id,
            'kategori'           => 'required|string|in:' . $validCategories,
            'description'        => 'required|string',
            'icon'               => 'required|string|max:100',
            'image'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
            'jam_operasional'    => 'nullable|string|max:255',
            'jadwal_pendaftaran' => 'nullable|string',
            'dokter_ids'         => 'nullable|array',
            'dokter_ids.*'       => 'integer|exists:dokters,id',
            'tindakan_medis'     => 'nullable|string',
            'persyaratan'        => 'nullable|string',
            'btn_text'           => 'nullable|string|max:100',
        ]);

        $kategoriData = $kategoriList[$validated['kategori']] ?? ['variant' => 'default', 'badge' => 'BPJS & UMUM'];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = 'layanan_' . time() . '_' . \Illuminate\Support\Str::random(6) . '.' . $file->getClientOriginalExtension();
            $uploadPath = public_path('uploads/layanan');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            $file->move($uploadPath, $imageName);

            // Hapus file lama jika ada
            if ($layanan->image && file_exists($uploadPath . '/' . $layanan->image)) {
                @unlink($uploadPath . '/' . $layanan->image);
            }
            $layanan->image = $imageName;
        }

        $slug = !empty($validated['slug']) ? \Illuminate\Support\Str::slug($validated['slug']) : ($layanan->slug ?: \Illuminate\Support\Str::slug($validated['title']));

        $layanan->order              = $validated['order'];
        $layanan->title              = $validated['title'];
        $layanan->slug               = $slug;
        $layanan->kategori           = $validated['kategori'];
        $layanan->description        = $validated['description'];
        $layanan->icon               = $validated['icon'];
        $layanan->variant            = $kategoriData['variant'];
        $layanan->tipe_jaminan       = $kategoriData['badge'];
        $layanan->jam_operasional    = $validated['jam_operasional'] ?? 'Senin - Sabtu: 08.00 - 14.00 WIB';
        $layanan->jadwal_pendaftaran = $validated['jadwal_pendaftaran'] ?? null;
        $layanan->dokter_ids         = $validated['dokter_ids'] ?? [];
        $layanan->tindakan_medis     = $validated['tindakan_medis'] ?? null;
        $layanan->persyaratan        = $validated['persyaratan'] ?? null;
        $layanan->btn_text           = $validated['btn_text'] ?? ($kategoriData['variant'] === 'emergency' ? 'Hubungi kami' : 'Janji Temu / Pendaftaran');
        $layanan->save();

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Data layanan berhasil diperbarui!');
    }

    /**
     * Ubah urutan naik atau turun
     */
    public function reorder(Request $request, $id)
    {
        $direction = $request->input('direction');
        $current = Layanan::findOrFail($id);

        if ($direction === 'up') {
            $prev = Layanan::where('order', '<', $current->order)
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
            $next = Layanan::where('order', '>', $current->order)
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

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Urutan kartu layanan berhasil diubah!');
    }

    /**
     * Hapus layanan
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Layanan berhasil dihapus!');
    }
}
