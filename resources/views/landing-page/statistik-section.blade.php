{{-- ══ Statistik Kesehatan — Landing Page Section ══════════════════════════ --}}
<section class="statistik-landing" id="statistik">
    <div class="statistik-landing__inner">

        {{-- Section Header --}}
        <div class="statistik-landing__header" data-aos="fade-up">
            <div class="statistik-landing__badge">
                <i class='bx bx-bar-chart-alt-2'></i>
                Data Kesehatan Transparan
            </div>
            <h2 class="statistik-landing__title">
                Statistik Kesehatan Masyarakat
            </h2>
            <p class="statistik-landing__desc">
                Kami menyajikan data kesehatan secara terbuka sebagai bentuk transparansi pelayanan kepada masyarakat.
            </p>
        </div>

        @php
            $tahunTerkini = \App\Models\StatistikPenyakit::availableTahun()->first() ?? date('Y');
            $penyakitLanding = \App\Models\StatistikPenyakit::active()
                ->byTahun($tahunTerkini)
                ->byBulan(null)
                ->orderBy('urutan','asc')
                ->limit(10)
                ->get();
            $kunjunganLanding = \App\Models\StatistikKunjungan::byTahun($tahunTerkini)
                ->orderBy('bulan','asc')
                ->get();
            $totalKunjunganLanding = $kunjunganLanding->sum('jumlah_kunjungan');
            $maxKasusLanding = $penyakitLanding->max('jumlah_kasus') ?: 1;
        @endphp

        {{-- KPI Row --}}
        <div class="statistik-landing__kpi" data-aos="fade-up" data-aos-delay="50">
            <div class="sl-kpi">
                <div class="sl-kpi__num" data-count="{{ $totalKunjunganLanding }}">0</div>
                <div class="sl-kpi__label">Total Kunjungan {{ $tahunTerkini }}</div>
            </div>
            <div class="sl-kpi">
                <div class="sl-kpi__num" data-count="{{ $kunjunganLanding->sum('kunjungan_baru') }}">0</div>
                <div class="sl-kpi__label">Pasien Baru</div>
            </div>
            <div class="sl-kpi">
                <div class="sl-kpi__num" data-count="{{ $penyakitLanding->count() }}">0</div>
                <div class="sl-kpi__label">Jenis Penyakit</div>
            </div>
            <div class="sl-kpi">
                <div class="sl-kpi__num" data-count="{{ $penyakitLanding->sum('jumlah_kasus') }}">0</div>
                <div class="sl-kpi__label">Total Kasus Tercatat</div>
            </div>
        </div>

        {{-- Two column: Bar chart + mini chart --}}
        @if($penyakitLanding->isNotEmpty())
        <div class="statistik-landing__grid" data-aos="fade-up" data-aos-delay="100">

            {{-- Left: Disease Bar List --}}
            <div class="sl-disease-wrap">
                <div class="sl-section-title">
                    <i class='bx bx-list-ol'></i>
                    10 Penyakit Terbanyak — {{ $tahunTerkini }}
                </div>
                <div class="sl-disease-list" id="slDiseaseList">
                    @foreach($penyakitLanding as $i => $item)
                    <div class="sl-disease-item">
                        <span class="sl-disease-rank">{{ $i + 1 }}</span>
                        <div class="sl-disease-body">
                            <div class="sl-disease-name">
                                {{ $item->nama_penyakit }}
                                @if($item->kode_icd)
                                    <span class="sl-disease-icd">({{ $item->kode_icd }})</span>
                                @endif
                            </div>
                            <div class="sl-disease-track">
                                <div class="sl-disease-fill"
                                     style="background: #0A5C45"
                                     data-width="{{ round(($item->jumlah_kasus / $maxKasusLanding) * 100) }}">
                                </div>
                            </div>
                        </div>
                        <div class="sl-disease-count">
                            <strong>{{ number_format($item->jumlah_kasus) }}</strong>
                            <span>kasus</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: Kunjungan mini chart --}}
            @if($kunjunganLanding->isNotEmpty())
            <div class="sl-kunjungan-wrap">
                <div class="sl-section-title">
                    <i class='bx bx-line-chart'></i>
                    Kunjungan Pasien Bulanan — {{ $tahunTerkini }}
                </div>
                <div class="sl-chart-container">
                    <canvas id="slKunjunganChart"></canvas>
                </div>
                <div class="sl-kunjungan-total">
                    <span>Total Kunjungan</span>
                    <strong>{{ number_format($totalKunjunganLanding) }} orang</strong>
                </div>
            </div>
            @endif

        </div>
        @endif

        {{-- CTA --}}
        <div class="statistik-landing__cta" data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('statistik') }}" class="sl-cta-btn">
                <i class='bx bx-bar-chart-alt-2'></i>
                Lihat Data Lengkap
                <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>

    </div>
</section>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // ── Animated Counter ──────────────────────────────────────────────────────
    const kpiNums = document.querySelectorAll('.sl-kpi__num[data-count]');
    const animateCounter = (el) => {
        const target = parseInt(el.dataset.count, 10);
        if (!target) { el.textContent = '0'; return; }
        const duration = 1400;
        const start = performance.now();
        const tick = (now) => {
            const pct = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - pct, 3);
            el.textContent = Math.round(eased * target).toLocaleString('id-ID');
            if (pct < 1) requestAnimationFrame(tick);
        };
        requestAnimationFrame(tick);
    };
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                animateCounter(e.target);
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.4 });
    kpiNums.forEach(el => observer.observe(el));

    // ── Animate Disease Bars ──────────────────────────────────────────────────
    const fills = document.querySelectorAll('.sl-disease-fill');
    const barObserver = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.width = e.target.dataset.width + '%';
                barObserver.unobserve(e.target);
            }
        });
    }, { threshold: 0.2 });
    fills.forEach(el => barObserver.observe(el));

    // ── Mini Kunjungan Chart ──────────────────────────────────────────────────
    const canvas = document.getElementById('slKunjunganChart');
    if (!canvas) return;

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: @json($kunjunganLanding->pluck('bulan_label')->map(fn($b) => substr($b, 0, 3))),
            datasets: [{
                label: 'Kunjungan',
                data: @json($kunjunganLanding->pluck('jumlah_kunjungan')),
                backgroundColor: '#0A5C45',
                borderRadius: 5,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    cornerRadius: 8,
                    callbacks: {
                        label: ctx => ` ${ctx.parsed.y.toLocaleString('id-ID')} orang`
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 10, weight: '600' }, color: '#94A3B8' } },
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.04)' }, ticks: { font: { size: 10 }, color: '#94A3B8', callback: v => v >= 1000 ? (v/1000).toFixed(1)+'K' : v } }
            }
        }
    });
});
</script>
@endpush
