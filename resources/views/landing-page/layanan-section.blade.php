<section class="layanan-bento-section" id="layanan-kami">
    <div class="layanan-bento-container">

        {{-- ===== HEADER SECTION ===== --}}
        <div class="layanan-bento-header">
            <div class="layanan-bento-badge">
                <i class="bx bx-plus-medical"></i>
                <span>LAYANAN PUBLIK</span>
            </div>
            <h2 class="layanan-bento-title">Pusat Layanan Kesehatan Terpadu</h2>
            <p class="layanan-bento-subtitle">
                Pilih kategori layanan yang Anda butuhkan. Kami menyediakan berbagai jalur pendaftaran, konsultasi dokter, dan informasi fasilitas kesehatan secara mudah dan terpadu.
            </p>
        </div>

        {{-- ===== BENTO GRID LAYOUT ===== --}}
        <div class="layanan-bento-grid">

            {{-- 1. KARTU BESAR KIRI (FEATURED HERO CARD: POLI KIA & IMUNISASI) --}}
            <div class="bento-card bento-card--hero">
                {{-- Decorative Medical Background Pattern --}}
                <div class="bento-hero-bg-decor" aria-hidden="true">
                    <svg viewBox="0 0 400 500" fill="none" xmlns="http://www.w3.org/2000/svg" class="bento-hero-svg">
                        <circle cx="200" cy="220" r="140" fill="rgba(255,255,255,0.04)"/>
                        <circle cx="200" cy="220" r="90" fill="rgba(255,255,255,0.06)"/>
                        <path d="M200 130v180M140 200h120" stroke="rgba(255,255,255,0.12)" stroke-width="16" stroke-linecap="round"/>
                        <path d="M160 170c20-20 60-20 80 0s60 20 80 0" stroke="rgba(255,255,255,0.08)" stroke-width="6" stroke-linecap="round"/>
                        <path d="M120 270c20 20 60 20 80 0s60-20 80 0" stroke="rgba(255,255,255,0.08)" stroke-width="6" stroke-linecap="round"/>
                    </svg>
                </div>

                {{-- Floating Pill Icon --}}
                <div class="bento-hero-top-badge">
                    <i class="bx bx-injection"></i>
                </div>

                {{-- Content Body --}}
                <div class="bento-hero-content">
                    <span class="bento-mini-tag">POLI KESEHATAN IBU & ANAK (KIA)</span>
                    <h3 class="bento-hero-title">Pemeriksaan Kehamilan & Imunisasi Balita</h3>
                    <p class="bento-hero-desc">
                        Layanan terpadu USG dasar, posyandu rutin, imunisasi vaksinasi anak, serta konsultasi tumbuh kembang balita bersama dokter spesialis anak di Poli KIA.
                    </p>
                    <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-bento-terracotta">
                        <span>Daftar Antrean Poli KIA</span>
                        <i class="bx bx-right-arrow-alt"></i>
                    </a>
                </div>
            </div>

            {{-- 2. KARTU KANAN ATAS 1: POLI UMUM & SURAT SEHAT (MINT TINT) --}}
            <div class="bento-card bento-card--mint">
                <div class="bento-card-icon-wrap icon-mint">
                    <i class="bx bx-clinic"></i>
                </div>
                <h4 class="bento-card-title">Pemeriksaan & Surat Sehat</h4>
                <p class="bento-card-desc">
                    Pemeriksaan fisik lengkap dokter umum, skrining tekanan darah, serta penerbitan surat keterangan sehat (KIR) untuk keperluan kerja atau studi.
                </p>
            </div>

            {{-- 3. KARTU KANAN ATAS 2: FARMASI & APOTEK (PEACH TINT) --}}
            <div class="bento-card bento-card--peach">
                <div class="bento-card-icon-wrap icon-peach">
                    <i class="bx bx-capsule"></i>
                </div>
                <h4 class="bento-card-title">Apotek & Konsultasi Obat</h4>
                <p class="bento-card-desc">
                    Pelayanan tebus resep obat BPJS & Umum, informasi aturan minum obat (PIO), serta ketersediaan obat esensial terpadu bersama apoteker.
                </p>
            </div>

            {{-- 4. KARTU KANAN BAWAH: KATALOG LENGKAP PUSKESMAS (WIDE SLATE CARD - SATU-SATUNYA YANG MENGARAHKAN KE /LAYANAN) --}}
            <div class="bento-card bento-card--slate">
                <div class="bento-slate-left">
                    <div class="bento-card-icon-wrap icon-slate-dark">
                        <i class="bx bx-map-pin"></i>
                    </div>
                    <h4 class="bento-slate-title">Katalog Lengkap Poliklinik & UGD</h4>
                    <p class="bento-slate-desc">
                        Temukan rincian seluruh 6+ poliklinik rawat jalan, dokter spesialis, jadwal operasional, laboratorium, serta fasilitas siaga UGD 24 jam.
                    </p>
                    <a href="{{ route('layanan.index') }}" class="btn-bento-white">
                        <i class="bx bx-grid-alt me-1"></i>
                        <span>Buka Katalog Semua Layanan</span>
                        <i class="bx bx-right-arrow-alt ms-1"></i>
                    </a>
                </div>

                {{-- Visual Map / Facilities Art --}}
                <div class="bento-slate-graphic" aria-hidden="true">
                    <div class="clinic-map-visual">
                        <div class="map-pulse-point point-1"><i class="bx bx-plus-medical"></i></div>
                        <div class="map-pulse-point point-2"><i class="bx bx-user-voice"></i></div>
                        <div class="map-pulse-point point-3"><i class="bx bx-shield-plus"></i></div>
                        <div class="map-card-center">
                            <i class="bx bx-clinic"></i>
                            <span>PUSKESMAS</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
