<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Konsultasi Kesehatan',
                'description' => 'Panduan profesional untuk menjaga gaya hidup sehat, mengelola kondisi kronis, dan banyak lagi.',
                'icon'        => 'bx bx-id-card',
                'variant'     => 'default',
                'btn_text'    => null,
                'btn_link'    => null,
                'is_active'   => true,
            ],
            [
                'title'       => 'Dokter spesialis',
                'description' => 'Konsultasikan dengan spesialis berpengalaman untuk diagnosis yang akurat dan rencana perawatan yang dipersonalisasi.',
                'icon'        => 'bx bx-plus-medical',
                'variant'     => 'featured',
                'btn_text'    => null,
                'btn_link'    => null,
                'is_active'   => true,
            ],
            [
                'title'       => 'Pemeriksaan Kesehatan',
                'description' => 'Pemeriksaan kesehatan rutin untuk memantau kondisi kesehatan Anda dan mendeteksi potensi masalah sejak dini.',
                'icon'        => 'bx bx-pulse',
                'variant'     => 'default',
                'btn_text'    => null,
                'btn_link'    => null,
                'is_active'   => true,
            ],
            [
                'title'       => 'Layanan Farmasi',
                'description' => 'Akses mudah ke obat resep & saran ahli farmasi, semuanya di satu tempat.',
                'icon'        => 'bx bx-capsule',
                'variant'     => 'default',
                'btn_text'    => null,
                'btn_link'    => null,
                'is_active'   => true,
            ],
            [
                'title'       => 'Jaminan Kesehatan',
                'description' => 'Paket asuransi kesehatan komprehensif yang menawarkan perlindungan finansial untuk perawatan medis.',
                'icon'        => 'bx bx-shield-alt-2',
                'variant'     => 'default',
                'btn_text'    => null,
                'btn_link'    => null,
                'is_active'   => true,
            ],
            [
                'title'       => 'Panggilan Darurat',
                'description' => 'Akses cepat ke layanan darurat, memastikan penanganan segera saat Anda paling membutuhkannya.',
                'icon'        => 'bx bx-phone-call',
                'variant'     => 'emergency',
                'btn_text'    => 'Hubungi kami',
                'btn_link'    => '#kontak',
                'is_active'   => true,
            ],
        ];

        foreach ($services as $item) {
            Layanan::updateOrCreate(['title' => $item['title']], $item);
        }
    }
}
