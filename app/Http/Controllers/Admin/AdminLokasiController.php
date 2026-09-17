<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;

class AdminLokasiController extends Controller
{
    /**
     * Tampilkan halaman kelola lokasi & peta puskesmas
     */
    public function index()
    {
        $setting = AppSetting::getSettings();
        return view('admin.lokasi.index', compact('setting'));
    }

    /**
     * Perbarui data lokasi, peta, dan kontak operasional
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'landmark'        => 'nullable|string|max:255',
            'maps_iframe_url' => 'nullable|string',
            'maps_link'       => 'nullable|string|max:500',
            'emergency_info'  => 'nullable|string|max:100',
        ]);

        $setting = AppSetting::getSettings();
        $setting->update($validated);

        return redirect()->route('admin.lokasi.index')
                         ->with('success', 'Informasi peta, landmark, dan UGD berhasil diperbarui!');
    }
}
