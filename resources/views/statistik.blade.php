@extends('layouts.app')

@section('title', 'Statistik Kesehatan - ' . config('app.name'))

@section('meta_description', 'Data statistik kesehatan masyarakat: 10 penyakit terbanyak dan jumlah kunjungan pasien ke Puskesmas.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/pages/statistik.css') }}?v={{ filemtime(public_path('css/pages/statistik.css')) }}">
@endpush

@section('content')
<div class="statistik-page">

    {{-- ── Subpage Header (konsisten dengan halaman lain) ─────────────────── --}}
    <section class="subpage-header">
        <img src="{{ asset('assets/botanical-clean.png') }}" alt="" class="subpage-header__watermark" aria-hidden="true">
        <div class="subpage-header__container">
            <div class="subpage-header__breadcrumb" data-aos="fade-right">
                <a href="{{ route('home') }}">Beranda</a>
                <span class="subpage-header__breadcrumb-sep">•</span>
                <span>Informasi Publik</span>
                <span class="subpage-header__breadcrumb-sep">•</span>
                <span class="subpage-header__breadcrumb-current">Statistik Kesehatan</span>
            </div>
            <h1 class="subpage-header__title" data-aos="fade-right">Statistik Kesehatan Masyarakat</h1>
            <p class="subpage-header__subtitle" data-aos="fade-up">
                Transparansi data layanan kesehatan: 10 penyakit terbanyak yang ditangani dan tren kunjungan pasien ke Puskesmas kami.
            </p>
        </div>
    </section>

    {{-- Year Filter --}}
    @if($tahunList->isNotEmpty())
    <div class="statistik-year-filter" data-aos="fade-up">
        @foreach($tahunList as $t)
            <a href="{{ route('statistik') }}?tahun={{ $t }}"
               class="year-btn {{ $tahunFilter == $t ? 'active' : '' }}">{{ $t }}</a>
        @endforeach
    </div>
    @endif

    {{-- ── Main Content ─────────────────────────────────────────────────────── --}}
    <div class="statistik-content">

        {{-- KPI Summary Cards --}}
        <div class="statistik-kpi-grid">
            <div class="kpi-card" style="--kpi-color:#0A5C45; --kpi-bg:#E6F4ED;" data-aos="fade-up" data-aos-delay="0">
                <div class="kpi-card__icon">
                    <i class='bx bx-user-check'></i>
                </div>
                <div class="kpi-card__number">{{ number_format($totalKunjungan) }}</div>
                <div class="kpi-card__label">Total Kunjungan {{ $tahunFilter }}</div>
            </div>
            <div class="kpi-card" style="--kpi-color:#0A5C45; --kpi-bg:#E6F4ED;" data-aos="fade-up" data-aos-delay="100">
                <div class="kpi-card__icon">
                    <i class='bx bx-user-plus'></i>
                </div>
                <div class="kpi-card__number">{{ number_format($totalBaru) }}</div>
                <div class="kpi-card__label">Pasien Baru</div>
            </div>
            <div class="kpi-card" style="--kpi-color:#0A5C45; --kpi-bg:#E6F4ED;" data-aos="fade-up" data-aos-delay="200">
                <div class="kpi-card__icon">
                    <i class='bx bx-user'></i>
                </div>
                <div class="kpi-card__number">{{ number_format($totalLama) }}</div>
                <div class="kpi-card__label">Pasien Lama</div>
            </div>
        </div>

        {{-- ── Section 1: 10 Penyakit Terbanyak ─────────────────────────────── --}}
        <section class="statistik-section" data-aos="fade-up">
            <div class="statistik-section__header">
                <div class="statistik-section__icon">
                    <i class='bx bx-list-ol'></i>
                </div>
                <div>
                    <h2 class="statistik-section__title">10 Penyakit Terbanyak</h2>
                    <p class="statistik-section__subtitle">
                        Data kasus yang ditangani sepanjang tahun {{ $tahunFilter }}
                    </p>
                </div>
            </div>

            @if($penyakit->isNotEmpty())
            <div class="disease-chart-wrap">
                <div class="disease-bar-list" id="diseaseBarList">
                    @php $maxKasusLocal = $penyakit->max('jumlah_kasus') ?: 1; @endphp
                    @foreach($penyakit as $index => $item)
                    <div class="disease-bar-item">
                        {{-- Rank Badge --}}
                        <div class="disease-bar-item__rank">{{ $index + 1 }}</div>

                        {{-- Name + Bar --}}
                        <div class="disease-bar-item__info">
                            <div class="disease-bar-item__name">
                                {{ $item->nama_penyakit }}
                                @if($item->kode_icd)
                                    <span class="disease-bar-item__icd">({{ $item->kode_icd }})</span>
                                @endif
                            </div>
                            <div class="disease-bar-track">
                                <div class="disease-bar-fill"
                                     style="--bar-color: #0A5C45"
                                     data-width="{{ round(($item->jumlah_kasus / $maxKasusLocal) * 100) }}">
                                </div>
                            </div>
                        </div>

                        {{-- Count --}}
                        <div class="disease-bar-item__count">
                            <div>{{ number_format($item->jumlah_kasus) }}</div>
                            <div class="disease-bar-item__sub">kasus</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="disease-chart-wrap">
                <div class="statistik-empty">
                    <span class="statistik-empty__icon">📊</span>
                    <h3 class="statistik-empty__title">Data belum tersedia</h3>
                    <p class="text-muted small">Data penyakit untuk tahun {{ $tahunFilter }} belum diinput.</p>
                </div>
            </div>
            @endif
        </section>

        {{-- ── Section 2: Kunjungan Pasien ──────────────────────────────────── --}}
        <section class="statistik-section" data-aos="fade-up">
            <div class="statistik-section__header">
                <div class="statistik-section__icon">
                    <i class='bx bx-line-chart'></i>
                </div>
                <div>
                    <h2 class="statistik-section__title">Kunjungan Pasien</h2>
                    <p class="statistik-section__subtitle">
                        Tren kunjungan bulanan sepanjang tahun {{ $tahunFilter }}
                    </p>
                </div>
            </div>

            @if($kunjungan->isNotEmpty())

            {{-- Chart.js Canvas --}}
            <div class="kunjungan-chart-wrap">
                <div class="kunjungan-canvas-container">
                    <canvas id="kunjunganChart"></canvas>
                </div>
                <div class="kunjungan-legend">
                    <div class="kunjungan-legend__item">
                        <div class="kunjungan-legend__dot" style="background:#0A5C45;"></div>
                        Total Kunjungan
                    </div>
                    <div class="kunjungan-legend__item">
                        <div class="kunjungan-legend__dot" style="background:#1A7A5E;"></div>
                        Pasien Baru
                    </div>
                    <div class="kunjungan-legend__item">
                        <div class="kunjungan-legend__dot" style="background:#2D9B77;"></div>
                        Pasien Lama
                    </div>
                </div>
            </div>

            {{-- Monthly Table --}}
            <div class="kunjungan-table-wrap">
                <table class="kunjungan-table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th class="text-center">Total Kunjungan</th>
                            <th class="text-center">Pasien Baru</th>
                            <th class="text-center">Pasien Lama</th>
                            <th class="text-center">% Baru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kunjungan as $k)
                        @php
                            $pctBaru = $k->jumlah_kunjungan > 0
                                ? round(($k->kunjungan_baru / $k->jumlah_kunjungan) * 100)
                                : 0;
                        @endphp
                        <tr>
                            <td class="month-badge">{{ $k->bulan_label }}</td>
                            <td class="text-center total-cell">{{ number_format($k->jumlah_kunjungan) }}</td>
                            <td class="text-center" style="color:#0A5C45; font-weight:600;">{{ number_format($k->kunjungan_baru) }}</td>
                            <td class="text-center" style="color:#0A5C45; font-weight:600;">{{ number_format($k->kunjungan_lama) }}</td>
                            <td class="text-center">
                                <span style="font-size:0.8rem; color:#64748B; font-weight:600;">{{ $pctBaru }}%</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>TOTAL {{ $tahunFilter }}</td>
                            <td class="text-center">{{ number_format($totalKunjungan) }}</td>
                            <td class="text-center">{{ number_format($totalBaru) }}</td>
                            <td class="text-center">{{ number_format($totalLama) }}</td>
                            <td class="text-center">
                                {{ $totalKunjungan > 0 ? round(($totalBaru / $totalKunjungan) * 100) : 0 }}%
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @else
            <div class="kunjungan-chart-wrap">
                <div class="statistik-empty">
                    <span class="statistik-empty__icon">📈</span>
                    <h3 class="statistik-empty__title">Data belum tersedia</h3>
                    <p class="text-muted small">Data kunjungan untuk tahun {{ $tahunFilter }} belum diinput.</p>
                </div>
            </div>
            @endif
        </section>

    </div>{{-- /.statistik-content --}}
