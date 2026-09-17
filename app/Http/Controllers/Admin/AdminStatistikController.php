<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenyakit;
use App\Models\StatistikKunjungan;
use Illuminate\Http\Request;

class AdminStatistikController extends Controller
{
    public function index(Request $request)
    {
        $tahunFilter = $request->query('tahun', date('Y'));

        $penyakit = StatistikPenyakit::byTahun($tahunFilter)
            ->byBulan(null)
            ->orderBy('urutan', 'asc')
            ->get();

        $kunjungan = StatistikKunjungan::byTahun($tahunFilter)
            ->orderBy('bulan', 'asc')
            ->get();

        $totalKunjungan    = $kunjungan->sum('jumlah_kunjungan');
        $totalBaru         = $kunjungan->sum('kunjungan_baru');
        $totalLama         = $kunjungan->sum('kunjungan_lama');
        $totalKasusPenyakit = $penyakit->sum('jumlah_kasus');

        $tahunList = StatistikPenyakit::availableTahun()
            ->merge(StatistikKunjungan::availableTahun())
            ->unique()->sortDesc()->values();

        return view('admin.statistik.index', compact(
            'penyakit', 'kunjungan',
            'totalKunjungan', 'totalBaru', 'totalLama', 'totalKasusPenyakit',
            'tahunList', 'tahunFilter'
        ));
    }

    // ── Penyakit CRUD ──────────────────────────────────────────────────────────
    public function createPenyakit()
    {
        $tahunList = StatistikPenyakit::availableTahun()->prepend(date('Y'))->unique()->sortDesc()->values();
        return view('admin.statistik.penyakit-create', compact('tahunList'));
    }

    public function storePenyakit(Request $request)
    {
        $validated = $request->validate([
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'jumlah_kasus'  => ['required', 'integer', 'min:0'],
            'kode_icd'      => ['nullable', 'string', 'max:20'],
            'warna'         => ['nullable', 'string', 'max:20'],
            'urutan'        => ['required', 'integer', 'min:1', 'max:100'],
            'tahun'         => ['required', 'integer', 'min:2000'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        StatistikPenyakit::create([
            'nama_penyakit' => $validated['nama_penyakit'],
            'jumlah_kasus'  => $validated['jumlah_kasus'],
            'kode_icd'      => $validated['kode_icd'] ?? null,
            'warna'         => $validated['warna'] ?? null,
            'urutan'        => $validated['urutan'],
            'tahun'         => $validated['tahun'],
            'bulan'         => null,
            'is_active'     => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.statistik.index', ['tahun' => $validated['tahun']])
                         ->with('success', 'Data penyakit berhasil ditambahkan!');
    }

    public function editPenyakit($id)
    {
        $item = StatistikPenyakit::findOrFail($id);
        $tahunList = StatistikPenyakit::availableTahun()->prepend(date('Y'))->unique()->sortDesc()->values();
        return view('admin.statistik.penyakit-edit', compact('item', 'tahunList'));
    }

    public function updatePenyakit(Request $request, $id)
    {
        $item = StatistikPenyakit::findOrFail($id);

        $validated = $request->validate([
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'jumlah_kasus'  => ['required', 'integer', 'min:0'],
            'kode_icd'      => ['nullable', 'string', 'max:20'],
            'warna'         => ['nullable', 'string', 'max:20'],
            'urutan'        => ['required', 'integer', 'min:1', 'max:100'],
            'tahun'         => ['required', 'integer', 'min:2000'],
            'is_active'     => ['nullable', 'boolean'],
        ]);

        $item->update([
            'nama_penyakit' => $validated['nama_penyakit'],
            'jumlah_kasus'  => $validated['jumlah_kasus'],
            'kode_icd'      => $validated['kode_icd'] ?? null,
            'warna'         => $validated['warna'] ?? null,
            'urutan'        => $validated['urutan'],
            'tahun'         => $validated['tahun'],
            'is_active'     => $request->boolean('is_active', false),
        ]);

        return redirect()->route('admin.statistik.index', ['tahun' => $validated['tahun']])
                         ->with('success', 'Data penyakit berhasil diperbarui!');
    }

    public function destroyPenyakit($id)
    {
        StatistikPenyakit::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data penyakit berhasil dihapus!');
    }

    // ── Kunjungan CRUD ─────────────────────────────────────────────────────────
    public function createKunjungan()
    {
        $tahunList = StatistikKunjungan::availableTahun()->prepend(date('Y'))->unique()->sortDesc()->values();
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        return view('admin.statistik.kunjungan-create', compact('tahunList', 'bulanList'));
    }

    public function storeKunjungan(Request $request)
    {
        $validated = $request->validate([
            'tahun'             => ['required', 'integer', 'min:2000'],
            'bulan'             => ['required', 'integer', 'min:1', 'max:12'],
            'jumlah_kunjungan'  => ['required', 'integer', 'min:0'],
            'kunjungan_baru'    => ['required', 'integer', 'min:0'],
            'kunjungan_lama'    => ['required', 'integer', 'min:0'],
        ]);

        $bulanNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        StatistikKunjungan::updateOrCreate(
            ['tahun' => $validated['tahun'], 'bulan' => $validated['bulan']],
            [
                'bulan_label'      => $bulanNames[$validated['bulan']],
                'jumlah_kunjungan' => $validated['jumlah_kunjungan'],
                'kunjungan_baru'   => $validated['kunjungan_baru'],
                'kunjungan_lama'   => $validated['kunjungan_lama'],
            ]
        );

        return redirect()->route('admin.statistik.index', ['tahun' => $validated['tahun']])
                         ->with('success', 'Data kunjungan berhasil disimpan!');
    }

    public function editKunjungan($id)
    {
        $item = StatistikKunjungan::findOrFail($id);
        $tahunList = StatistikKunjungan::availableTahun()->prepend(date('Y'))->unique()->sortDesc()->values();
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];
        return view('admin.statistik.kunjungan-edit', compact('item', 'tahunList', 'bulanList'));
    }

    public function updateKunjungan(Request $request, $id)
    {
        $item = StatistikKunjungan::findOrFail($id);

        $validated = $request->validate([
            'tahun'            => ['required', 'integer', 'min:2000'],
            'bulan'            => ['required', 'integer', 'min:1', 'max:12'],
            'jumlah_kunjungan' => ['required', 'integer', 'min:0'],
            'kunjungan_baru'   => ['required', 'integer', 'min:0'],
            'kunjungan_lama'   => ['required', 'integer', 'min:0'],
        ]);

        $bulanNames = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        $item->update([
            'tahun'            => $validated['tahun'],
            'bulan'            => $validated['bulan'],
            'bulan_label'      => $bulanNames[$validated['bulan']],
            'jumlah_kunjungan' => $validated['jumlah_kunjungan'],
            'kunjungan_baru'   => $validated['kunjungan_baru'],
            'kunjungan_lama'   => $validated['kunjungan_lama'],
        ]);

        return redirect()->route('admin.statistik.index', ['tahun' => $validated['tahun']])
                         ->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    public function destroyKunjungan($id)
    {
        StatistikKunjungan::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data kunjungan berhasil dihapus!');
    }
}
