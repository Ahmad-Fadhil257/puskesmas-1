<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;
use App\Models\Dokter;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $allDokters = Dokter::all();
        $drJantung = $allDokters->where('specialty', 'Spesialis Jantung dan Pembuluh Darah')->first();
        $drBedah = $allDokters->where('specialty', 'Spesialis Bedah Umum')->first();
        $drAnak = $allDokters->where('specialty', 'Spesialis Anak')->first();
        $drKandungan = $allDokters->where('specialty', 'Spesialis Kandungan')->first();

        $services = [
            [
                'title'           => 'Poli Pemeriksaan Umum',
                'description'     => 'Pelayanan pemeriksaan kesehatan dasar, diagnosis penyakit umum, pengobatan rawat jalan, dan penerbitan surat keterangan sehat.',
                'icon'            => 'bx bx-pulse',
                'variant'         => 'default',
                'jam_operasional' => 'Senin - Sabtu: 08.00 - 14.00 WIB',
                'dokter_ids'      => $drBedah ? [$drBedah->id] : [],
                'tindakan_medis'  => "Pemeriksaan Fisik Lengkap\nPengukuran Tekanan Darah & Gula\nPengobatan Batuk, Flu & Demam\nSurat Keterangan Sehat (KIR Dokter)\nKonsultasi Pola Hidup Sehat",
                'persyaratan'     => "Membawa e-KTP / Kartu Identitas Asli\nMembawa Kartu BPJS Kesehatan / KIS Aktif (Faskes 1 Puskesmas)\nBagi pasien lama: Membawa Kartu Berobat",
                'btn_text'        => 'Daftar Poli Umum',
                'btn_link'        => null,
                'is_active'       => true,
            ],
            [
                'title'           => 'Poliklinik Spesialis',
                'description'     => 'Konsultasikan dengan dokter spesialis berpengalaman untuk penanganan terarah penyakit jantung, bedah, anak, dan kandungan.',
                'icon'            => 'bx bx-plus-medical',
                'variant'         => 'featured',
                'jam_operasional' => 'Sesuai Jadwal Dokter (08.00 - 13.00 WIB)',
                'dokter_ids'      => $allDokters->pluck('id')->toArray(),
                'tindakan_medis'  => "Pemeriksaan & EKG Jantung Dasar\nKonsultasi Bedah Minor & Rawat Luka\nPemeriksaan Tumbuh Kembang Anak\nKonsultasi Kehamilan & USG Dasar\nRujukan Spesialistik Rumah Sakit",
                'persyaratan'     => "Surat Rujukan dari Dokter Umum (jika rujukan internal)\nMembawa Kartu BPJS Kesehatan Aktif\ne-KTP / Kartu Keluarga",
                'btn_text'        => 'Konsultasi Spesialis',
                'btn_link'        => null,
                'is_active'       => true,
            ],
            [
                'title'           => 'Poli Kesehatan Ibu & Anak (KIA)',
                'description'     => 'Pelayanan antenatal care (pemeriksaan kehamilan), imunisasi dasar bayi & balita, KB (Keluarga Berencana), serta pemantauan gizi anak.',
                'icon'            => 'bx bx-face',
                'variant'         => 'default',
                'jam_operasional' => 'Senin - Jumat: 08.00 - 13.00 WIB',
                'dokter_ids'      => array_filter([$drAnak ? $drAnak->id : null, $drKandungan ? $drKandungan->id : null]),
                'tindakan_medis'  => "Pemeriksaan Kehamilan (ANC Terpadu)\nImunisasi Lengkap Bayi & Balita (BCG, DPT, Polio, Campak)\nPelayanan KB (Suntik, IUD, Implan, Pil)\nPemantauan Tumbuh Kembang & Stunting\nKonseling ASI Eksklusif & MPASI",
                'persyaratan'     => "Buku KIA (Kesehatan Ibu dan Anak) warna pink\nKartu BPJS Kesehatan & KTP Ibu\nKartu Identitas Anak (KIA) / Akta Lahir (untuk imunisasi)",
                'btn_text'        => 'Daftar Poli KIA',
                'btn_link'        => null,
                'is_active'       => true,
            ],
            [
                'title'           => 'Layanan Farmasi & Apotek',
                'description'     => 'Penyediaan dan penyerahan obat resep dokter Puskesmas secara cepat, aman, dan disertai edukasi cara pemakaian obat yang tepat.',
                'icon'            => 'bx bx-capsule',
                'variant'         => 'default',
                'jam_operasional' => 'Senin - Sabtu: 08.00 - 15.00 WIB',
                'dokter_ids'      => [],
                'tindakan_medis'  => "Penebusan Resep Obat BPJS & Umum\nKonseling & Edukasi Informasi Obat (PIO)\nPelayanan Obat Penyakit Kronis (Prolanis)\nPenyediaan Obat Generik & Paten Standar Kemenkes",
                'persyaratan'     => "Membawa Lembar Resep Asli dari Dokter Puskesmas\nMenunjukkan Nomor Antrean Pendaftaran / Kartu Pasien",
                'btn_text'        => 'Tanya Apoteker',
                'btn_link'        => null,
                'is_active'       => true,
            ],
            [
                'title'           => 'Laboratorium Medis',
                'description'     => 'Pemeriksaan penunjang diagnostik spesimen darah, urine, dan dahak untuk memastikan diagnosis dokter secara akurat.',
                'icon'            => 'bx bx-test-tube',
                'variant'         => 'default',
                'jam_operasional' => 'Senin - Sabtu: 08.00 - 12.30 WIB',
                'dokter_ids'      => [],
                'tindakan_medis'  => "Cek Darah Lengkap (Hematologi Rutin)\nPemeriksaan Gula Darah Sewaktu / Puasa\nCek Kolesterol Total & Asam Urat\nTes Urine Lengkap & Tes Kehamilan (Plano Test)\nPemeriksaan Golongan Darah & Rhesus\nTes Dahak TCM (TBC)",
                'persyaratan'     => "Membawa Formulir Rujukan Lab dari Dokter Puskesmas\nPuasa 8-10 jam (khusus pemeriksaan Gula Puasa & Profil Lemak)\nKartu BPJS Kesehatan / KTP",
                'btn_text'        => 'Informasi Tes Lab',
                'btn_link'        => null,
                'is_active'       => true,
            ],
            [
                'title'           => 'Unit Gawat Darurat (UGD 24 Jam)',
                'description'     => 'Layanan medis tanggap darurat 24 jam nonstop untuk pertolongan pertama pasien kritis, kecelakaan, dan evakuasi ambulans siaga.',
                'icon'            => 'bx bx-alarm-exclamation',
                'variant'         => 'emergency',
                'jam_operasional' => 'Buka Setiap Hari 24 Jam Nonstop',
                'dokter_ids'      => array_filter([$drBedah ? $drBedah->id : null]),
                'tindakan_medis'  => "Pertolongan Pertama Resusitasi Jantung Paru (RJP)\nPenanganan Luka Trauma, Luka Bakar & Jahit Luka\nTerapi Oksigenasi & Nebulisasi Asma Akut\nPemasangan Infus & Kateter Darurat\nLayanan Ambulans Siaga & Rujukan Gawat Darurat",
                'persyaratan'     => "Prioritas Utama Langsung Ditangani Medis Tanpa Menunggu Berkas\nKeluarga dapat menyusulkan e-KTP & Kartu BPJS setelah pasien stabil",
                'btn_text'        => 'Hubungi Hotline UGD',
                'btn_link'        => null,
                'is_active'       => true,
            ],
        ];

        foreach ($services as $service) {
            Layanan::updateOrCreate(
                ['title' => $service['title']],
                $service
            );
        }
    }
}
