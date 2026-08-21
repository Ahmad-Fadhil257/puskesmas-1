<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title'        => 'Memahami Pentingnya Pemeriksaan Kesehatan Rutin',
                'slug'         => 'memahami-pentingnya-pemeriksaan-kesehatan-rutin',
                'category'     => 'Tips Kesehatan',
                'excerpt'      => 'Pemeriksaan kesehatan secara berkala atau medical check-up merupakan langkah preventif utama dalam mendeteksi potensi penyakit sejak dini sebelum berkembang menjadi kondisi yang serius.',
                'content'      => '
<p>Kesehatan adalah aset paling berharga dalam hidup kita. Namun, seringkali kita baru menyadari pentingnya menjaga kesehatan setelah jatuh sakit. Pemeriksaan kesehatan secara berkala (medical check-up) adalah salah satu investasi terbaik yang dapat Anda lakukan untuk masa depan Anda dan keluarga.</p>

<h3>Mengapa Pemeriksaan Rutin Sangat Penting?</h3>
<p>Banyak penyakit kronis, seperti hipertensi, diabetes melitus, dan kolesterol tinggi, sering kali tidak menunjukkan gejala pada tahap awal (sering disebut sebagai <em>silent killer</em>). Melalui pemeriksaan rutin di puskesmas atau klinik terdekat, kondisi-kondisi ini dapat dideteksi jauh sebelum komplikasi terjadi.</p>

<blockquote>
    <p>"Mencegah selalu lebih baik, lebih murah, dan lebih aman daripada mengobati ketika penyakit telah memasuki stadium lanjut."</p>
</blockquote>

<h3>Pemeriksaan Apa Saja yang Dianjurkan?</h3>
<ul>
    <li><strong>Pemeriksaan Tekanan Darah:</strong> Dianjurkan setidaknya 1 bulan sekali bagi dewasa untuk memantau risiko hipertensi dan penyakit kardiovaskular.</li>
    <li><strong>Tes Gula Darah:</strong> Menilai risiko diabetes melitus tipe 2, terutama bagi mereka dengan riwayat keluarga atau berat badan berlebih.</li>
    <li><strong>Profil Lipid (Kolesterol):</strong> Memantau kadar kolesterol total, HDL, LDL, dan trigliserida untuk mencegah penyumbatan pembuluh darah.</li>
    <li><strong>Pemeriksaan Fisik Dasar & BMI:</strong> Mengukur indeks massa tubuh dan mendiskusikan keluhan fisik sehari-hari bersama dokter.</li>
</ul>

