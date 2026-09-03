<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminInfografisController extends Controller
{
    public function index(Request $request)
    {
        $query = Infografis::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $infografis = $query->orderBy('order', 'asc')->orderBy('id', 'desc')->paginate(12)->withQueryString();
        $kategoris = Infografis::distinct()->whereNotNull('kategori')->pluck('kategori');
        $totalInfografis = Infografis::count();
        $totalActive = Infografis::where('is_active', true)->count();

        return view('admin.infografis.index', compact('infografis', 'kategoris', 'totalInfografis', 'totalActive'));
    }

    public function create()
    {
        return redirect()->route('admin.infografis.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'image'     => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ], [
            'image.required' => 'Gambar infografis wajib diunggah.',
            'image.max'      => 'Ukuran gambar maksimal 5 MB.',
        ]);

        $uploadDir = public_path('uploads/infografis');
        if (!\Illuminate\Support\Facades\File::isDirectory($uploadDir)) {
            \Illuminate\Support\Facades\File::makeDirectory($uploadDir, 0755, true, true);
        }
        $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
        $request->file('image')->move($uploadDir, $filename);

        Infografis::create([
            'title'      => $request->title,
            'kategori'   => \Illuminate\Support\Str::title(trim($request->kategori)),
            'image_path' => 'uploads/infografis/' . $filename,
            'is_active'  => $request->boolean('is_active', true),
            'order'      => $request->order ?? 0,
        ]);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Infografis berhasil ditambahkan.');
    }

    public function edit(Infografis $infografis)
    {
        return redirect()->route('admin.infografis.index');
    }

    public function update(Request $request, Infografis $infografis)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'kategori'  => 'required|string|max:100',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'order'     => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'title'     => $request->title,
            'kategori'  => \Illuminate\Support\Str::title(trim($request->kategori)),
            'is_active' => $request->boolean('is_active', true),
            'order'     => $request->order ?? 0,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($infografis->image_path && \Illuminate\Support\Facades\File::exists(public_path($infografis->image_path))) {
                \Illuminate\Support\Facades\File::delete(public_path($infografis->image_path));
            }
            $uploadDir = public_path('uploads/infografis');
            if (!\Illuminate\Support\Facades\File::isDirectory($uploadDir)) {
                \Illuminate\Support\Facades\File::makeDirectory($uploadDir, 0755, true, true);
            }
            $filename = time() . '_' . \Illuminate\Support\Str::random(10) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move($uploadDir, $filename);
            $data['image_path'] = 'uploads/infografis/' . $filename;
        }

        $infografis->update($data);

        return redirect()->route('admin.infografis.index')
            ->with('success', 'Infografis berhasil diperbarui.');
    }

    public function destroy(Infografis $infografis)
    {
        if ($infografis->image_path && \Illuminate\Support\Facades\File::exists(public_path($infografis->image_path))) {
            \Illuminate\Support\Facades\File::delete(public_path($infografis->image_path));
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
