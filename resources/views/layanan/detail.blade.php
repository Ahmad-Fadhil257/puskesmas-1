@extends('layouts.app')

@section('title', $layanan->title . ' - ' . ($appSetting->app_name ?? config('app.name')))
@section('meta_description', Str::limit(strip_tags($layanan->description), 160))

@push('styles')
<style>
/* Content Container */
.layanan-detail-wrapper {
    background: #EDF2F7;
    padding: 48px 24px 80px;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
}

.layanan-detail-main {
    max-width: 960px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 28px;
}

/* 1. Image / Banner Card */
.layanan-image-card {
    background: #FFFFFF;
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #CBD5E1;
    box-shadow: 0 4px 18px rgba(10, 92, 69, 0.06), 0 1px 3px rgba(15, 23, 42, 0.02);
    text-align: center;
}

.layanan-image-img {
    width: 100%;
    max-height: 420px;
    object-fit: cover;
    display: block;
}

.layanan-image-placeholder {
    padding: 50px 24px;
    background: #F8FAF9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: #0A5C45;
}

.layanan-image-placeholder i {
    font-size: 56px;
    color: #0A5C45;
}

/* 2. Main Content Card */
.layanan-content-card {
    background: #FFFFFF;
    border-radius: 12px;
    padding: 36px 40px;
    border: 1px solid #CBD5E1;
    box-shadow: 0 4px 18px rgba(10, 92, 69, 0.06), 0 1px 3px rgba(15, 23, 42, 0.02);
    overflow-wrap: anywhere;
    word-break: break-word;
    word-wrap: break-word;
    overflow: hidden;
    max-width: 100%;
}

@media (max-width: 768px) {
    .layanan-content-card {
        padding: 24px 18px;
    }
}

/* Clean Minimal Section Headline */
.section-headline {
    font-size: 16.5px;
    font-weight: 700;
    color: #0F172A;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    padding-bottom: 12px;
    border-bottom: 1px solid #E2E8F0;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.section-headline i {
    color: #0A5C45;
    font-size: 20px;
    flex-shrink: 0;
}

.layanan-description-text {
    font-size: 15px;
    line-height: 1.75;
    color: #334155;
    margin-bottom: 32px;
    overflow-wrap: anywhere;
    word-break: break-word;
    word-wrap: break-word;
    white-space: pre-wrap;
    max-width: 100%;
}

/* 3. Tables for Jadwal */
.jadwal-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 32px;
}

@media (max-width: 768px) {
    .jadwal-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

.jadwal-card {
    background: #F8FAFC;
    border-radius: 12px;
    border: 1px solid #CBD5E1;
    padding: 18px 20px;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.jadwal-card-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 700;
    color: #0A5C45;
}

.jadwal-card-header i {
    font-size: 18px;
    flex-shrink: 0;
}

.jadwal-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13.5px;
}

.jadwal-table tr {
    border-bottom: 1px solid #E2E8F0;
}

.jadwal-table tr:last-child {
    border-bottom: none;
}

.jadwal-table td {
    padding: 8px 4px;
    color: #334155;
    overflow-wrap: anywhere;
    word-break: break-word;
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

/* 4. Checklist Tindakan */
.tindakan-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
    gap: 10px;
    margin-bottom: 32px;
}

.tindakan-item {
    background: #F0FDF4;
    border: 1px solid #BBF7D0;
    border-radius: 10px;
    padding: 10px 14px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #166534;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.tindakan-item i {
    font-size: 18px;
    color: #16A34A;
    flex-shrink: 0;
}

/* 5. Persyaratan Card (Clean, Subtle Amber Tint, 1px Stroke) */
.persyaratan-box {
    background: #FFFBEB;
    border: 1px solid #FDE68A;
    border-radius: 12px;
    padding: 18px 20px;
    margin-bottom: 32px;
    overflow-wrap: anywhere;
    word-break: break-word;
    word-wrap: break-word;
    max-width: 100%;
}

.persyaratan-box h4,
.persyaratan-box-header {
    font-size: 14.5px;
    font-weight: 700;
    color: #92400E;
    margin: 0 0 8px 0;
    display: flex;
    align-items: center;
    gap: 8px;
    overflow-wrap: anywhere;
    word-break: break-word;
}

.persyaratan-box h4 i,
.persyaratan-box-header i {
    color: #D97706;
    font-size: 18px;
    flex-shrink: 0;
}

.persyaratan-box p,
.persyaratan-box-text {
    font-size: 13.5px;
    color: #78350F;
    line-height: 1.6;
    margin: 0;
    overflow-wrap: anywhere;
    word-break: break-word;
    word-wrap: break-word;
    white-space: pre-wrap;
    max-width: 100%;
}



/* 7. Call to Action Card */
.cta-help-card {
    background: #0A5C45;
    border-radius: 12px;
    padding: 24px 28px;
    color: #FFFFFF;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.cta-help-text h4 {
    font-size: 16.5px;
    font-weight: 700;
    color: #FFFFFF;
    margin: 0 0 4px 0;
}

.cta-help-text p {
    font-size: 13.5px;
    color: rgba(255, 255, 255, 0.85);
    margin: 0;
}

.cta-help-actions {
    display: flex;
    align-items: center;
    gap: 12px;
}

.btn-cta-wa {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #25D366;
    color: #FFFFFF;
    font-size: 14px;
    font-weight: 700;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s ease;
}

