<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Dokter;
use App\Models\Faq;
use App\Models\Infografis;
use App\Models\Layanan;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DummyPaginationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. DUMMY ARTICLES (Rilis Berita) - Minimum 25 data
        $categoriesArticle = ['Tips Kesehatan', 'Gizi & Nutrisi', 'Info Medis', 'Kesehatan Mental', 'Kegiatan'];
        $authors = ['dr. Andi Pratama, Sp.JP', 'dr. Siti Nurhaliza, Sp.A', 'Ahli Gizi Fitriani, S.Gz', 'Psikolog Maya Rianty, M.Psi', 'dr. Farhan Nugroho, Sp.EM'];
        
        $blogThumbnails = [
            'assets/blog/blog-1.png',
            'assets/blog/blog-2.png',
            'assets/blog/blog-3.png',
            'assets/blog/Blog.png',
        ];

        for ($i = 1; $i <= 25; $i++) {
            $title = "Rilis Informasi Kesehatan Terkini ke-$i: Panduan Hidup Sehat Puskesmas";
            $slug = Str::slug($title);

            Article::updateOrCreate(
                ['slug' => $slug],
                [
                    'title'        => $title,
                    'category'     => $categoriesArticle[($i - 1) % count($categoriesArticle)],
                    'excerpt'      => "Ini adalah cuplikan ringkas rilis berita kesehatan ke-$i untuk pengujian pagination di halaman berita.",
                    'content'      => "<p>Konten lengkap artikel kesehatan ke-$i. Puskesmas terus berkomitmen memberikan informasi tepercaya kepada masyarakat.</p>",
                    'author'       => $authors[($i - 1) % count($authors)],
                    'reading_time' => rand(3, 7) . ' Menit',
                    'thumbnail'    => $blogThumbnails[($i - 1) % count($blogThumbnails)],
                    'views_count'  => rand(50, 950),
                    'is_published' => true,
                    'published_at' => now()->subHours($i * 4),
                ]
            );
        }

        // 2. DUMMY INFOGRAFIS - Minimum 20 data
        $categoriesInfografis = ['Edukasi Kesehatan', 'Penyakit Menular', 'Gizi Anak', 'Layanan Puskesmas', 'Kesehatan Ibu & Anak'];

        for ($i = 1; $i <= 20; $i++) {
            Infografis::updateOrCreate(
                ['title' => "Infografis Kesehatan Terpadu Seri $i"],
                [
                    'kategori'       => $categoriesInfografis[($i - 1) % count($categoriesInfografis)],
                    'deskripsi'      => "Panduan visual infografis kesehatan seri ke-$i untuk mempermudah masyarakat memahami informasi medis.",
                    'image_path'     => 'assets/images/infografis-placeholder.svg',
                    'thumbnail_path' => 'assets/images/infografis-placeholder.svg',
                    'is_active'      => true,
                    'order'          => $i,
                ]
            );
        }

        // 3. DUMMY DOKTER - Minimum 15 data
        $spesialis = ['Dokter Umum', 'Dokter Gigi', 'Spesialis Anak', 'Spesialis Kebidanan & Kandungan', 'Ahli Gizi Medis'];
        $hari = ['Senin - Rabu', 'Kamis - Sabtu', 'Senin - Jumat', 'Selasa & Kamis'];
        $dokterPhotos = [
            'assets/dokter/dokter_emily.png',
            'assets/dokter/dokter_john.png',
            'assets/dokter/dokter_michael.png',
            'assets/dokter/dokter_sarah.png',
            'assets/dokter/1787708317_1000325255.jpg',
        ];

        for ($i = 1; $i <= 15; $i++) {
            Dokter::updateOrCreate(
                ['name' => "dr. Dokter Medis $i"],
                [
                    'specialty'      => $spesialis[($i - 1) % count($spesialis)],
                    'photo'          => $dokterPhotos[($i - 1) % count($dokterPhotos)],
                    'jadwal_praktek' => [
                        'hari' => $hari[($i - 1) % count($hari)],
                        'jam'  => '08:00 - 14:00 WIB',
                    ],
                    'is_active'      => true,
                ]
            );
        }

        // 5. DUMMY FAQ - Minimum 18 data
        $katFaq = ['Umum & Pendaftaran', 'BPJS & Jaminan Kesehatan', 'Pelayanan Medis & Poli', 'UGD & Rujukan', 'Laboratorium & Farmasi'];

        for ($i = 1; $i <= 18; $i++) {
            Faq::updateOrCreate(
                ['pertanyaan' => "Pertanyaan Umum Layanan Kesehatan ke-$i?"],
                [
                    'jawaban'   => "Jawaban lengkap mengenai pertanyaan ke-$i. Masyarakat dapat langsung menghubungi kontak Puskesmas jika memerlukan bantuan lanjutan.",
                    'kategori'  => $katFaq[($i - 1) % count($katFaq)],
                    'urutan'    => $i,
                    'is_active' => true,
                ]
            );
        }

        // 6. DUMMY SURVEY (Ulasan Pasien) - Minimum 20 data
        $polis = ['Poli Umum', 'Poli Gigi', 'Poli KIA / Anak', 'Poli Lansia', 'UGD 24 Jam'];

        for ($i = 1; $i <= 20; $i++) {
            Survey::updateOrCreate(
                ['email_or_phone' => "pasien$i@gmail.com"],
                [
                    'name'           => "Pasien Pengunjung $i",
                    'poli_name'      => $polis[($i - 1) % count($polis)],
                    'rating'         => rand(4, 5),
                    'pesan'          => "Pelayanan di Puskesmas sangat baik, dokter dan perawat sangat ramah dan profesional pada kunjungan ke-$i.",
                    'is_approved'    => true,
                    'is_featured'    => ($i <= 6),
                ]
            );
        }

        // 7. DUMMY USERS - Minimum 15 data
        for ($i = 1; $i <= 15; $i++) {
            User::updateOrCreate(
                ['email' => "staf$i@carelink.com"],
                [
                    'name'              => "Staf Petugas Puskesmas $i",
                    'password'          => Hash::make('password123'),
                    'role'              => ($i % 3 === 0) ? 'admin' : 'staf',
                    'is_active'         => true,
                    'phone'             => "081234567" . sprintf("%03d", $i),
                    'email_verified_at' => now(),
                ]
            );
        }

        $this->command->info('DummyPaginationSeeder completed successfully! Added dummy data for Articles, Infografis, Dokter, Layanan, FAQ, Surveys, and Users.');
    }
}