</div>{{-- /.statistik-page --}}
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── 1. Animate Bar Fills on Scroll ────────────────────────────────────────
    const bars = document.querySelectorAll('.disease-bar-fill');
    const animateBars = () => {
        bars.forEach(bar => {
            const rect = bar.closest('.disease-bar-item').getBoundingClientRect();
            if (rect.top < window.innerHeight - 40) {
                bar.style.width = bar.dataset.width + '%';
            }
        });
    };
    window.addEventListener('scroll', animateBars, { passive: true });
    setTimeout(animateBars, 400); // trigger on load too

    // ── 2. Kunjungan Chart.js ─────────────────────────────────────────────────
    const canvas = document.getElementById('kunjunganChart');
    if (!canvas) return;

    const labels  = @json($kunjungan->pluck('bulan_label'));
    const total   = @json($kunjungan->pluck('jumlah_kunjungan'));
    const baru    = @json($kunjungan->pluck('kunjungan_baru'));
    const lama    = @json($kunjungan->pluck('kunjungan_lama'));

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels,
            datasets: [
                {
                    label: 'Total Kunjungan',
                    data: total,
                    backgroundColor: '#0A5C45',
                    borderRadius: 6,
                    borderSkipped: false,
                    order: 2,
                },
                {
                    label: 'Pasien Baru',
                    data: baru,
                    type: 'line',
                    borderColor: '#1A7A5E',
                    backgroundColor: 'rgba(26,122,94,0.1)',
                    pointBackgroundColor: '#1A7A5E',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: false,
                    order: 1,
                },
                {
                    label: 'Pasien Lama',
                    data: lama,
                    type: 'line',
                    borderColor: '#2D9B77',
                    backgroundColor: 'rgba(45,155,119,0.08)',
                    pointBackgroundColor: '#2D9B77',
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: false,
                    order: 1,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleColor: '#fff',
                    bodyColor: '#CBD5E1',
                    cornerRadius: 8,
                    padding: 12,
                    callbacks: {
                        label: ctx => ` ${ctx.dataset.label}: ${ctx.parsed.y.toLocaleString('id-ID')} orang`,
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: '600' }, color: '#64748B' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0,0,0,0.04)', lineWidth: 1 },
                    ticks: {
                        font: { size: 11 },
                        color: '#94A3B8',
                        callback: v => v.toLocaleString('id-ID')
                    }
                }
            }
        }
    });
});
</script>
@endpush
