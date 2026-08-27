@extends('layouts.app')

@section('title', $layanan->title . ' - ' . ($appSetting->app_name ?? config('app.name')))
@section('meta_description', Str::limit(strip_tags($layanan->description), 160))

@push('styles')
<style>
/* Header Dark Emerald Puskesmas */
.layanan-detail-header {
    width: 100%;
    margin-top: -95px;
    padding-top: 145px;
    padding-bottom: 55px;
    padding-left: 24px;
    padding-right: 24px;
    background: linear-gradient(135deg, #0A5C45 0%, #064E3B 60%, #043628 100%);
    position: relative;
    overflow: hidden;
    isolation: isolate;
    box-shadow: 0 12px 36px rgba(0, 50, 35, 0.16);
    box-sizing: border-box;
}

.layanan-detail-header__glow {
    position: absolute;
    top: -60px;
    right: -60px;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(52, 211, 153, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    filter: blur(50px);
    pointer-events: none;
    z-index: -1;
}

.layanan-detail-header__decor {
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

.layanan-detail-header__container {
    max-width: 1000px;
    margin: 0 auto;
}

.layanan-detail-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #A7F3D0;
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.16);
    padding: 6px 16px;
    border-radius: 9999px;
    margin-bottom: 16px;
}

.layanan-detail-title {
    font-size: clamp(1.85rem, 3.8vw, 2.6rem);
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 10px 0;
    line-height: 1.25;
    letter-spacing: -0.02em;
}

.layanan-detail-sub {
    font-size: 15px;
    color: rgba(240, 253, 250, 0.85);
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}

.layanan-breadcrumb {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    color: rgba(255, 255, 255, 0.7);
    list-style: none;
    padding: 0;
    margin: 0;
}

.layanan-breadcrumb a {
    color: #A7F3D0;
    text-decoration: none;
    transition: color 0.2s;
}

.layanan-breadcrumb a:hover {
    color: #FFFFFF;
    text-decoration: underline;
}

.layanan-breadcrumb-sep {
    color: rgba(255, 255, 255, 0.4);
}

/* Content Container */
.layanan-detail-wrapper {
    background: #F8FAFC;
    padding: 48px 24px 80px;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
}

.layanan-detail-main {
    max-width: 1000px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 36px;
}

/* Banner / Image Section */
.layanan-image-card {
    background: #FFFFFF;
    border-radius: 20px;
    overflow: hidden;
    border: 1px solid #E2E8F0;
    box-shadow: 0 4px 20px rgba(10, 92, 69, 0.05);
    text-align: center;
    position: relative;
}

.layanan-image-img {
    width: 100%;
    max-height: 480px;
    object-fit: cover;
    display: block;
    margin: 0 auto;
}

.layanan-image-placeholder {
    padding: 60px 24px;
    background: linear-gradient(135deg, #E6F5F1 0%, #F0FDF4 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 16px;
    color: #0A5C45;
}

.layanan-image-placeholder i {
    font-size: 72px;
    opacity: 0.8;
}

/* Card Section */
.layanan-content-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 36px 40px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
}

@media (max-width: 768px) {
    .layanan-content-card {
        padding: 24px 20px;
    }
}

.section-headline {
    font-size: 18px;
    font-weight: 800;
    color: #0F172A;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 10px;
    border-bottom: 2px solid #E2E8F0;
    position: relative;
}

.section-headline::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 48px;
    height: 2px;
    background: #0A5C45;
}

.section-headline i {
    color: #0A5C45;
    font-size: 22px;
}

.layanan-description-text {
    font-size: 15.5px;
    line-height: 1.8;
    color: #334155;
    margin-bottom: 28px;
}

/* Tables for Jadwal */
.jadwal-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
    margin-bottom: 32px;
}

@media (max-width: 768px) {
    .jadwal-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}

.jadwal-card {
    background: #F8FAFC;
    border-radius: 14px;
    border: 1px solid #E2E8F0;
    padding: 20px;
    transition: all 0.2s ease;
}

.jadwal-card:hover {
    border-color: rgba(10, 92, 69, 0.25);
    background: #F4FAF7;
}

.jadwal-card-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 14px;
    font-size: 15px;
    font-weight: 700;
    color: #0A5C45;
}

.jadwal-card-header i {
    font-size: 20px;
}

.jadwal-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}

.jadwal-table tr {
    border-bottom: 1px dashed #E2E8F0;
}

.jadwal-table tr:last-child {
    border-bottom: none;
}

.jadwal-table td {
    padding: 8px 4px;
    color: #334155;
}

