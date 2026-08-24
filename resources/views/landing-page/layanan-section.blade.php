@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
@endonce

<section class="layanan-section" id="layanan-kami">
    <div class="layanan-container">

        {{-- ---- HEADER ---- --}}
        <div class="layanan-header">

            <div class="layanan-label">
                {{-- Ikon gedung/rumah --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                </svg>
                LAYANAN KAMI
            </div>

            <h2 class="layanan-title">Solusi Layanan Kesehatan Komprehensif</h2>

            <p class="layanan-subtitle">
                Di CareLink, kami menawarkan beragam layanan medis yang disesuaikan dengan kebutuhan Anda,<br>
                mulai dari pemeriksaan rutin hingga perawatan khusus.
            </p>

        </div>
        {{-- END HEADER --}}

        {{-- ---- CARDS GRID ---- --}}
        <div class="layanan-grid">

            {{-- CARD 1 · Konsultasi Kesehatan --}}
            <div class="layanan-card">
                <div class="layanan-card-icon">
                    <i class="ti ti-id-badge-2"></i>
                </div>
                <h3 class="layanan-card-title">Konsultasi Kesehatan</h3>
                <p class="layanan-card-desc">Panduan profesional untuk menjaga gaya hidup sehat, mengelola kondisi kronis, dan banyak lagi.</p>
            </div>

            {{-- CARD 2 · Dokter Spesialis — FEATURED (hijau gelap) --}}
            <div class="layanan-card layanan-card--featured">
                <div class="layanan-card-icon">
                    <i class="ti ti-stethoscope"></i>
                </div>
                <h3 class="layanan-card-title">Dokter spesialis</h3>
                <p class="layanan-card-desc">Konsultasikan dengan spesialis berpengalaman untuk diagnosis yang akurat dan rencana perawatan yang dipersonalisasi.</p>
            </div>

            {{-- CARD 3 · Pemeriksaan Kesehatan --}}
            <div class="layanan-card">
                <div class="layanan-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="14" rx="2"/>
                        <polyline points="7 12 9 9 11 14 13 10 15 13 17 12"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Pemeriksaan Kesehatan</h3>
                <p class="layanan-card-desc">Pemeriksaan kesehatan rutin untuk memantau kondisi kesehatan Anda dan mendeteksi potensi masalah sejak dini.</p>
            </div>

            {{-- CARD 4 · Layanan Farmasi --}}
            <div class="layanan-card">
                <div class="layanan-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="1"/>
                        <line x1="9" y1="12" x2="15" y2="12"/>
                        <line x1="9" y1="16" x2="13" y2="16"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Layanan Farmasi</h3>
                <p class="layanan-card-desc">Akses mudah ke obat resep & saran ahli farmasi, semuanya di satu tempat.</p>
            </div>

            {{-- CARD 5 · Jaminan Kesehatan --}}
            <div class="layanan-card">
                <div class="layanan-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        <line x1="12" y1="9" x2="12" y2="15"/>
                        <line x1="9" y1="12" x2="15" y2="12"/>
                    </svg>
                </div>
                <h3 class="layanan-card-title">Jaminan Kesehatan</h3>
                <p class="layanan-card-desc">Paket asuransi kesehatan komprehensif yang menawarkan perlindungan finansial untuk perawatan medis.</p>
            </div>

            {{-- CARD 6 · Panggilan Darurat — RED --}}
            <div class="layanan-card layanan-card--emergency">
                <h3 class="layanan-card-title">Panggilan Darurat</h3>
                <p class="layanan-card-desc">
                    Akses cepat ke layanan darurat, memastikan penanganan segera saat Anda paling membutuhkannya.
                </p>
                <a href="#" class="layanan-emergency-btn">
                    Hubungi kami <i class="ti ti-arrow-right" style="font-size: 1.1em;"></i>
                </a>
            </div>

        </div>
        {{-- END GRID --}}

    </div>
</section>
