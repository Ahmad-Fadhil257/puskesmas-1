<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DummyArticleSeeder extends Seeder
{
    public function run(): void
    {
        $dummyArticles = [
            [
                'title'        => '10 Manfaat Olahraga Pagi untuk Kesehatan Jantung',
                'category'     => 'Tips Kesehatan',
                'excerpt'      => 'Olahraga pagi secara rutin terbukti mampu menurunkan risiko penyakit jantung koroner hingga 45%. Simak manfaat lengkapnya dan cara memulai rutinitas yang tepat.',
                'content'      => '<p>Olahraga pagi merupakan salah satu kebiasaan sehat yang memberikan dampak positif signifikan bagi kesehatan jantung. Penelitian menunjukkan bahwa aktivitas fisik di pagi hari dapat membantu mengatur tekanan darah, menurunkan kolesterol jahat (LDL), dan meningkatkan kolesterol baik (HDL).</p><p>Para ahli merekomendasikan setidaknya 30 menit olahraga aerobik dengan intensitas sedang setiap pagi. Jenis olahraga yang direkomendasikan antara lain jalan cepat, jogging ringan, bersepeda, atau senam aerobik.</p>',
                'author'       => 'dr. Andi Pratama, Sp.JP',
                'reading_time' => '5 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?w=800&q=80',
                'views_count'  => 324,
                'published_at' => now()->subDays(1),
            ],
            [
                'title'        => 'Pentingnya Imunisasi Lengkap pada Anak Usia 0-5 Tahun',
                'category'     => 'Info Medis',
                'excerpt'      => 'Imunisasi dasar lengkap melindungi anak dari berbagai penyakit berbahaya. Ketahui jadwal, jenis vaksin, dan efek samping yang perlu diwaspadai oleh orang tua.',
                'content'      => '<p>Imunisasi merupakan upaya preventif paling efektif untuk melindungi anak dari penyakit-penyakit infeksi yang berbahaya. Program imunisasi dasar lengkap mencakup vaksin BCG, DPT-HB-Hib, Polio, Campak, dan Hepatitis B.</p><p>Setiap anak berhak mendapatkan imunisasi dasar lengkap sesuai jadwal yang telah ditetapkan oleh Kementerian Kesehatan. Orang tua diharapkan membawa anak ke posyandu atau puskesmas terdekat untuk mendapatkan vaksinasi tepat waktu.</p>',
                'author'       => 'dr. Siti Nurhaliza, Sp.A',
                'reading_time' => '4 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1632053002928-1919605ee6f7?w=800&q=80',
                'views_count'  => 567,
                'published_at' => now()->subDays(2),
            ],
            [
                'title'        => 'Resep Makanan Sehat Berbahan Lokal untuk Keluarga',
                'category'     => 'Gizi & Nutrisi',
                'excerpt'      => 'Makanan bergizi tidak harus mahal. Manfaatkan bahan pangan lokal seperti tempe, tahu, ikan lele, dan sayuran segar untuk menu harian keluarga yang seimbang.',
                'content'      => '<p>Indonesia memiliki kekayaan bahan pangan lokal yang sangat beragam dan bergizi tinggi. Tempe misalnya, mengandung protein nabati berkualitas tinggi, serat, dan probiotik alami yang baik untuk pencernaan.</p><p>Dengan mengombinasikan bahan pangan lokal secara kreatif, kita bisa menyajikan menu harian yang tidak hanya lezat tetapi juga memenuhi kebutuhan gizi keluarga dengan biaya yang terjangkau.</p>',
                'author'       => 'Ahli Gizi Dewi Lestari, S.Gz',
                'reading_time' => '6 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=800&q=80',
                'views_count'  => 289,
                'published_at' => now()->subDays(3),
            ],
            [
                'title'        => 'Mengenali Tanda-Tanda Dehidrasi dan Cara Mengatasinya',
                'category'     => 'Tips Kesehatan',
                'excerpt'      => 'Dehidrasi sering kali tidak disadari hingga kondisinya memburuk. Pelajari gejala awal dehidrasi dan langkah-langkah pencegahan yang bisa Anda lakukan sehari-hari.',
                'content'      => '<p>Dehidrasi terjadi ketika tubuh kehilangan lebih banyak cairan daripada yang dikonsumsi. Kondisi ini dapat memengaruhi fungsi organ tubuh secara keseluruhan, mulai dari ginjal, otak, hingga sistem kardiovaskular.</p><p>Tanda-tanda dehidrasi ringan meliputi mulut kering, urine berwarna gelap, sakit kepala, dan merasa lelah. Untuk mencegah dehidrasi, pastikan minum setidaknya 8 gelas air putih per hari.</p>',
                'author'       => 'dr. Budi Setiawan, M.Kes',
                'reading_time' => '3 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1559839914-17aae19cec71?w=800&q=80',
                'views_count'  => 198,
                'published_at' => now()->subDays(4),
            ],
            [
                'title'        => 'Program Posyandu Lansia: Deteksi Dini Penyakit Degeneratif',
                'category'     => 'Info Medis',
                'excerpt'      => 'Posyandu lansia menyediakan pemeriksaan kesehatan rutin gratis untuk warga usia 60 tahun ke atas. Cek tekanan darah, gula darah, dan kolesterol secara berkala.',
                'content'      => '<p>Posyandu lansia merupakan program layanan kesehatan berbasis masyarakat yang ditujukan untuk warga berusia 60 tahun ke atas. Melalui posyandu lansia, para lansia dapat memperoleh pemeriksaan kesehatan dasar secara rutin dan gratis.</p><p>Pemeriksaan yang tersedia meliputi pengukuran tekanan darah, pemeriksaan gula darah, pengukuran indeks massa tubuh (IMT), dan konsultasi kesehatan dengan tenaga medis terlatih.</p>',
                'author'       => 'dr. Ratna Kumalasari',
                'reading_time' => '4 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=800&q=80',
                'views_count'  => 412,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Cara Menjaga Kesehatan Mental di Era Digital',
                'category'     => 'Kesehatan Mental',
                'excerpt'      => 'Penggunaan gadget berlebihan dapat berdampak negatif pada kesehatan mental. Terapkan digital detox dan kebiasaan mindfulness untuk keseimbangan hidup yang lebih baik.',
                'content'      => '<p>Di era digital saat ini, kita sering kali terlalu banyak menghabiskan waktu di depan layar. Hal ini dapat menyebabkan kecemasan, gangguan tidur, dan penurunan kualitas interaksi sosial secara langsung.</p><p>Praktik digital detox secara berkala, meditasi mindfulness, dan menjaga rutinitas tidur yang sehat adalah beberapa langkah efektif untuk menjaga kesehatan mental di tengah derasnya arus informasi digital.</p>',
                'author'       => 'Psikolog Hana Safitri, M.Psi',
                'reading_time' => '5 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1493836512294-502baa1986e2?w=800&q=80',
                'views_count'  => 543,
                'published_at' => now()->subDays(6),
            ],
            [
                'title'        => 'Panduan Pertolongan Pertama pada Kecelakaan Ringan',
                'category'     => 'Tips Kesehatan',
                'excerpt'      => 'Mengetahui dasar-dasar pertolongan pertama bisa menyelamatkan nyawa. Pelajari cara menangani luka bakar ringan, pendarahan, dan patah tulang sebelum bantuan medis tiba.',
                'content'      => '<p>Pertolongan pertama adalah tindakan awal yang diberikan kepada korban kecelakaan atau orang yang sakit mendadak sebelum mendapat pertolongan medis profesional. Pengetahuan P3K sangat penting dimiliki oleh setiap anggota masyarakat.</p><p>Beberapa tindakan P3K dasar meliputi membersihkan dan membalut luka, menghentikan pendarahan, serta menstabilkan korban patah tulang dengan bidai sederhana.</p>',
                'author'       => 'dr. Farhan Nugroho, Sp.EM',
                'reading_time' => '7 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1516574187841-cb9cc2ca948b?w=800&q=80',
                'views_count'  => 176,
                'published_at' => now()->subDays(7),
            ],
            [
                'title'        => 'Bahaya Merokok dan Strategi Berhenti yang Efektif',
                'category'     => 'Info Medis',
                'excerpt'      => 'Rokok mengandung lebih dari 7.000 bahan kimia berbahaya. Kenali dampaknya pada tubuh dan temukan strategi berhenti merokok yang telah terbukti secara klinis.',
                'content'      => '<p>Merokok merupakan salah satu penyebab utama kematian yang dapat dicegah di seluruh dunia. Asap rokok mengandung lebih dari 7.000 bahan kimia, dimana setidaknya 70 di antaranya diketahui bersifat karsinogenik atau penyebab kanker.</p><p>Strategi berhenti merokok yang efektif meliputi terapi pengganti nikotin (NRT), konseling perilaku, dukungan kelompok, dan dalam beberapa kasus, pengobatan dengan resep dokter.</p>',
                'author'       => 'dr. Agus Hermawan, Sp.P',
                'reading_time' => '6 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1555848962-6e79363ec58f?w=800&q=80',
                'views_count'  => 631,
                'published_at' => now()->subDays(8),
            ],
            [
                'title'        => 'Menu MPASI 6 Bulan: Panduan Lengkap untuk Ibu Baru',
                'category'     => 'Gizi & Nutrisi',
                'excerpt'      => 'Masa MPASI adalah periode krusial untuk tumbuh kembang bayi. Ikuti panduan menu MPASI 6 bulan yang kaya zat besi, protein, dan vitamin untuk si kecil.',
                'content'      => '<p>Makanan Pendamping ASI (MPASI) mulai diberikan saat bayi berusia 6 bulan. Pada tahap ini, ASI saja sudah tidak mencukupi kebutuhan nutrisi bayi yang semakin meningkat, terutama kebutuhan zat besi.</p><p>Menu MPASI 6 bulan sebaiknya dimulai dengan tekstur puree halus dan secara bertahap ditingkatkan kekasarannya. Bahan makanan yang direkomendasikan meliputi hati ayam, daging sapi giling halus, alpukat, ubi jalar, dan brokoli.</p>',
                'author'       => 'Ahli Gizi Maya Sari, S.Gz',
                'reading_time' => '8 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1565538420870-da08ff96a207?w=800&q=80',
                'views_count'  => 487,
                'published_at' => now()->subDays(9),
            ],
            [
                'title'        => 'Yoga untuk Pemula: Gerakan Dasar yang Aman Dilakukan di Rumah',
                'category'     => 'Tips Kesehatan',
                'excerpt'      => 'Yoga bukan hanya untuk yang fleksibel. Mulailah dengan 5 gerakan dasar ini untuk meningkatkan fleksibilitas, kekuatan otot, dan ketenangan pikiran dari rumah.',
                'content'      => '<p>Yoga adalah praktik kuno yang menggabungkan gerakan fisik, teknik pernapasan, dan meditasi. Manfaat yoga telah dibuktikan secara ilmiah, termasuk mengurangi stres, meningkatkan fleksibilitas, dan memperkuat otot inti tubuh.</p><p>Untuk pemula, mulailah dengan gerakan-gerakan sederhana seperti Mountain Pose, Downward Dog, Warrior I, Tree Pose, dan Child Pose. Lakukan setiap gerakan selama 30 detik hingga 1 menit.</p>',
                'author'       => 'Instruktur Yoga Lina Wijaya',
                'reading_time' => '5 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=800&q=80',
                'views_count'  => 356,
                'published_at' => now()->subDays(10),
            ],
            [
                'title'        => 'Vaksinasi COVID-19 Booster: Siapa yang Perlu dan Kapan?',
                'category'     => 'Info Medis',
                'excerpt'      => 'Vaksin booster COVID-19 penting untuk memperkuat kekebalan tubuh. Cek syarat dan jadwal vaksinasi booster di puskesmas terdekat.',
                'content'      => '<p>Vaksinasi booster COVID-19 bertujuan untuk memperkuat respons imun tubuh yang mungkin menurun seiring waktu setelah vaksinasi primer. Booster direkomendasikan untuk seluruh kelompok usia dewasa.</p><p>Puskesmas menyediakan layanan vaksinasi booster secara gratis. Masyarakat dapat datang dengan membawa KTP dan kartu vaksinasi sebelumnya.</p>',
                'author'       => 'dr. Rizky Amelia, Sp.PD',
                'reading_time' => '3 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1615631648086-325025c9e51e?w=800&q=80',
                'views_count'  => 892,
                'published_at' => now()->subDays(11),
            ],
            [
                'title'        => 'Kegiatan Senam Sehat Bersama Warga RW 05 Kelurahan Sukamaju',
                'category'     => 'Kegiatan',
                'excerpt'      => 'Puskesmas CareLink mengadakan kegiatan senam sehat bersama warga RW 05 sebagai upaya promosi kesehatan dan pencegahan penyakit tidak menular.',
                'content'      => '<p>Pada hari Minggu lalu, Puskesmas CareLink bekerja sama dengan kader kesehatan RW 05 Kelurahan Sukamaju menyelenggarakan kegiatan senam sehat bersama. Kegiatan ini diikuti oleh lebih dari 100 warga dari berbagai kelompok usia.</p><p>Selain senam, kegiatan juga diisi dengan pemeriksaan tekanan darah gratis dan penyuluhan tentang pentingnya gaya hidup aktif untuk mencegah penyakit tidak menular seperti diabetes dan hipertensi.</p>',
                'author'       => 'Tim Promkes Puskesmas',
                'reading_time' => '3 Menit',
                'thumbnail'    => 'https://images.unsplash.com/photo-1571902943202-507ec2618e8f?w=800&q=80',
                'views_count'  => 145,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($dummyArticles as $data) {
            $slug = Str::slug($data['title']);

            // Skip jika slug sudah ada
            if (Article::where('slug', $slug)->exists()) {
                continue;
            }

            Article::create(array_merge($data, [
                'slug'         => $slug,
                'is_published' => true,
            ]));
        }

        $this->command->info('Dummy articles seeded successfully! (' . count($dummyArticles) . ' articles)');
    }
}
