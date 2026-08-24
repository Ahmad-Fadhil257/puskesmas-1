<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::updateOrCreate(
            ['id' => 1],
            [
                'badge_label' => 'Tentang Kami',
                'title' => 'Puskesmas CareLink  Menciptakan Pelayanan Aman, Kesehatan Adalah Prioritas Kami',
                'description' => 'Puskesmas CareLink menyediakan layanan kesehatan berkualitas tinggi dengan dokter berpengalaman, layanan gawat darurat, dan dukungan sepanjang waktu. Mitra tepercaya Anda untuk hidup yang lebih sehat.',
                'image_main' => null,
                'image_accent' => null,
                'visi_title' => 'Visi Kami',
                'visi_text' => 'Menjadi pemimpin tepercaya dalam layanan kesehatan yang berkualitas, mudah diakses, dan penuh kepedulian.',
                'misi_title' => 'Misi Kami',
                'misi_text' => 'CareLink menghadirkan layanan ahli yang berfokus pada pasien, didukung oleh teknologi canggih dan layanan 24/7, serta berorientasi pada kesehatan dan kesejahteraan.',
                'is_active' => true,
            ]
        );
    }
}