.btn-cta-wa:hover {
    background: #1EBE57;
    color: #FFFFFF;
}
</style>
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header" data-aos="fade-down">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        {{-- Breadcrumb Nav dengan aksen oranye --}}
        <div class="subpage-header__breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span>Layanan</span>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">{{ $layanan->title }}</span>
        </div>

        <h1 class="subpage-header__title">{{ $layanan->title }}</h1>
        <p class="subpage-header__subtitle">
            Pelayanan kesehatan komprehensif UPTD Puskesmas {{ $appSetting->app_name ?? 'CareLink' }} • {{ $layanan->tipe_jaminan ?? 'BPJS & Umum' }}
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN CONTENT: INFORMATIF, RESMI & TERSTRUKTUR (ALA PUSKESMAS PANGLAYUNGAN)
   ========================================================================= --}}
<div class="layanan-detail-wrapper">
    <div class="layanan-detail-main">

        {{-- 1. FOTO TIM / RUANGAN POLI / ICON HEADER --}}
        <div class="layanan-image-card" data-aos="fade-up">
            @if(!empty($layanan->image))
                <img src="{{ $layanan->image_url }}" alt="{{ $layanan->title }}" class="layanan-image-img">
            @else
                <div class="layanan-image-placeholder">
                    <i class="{{ $layanan->icon ?? 'bx bx-clinic' }}"></i>
                    <h3 style="font-size: 20px; font-weight: 800; margin: 0; color: #0A5C45;">{{ $layanan->title }}</h3>
                    <p style="font-size: 14px; color: #3B5249; margin: 0; max-width: 500px;">
                        {{ $layanan->subtitle ?? 'Fasilitas dan tenaga kesehatan profesional siap memberikan pelayanan terbaik untuk kesehatan Anda dan keluarga.' }}
                    </p>
                </div>
            @endif
        </div>

        {{-- 2. DESKRIPSI & RUANG LINGKUP LAYANAN --}}
        <div class="layanan-content-card" data-aos="fade-up" data-aos-delay="100">
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
                    @php
                        $loketLines = !empty($layanan->jadwal_pendaftaran)
                            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $layanan->jadwal_pendaftaran))))
                            : [
                                'Senin - Kamis : 07.30 - 12.00 WIB',
                                'Jumat : 07.30 - 10.30 WIB',
                                'Sabtu : 07.30 - 11.30 WIB'
                            ];
                    @endphp
                    <table class="jadwal-table">
                        <tbody>
                            @foreach($loketLines as $line)
                                @php
                                    $parts = preg_split('/[:–-]\s*(?=[0-9])/', $line, 2);
                                @endphp
                                @if(count($parts) == 2)
                                    <tr>
                                        <td class="hari">{{ trim($parts[0], " :-–") }}</td>
                                        <td class="jam">{{ trim($parts[1]) }}</td>
                                    </tr>
                                @else
                                    <tr><td colspan="2">{{ $line }}</td></tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Jadwal Pemeriksaan / Pelayanan --}}
                <div class="jadwal-card">
                    <div class="jadwal-card-header">
                        <i class="bx bx-stethoscope"></i>
                        <span>Jadwal Pemeriksaan Medis</span>
                    </div>
                    @php
                        $medisLines = !empty($layanan->jam_operasional) && $layanan->jam_operasional !== 'Senin - Sabtu: 08.00 - 14.00 WIB'
                            ? array_filter(array_map('trim', explode("\n", str_replace("\r", "", $layanan->jam_operasional))))
                            : [
                                'Senin - Kamis : 08.00 - 14.00 WIB',
                                'Jumat : 08.00 - 14.00 WIB',
                                'Sabtu : 08.00 - 13.30 WIB'
                            ];
                    @endphp
                    <table class="jadwal-table">
                        <tbody>
                            @foreach($medisLines as $line)
                                @php
                                    $parts = preg_split('/[:–-]\s*(?=[0-9])/', $line, 2);
                                @endphp
                                @if(count($parts) == 2)
                                    <tr>
                                        <td class="hari">{{ trim($parts[0], " :-–") }}</td>
                                        <td class="jam">{{ trim($parts[1]) }}</td>
                                    </tr>
                                @else
                                    <tr><td colspan="2">{{ $line }}</td></tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- 4. PERSYARATAN BEROBAT --}}
            <div class="persyaratan-box">
                <div class="persyaratan-box-header">
                    <i class="bx bx-info-circle"></i>
                    <span>Persyaratan Berobat Umum / BPJS</span>
                </div>
                <p class="persyaratan-box-text">
                    {{ $layanan->persyaratan ?? 'Membawa KTP / Kartu Keluarga (KK), Kartu Indonesia Sehat (KIS/BPJS) aktif bagi peserta jaminan kesehatan, serta Kartu Rekam Medis Puskesmas bagi pasien ulangan.' }}
                </p>
            </div>



            {{-- 7. CTA / PENDAFTARAN & KONSULTASI --}}
            <div class="cta-help-card">
                <div class="cta-help-text">
                    <h4>Perlu Bantuan atau Informasi Pendaftaran?</h4>
                    <p>Petugas kami siap membantu memberikan informasi seputar alur rujukan, antrean, dan pendaftaran poli.</p>
                </div>
                <div class="cta-help-actions">
                    @php
                        $pesanWaLayanan = "Halo Admin Puskesmas, saya ingin bertanya dan berkonsultasi mengenai layanan " . ($layanan->title ?? $layanan->nama ?? 'kesehatan') . ". Apakah kuota antrean untuk hari ini/besok masih tersedia? Terima kasih.";
                        $waLayananLink = isset($appSetting) ? $appSetting->getWaUrl($pesanWaLayanan) : '#';
                    @endphp
                    <a href="{{ $waLayananLink }}" target="_blank" rel="noopener" class="btn-cta-wa">
                        <i class="bx bxl-whatsapp fs-5"></i>
                        <span>Pendaftaran / Chat WA</span>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