.jadwal-table td.hari {
    font-weight: 600;
    color: #1E293B;
    width: 45%;
}

.jadwal-table td.jam {
    text-align: right;
    font-weight: 700;
    color: #0A5C45;
}

/* Checklist Tindakan */
.tindakan-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 12px;
    margin-bottom: 32px;
}

.tindakan-item {
    background: #F0FDF4;
    border: 1px solid #DCFCE7;
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 14px;
    font-weight: 600;
    color: #166534;
}

.tindakan-item i {
    font-size: 18px;
    color: #16A34A;
    flex-shrink: 0;
}

/* Persyaratan Card */
.persyaratan-box {
    background: #FFFBEB;
    border-left: 4px solid #D97706;
    border-radius: 0 12px 12px 0;
    padding: 18px 22px;
    margin-bottom: 32px;
}

.persyaratan-box h4 {
    font-size: 15px;
    font-weight: 700;
    color: #92400E;
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.persyaratan-box p {
    font-size: 14px;
    color: #78350F;
    line-height: 1.6;
    margin: 0;
}

/* Dokter Penanggung Jawab */
.dokter-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 18px;
    margin-bottom: 32px;
}

.dokter-item-card {
    display: flex;
    align-items: center;
    gap: 14px;
    background: #F8FAFC;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 14px;
    transition: all 0.2s ease;
}

.dokter-item-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(10, 92, 69, 0.08);
    border-color: rgba(10, 92, 69, 0.2);
}

.dokter-avatar-wrap {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    background: #E2E8F0;
    border: 2px solid #0A5C45;
}

.dokter-avatar-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.dokter-avatar-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #E6F5F1;
    color: #0A5C45;
    font-size: 24px;
}

.dokter-info h5 {
    font-size: 14px;
    font-weight: 700;
    color: #0F172A;
    margin: 0 0 2px 0;
}

.dokter-info p {
    font-size: 12.5px;
    color: #64748B;
    margin: 0 0 4px 0;
}

.dokter-info .badge-jadwal {
    font-size: 11px;
    font-weight: 600;
    color: #0A5C45;
    background: #E6F5F1;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
}

/* Call to Action Card */
.cta-help-card {
    background: linear-gradient(135deg, #0A5C45 0%, #064E3B 100%);
    border-radius: 16px;
    padding: 28px 32px;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
    box-shadow: 0 8px 24px rgba(10, 92, 69, 0.2);
}

.cta-help-text h4 {
    font-size: 18px;
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 6px 0;
}

.cta-help-text p {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
}

.cta-help-actions {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-cta-wa {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25D366;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: 700;
    padding: 12px 22px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
}

.btn-cta-wa:hover {
    background: #1EBE57;
    color: #FFFFFF;
    transform: translateY(-2px);
}

.btn-cta-all {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #FFFFFF;
    font-size: 14px;
    font-weight: 600;
    padding: 12px 20px;
    border-radius: 10px;
    text-decoration: none;
    transition: all 0.2s ease;
}

.btn-cta-all:hover {
    background: rgba(255, 255, 255, 0.25);
    color: #FFFFFF;
}

/* Other Services Grid */
.other-layanans-section {
    margin-top: 12px;
}

.other-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 16px;
    margin-top: 16px;
}

.other-card {
    background: #FFFFFF;
    border: 1px solid #E2E8F0;
    border-radius: 14px;
    padding: 18px;
    text-decoration: none;
    transition: all 0.25s ease;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.other-card:hover {
    transform: translateY(-3px);
    border-color: rgba(10, 92, 69, 0.25);
    box-shadow: 0 8px 20px rgba(10, 92, 69, 0.08);
}

.other-card i {
    font-size: 24px;
    color: #0A5C45;
}

.other-card h5 {
    font-size: 14.5px;
    font-weight: 700;
    color: #0F172A;
    margin: 0;
}

.other-card p {
    font-size: 12.5px;
    color: #64748B;
    margin: 0;
    line-height: 1.4;
}
</style>
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: DARK EMERALD
   ========================================================================= --}}
