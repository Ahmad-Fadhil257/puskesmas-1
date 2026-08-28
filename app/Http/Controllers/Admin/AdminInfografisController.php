<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInfografisController extends Controller
{
    public function index()
    {
        $infografis = Infografis::orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(12);
        $kategoris = Infografis::distinct()->pluck('kategori');
        return view('admin.infografis.index', compact('infografis', 'kategoris'));
    }

    public function create()
    {
        return view('admin.infografis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'image.required' => 'Gambar infografis wajib diunggah.',
            'image.max'      => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $path = $request->file('image')->store('uploads/infografis', 'public');

        Infografis::create([
            'title'      => $request->title,
            'kategori'   => $request->kategori,
            'deskripsi'  => $request->deskripsi,
            'image_path' => 'storage/' . $path,
            'is_active'  => $request->boolean('is_active', true),
            'order'      => $request->order ?? 0,
        ]);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Infografis berhasil ditambahkan.');
    }

    public function edit(Infografis $infografis)
    {
        return view('admin.infografis.edit', compact('infografis'));
    }

    public function update(Request $request, Infografis $infografis)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'deskripsi' => 'nullable|string|max:500',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title'     => $request->title,
            'kategori'  => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'is_active' => $request->boolean('is_active', true),
            'order'     => $request->order ?? 0,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            $oldPath = str_replace('storage/', '', $infografis->image_path);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
            $path = $request->file('image')->store('uploads/infografis', 'public');
            $data['image_path'] = 'storage/' . $path;
        }

        $infografis->update($data);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Infografis berhasil diperbarui.');
    }

    public function destroy(Infografis $infografis)
    {
        $oldPath = str_replace('storage/', '', $infografis->image_path);
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
        $infografis->delete();

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Infografis berhasil dihapus.');
    }

    public function toggleStatus(Infografis $infografis)
    {
        $infografis->update(['is_active' => !$infografis->is_active]);
        return back()->with('success', 'Status infografis diperbarui.');
    }
}
