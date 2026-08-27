@extends('layouts.app')

@section('title', 'Layanan & Poliklinik - Puskesmas')
@section('meta_description', 'Solusi layanan kesehatan komprehensif mulai dari pemeriksaan rutin, dokter spesialis, farmasi, hingga penanganan gawat darurat di Puskesmas.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/layanan-page.css') }}?v={{ file_exists(public_path('css/pages/layanan-page.css')) ? filemtime(public_path('css/pages/layanan-page.css')) : time() }}">
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Layanan & Poliklinik</span>
        </div>
        <h1 class="subpage-header__title">Solusi Layanan Kesehatan Komprehensif</h1>
        <p class="subpage-header__subtitle">
            Di Puskesmas kami, kami menawarkan beragam layanan medis yang disesuaikan dengan kebutuhan Anda, mulai dari pemeriksaan rutin hingga perawatan khusus.
        </p>
    </div>
</section>

{{-- =========================================================================
   GRID SECTION: KARTU LAYANAN (DIRECT LINK TANPA DOM MODAL)
   ========================================================================= --}}
<section class="layanan-grid-section">
    <div class="layanan-grid-container">

        <div class="layanan-cards-grid">
            @forelse($layanans as $item)
                @if($item->variant === 'emergency')
                    {{-- KARTU MERAH: PANGGILAN DARURAT / UGD --}}
                    <div class="layanan-box-card card--emergency">
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                        <a href="{{ $item->btn_link ? $item->btn_link : $appSetting->wa_link }}" 
                           target="_blank" rel="noopener" 
                           class="btn-emergency-pill">
                            <span>{{ $item->btn_text ? $item->btn_text : 'Hubungi kami' }}</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                @elseif($item->variant === 'featured')
                    {{-- KARTU HIJAU GELAP: DOKTER SPESIALIS / UNGGULAN --}}
                    <a href="{{ route('layanan.detail', $item->slug) }}" class="layanan-box-card card--featured">
                        <div class="box-card-icon icon--featured">
                            @if($item->custom_icon)
                                <img src="{{ asset($item->custom_icon) }}" alt="{{ $item->title }}">
                            @else
                                <i class="{{ $item->icon ?? 'bx bx-plus-medical' }}"></i>
                            @endif
                        </div>
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                        <div class="box-card-action">
                            <span>Lihat Detail Layanan</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </div>
                    </a>
                @else
                    {{-- KARTU STANDAR: LIGHT GRAY DENGAN IKON SOFT GREEN --}}
                    <a href="{{ route('layanan.detail', $item->slug) }}" class="layanan-box-card card--default">
                        <div class="box-card-icon icon--default">
                            @if($item->custom_icon)
                                <img src="{{ asset($item->custom_icon) }}" alt="{{ $item->title }}">
                            @else
                                <i class="{{ $item->icon ?? 'bx bx-plus-medical' }}"></i>
                            @endif
                        </div>
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                        <div class="box-card-action">
                            <span>Lihat Detail Layanan</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </div>
                    </a>
                @endif
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada layanan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>
@endsection
