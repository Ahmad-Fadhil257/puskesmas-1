@extends('layouts.app')

@section('title', 'Lokasi & Kontak Puskesmas - ' . config('app.name'))
@section('meta_description', 'Temukan alamat lengkap, peta interaktif, petunjuk arah navigasi, dan jam pelayanan ' . ($appSetting->app_name ?? 'Puskesmas') . '.')

@push('styles')
<style>
/* Full Width Dark Emerald Header (Ijo Tua Seragam) */
.lokasi-full-header {
    width: 100%;
    margin-top: -95px;
    padding-top: 150px;
    padding-bottom: 60px;
    padding-left: 24px;
    padding-right: 24px;
    background: linear-gradient(135deg, #0A5C45 0%, #064E3B 60%, #043628 100%);
    position: relative;
    overflow: hidden;
    isolation: isolate;
    box-shadow: 0 12px 36px rgba(0, 50, 35, 0.15);
    text-align: left;
    box-sizing: border-box;
}

.lokasi-full-header__glow {
    position: absolute;
    top: -80px;
    right: -80px;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(52, 211, 153, 0.18) 0%, transparent 70%);
    border-radius: 50%;
    filter: blur(50px);
    pointer-events: none;
    z-index: -1;
}

.lokasi-full-header__decor-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(rgba(255, 255, 255, 0.08) 1.2px, transparent 1.2px),
        linear-gradient(to right, rgba(255, 255, 255, 0.01) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.01) 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.6;
    pointer-events: none;
    z-index: -1;
}

.lokasi-full-header__container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.lokasi-header-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #A7F3D0;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 6px 16px;
    border-radius: 9999px;
    margin-bottom: 20px;
}

.lokasi-full-header__title {
    font-size: clamp(1.85rem, 4vw, 2.5rem);
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 12px 0;
    line-height: 1.25;
    letter-spacing: -0.02em;
}

.lokasi-full-header__subtitle {
    font-size: 15.5px;
    color: rgba(240, 253, 250, 0.85);
    line-height: 1.6;
    max-width: 700px;
    margin: 0;
}

.lokasi-content-wrapper {
    background: #F8FAFC;
    padding: 60px 24px 90px;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
}

/* 2-Column Main Layout */
.lokasi-main-grid {
    display: grid;
    grid-template-columns: 1fr 1.15fr;
    gap: 32px;
    max-width: 1200px;
    margin: 0 auto;
    align-items: stretch;
}

@media (max-width: 991px) {
    .lokasi-main-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
}

.lokasi-card {
    background: #FFFFFF;
    border-radius: 16px;
    padding: 26px 30px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
}

.lokasi-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(10, 92, 69, 0.06), 0 4px 12px rgba(0, 0, 0, 0.02);
    border-color: rgba(10, 92, 69, 0.15);
}

.lokasi-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #E6F5F1;
    color: #0A5C45;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    flex-shrink: 0;
}

.lokasi-maps-container {
    background: #FFFFFF;
    border-radius: 16px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
    height: 100%;
    position: relative;
    min-height: 500px;
    overflow: hidden;
}

.lokasi-maps-iframe {
    width: 100%;
    height: 100%;
    min-height: 520px;
    border: none;
    border-radius: 16px;
    display: block;
}

.btn-rute-maps {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #0A5C45;
    color: #FFFFFF;
    font-size: 14.5px;
    font-weight: 700;
    padding: 13px 24px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 12px rgba(10, 92, 69, 0.2);
}

.btn-rute-maps:hover {
    background: #064E3B;
    color: #FFFFFF;
    box-shadow: 0 6px 18px rgba(10, 92, 69, 0.3);
    transform: translateY(-2px);
}

.btn-wa-lokasi {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: #25D366;
    color: #FFFFFF;
    font-size: 14.5px;
    font-weight: 700;
    padding: 13px 24px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
}

.btn-wa-lokasi:hover {
    background: #1EBE57;
    color: #FFFFFF;
    box-shadow: 0 6px 18px rgba(37, 211, 102, 0.3);
    transform: translateY(-2px);
}

.landmark-badge {
    background: #F1F5F9;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 12.5px;
    color: #475569;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    border: 1px solid #E2E8F0;
}

.contact-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 14px;
    font-weight: 600;
    color: #0A5C45;
    text-decoration: none;
    transition: color 0.2s ease;
}

.contact-link:hover {
    color: #064E3B;
    text-decoration: underline;
}
</style>
@endpush

@section('content')

{{-- =========================================================================
   FULL WIDTH DARK EMERALD HEADER (IJO TUA PERSIS BERITA & LAYANAN)
   ========================================================================= --}}
<section class="lokasi-full-header">
    <div class="lokasi-full-header__decor-pattern" aria-hidden="true"></div>
    <div class="lokasi-full-header__glow" aria-hidden="true"></div>

    <div class="lokasi-full-header__container">
        <div class="lokasi-header-badge" data-aos="fade-right">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
            <span>Informasi & Peta Lokasi</span>
        </div>
        <h1 class="lokasi-full-header__title" data-aos="fade-right">Lokasi & Kontak Puskesmas</h1>
        <p class="lokasi-full-header__subtitle" data-aos="fade-up">
            Kunjungi Puskesmas kami dengan mudah. Temukan rute navigasi terdekat, alamat lengkap, jadwal operasional pelayanan, serta kontak informasi bantuan kami.
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN 2-COLUMN SECTION: INFORMASI & INTERACTIVE MAPS
   ========================================================================= --}}
