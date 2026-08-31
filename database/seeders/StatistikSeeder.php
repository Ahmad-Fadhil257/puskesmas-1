<?php

namespace Database\Seeders;

use App\Models\StatistikPenyakit;
use App\Models\StatistikKunjungan;
use Illuminate\Database\Seeder;

class StatistikSeeder extends Seeder
{
    public function run(): void
    {
        $tahun = 2025;

        // ── 10 Penyakit Terbanyak (Data Tahunan) ──────────────────────────────
        $penyakit = [
            ['nama_penyakit' => 'Hipertensi (Tekanan Darah Tinggi)', 'jumlah_kasus' => 1842, 'kode_icd' => 'I10', 'warna' => '#EF4444', 'urutan' => 1],
            ['nama_penyakit' => 'Infeksi Saluran Pernafasan Atas (ISPA)', 'jumlah_kasus' => 1631, 'kode_icd' => 'J06', 'warna' => '#3B82F6', 'urutan' => 2],
            ['nama_penyakit' => 'Diabetes Melitus Tipe 2', 'jumlah_kasus' => 1205, 'kode_icd' => 'E11', 'warna' => '#F59E0B', 'urutan' => 3],
            ['nama_penyakit' => 'Gastritis & Duodenitis', 'jumlah_kasus' => 984, 'kode_icd' => 'K29', 'warna' => '#10B981', 'urutan' => 4],
            ['nama_penyakit' => 'Diare & Gastroenteritis', 'jumlah_kasus' => 876, 'kode_icd' => 'A09', 'warna' => '#8B5CF6', 'urutan' => 5],
            ['nama_penyakit' => 'Demam Berdarah Dengue (DBD)', 'jumlah_kasus' => 743, 'kode_icd' => 'A91', 'warna' => '#F97316', 'urutan' => 6],
            ['nama_penyakit' => 'Penyakit Kulit & Alergi', 'jumlah_kasus' => 698, 'kode_icd' => 'L30', 'warna' => '#EC4899', 'urutan' => 7],
            ['nama_penyakit' => 'Arthritis & Nyeri Sendi', 'jumlah_kasus' => 612, 'kode_icd' => 'M13', 'warna' => '#06B6D4', 'urutan' => 8],
            ['nama_penyakit' => 'Tuberkulosis (TBC)', 'jumlah_kasus' => 534, 'kode_icd' => 'A15', 'warna' => '#84CC16', 'urutan' => 9],
            ['nama_penyakit' => 'Anemia', 'jumlah_kasus' => 487, 'kode_icd' => 'D64', 'warna' => '#14B8A6', 'urutan' => 10],
        ];

        foreach ($penyakit as $item) {
            StatistikPenyakit::firstOrCreate(
                ['nama_penyakit' => $item['nama_penyakit'], 'tahun' => $tahun, 'bulan' => null],
                array_merge($item, ['tahun' => $tahun, 'bulan' => null, 'is_active' => true])
            );
        }

        // ── Kunjungan Pasien Per Bulan ─────────────────────────────────────────
        $kunjungan = [
            ['bulan' => 1,  'bulan_label' => 'Januari',   'jumlah_kunjungan' => 1120, 'kunjungan_baru' => 312, 'kunjungan_lama' => 808],
            ['bulan' => 2,  'bulan_label' => 'Februari',  'jumlah_kunjungan' => 985,  'kunjungan_baru' => 278, 'kunjungan_lama' => 707],
            ['bulan' => 3,  'bulan_label' => 'Maret',     'jumlah_kunjungan' => 1340, 'kunjungan_baru' => 401, 'kunjungan_lama' => 939],
            ['bulan' => 4,  'bulan_label' => 'April',     'jumlah_kunjungan' => 1198, 'kunjungan_baru' => 356, 'kunjungan_lama' => 842],
            ['bulan' => 5,  'bulan_label' => 'Mei',       'jumlah_kunjungan' => 1420, 'kunjungan_baru' => 423, 'kunjungan_lama' => 997],
            ['bulan' => 6,  'bulan_label' => 'Juni',      'jumlah_kunjungan' => 1056, 'kunjungan_baru' => 290, 'kunjungan_lama' => 766],
            ['bulan' => 7,  'bulan_label' => 'Juli',      'jumlah_kunjungan' => 1380, 'kunjungan_baru' => 415, 'kunjungan_lama' => 965],
            ['bulan' => 8,  'bulan_label' => 'Agustus',   'jumlah_kunjungan' => 1512, 'kunjungan_baru' => 467, 'kunjungan_lama' => 1045],
            ['bulan' => 9,  'bulan_label' => 'September', 'jumlah_kunjungan' => 1287, 'kunjungan_baru' => 388, 'kunjungan_lama' => 899],
            ['bulan' => 10, 'bulan_label' => 'Oktober',   'jumlah_kunjungan' => 1463, 'kunjungan_baru' => 444, 'kunjungan_lama' => 1019],
            ['bulan' => 11, 'bulan_label' => 'November',  'jumlah_kunjungan' => 1329, 'kunjungan_baru' => 397, 'kunjungan_lama' => 932],
            ['bulan' => 12, 'bulan_label' => 'Desember',  'jumlah_kunjungan' => 1102, 'kunjungan_baru' => 318, 'kunjungan_lama' => 784],
        ];

        foreach ($kunjungan as $item) {
            StatistikKunjungan::firstOrCreate(
                ['tahun' => $tahun, 'bulan' => $item['bulan']],
                array_merge($item, ['tahun' => $tahun])
            );
        }
    }
}
