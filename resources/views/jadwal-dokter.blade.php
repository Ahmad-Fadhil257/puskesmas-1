@extends('layouts.app')

@section('title', 'Jadwal Praktik Dokter - Puskesmas')
@section('meta_description', 'Lihat jadwal lengkap dokter spesialis dan dokter umum di Puskesmas. Rencanakan kunjungan pemeriksaan kesehatan Anda dengan mudah.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/jadwal-dokter.css') }}">
@endpush

@section('content')

{{-- Full Width Dark Emerald Header (Serasi & Konsisten dengan Halaman Berita) --}}
<section class="jadwal-full-header">
    <div class="jadwal-full-header__decor-pattern" aria-hidden="true"></div>
    <div class="jadwal-full-header__glow" aria-hidden="true"></div>

    <div class="jadwal-full-header__container">
        <div class="jadwal-header-badge" data-aos="fade-right">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span>JADWAL DOKTER</span>
        </div>
        <h1 class="jadwal-full-header__title" data-aos="fade-right">Jadwal Praktik Dokter Spesialis & Umum</h1>
        <p class="jadwal-full-header__subtitle" data-aos="fade-up">
            Temukan jadwal lengkap praktik dokter spesialis dan umum kami untuk perencanaan kunjungan kesehatan Anda dan keluarga.
        </p>
    </div>
</section>

{{-- Main Content Section (Pure White Background) --}}
<div class="jadwal-content-wrapper">
    <div class="jadwal-container">
        <div class="jadwal-grid">
            @forelse($dokters as $dokter)
            <div class="jadwal-card" data-aos="fade-up">
                <div class="jadwal-card-photo">
                    @if($dokter->photo)
                        <img src="{{ asset($dokter->photo) }}" alt="{{ $dokter->name }}" loading="lazy">
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100" style="background: #E2F0EC; font-size: 2rem; font-weight: 700; color: #0A5C45;">
                            {{ strtoupper(substr($dokter->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="jadwal-card-info">
                    <h3 class="jadwal-card-name">{{ $dokter->name }}</h3>
                    <p class="jadwal-card-specialty">{{ $dokter->specialty }}</p>
                    <div class="jadwal-card-schedule">
                        <h4 class="jadwal-schedule-label">Jadwal Praktik</h4>
                        <div class="jadwal-schedule-grid">
                            @php $jadwal = $dokter->jadwal_praktek ?? []; @endphp
                            @forelse($jadwal as $j)
                                <div class="jadwal-day">
                                    <span class="jadwal-day-name">{{ $j['hari'] ?? '' }}</span>
                                    <span class="jadwal-day-time">{{ $j['jam'] ?? '' }}</span>
                                </div>
                            @empty
                                <div class="jadwal-day">
                                    <span class="jadwal-day-name text-muted fst-italic">Belum ada jadwal</span>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bx bx-user-x display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                <p class="text-muted">Belum ada data dokter yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