<section class="layanan-detail-header">
    <div class="layanan-detail-header__decor" aria-hidden="true"></div>
    <div class="layanan-detail-header__glow" aria-hidden="true"></div>

    <div class="layanan-detail-header__container">
        <div class="layanan-detail-badge">
            <i class="{{ $layanan->icon ?? 'bx bx-plus-medical' }}"></i>
            <span>{{ $layanan->tipe_jaminan ?? 'LAYANAN PUSKESMAS' }}</span>
        </div>
        <h1 class="layanan-detail-title">{{ $layanan->title }}</h1>
        <p class="layanan-detail-sub">
            <i class="bx bx-building-house"></i>
            <span>UPTD Puskesmas {{ $appSetting->app_name ?? 'CareLink' }}</span>
        </p>

        {{-- Breadcrumb --}}
        <ul class="layanan-breadcrumb">
            <li><a href="{{ route('home') }}">Beranda</a></li>
            <li class="layanan-breadcrumb-sep">/</li>
            <li><a href="{{ route('layanan.index') }}">Layanan</a></li>
            <li class="layanan-breadcrumb-sep">/</li>
            <li style="color: #FFFFFF; font-weight: 600;">{{ $layanan->title }}</li>
        </ul>
    </div>
</section>

{{-- =========================================================================
   MAIN CONTENT: INFORMATIF, RESMI & TERSTRUKTUR (ALA PUSKESMAS PANGLAYUNGAN)
   ========================================================================= --}}
