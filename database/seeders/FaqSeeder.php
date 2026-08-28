<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        if (Faq::count() > 0) {
            return;
        }

        $faqs = [
            [
                'pertanyaan' => 'Bagaimana cara mendaftar berobat menggunakan BPJS Kesehatan / KIS?',
                'jawaban'    => 'Pasien cukup membawa KTP/KK asli dan Kartu BPJS Kesehatan / KIS aktif (dapat juga menunjukkan KIS digital melalui aplikasi Mobile JKN), serta Kartu Berobat Puskesmas bagi pasien lama. Pastikan faskes tingkat pertama (FKTP) Anda terdaftar di Puskesmas kami.',
                'kategori'   => 'BPJS & Jaminan Kesehatan',
                'urutan'     => 1,
                'is_active'  => true,
            ],
            [
                'pertanyaan' => 'Apakah pasien dengan BPJS luar kota / faskes lain bisa berobat di Puskesmas?',
                'jawaban'    => 'Bisa. Sesuai regulasi BPJS Kesehatan, peserta jaminan yang sedang berada di luar domisili FKTP dapat dilayani di Puskesmas kami maksimal 3 kali kunjungan dalam 1 bulan untuk penanganan medis awal.',
                'kategori'   => 'BPJS & Jaminan Kesehatan',
                'urutan'     => 2,
                'is_active'  => true,
            ],
            [
                'pertanyaan' => 'Bagaimana alur dan syarat mendapatkan surat rujukan ke Rumah Sakit (RSUD)?',
                'jawaban'    => 'Pasien wajib menjalani pemeriksaan terlebih dahulu di poliklinik Puskesmas. Surat rujukan online (Sistem Rujukan Terintegrasi P-Care) akan diterbitkan oleh dokter pemeriksa apabila secara indikasi medis kondisi pasien memerlukan penanganan spesialistik lanjutan di rumah sakit rujukan.',
                'kategori'   => 'UGD & Rujukan',
                'urutan'     => 3,
                'is_active'  => true,
            ],
            [
                'pertanyaan' => 'Apakah layanan UGD (Unit Gawat Darurat) dan Bersalin buka 24 jam?',
                'jawaban'    => 'Ya, layanan UGD dan Penanganan Persalinan beroperasi selama 24 jam setiap hari, termasuk hari Minggu dan hari libur nasional. Pasien dengan kondisi darurat medis dapat langsung menuju ruang UGD tanpa antre loket.',
                'kategori'   => 'UGD & Rujukan',
                'urutan'     => 4,
                'is_active'  => true,
            ],
            [
                'pertanyaan' => 'Kapan jadwal pendaftaran loket rawat jalan dibuka dan ditutup?',
                'jawaban'    => 'Pendaftaran loket buka Senin - Kamis pukul 07.30 - 12.00 WIB, Jumat pukul 07.30 - 10.30 WIB, dan Sabtu pukul 07.30 - 11.30 WIB. Disarankan datang lebih awal untuk mengambil nomor antrean loket.',
                'kategori'   => 'Umum & Pendaftaran',
                'urutan'     => 5,
                'is_active'  => true,
            ],
            [
                'pertanyaan' => 'Apa saja jenis pemeriksaan laboratorium yang tersedia di Puskesmas?',
                'jawaban'    => 'Laboratorium kami melayani tes darah rutin, hemoglobin, gula darah sewaktu/puasa, kolesterol, asam urat, tes urin lengkap, tes kehamilan, pemeriksaan dahak (TBC), dan skrining penyakit menular dengan hasil cepat pada hari yang sama.',
                'kategori'   => 'Laboratorium & Farmasi',
                'urutan'     => 6,
                'is_active'  => true,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
