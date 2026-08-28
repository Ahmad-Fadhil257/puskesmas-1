<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    /**
     * Tampilkan daftar FAQ di Dashboard Admin
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryFilter = $request->query('kategori');
        $statusFilter = $request->query('status');

        $query = Faq::orderBy('urutan', 'asc')->orderBy('id', 'asc');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                  ->orWhere('jawaban', 'like', "%{$search}%");
            });
        }

        if (!empty($categoryFilter)) {
            $query->where('kategori', $categoryFilter);
        }

        if ($statusFilter === 'active') {
            $query->where('is_active', true);
        } elseif ($statusFilter === 'inactive') {
            $query->where('is_active', false);
        }

        $faqs = $query->paginate(15)->withQueryString();

        $totalFaq = Faq::count();
        $totalActive = Faq::where('is_active', true)->count();
        $categories = Faq::getKategoriList();

        return view('admin.faq.index', compact('faqs', 'totalFaq', 'totalActive', 'categories', 'search', 'categoryFilter', 'statusFilter'));
    }

    /**
     * Form tambah FAQ baru
     */
    public function create()
    {
        $categories = Faq::getKategoriList();
        $nextOrder = (Faq::max('urutan') ?? 0) + 1;
        return view('admin.faq.create', compact('categories', 'nextOrder'));
    }

    /**
     * Simpan FAQ baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban'    => ['required', 'string'],
            'kategori'   => ['required', 'string', 'max:100'],
            'urutan'     => ['nullable', 'integer', 'min:1'],
            'is_active'  => ['nullable', 'boolean'],
        ], [
            'pertanyaan.required' => 'Teks pertanyaan wajib diisi.',
            'jawaban.required'    => 'Teks jawaban lengkap wajib diisi.',
            'kategori.required'   => 'Kategori pertanyaan wajib dipilih.',
        ]);

        $urutan = $validated['urutan'] ?? ((Faq::max('urutan') ?? 0) + 1);

        Faq::create([
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban'    => $validated['jawaban'],
            'kategori'   => $validated['kategori'],
            'urutan'     => $urutan,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.faq.index')
                         ->with('success', 'Pertanyaan FAQ baru berhasil ditambahkan!');
    }

    /**
     * Form ubah data FAQ
     */
    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        $categories = Faq::getKategoriList();
        return view('admin.faq.edit', compact('faq', 'categories'));
    }

    /**
     * Simpan pembaruan data FAQ
     */
    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);

        $validated = $request->validate([
            'pertanyaan' => ['required', 'string', 'max:255'],
            'jawaban'    => ['required', 'string'],
            'kategori'   => ['required', 'string', 'max:100'],
            'urutan'     => ['required', 'integer', 'min:1'],
            'is_active'  => ['nullable', 'boolean'],
        ], [
            'pertanyaan.required' => 'Teks pertanyaan wajib diisi.',
            'jawaban.required'    => 'Teks jawaban lengkap wajib diisi.',
            'kategori.required'   => 'Kategori pertanyaan wajib dipilih.',
            'urutan.required'     => 'Nomor urut prioritas wajib diisi.',
        ]);

        $faq->update([
            'pertanyaan' => $validated['pertanyaan'],
            'jawaban'    => $validated['jawaban'],
            'kategori'   => $validated['kategori'],
            'urutan'     => $validated['urutan'],
            'is_active'  => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.faq.index')
                         ->with('success', 'Pertanyaan FAQ berhasil diperbarui!');
    }

    /**
     * Hapus pertanyaan FAQ
     */
    public function destroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('admin.faq.index')
                         ->with('success', 'Pertanyaan FAQ berhasil dihapus!');
    }

    /**
     * Toggle status aktif/non-aktif FAQ (AJAX)
     */
    public function toggleStatus($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->is_active = !$faq->is_active;
        $faq->save();

        return response()->json([
            'success' => true,
            'is_active' => $faq->is_active,
            'message' => 'Status aktif FAQ berhasil diperbarui!'
        ]);
    }
}
