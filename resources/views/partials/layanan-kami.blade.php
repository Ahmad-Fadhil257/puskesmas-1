{{-- ======================================================
     SECTION: LAYANAN KAMI
     Sesuai desain referensi (gambar)
     ====================================================== --}}

@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
@endonce

<style>
/* ===== Google Font Import ===== */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

/* ===== Section Layanan Kami ===== */
.layanan-section {
    background-color: #ffffff;
    padding: 80px 24px;
    font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
}

/* --- Container --- */
.layanan-container {
    max-width: 1080px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.layanan-header {
    text-align: center;
    margin-bottom: 52px;
}

.layanan-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11.5px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #2a7a55;
    margin-bottom: 16px;
}

.layanan-label svg {
    width: 15px;
    height: 15px;
    flex-shrink: 0;
}

.layanan-title {
    font-size: 2.1rem;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px 0;
    line-height: 1.2;
    letter-spacing: -0.01em;
}

.layanan-subtitle {
    font-size: 0.93rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
}

/* ===== GRID ===== */
.layanan-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 18px;
}

/* ===== BASE CARD ===== */
.layanan-card {
    background-color: #f3f4f6;
    border-radius: 16px;
    padding: 30px 26px;
    display: flex;
    flex-direction: column;
    transition: box-shadow 0.2s ease, transform 0.2s ease;
    cursor: default;
}

.layanan-card:hover {
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

/* ===== CARD ICON ===== */
.layanan-card-icon {
    width: 46px;
    height: 46px;
    background-color: #e6f0eb;
    border-radius: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 22px;
    color: #1a6b4a;
    flex-shrink: 0;
}

.layanan-card-icon i {
    font-size: 24px;
    line-height: 1;
    display: flex;
}

/* ===== CARD TEXT ===== */
.layanan-card-title {
    font-size: 1rem;
    font-weight: 600;
    color: #111827;
    margin: 0 0 10px 0;
    line-height: 1.3;
}

.layanan-card-desc {
    font-size: 0.865rem;
    color: #6b7280;
    line-height: 1.65;
    margin: 0;
}

/* ===== FEATURED CARD — Dark Green ===== */
.layanan-card--featured {
    background-color: #1c5c3e;
}

.layanan-card--featured:hover {
    background-color: #185235;
    box-shadow: 0 8px 28px rgba(28, 92, 62, 0.35);
}

.layanan-card--featured .layanan-card-icon {
    background-color: rgba(255, 255, 255, 0.18);
    color: #ffffff;
}

.layanan-card--featured .layanan-card-title {
    color: #ffffff;
}

.layanan-card--featured .layanan-card-desc {
    color: rgba(255, 255, 255, 0.82);
}

/* ===== EMERGENCY CARD — Red ===== */
.layanan-card--emergency {
    background-color: #cc0000;
    justify-content: center;
    text-align: center;
    align-items: center;
}

.layanan-card--emergency:hover {
    background-color: #b30000;
    box-shadow: 0 8px 28px rgba(204, 0, 0, 0.38);
}

.layanan-card--emergency .layanan-card-title {
    color: #ffffff;
    font-size: 1.1rem;
    margin-bottom: 12px;
}

.layanan-card--emergency .layanan-card-desc {
    color: rgba(255, 255, 255, 0.85);
    text-align: center;
    max-width: 240px;
}

/* ===== EMERGENCY BUTTON ===== */
.layanan-emergency-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
    padding: 8px 24px;
    background-color: transparent;
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 999px;
    color: #ffffff;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: background-color 0.2s ease, border-color 0.2s ease;
}

.layanan-emergency-btn:hover {
    background-color: rgba(255, 255, 255, 0.15);
    border-color: #ffffff;
    color: #ffffff;
    text-decoration: none;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .layanan-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 580px) {
    .layanan-section {
        padding: 60px 16px;
    }

    .layanan-title {
        font-size: 1.65rem;
    }

    .layanan-grid {
        grid-template-columns: 1fr;
    }

    .layanan-card--emergency {
        align-items: flex-start;
        text-align: left;
    }

    .layanan-card--emergency .layanan-card-desc {
        text-align: left;
    }
}
</style>

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
                    {{-- Konsultasi Kesehatan --}}
                    <i class="ti ti-id-badge-2"></i>
                </div>
                <h3 class="layanan-card-title">Konsultasi Kesehatan</h3>
                <p class="layanan-card-desc">Panduan profesional untuk menjaga gaya hidup sehat, mengelola kondisi kronis, dan banyak lagi.</p>
            </div>

            {{-- CARD 2 · Dokter Spesialis — FEATURED (hijau gelap) --}}
            <div class="layanan-card layanan-card--featured">
                <div class="layanan-card-icon">
                    {{-- Dokter Spesialis --}}
                    <i class="ti ti-stethoscope"></i>
                </div>
                <h3 class="layanan-card-title">Dokter spesialis</h3>
                <p class="layanan-card-desc">Konsultasikan dengan spesialis berpengalaman untuk diagnosis yang akurat dan rencana perawatan yang dipersonalisasi.</p>
            </div>

            {{-- CARD 3 · Pemeriksaan Kesehatan --}}
            <div class="layanan-card">
                <div class="layanan-card-icon">
                    {{-- Pemeriksaan Kesehatan: monitor tanpa penyangga --}}
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
                    {{-- Layanan Farmasi: clipboard dengan garis-garis teks --}}
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
                    {{-- Jaminan Kesehatan: shield dengan tanda plus medis --}}
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
