@extends('layouts.app')

@section('title', 'Jadwal Dokter')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/jadwal-dokter.css') }}">
@endpush

@section('content')
<section class="jadwal-section">
    <div class="jadwal-container">
        <div class="jadwal-header">
            <div class="jadwal-label">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.77C4.484 10.426 5.980 10 8 10c.145 0 .288.004.43.01a4.5 4.5 0 0 1 .288-.97C8.51 9.015 8.27 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                </svg>
                JADWAL DOKTER
            </div>
            <h2 class="jadwal-title">Jadwal Praktik Dokter Kami</h2>
            <p class="jadwal-subtitle">Temukan jadwal praktik dokter spesialis kami untuk perencanaan kunjungan Anda.</p>
        </div>
        <div class="jadwal-grid">
            @forelse($dokters as $dokter)
            <div class="jadwal-card">
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
                        <h4 class="jadwal-schedule-label">Jadwal Praktek</h4>
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
                <p class="text-muted">Belum ada data dokter.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
