<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cara Kerja - Puskesmas</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600;inter:400,500,600,700" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        body {
            font-family: 'Inter', 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #FFFFFF;
            color: #191C1D;
        }
    </style>
</head>
<body>
    <section class="w-full py-12 sm:py-16 lg:py-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Badge --}}
            <div class="flex items-center justify-center gap-2 mb-6">
                <svg class="w-4 h-4 text-[#00644A]" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.14 12.94c.04-.3.06-.61.06-.94 0-.32-.02-.64-.07-.94l2.03-1.58a.49.49 0 00.12-.61l-1.92-3.32a.488.488 0 00-.59-.22l-2.39.96c-.5-.38-1.03-.7-1.62-.94l-.36-2.54a.484.484 0 00-.48-.41h-3.84c-.24 0-.43.17-.47.41l-.36 2.54c-.59.24-1.13.57-1.62.94l-2.39-.96c-.22-.08-.47 0-.59.22L2.74 8.87c-.12.21-.08.47.12.61l2.03 1.58c-.05.3-.07.62-.07.94s.02.64.07.94l-2.03 1.58a.49.49 0 00-.12.61l1.92 3.32c.12.22.37.29.59.22l2.39-.96c.5.38 1.03.7 1.62.94l.36 2.54c.05.24.24.41.48.41h3.84c.24 0 .44-.17.47-.41l.36-2.54c.59-.24 1.13-.56 1.62-.94l2.39.96c.22.08.47 0 .59-.22l1.92-3.32c.12-.22.07-.47-.12-.61l-2.01-1.58zM12 15.6A3.6 3.6 0 1115.6 12 3.611 3.611 0 0112 15.6z"/>
                </svg>
                <span class="text-xs font-semibold tracking-widest uppercase text-[#00644A]">Cara Kerjanya</span>
            </div>

            {{-- Heading --}}
            <div class="text-center max-w-3xl mx-auto mb-12 sm:mb-16">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-[#191C1D] leading-tight mb-4">
                    Layanan Kesehatan Terpercaya yang Berfokus pada Kesejahteraan Anda
                </h2>
                <p class="text-sm sm:text-base text-[#3E4944] leading-relaxed">
                    Di CareLink, kami telah menyederhanakan proses layanan kesehatan
                    untuk memastikan Anda mendapatkan perawatan terbaik dengan
                    mudah dan nyaman.
                </p>
            </div>

            {{-- Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                {{-- Card 01 --}}
                <div class="bg-[#F3F4F5] rounded-2xl p-6 sm:p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00644A] flex items-center justify-center shrink-0">
                            <span class="text-white font-bold text-sm sm:text-base">01</span>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#191C1D] mb-2">Buat Janji Temu</h3>
                            <p class="text-sm text-[#3E4944] leading-relaxed">
                                Jadwalkan kunjungan Anda melalui platform daring kami yang mudah digunakan atau dengan menghubungi tim dukungan kami yang ramah. Pilih waktu yang paling sesuai bagi Anda.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 02 --}}
                <div class="bg-[#F3F4F5] rounded-2xl p-6 sm:p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00644A] flex items-center justify-center shrink-0">
                            <span class="text-white font-bold text-sm sm:text-base">02</span>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#191C1D] mb-2">Konsultasikan dengan Ahli Kami</h3>
                            <p class="text-sm text-[#3E4944] leading-relaxed">
                                Temui dokter dan spesialis medis kami yang sangat ahli, yang akan mendengarkan keluhan Anda, memberikan diagnosis yang akurat, serta merekomendasikan pilihan pengobatan yang efektif.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 03 --}}
                <div class="bg-[#F3F4F5] rounded-2xl p-6 sm:p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00644A] flex items-center justify-center shrink-0">
                            <span class="text-white font-bold text-sm sm:text-base">03</span>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#191C1D] mb-2">Mendapatkan Perawatan</h3>
                            <p class="text-sm text-[#3E4944] leading-relaxed">
                                Setelah rencana perawatan ditetapkan, tim kami memastikan Anda mendapatkan layanan medis yang diperlukan, baik itu berupa resep dari apotek kami maupun perawatan khusus.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Card 04 --}}
                <div class="bg-[#F3F4F5] rounded-2xl p-6 sm:p-8">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-[#00644A] flex items-center justify-center shrink-0">
                            <span class="text-white font-bold text-sm sm:text-base">04</span>
                        </div>
                        <div>
                            <h3 class="text-base sm:text-lg font-bold text-[#191C1D] mb-2">Menindaklanjuti</h3>
                            <p class="text-sm text-[#3E4944] leading-relaxed">
                                Setelah perawatan, kami tetap menjalin komunikasi untuk konsultasi lanjutan guna memastikan proses pemulihan Anda berjalan lancar serta menjawab pertanyaan lain yang mungkin Anda miliki.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
