<?php

namespace Database\Seeders;

use App\Models\CaraKerja;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin Account Default untuk Demo & Testing
        User::updateOrCreate(
            ['email' => 'admin@carelink.com'],
            [
                'name' => 'Admin Puskesmas',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
                'phone' => '081234567890',
                'email_verified_at' => now(),
            ]
        );

        // Staf Account Default untuk Demo & Testing
        User::updateOrCreate(
            ['email' => 'staf@carelink.com'],
            [
                'name' => 'Siti Rahmawati (Staf Medis)',
                'password' => Hash::make('password123'),
                'role' => 'staf',
                'is_active' => true,
                'phone' => '089876543210',
                'email_verified_at' => now(),
            ]
        );

        // Seed Data Artikel Berita Awal
        $this->call(ArticleSeeder::class);

        // Seed Data Tentang Kami (About)
        $this->call(AboutSeeder::class);

        // Seed Data Hero Section & Info Cards
        $this->call(HeroSeeder::class);

        // Seed Data Dokter
        $this->call(DokterSeeder::class);

        // Seed Data Layanan
        $this->call(LayananSeeder::class);

        // Seed Data Nilai & Mitra
        $this->call(NilaiSectionSeeder::class);

        // Seed Data Cara Kerja
        $caraKerja = [
            [
                'urutan' => 1,
                'judul' => 'Buat Janji Temu',
                'deskripsi' => 'Jadwalkan kunjungan Anda melalui platform daring kami yang mudah digunakan atau dengan menghubungi tim dukungan kami yang ramah. Pilih waktu yang paling sesuai bagi Anda.',
            ],
            [
                'urutan' => 2,
                'judul' => 'Konsultasikan dengan Ahli Kami',
                'deskripsi' => 'Temui dokter dan spesialis medis kami yang sangat ahli, yang akan mendengarkan keluhan Anda, memberikan diagnosis yang akurat, serta merekomendasikan pilihan pengobatan yang efektif.',
            ],
            [
                'urutan' => 3,
                'judul' => 'Mendapatkan Perawatan',
                'deskripsi' => 'Setelah rencana perawatan ditetapkan, tim kami memastikan Anda mendapatkan layanan medis yang diperlukan, baik itu berupa resep dari apotek kami maupun perawatan khusus.',
            ],
            [
                'urutan' => 4,
                'judul' => 'Menindaklanjuti',
                'deskripsi' => 'Setelah perawatan, kami tetap menjalin komunikasi untuk konsultasi lanjutan guna memastikan proses pemulihan Anda berjalan lancar serta menjawab pertanyaan lain yang mungkin Anda miliki.',
            ],
        ];

        foreach ($caraKerja as $item) {
            CaraKerja::updateOrCreate(
                ['urutan' => $item['urutan']],
                $item
            );
        }
    }
}
