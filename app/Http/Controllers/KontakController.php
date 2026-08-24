<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::data();
        return view('admin.kontak.index', compact('kontak'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        Kontak::data()->update($request->only('alamat', 'email', 'telepon'));

        return redirect()->route('admin.kontak.index')
            ->with('success', 'Data kontak berhasil diperbarui!');
    }
}
