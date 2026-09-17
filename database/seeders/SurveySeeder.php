<?php

namespace Database\Seeders;

use App\Models\Survey;
use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    public function run(): void
    {
        $surveys = [
            [
                'name' => 'Rina Wulandari',
                'email_or_phone' => '081234567890',
                'poli_name' => 'Poli Umum',
                'rating' => 5,
                'pesan' => 'Saya ingin menyampaikan rasa terima kasih yang sebesar-besarnya kepada seluruh petugas medis di Puskesmas ini. Beberapa minggu yang lalu saya mengalami gejala yang cukup mengkhawatirkan, mulai dari demam tinggi yang tidak kunjung turun selama tiga hari berturut-turut, disertai dengan sakit kepala hebat dan nyeri pada seluruh tubuh. Ketika saya datang ke Puskesmas, saya diterima dengan sangat ramah oleh petugas front desk yang langsung membantu saya mendaftarkan diri ke poli umum. Dokter yang menangani saya sangat profesional, teliti dalam melakukan pemeriksaan, dan memberikan penjelasan yang sangat mudah dipahami mengenai kondisi saya. Obat yang diberikan juga sangat cocok dan dalam waktu kurang dari seminggu saya sudah merasa jauh lebih baik. Pelayanan di sini benar-benar luar biasa dan saya sangat merekomendasikan Puskesmas ini kepada seluruh masyarakat.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Budi Santoso',
                'email_or_phone' => 'budi.santoso@gmail.com',
                'poli_name' => 'Poli Gigi',
                'rating' => 5,
                'pesan' => 'Kunjungan saya ke Poli Gigi di Puskesmas ini meninggalkan kesan yang sangat positif. Sudah sejak lama saya menunda untuk memeriksakan gigi saya karena takut dengan rasa sakit, namun dokter gigi di sini berhasil membuat saya merasa nyaman sepanjang proses pemeriksaan. Dokternya sangat sabar mendengarkan keluhan saya, menjelaskan kondisi gigi saya dengan detail menggunakan gambar rontgen, dan memberikan rekomendasi perawatan yang tepat. Yang paling saya apresiasi adalah bagaimana dokter tersebut memberikan edukasi mengenai cara menggosok gigi yang benar, pemilihan sikat gigi yang sesuai, dan pentingnya rutin berkunjung ke dokter gigi setiap enam bulan sekali. Petugas yang membantu di belakang juga sangat cekatan dan profesional. Ruang tunggu poli gigi juga bersih dan tertata rapi dengan majalah serta fasilitas Wi-Fi yang memadai. Terima kasih banyak atas pelayanan terbaiknya.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email_or_phone' => '085678901234',
                'poli_name' => 'Poli Kandungan',
                'rating' => 5,
                'pesan' => 'Sebagai ibu hamil yang sedang menjalani kehamilan pertama, saya merasa sangat terbantu dengan pelayanan di Poli Kandungan Puskesmas ini. Setiap kali saya datang untuk kontrol kehamilan, saya selalu dilayani dengan sangat hangat dan penuh perhatian oleh bidan dan dokter kandungan. Mereka selalu dengan sabar menjawab setiap pertanyaan saya yang kadang terdengar sepele, namun bagi saya sebagai ibu baru sangatlah penting. Pemeriksaan kehamilan dilakukan dengan teliti, mulai dari pengukuran tekanan darah, pemeriksaan urine, hingga USG yang dilakukan dengan alat yang memadai. Saya juga mendapatkan edukasi mengenai nutrisi yang tepat selama kehamilan, olahraga yang aman untuk ibu hamil, dan tanda-tanda yang harus diwaspadai. Program KIA yang diselenggarakan di Puskesmas ini juga sangat bermanfaat, termasuk pemberian vitamin dan suplemen yang dibutuhkan. Saya merasa sangat aman dan nyaman menjalani kehamilan di bawah pengawasan Puskesmas ini.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email_or_phone' => '087890123456',
                'poli_name' => 'Poli Anak',
                'rating' => 4,
                'pesan' => 'Putra saya yang berusia tiga tahun harus dirawat karena mengalami demam tinggi yang disertai kejang. Sebagai orang tua, tentu saja saya sangat panik dan khawatir. Namun ketika kami tiba di Puskesmas, tim medis langsung bergerak cepat menangani anak saya dengan sangat profesional. Dokter anak yang bertugas saat itu sangat kompeten dan berhasil menenangkan saya sambil terus memantau kondisi anak saya. Proses pemeriksaan dan penanganan dilakukan dengan cepat tanpa mengurangi ketelitian. Setelah kondisi anak saya stabil, dokter memberikan penjelasan yang sangat detail mengenai penyebab kejang demam pada anak, langkah-langkah pertolongan pertama yang harus dilakukan orang tua di rumah, serta jadwal kontrol lanjutan. Petugas keperawatan juga sangat ramah dan sabar dalam merawat anak saya selama di Puskesmas. Saya merasa bersyukur memiliki Puskesmas dengan pelayanan sebaik ini di dekat rumah saya.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Dewi Kartika',
                'email_or_phone' => 'dewi.kartika@yahoo.com',
                'poli_name' => 'Poli Kulit dan Kelamin',
                'rating' => 5,
                'pesan' => 'Saya sudah berbulan-bulan mengalami masalah kulit yang sangat mengganggu di bagian wajah dan tangan. Kondisi kulit saya menjadi merah, gatal, dan mengelupas sehingga sangat mempengaruhi kepercayaan diri saya dalam beraktivitas sehari-hari. Setelah mencari referensi, saya memutuskan untuk memeriksakan diri ke Poli Kulit dan Kelamin di Puskesmas ini. Ternyata pelayanannya jauh melampaui ekspektasi saya. Dokter spesialis kulit yang menangani saya sangat ahli dan berpengalaman. Beliau melakukan pemeriksaan dengan teliti, bahkan menggunakan alat dermatoskop untuk melihat kondisi kulit saya lebih detail. Diagnosis yang diberikan sangat akurat dan pengobatan yang diresepkan juga sangat sesuai dengan kondisi saya. Dokter juga memberikan konsultasi lengkap mengenai pola makan, jenis produk perawatan kulit yang aman, serta kebiasaan sehari-hari yang dapat memperburuk kondisi kulit. Setelah rutin mengikuti anjuran dokter, kondisi kulit saya membaik secara signifikan. Terima kasih Puskesmas.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Hendra Kurniawan',
                'email_or_phone' => '081987654321',
                'poli_name' => 'Poli Umum',
                'rating' => 4,
                'pesan' => 'Pengalaman saya di Puskesmas ini cukup memuaskan secara keseluruhan. Saya datang untuk pemeriksaan rutin tahunan karena pekerjaan saya yang mengharuskan saya memiliki surat keterangan sehat. Proses pendaftaran berjalan cukup lancar meskipun saya datang di hari Senin yang biasanya cukup ramai. Petugas administrasi membantu saya dengan cepat dan efisien. Dokter yang memeriksa saya melakukan pemeriksaan fisik yang lengkap mulai dari pengukuran tekanan darah, pemeriksaan tinggi dan berat badan, tes penglihatan, hingga pemeriksaan laboratorium dasar. Yang saya sukai adalah dokter tersebut tidak hanya sekadar memeriksa, tetapi juga memberikan konsultasi mengenai gaya hidup sehat, pentingnya olahraga rutin, dan pola makan yang seimbang mengingat pekerjaan saya yang mayoritas duduk di depan komputer. Satu-satunya masukan saya mungkin dari segi waktu tunggu yang bisa diperbaiki agar lebih efisien lagi. Secara keseluruhan saya puas dengan pelayanan yang diberikan.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Putri Amelia',
                'email_or_phone' => '082345678901',
                'poli_name' => 'Poli Mata',
                'rating' => 5,
                'pesan' => 'Ibu saya yang berusia 65 tahun mengeluhkan penglihatannya yang semakin kabur belakangan ini. Kami memutuskan untuk membawa ibu saya ke Poli Mata di Puskesmas ini atas rekomendasi tetangga. Ternyata pelayanannya sangat profesional dan memuaskan. Dokter spesialis mata yang menangani ibu saya sangat teliti dalam melakukan pemeriksaan, mulai dari tes ketajaman penglihatan, pemeriksaan funduskopi, hingga pengukuran tekanan bola mata. Dokter menjelaskan dengan sabar bahwa ibu saya mengalami presbiopi dan katarak stadium awal pada salah satu mata. Beliau memberikan penjelasan yang sangat detail mengenai kondisi tersebut, pilihan pengobatan yang tersedia, serta langkah-langkah pencegahan agar kondisi tidak memburuk. Kami juga diberikan resep kacamata yang sesuai dengan kondisi ibu saya. Petugas optometri di Puskesmas juga sangat membantu dalam membantu kami memilih frame kacamata yang nyaman. Pelayanan yang luar biasa untuk orang tua kami.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Rizky Pratama',
                'email_or_phone' => 'rizky.pratama@outlook.com',
                'poli_name' => 'Poli Rehabilitasi Medis',
                'rating' => 5,
                'pesan' => 'Setelah mengalami kecelakaan kerja yang mengakibatkan cedera pada punggung bawah, saya harus menjalani terapi rehabilitasi medis selama beberapa bulan. Pelayanan rehabilitasi medis di Puskesmas ini benar-benar membantu saya dalam proses pemulihan. Fisioterapis yang menangani saya sangat profesional, berpengetahuan luas, dan sabar dalam membimbing saya melalui setiap sesi terapi. Mereka membuat program latihan yang disesuaikan dengan kondisi saya, memantau perkembangan saya dari minggu ke minggu, dan terus memberikan motivasi agar saya tetap semangat dalam menjalani proses pemulihan. Peralatan terapi yang tersedia di Puskesmas juga cukup lengkap dan modern, termasuk alat elektroterapi, terapi panas dan dingin, serta area latihan yang luas dan nyaman. Selama menjalani terapi, saya juga mendapatkan edukasi mengenai postur tubuh yang benar saat duduk dan berdiri, serta latihan peregangan yang bisa dilakukan di rumah untuk mempercepat pemulihan. Berkat pelayanan yang luar biasa ini, saya kembali bekerja tepat waktu dan kondisi punggung saya membaik secara signifikan.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Anisa Rahmawati',
                'email_or_phone' => '083456789012',
                'poli_name' => 'Poli Kandungan',
                'rating' => 5,
                'pesan' => 'Kehamilan kedua saya kali ini mendapatkan pengalaman yang berbeda dari kehamilan pertama. Di kehamilan pertama saya periksa di klinik swasta yang mahal, namun di kehamilan kedua ini saya memutuskan untuk berpindah ke Puskesmas dan ternyata keputusan saya sangat tepat. Pelayanan yang diberikan tidak kalah profesional bahkan lebih personal dan hangat. Setiap kunjungan kontrol, saya selalu mendapatkan pemeriksaan yang lengkap termasuk pemeriksaan laboratorium, USG, dan konsultasi gizi khusus ibu hamil. Bidan yang menangani saya sangat berpengalaman dan selalu ingat dengan kondisi kehamilan saya di setiap kunjungan. Program senam hamil yang diselenggarakan setiap hari Rabu juga sangat bermanfaat untuk menjaga kebugaran saya. Selain itu, Puskesmas juga menyediakan kelas ibu hamil yang memberikan edukasi tentang persiapan persalinan, perawatan bayi baru lahir, dan pentingnya ASI eksklusif. Suami saya juga diizinkan untuk hadir di kelas tersebut sehingga kami berdua bisa mempersiapkan diri dengan baik. Terima kasih Puskesmas atas pelayanan yang luar biasa.',
                'is_approved' => false,
                'is_featured' => false,
            ],
            [
                'name' => 'Dedi Misbahudin',
                'email_or_phone' => '084567890123',
                'poli_name' => 'Poli Gizi',
                'rating' => 5,
                'pesan' => 'Sebagai penderita diabetes tipe 2, saya membutuhkan pengelolaan pola makan yang sangat ketat. Keputusan saya untuk berkonsultasi ke Poli Gizi di Puskesmas ini merupakan salah satu keputusan terbaik yang pernah saya ambil untuk kesehatan saya. Ahli gizi yang menangani saya sangat kompeten dan berpengetahuan luas mengenai diet untuk penderita diabetes. Beliau melakukan asesmen menyeluruh terhadap kondisi saya, termasuk riwayat makanan sehari-hari, hasil pemeriksaan laboratorium, serta aktivitas fisik yang saya lakukan. Berdasarkan asesmen tersebut, beliau menyusun rencana makan yang sangat detail dan realistis, termasuk daftar makanan yang boleh dan tidak boleh dikonsumsi, porsi yang tepat, jadwal makan yang teratur, serta alternatif makanan yang bervariasi agar saya tidak bosan. Beliau juga memberikan edukasi mengenai cara membaca label makanan, menghitung indeks glikemik, dan mengelola porsi makan saat bepergian. Setelah mengikuti anjuran dari ahli gizi selama tiga bulan, kadar HbA1c saya turun dari 9.2% menjadi 6.8%, yang merupakan pencapaian luar biasa bagi saya. Saya sangat bersyukur dan merekomendasikan Poli Gizi ini kepada siapa saja yang membutuhkan konsultasi gizi.',
                'is_approved' => false,
                'is_featured' => false,
            ],
        ];

        foreach ($surveys as $survey) {
            Survey::create($survey);
        }
    }
}
