<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use App\Models\InfoCard;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Data Default Hero Section
        HeroSection::firstOrCreate(
            ['id' => 1],
            [
                'badge_text' => 'Selamat Datang Di Puskesmas CareLink',
                'title' => 'Melayani Kesehatan Masyarakat dengan Sepenuh Hati',
                'description' => 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.',
                'btn_primary_text' => 'Statistik',
                'btn_primary_link' => '#statistik',
                'btn_secondary_text' => 'Layanan Kami',
                'btn_secondary_link' => '#layanan',
                'image_1' => null, // fallback ke assets/hero/image 5.png
                'image_2' => null, // fallback ke assets/hero/image 6.png
                'image_3' => null, // fallback ke assets/hero/image 4.png
                'image_4' => null, // fallback ke assets/hero/image 1.png
            ]
        );

        // 2. Data Default 3 Info Cards
        $cards = [
            [
                'urutan' => 1,
                'icon' => 'doctor',
                'title' => 'Dokter Ahli',
                'description' => 'Berkonsultasi dengan dokter berpengalaman.',
                'is_featured' => false,
            ],
            [
                'urutan' => 2,
                'icon' => 'emergency',
                'title' => 'Pelayanan Gawat Darurat',
                'description' => 'Layanan gawat darurat 24/7 siap membantu Anda.',
                'is_featured' => true,
            ],
            [
                'urutan' => 3,
                'icon' => 'clock',
                'title' => '24/7 Siap Melayani',
                'description' => 'Kami siap melayani Anda kapan saja dan dimana saja.',
                'is_featured' => false,
            ],
        ];

        foreach ($cards as $card) {
            InfoCard::updateOrCreate(
                ['urutan' => $card['urutan']],
                $card
            );
        }
    }
}
