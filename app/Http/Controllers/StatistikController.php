<?php

namespace App\Http\Controllers;

use App\Models\StatistikPenyakit;
use App\Models\StatistikKunjungan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function index(Request $request)
    {
        // Ambil tahun yang tersedia
        $tahunPenyakit   = StatistikPenyakit::availableTahun();
        $tahunKunjungan  = StatistikKunjungan::availableTahun();
        $tahunList       = $tahunPenyakit->merge($tahunKunjungan)->unique()->sortDesc()->values();

        $tahunFilter = $request->query('tahun', $tahunList->first() ?? date('Y'));

        // 10 penyakit terbanyak aktif
        $penyakit = StatistikPenyakit::active()
            ->byTahun($tahunFilter)
            ->byBulan(null)
            ->orderBy('urutan', 'asc')
            ->limit(10)
            ->get();

        // Kunjungan per bulan
        $kunjungan = StatistikKunjungan::byTahun($tahunFilter)
            ->orderBy('bulan', 'asc')
            ->get();

        $totalKunjungan = $kunjungan->sum('jumlah_kunjungan');
        $totalBaru      = $kunjungan->sum('kunjungan_baru');
        $totalLama      = $kunjungan->sum('kunjungan_lama');
        $maxKasus       = $penyakit->max('jumlah_kasus') ?: 1;

        return view('statistik', compact(
            'penyakit', 'kunjungan',
            'totalKunjungan', 'totalBaru', 'totalLama', 'maxKasus',
            'tahunList', 'tahunFilter'
        ));
    }
}
