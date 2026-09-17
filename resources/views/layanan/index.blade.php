@extends('layouts.app')

@section('title', 'Semua Layanan - ' . ($appSetting->app_name ?? config('app.name', 'Puskesmas')))
@section('meta_description', 'Daftar lengkap layanan kesehatan dan poliklinik yang tersedia di ' . ($appSetting->app_name ?? 'Puskesmas') . '.')

@section('content')

{{-- Subpage Header with Botanical Watermark --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Semua Layanan</span>
        </div>
        <h1 class="subpage-header__title" data-aos="fade-right">Semua Layanan Puskesmas</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Daftar lengkap layanan kesehatan, fasilitas medis, dan poliklinik yang siap melayani kebutuhan Anda di {{ $appSetting->app_name ?? 'Puskesmas' }}.
        </p>
    </div>
</section>

{{-- Layanan Index Content --}}
<section class="layanan-section" style="background: #FFFFFF;">
    <div class="layanan-container">
        @if(isset($layanans) && $layanans->isNotEmpty())
            <div class="layanan-grid">
                @foreach($layanans as $index => $layanan)
                    <a href="{{ route('layanan.detail', $layanan->slug) }}" class="layanan-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 60 }}">
                        <div class="layanan-card__icon">
                            {!! $layanan->icon_html !!}
                        </div>
                        <div class="layanan-card__body">
                            <h3 class="layanan-card__title">{{ $layanan->title }}</h3>
                            <p class="layanan-card__desc">
                                {{ \Illuminate\Support\Str::limit(strip_tags($layanan->description), 85) }}
                            </p>
                            <span class="layanan-card__link">
                                <span>Lihat detail</span>
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>

            @if($layanans->hasPages())
                <div style="display: flex; justify-content: center; margin-top: 40px;">
                    {{ $layanans->links('vendor.pagination.custom') }}
                </div>
            @endif
        @else
            <div style="text-align: center; padding: 60px 24px; background: #F8FAF9; border-radius: 14px; border: 1px solid var(--color-border); max-width: 600px; margin: 40px auto;">
                <i class="bx bx-info-circle" style="font-size: 48px; color: #94a3b8; display: block; margin-bottom: 12px;"></i>
                <h3 style="font-size: 20px; font-weight: 700; color: #122822; margin-bottom: 8px;">Belum Ada Layanan</h3>
                <p style="color: #526B63; font-size: 14px;">Data layanan belum tersedia saat ini.</p>
            </div>
        @endif
    </div>
</section>

@endsection