<h3>Kapan Anda Harus Memulai?</h3>
<p>Tidak perlu menunggu usia tua untuk melakukan pemeriksaan rutin. Mulailah sedini mungkin, setidaknya satu kali dalam setahun untuk usia produktif, dan lebih sering bagi mereka yang memiliki riwayat penyakit keluarga. Kunjungi Puskesmas CareLink untuk berkonsultasi langsung dengan tim dokter kami!</p>
                ',
                'thumbnail'    => 'assets/blog/blog-1.png',
                'author'       => 'dr. Alamsyah Pratama',
                'reading_time' => '4 Menit',
                'views_count'  => 142,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
            [
                'title'        => 'Cara Mengelola Stres dan Meningkatkan Kesejahteraan Mental',
                'slug'         => 'cara-mengelola-stres-dan-meningkatkan-kesejahteraan-mental',
                'category'     => 'Kesehatan Mental',
                'excerpt'      => 'Stres yang berkepanjangan dapat berdampak negatif pada kesehatan fisik dan mental. Temukan cara efektif dan praktis untuk mengelola stres harian Anda.',
                'content'      => '
<p>Kehidupan modern yang serba cepat, tuntutan pekerjaan, dan dinamika keluarga sering kali menjadi pemicu timbulnya stres. Mengelola stres bukan berarti menghilangkan seluruh tekanan hidup, melainkan membangun respons yang sehat terhadap tekanan tersebut.</p>

<h3>Dampak Stres Kronis bagi Tubuh</h3>
<p>Ketika stres tidak dikelola dengan baik, tubuh akan terus-menerus memproduksi hormon kortisol dan adrenalin. Dalam jangka panjang, hal ini dapat memicu gangguan tidur (insomnia), penurunan sistem kekebalan tubuh, gangguan pencernaan, hingga meningkatnya risiko penyakit jantung.</p>

<h3>Langkah Praktis Mengelola Stres Harian:</h3>
<ol>
    <li><strong>Latihan Pernapasan Dalam (Deep Breathing):</strong> Luangkan waktu 5-10 menit setiap pagi untuk menarik napas dalam secara perlahan. Ini membantu mengaktifkan sistem saraf parasimpatis yang menenangkan detak jantung.</li>
    <li><strong>Rutin Berolahraga:</strong> Aktivitas fisik seperti jalan santai, jogging, atau bersepeda selama 30 menit merangsang pelepasan hormon endorfin yang meningkatkan suasana hati (*mood*).</li>
    <li><strong>Batasi Paparan Layar (Digital Detox):</strong> Hindari memeriksa media sosial atau email pekerjaan minimal 1 jam sebelum tidur untuk mendapatkan istirahat yang berkualitas.</li>
    <li><strong>Berbagi Cerita dengan Orang Terpercaya:</strong> Jangan ragu untuk mencurahkan beban pikiran kepada keluarga, sahabat, atau konselor profesional.</li>
</ol>

<p>Jika Anda merasa stres mulai mengganggu aktivitas harian, Puskesmas CareLink menyediakan layanan konseling psikologi dan konsultasi dokter umum untuk membantu Anda memulihkan keseimbangan hidup.</p>
                ',
                'thumbnail'    => 'assets/blog/blog-2.png',
                'author'       => 'Psikolog Maya Rianty, M.Psi',
                'reading_time' => '3 Menit',
                'views_count'  => 98,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title'        => 'Kemajuan Terbaru dalam Perawatan Gawat Darurat: Hal yang Perlu Anda Ketahui',
                'slug'         => 'kemajuan-terbaru-dalam-perawatan-gawat-darurat',
                'category'     => 'Info Medis',
                'excerpt'      => 'Pelajari protokol terbaru dan teknologi modern dalam penanganan kegawatdaruratan medis yang dapat menyelamatkan nyawa saat detik-detik kritis.',
                'content'      => '
<p>Dalam situasi darurat medis, waktu adalah faktor penentu keselamatan pasien. Istilah <em>"Golden Hour"</em> merujuk pada periode kritis di mana tindakan medis yang tepat dan cepat dapat mengurangi risiko kecacatan permanen atau kematian secara signifikan.</p>

<h3>Modernisasi Layanan Gawat Darurat</h3>
<p>Puskesmas CareLink terus berinovasi dalam meningkatkan standar Unit Gawat Darurat (UGD) dengan mengadopsi protokol triase terintegrasi digital, ambulans respon cepat, dan peralatan defibrilator otomatis (AED) modern.</p>

<h3>Tanda-Tanda Darurat yang Membutuhkan Penanganan Segera:</h3>
<ul>
    <li>Nyeri dada hebat yang menjalar ke lengan kiri, leher, atau rahang.</li>
    <li>Kesulitan bernapas tiba-tiba atau sesak napas berat.</li>
    <li>Penurunan kesadaran, kejang, atau kelemahan mendadak pada satu sisi tubuh (gejala stroke).</li>
    <li>Perdarahan hebat akibat trauma atau kecelakaan yang tidak kunjung berhenti.</li>
    <li>Reaksi alergi berat (anafilaksis) dengan pembengkakan bibir dan jalan napas.</li>
</ul>

<p>Simpan nomor darurat Puskesmas CareLink di kontak cepat ponsel Anda. Tim medis kami siaga 24 jam untuk memberikan pertolongan pertama yang cepat, tepat, dan penuh kepedulian.</p>
                ',
                'thumbnail'    => 'assets/blog/blog-3.png',
                'author'       => 'dr. Farhan Nugroho, Sp.EM',
                'reading_time' => '5 Menit',
                'views_count'  => 210,
                'is_published' => true,
                'published_at' => now()->subDays(8),
            ],
            [
                'title'        => 'Panduan Pola Makan Seimbang untuk Menjaga Imunitas Tubuh',
                'slug'         => 'panduan-pola-makan-seimbang-untuk-menjaga-imunitas-tubuh',
                'category'     => 'Gizi & Nutrisi',
                'excerpt'      => 'Gizi seimbang adalah pondasi utama daya tahan tubuh. Pahami konsep Isi Piringku dan asupan mikronutrien penting untuk keluarga.',
                'content'      => '
<p>Sistem imun tubuh bekerja tanpa henti melindungi kita dari serangan bakteri, virus, dan patogen berbahaya. Agar sistem pertahanan ini bekerja optimal, tubuh memerlukan pasokan nutrisi berkualitas setiap hari.</p>

<h3>Konsep "Isi Piringku" dari Kemenkes RI</h3>
<p>Setiap kali makan, bagi piring Anda menjadi empat bagian:</p>
<ul>
    <li><strong>1/3 Makanan Pokok:</strong> Sumber karbohidrat kompleks seperti nasi merah, jagung, ubi, atau oatmeal.</li>
    <li><strong>1/3 Sayuran:</strong> Sayuran hijau, brokoli, wortel, dan tomat yang kaya serat dan antioksidan.</li>
    <li><strong>1/6 Lauk-Pauk:</strong> Sumber protein hewani dan nabati (ikan, telur, tahu, tempe, dada ayam).</li>
    <li><strong>1/6 Buah-Buahan:</strong> Buah kaya vitamin C dan serat seperti jeruk, pepaya, dan apel.</li>
</ul>

<p>Jangan lupa untuk mencukupi kebutuhan air putih minimal 2 liter (8 gelas) sehari dan membatasi konsumsi gula, garam, serta minyak berlebih.</p>
                ',
                'thumbnail'    => 'assets/blog/blog-1.png',
                'author'       => 'Ahli Gizi Fitriani, S.Gz',
                'reading_time' => '3 Menit',
                'views_count'  => 85,
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],
        ];

        foreach ($articles as $data) {
            Article::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