<div class="layanan-detail-wrapper">
    <div class="layanan-detail-main">

        {{-- 1. FOTO TIM / RUANGAN POLI --}}
        <div class="layanan-image-card">
            @if(!empty($layanan->image))
                <img src="{{ $layanan->image_url }}" alt="{{ $layanan->title }}" class="layanan-image-img">
            @else
                <div class="layanan-image-placeholder">
                    <i class="{{ $layanan->icon ?? 'bx bx-clinic' }}"></i>
                    <h3 style="font-size: 20px; font-weight: 800; margin: 0; color: #0A5C45;">{{ $layanan->title }}</h3>
                    <p style="font-size: 14px; color: #3B5249; margin: 0; max-width: 500px;">
                        Fasilitas dan tenaga kesehatan profesional siap memberikan pelayanan terbaik untuk kesehatan Anda dan keluarga.
                    </p>
                </div>
            @endif
        </div>

        {{-- 2. DESKRIPSI & RUANG LINGKUP LAYANAN --}}
        <div class="layanan-content-card">
            <h3 class="section-headline">
                <i class="bx bx-detail"></i>
                <span>Deskripsi & Ruang Lingkup Layanan</span>
            </h3>
            <div class="layanan-description-text">
                {!! nl2br(e($layanan->description)) !!}
            </div>

            {{-- 3. JADWAL PENDAFTARAN & JADWAL PELAYANAN --}}
            <h3 class="section-headline">
                <i class="bx bx-time"></i>
                <span>Jadwal Operasional Pelayanan</span>
            </h3>
            <div class="jadwal-grid">
                {{-- Jadwal Pendaftaran --}}
                <div class="jadwal-card">
                    <div class="jadwal-card-header">
                        <i class="bx bx-id-card"></i>
                        <span>Jadwal Pendaftaran Loket</span>
                    </div>
                    @if(!empty($layanan->jadwal_pendaftaran))
                        <div style="font-size: 13.5px; line-height: 1.7; color: #334155;">
                            {!! nl2br(e($layanan->jadwal_pendaftaran)) !!}
                        </div>
                    @else
                        <table class="jadwal-table">
                            <tbody>
                                <tr>
                                    <td class="hari">Senin - Kamis</td>
                                    <td class="jam">07.30 - 12.00 WIB</td>
                                </tr>
                                <tr>
                                    <td class="hari">Jumat</td>
                                    <td class="jam">07.30 - 10.30 WIB</td>
                                </tr>
                                <tr>
                                    <td class="hari">Sabtu</td>
                                    <td class="jam">07.30 - 11.30 WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>

                {{-- Jadwal Pemeriksaan / Pelayanan --}}
                <div class="jadwal-card">
                    <div class="jadwal-card-header">
                        <i class="bx bx-stethoscope"></i>
                        <span>Jadwal Pemeriksaan Medis</span>
                    </div>
                    @if(!empty($layanan->jam_operasional) && $layanan->jam_operasional !== 'Senin - Sabtu: 08.00 - 14.00 WIB')
                        <div style="font-size: 13.5px; line-height: 1.7; color: #0A5C45; font-weight: 700;">
                            {!! nl2br(e($layanan->jam_operasional)) !!}
                        </div>
                    @else
                        <table class="jadwal-table">
                            <tbody>
                                <tr>
                                    <td class="hari">Senin - Kamis</td>
                                    <td class="jam">08.00 - 14.00 WIB</td>
                                </tr>
                                <tr>
                                    <td class="hari">Jumat</td>
                                    <td class="jam">08.00 - 14.00 WIB</td>
                                </tr>
                                <tr>
                                    <td class="hari">Sabtu</td>
                                    <td class="jam">08.00 - 13.30 WIB</td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>

            {{-- 4. TINDAKAN & PEMERIKSAAN MEDIS (JIKA ADA) --}}
            @if(!empty($layanan->tindakan_list) && count($layanan->tindakan_list) > 0)
                <h3 class="section-headline">
                    <i class="bx bx-check-shield"></i>
                    <span>Cakupan Tindakan & Layanan Medis</span>
                </h3>
                <div class="tindakan-list">
                    @foreach($layanan->tindakan_list as $tindakan)
                        <div class="tindakan-item">
                            <i class="bx bx-check-circle"></i>
                            <span>{{ $tindakan }}</span>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 5. PERSYARATAN BEROBAT --}}
            @if(!empty($layanan->persyaratan))
                <div class="persyaratan-box">
                    <h4>
                        <i class="bx bx-error-circle"></i>
                        <span>Persyaratan Berobat Pasien</span>
                    </h4>
                    <p>{!! nl2br(e($layanan->persyaratan)) !!}</p>
                </div>
            @else
                <div class="persyaratan-box">
                    <h4>
                        <i class="bx bx-info-circle"></i>
                        <span>Persyaratan Berobat Umum / BPJS</span>
                    </h4>
                    <p>
                        Membawa KTP / Kartu Keluarga (KK), Kartu Indonesia Sehat (KIS/BPJS) aktif bagi peserta jaminan kesehatan, serta Kartu Rekam Medis Puskesmas bagi pasien ulangan.
                    </p>
                </div>
            @endif

            {{-- 6. DOKTER & TENAGA MEDIS PENANGGUNG JAWAB --}}
            @if($layanan->dokters->isNotEmpty())
                <h3 class="section-headline">
                    <i class="bx bx-user-pin"></i>
                    <span>Dokter & Tenaga Medis Penanggung Jawab</span>
                </h3>
                <div class="dokter-cards-grid">
                    @foreach($layanan->dokters as $dokter)
                        <div class="dokter-item-card">
                            <div class="dokter-avatar-wrap">
                                @if($dokter->photo)
                                    <img src="{{ asset($dokter->photo) }}" alt="{{ $dokter->name }}">
                                @else
                                    <div class="dokter-avatar-placeholder">
                                        <i class="bx bx-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="dokter-info">
                                <h5>{{ $dokter->name }}</h5>
                                <p>{{ $dokter->specialty ?? 'Dokter Pelaksana' }}</p>
                                @if(!empty($dokter->jadwal_praktek))
                                    <span class="badge-jadwal">
                                        <i class="bx bx-calendar-event me-1"></i>
                                        {{ is_array($dokter->jadwal_praktek) ? implode(', ', array_slice($dokter->jadwal_praktek, 0, 2)) : $dokter->jadwal_praktek }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 7. CTA / PENDAFTARAN & KONSULTASI --}}
            <div class="cta-help-card">
                <div class="cta-help-text">
                    <h4>Perlu Bantuan atau Informasi Pendaftaran?</h4>
                    <p>Petugas kami siap membantu memberikan informasi seputar alur rujukan, antrean, dan pendaftaran poli.</p>
                </div>
                <div class="cta-help-actions">
                    <a href="{{ $layanan->btn_link ? $layanan->btn_link : $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-cta-wa">
                        <i class="bx bxl-whatsapp fs-5"></i>
                        <span>{{ $layanan->btn_text ? $layanan->btn_text : 'Pendaftaran / Chat WA' }}</span>
                    </a>
                    <a href="{{ route('layanan.index') }}" class="btn-cta-all">
                        <span>Semua Layanan</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
            </div>

        </div>

        {{-- 8. JELAJAHI LAYANAN LAINNYA --}}
        @if(isset($otherLayanans) && $otherLayanans->isNotEmpty())
            <div class="other-layanans-section">
                <h4 style="font-size: 16px; font-weight: 800; color: #0F172A; margin: 0 0 14px 0;">
                    <i class="bx bx-grid-alt text-primary me-1" style="color: #0A5C45 !important;"></i>
                    Pelayanan Puskesmas Lainnya
                </h4>
                <div class="other-grid">
                    @foreach($otherLayanans as $other)
                        <a href="{{ route('layanan.detail', $other->slug) }}" class="other-card">
                            <i class="{{ $other->icon ?? 'bx bx-plus-medical' }}"></i>
                            <h5>{{ $other->title }}</h5>
                            <p>{{ Str::limit(strip_tags($other->description), 65) }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
@endsection
