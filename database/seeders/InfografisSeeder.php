<?php

namespace Database\Seeders;

use App\Models\Infografis;
use Illuminate\Database\Seeder;

class InfografisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'title' => '7 Langkah Gerakan Masyarakat Hidup Sehat (GERMAS) Sehari-hari',
                'kategori' => 'Pencegahan',
                'image_path' => 'assets/blog/Blog.png',
                'thumbnail_path' => 'assets/blog/Blog.png',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'title' => 'Waspada Demam Berdarah Dengue (DBD) dengan Gerakan 3M Plus',
                'kategori' => 'Pencegahan',
                'image_path' => 'assets/blog/blog-1.png',
                'thumbnail_path' => 'assets/blog/blog-1.png',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'title' => 'Panduan Porsi Gizi Seimbang: Isi Piringku untuk Balita & Dewasa',
                'kategori' => 'Gizi',
                'image_path' => 'assets/blog/blog-2.png',
                'thumbnail_path' => 'assets/blog/blog-2.png',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'title' => 'Jadwal Lengkap Imunisasi Dasar & Lanjutan Bayi Usia 0 - 18 Bulan',
                'kategori' => 'Imunisasi',
                'image_path' => 'assets/blog/blog-3.png',
                'thumbnail_path' => 'assets/blog/blog-3.png',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'title' => 'Kendalikan Hipertensi dengan Pola CERDIK & Cek Kesehatan Rutin',
                'kategori' => 'Kesehatan',
                'image_path' => 'assets/about/about-1.jpg',
                'thumbnail_path' => 'assets/about/about-1.jpg',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'title' => 'Alur Pelayanan Rujukan BPJS Kesehatan di UPTD Puskesmas',
                'kategori' => 'Program',
                'image_path' => 'assets/about/about-2.jpg',
                'thumbnail_path' => 'assets/about/about-2.jpg',
                'is_active' => true,
                'order' => 6,
            ],
        ];

        foreach ($data as $item) {
            Infografis::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
