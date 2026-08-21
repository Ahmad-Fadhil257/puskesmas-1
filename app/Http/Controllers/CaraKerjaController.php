<?php

namespace App\Http\Controllers;

use App\Models\CaraKerja;
use Illuminate\Http\Request;

class CaraKerjaController extends Controller
{
    public function index()
    {
        $data = CaraKerja::orderBy('urutan', 'asc')->get();
        return view('admin.cara-kerja.index', compact('data'));
    }

    public function create()
    {
        return view('admin.cara-kerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'urutan' => 'required|integer|min:1',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        CaraKerja::create($request->only('urutan', 'judul', 'deskripsi'));

        return redirect()->route('admin.cara-kerja.index')
            ->with('success', 'Data cara kerja berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $item = CaraKerja::findOrFail($id);
        return view('admin.cara-kerja.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'urutan' => 'required|integer|min:1',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $item = CaraKerja::findOrFail($id);
        $item->update($request->only('urutan', 'judul', 'deskripsi'));

        return redirect()->route('admin.cara-kerja.index')
            ->with('success', 'Data cara kerja berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $item = CaraKerja::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.cara-kerja.index')
            ->with('success', 'Data cara kerja berhasil dihapus!');
    }
}
