<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Tampilkan halaman kelola identitas & logo
     */
    public function index()
    {
        $setting = AppSetting::getSettings();
        return view('admin.settings.index', compact('setting'));
    }

    /**
     * Perbarui identitas, nama aplikasi, dan logo
     */
    public function update(Request $request)
    {
        $setting = AppSetting::getSettings();

        $request->validate([
            'app_name' => ['nullable', 'string', 'max:100'],
            'show_app_name' => ['nullable', 'boolean'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,svg,webp', 'max:3072'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:100'],
            'address' => ['nullable', 'string', 'max:500'],
        ], [
            'logo.image' => 'File logo harus berupa gambar.',
            'logo.mimes' => 'Format logo yang diizinkan: PNG, JPG, JPEG, SVG, WEBP.',
            'logo.max' => 'Ukuran file logo maksimal 3 MB.',
        ]);

        $data = [
            'app_name' => $request->app_name,
            'show_app_name' => $request->boolean('show_app_name', false),
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ];

        // Handle upload logo baru
        if ($request->hasFile('logo')) {
            $uploadDir = public_path('uploads/logo');
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $file = $request->file('logo');
            $fileName = 'logo_' . time() . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
            $file->move($uploadDir, $fileName);

            // Hapus logo lama jika ada di folder uploads
            if ($setting->logo && file_exists($uploadDir . '/' . $setting->logo)) {
                @unlink($uploadDir . '/' . $setting->logo);
            }

            $data['logo'] = $fileName;
        }

        $setting->update($data);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan identitas dan logo aplikasi berhasil diperbarui!');
    }
}
