<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class AdminLayananController extends Controller
{
    /**
     * Tampilkan daftar layanan di Dashboard Admin
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Layanan::query()->orderBy('created_at', 'asc');

        if ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $layanans = $query->paginate(10)->withQueryString();
        $totalLayanan = Layanan::count();

        return view('admin.layanan.index', compact('layanans', 'search', 'totalLayanan'));
    }

    /**
     * Form tambah layanan baru
     */
    public function create()
    {
        return view('admin.layanan.create');
    }

    /**
     * Simpan layanan baru ke database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:100',
            'variant'     => 'required|string|in:default,featured,emergency',
            'btn_text'    => 'nullable|string|max:100',
            'btn_link'    => 'nullable|string|max:255',
        ]);

        Layanan::create([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'icon'        => $validated['icon'],
            'variant'     => $validated['variant'],
            'btn_text'    => $validated['btn_text'] ?? null,
            'btn_link'    => $validated['btn_link'] ?? null,
            'is_active'   => true,
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
        return view('admin.layanan.edit', compact('layanan'));
    }

    /**
     * Update data layanan
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'required|string|max:100',
            'variant'     => 'required|string|in:default,featured,emergency',
            'btn_text'    => 'nullable|string|max:100',
            'btn_link'    => 'nullable|string|max:255',
        ]);

        $layanan->title       = $validated['title'];
        $layanan->description = $validated['description'];
        $layanan->icon        = $validated['icon'];
        $layanan->variant     = $validated['variant'];
        $layanan->btn_text    = $validated['btn_text'] ?? null;
        $layanan->btn_link    = $validated['btn_link'] ?? null;
        $layanan->save();

        return redirect()->route('admin.layanan.index')
                         ->with('success', 'Data layanan berhasil diperbarui!');
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