<div class="lokasi-content-wrapper">
    <div style="max-width: 1200px; margin: 0 auto; width: 100%;">

        <div class="lokasi-main-grid">

            {{-- Kolom Kiri: Kartu Informasi Alamat, Jam & Kontak --}}
            <div style="display: flex; flex-direction: column; gap: 24px;">

                {{-- Card 1: Alamat Utama --}}
                <div class="lokasi-card" data-aos="fade-up">
                    <div style="display: flex; align-items: flex-start; gap: 18px;">
                        <div class="lokasi-icon-wrapper">
                            <i class="bx bx-map"></i>
                        </div>
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 16.5px; font-weight: 800; color: #122822; margin: 0 0 8px 0; font-family: 'Plus Jakarta Sans', sans-serif;">
                                Alamat Fasilitas Kesehatan
                            </h3>
                            <p style="font-size: 14.5px; color: #334155; line-height: 1.6; margin: 0;">
                                {{ $appSetting->address ?? 'Jl. Raya Puskesmas No. 123, Indonesia' }}
                            </p>
                            @if(!empty($appSetting->landmark))
                                <div class="landmark-badge">
                                    <i class="bx bx-map-pin text-primary" style="color: #0A5C45 !important;"></i>
                                    <span><strong>Patokan:</strong> {{ $appSetting->landmark }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Card 2: Jam Pelayanan --}}
                <div class="lokasi-card" data-aos="fade-up">
                    <div style="display: flex; align-items: flex-start; gap: 18px;">
                        <div class="lokasi-icon-wrapper" style="background: #FFFBEB; color: #D97706;">
                            <i class="bx bx-time-five"></i>
                        </div>
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 16.5px; font-weight: 800; color: #122822; margin: 0 0 8px 0; font-family: 'Plus Jakarta Sans', sans-serif;">
                                Jam Pelayanan & Buka
                            </h3>
                            <div style="margin-bottom: 12px;">
                                <div style="display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 6px;">
                                    <strong style="color: #334155;">Poli Rawat Jalan:</strong>
                                    <span style="color: #0A5C45; font-weight: 700;">{{ $appSetting->operational_hours ?? '08.00 - 16.00 WIB' }}</span>
                                </div>
                                <div style="font-size: 13px; color: #64748B;">
                                    <span>Hari Operasional: <strong>{{ $appSetting->operational_days ?? 'Senin - Sabtu' }}</strong></span>
                                </div>
                            </div>
                            
                            @if(!empty($appSetting->emergency_info))
                                <div style="border-top: 1px dashed #E2E8F0; padding-top: 12px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 8px;">
                                    <span style="font-size: 13.5px; font-weight: 700; color: #DC2626;">Unit Gawat Darurat (UGD):</span>
                                    <span class="badge" style="background: #FEE2E2; color: #B91C1C; font-weight: 800; padding: 5px 12px; border-radius: 9999px; font-size: 11px; text-transform: uppercase; letter-spacing: 0.05em;">
                                        {{ $appSetting->emergency_info }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Card 3: Kontak & Bantuan --}}
                <div class="lokasi-card" data-aos="fade-up">
                    <div style="display: flex; align-items: flex-start; gap: 18px;">
                        <div class="lokasi-icon-wrapper" style="background: #F0FDF4; color: #16A34A;">
                            <i class="bx bx-phone-call"></i>
                        </div>
                        <div style="flex-grow: 1;">
                            <h3 style="font-size: 16.5px; font-weight: 800; color: #122822; margin: 0 0 8px 0; font-family: 'Plus Jakarta Sans', sans-serif;">
                                Kontak Resmi
                            </h3>
                            <p style="font-size: 14px; color: #475569; margin: 0 0 14px 0; line-height: 1.5;">
                                Hubungi petugas kami untuk pendaftaran, rujukan, jadwal praktik, atau informasi pelayanan kesehatan lainnya.
                            </p>
                            <div style="display: flex; flex-wrap: wrap; gap: 16px;">
                                @if(!empty($appSetting->phone))
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $appSetting->phone) }}" class="contact-link">
                                        <i class="bx bx-phone" style="font-size: 16px;"></i> <span>{{ $appSetting->phone }}</span>
                                    </a>
                                @endif
                                @if(!empty($appSetting->email))
                                    <a href="mailto:{{ $appSetting->email }}" class="contact-link">
                                        <i class="bx bx-envelope" style="font-size: 16px;"></i> <span>{{ $appSetting->email }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Action Buttons --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <a href="{{ $appSetting->direct_maps_link }}" target="_blank" rel="noopener" class="btn-rute-maps">
                        <i class="bx bx-navigation"></i>
                        <span>Petunjuk Rute</span>
                    </a>
                    @if(!empty($appSetting->wa_link))
                        <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-wa-lokasi">
                            <i class="bx bxl-whatsapp" style="font-size: 18px;"></i>
                            <span>Hubungi WhatsApp</span>
                        </a>
                    @endif
                </div>

            </div>

            {{-- Kolom Kanan: Interactive Google Maps Frame (Edge to Edge, Clean) --}}
            <div class="lokasi-maps-container">
                <iframe class="lokasi-maps-iframe"
                        src="{{ $appSetting->embed_map_url }}" 
                        loading="lazy" 
                        allowfullscreen 
                        referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div>

    </div>
</div>
@endsection
