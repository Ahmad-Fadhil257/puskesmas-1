@extends('layouts.admin')

@section('title', 'Dashboard Utama - Puskesmas CareLink')

@section('content')

    <!-- Flash Alert Success Login -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center mb-4" role="alert" style="background-color: #E6F4EA; color: #137333; border-left: 4px solid #137333 !important; border-radius: 8px;">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4 mb-4">
        <!-- 1. Banner Sambutan Real-Time (Adaptive Sneat Theme) -->
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="d-flex align-items-center row">
                    <div class="col-md-8 col-12">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center gap-2 mb-2 text-muted fw-semibold small">
                                <i class="bx bx-time-five text-primary fs-5"></i>
                                <span>{{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->translatedFormat('l, d F Y') }} • <span id="dashboardClock">{{ \Carbon\Carbon::now('Asia/Jakarta')->format('H:i:s') }}</span> WIB</span>
                            </div>
                            <h4 class="card-title fw-bold mb-2">
                                Selamat Datang Kembali, {{ Auth::user()->name }}! 👋
                            </h4>
                            <p class="card-text text-muted mb-3" style="max-width: 620px;">
                                Anda terhubung sebagai <strong class="text-primary">{{ Auth::user()->role === 'admin' ? 'Administrator Utama' : 'Staf Puskesmas' }}</strong>. Seluruh modul manajemen informasi, fasilitas medis, dan layanan masyarakat siap dikelola.
                            </p>
                            <div class="d-flex flex-wrap gap-2 pt-1">
                                <a href="{{ route('admin.articles.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-xs">
                                    <i class="bx bx-plus-circle"></i>
                                    <span>Tulis Berita Baru</span>
                                </a>
                                <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                                    <i class="bx bx-images"></i>
                                    <span>Kelola Infografis</span>
                                </a>
                                <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                                    <i class="bx bx-globe"></i>
                                    <span>Lihat Website</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 text-center text-md-end pe-md-4 d-none d-md-block">
                        <div class="card-body pb-0 px-0 pt-2">
                            <img src="{{ asset('admin-assets/img/illustrations/man-with-laptop-light.png') }}" height="150" alt="Petugas Puskesmas" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Stat Cards Real-Time (4 Cards Metrik Kinerja) -->
        <!-- Card 1: Berita & Artikel -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar avatar-md bg-label-primary rounded p-2 d-flex align-items-center justify-content-center">
                            <i class="bx bx-news fs-3 text-primary"></i>
                        </div>
                        <span class="badge bg-label-primary rounded-pill fw-semibold">{{ number_format($totalViews ?? 0) }} Views</span>
                    </div>
                    <span class="text-muted d-block small fw-semibold">Berita & Informasi Publik</span>
                    <h3 class="card-title mb-1 fw-bold">{{ $totalArticles ?? 0 }}</h3>
                    <small class="text-muted">Total artikel terpublikasi</small>
                </div>
            </div>
        </div>

        <!-- Card 2: Layanan & Dokter -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar avatar-md bg-label-success rounded p-2 d-flex align-items-center justify-content-center">
                            <i class="bx bx-plus-medical fs-3 text-success"></i>
                        </div>
                        <span class="badge bg-label-success rounded-pill fw-semibold">{{ $totalDokter ?? 0 }} Dokter</span>
                    </div>
                    <span class="text-muted d-block small fw-semibold">Layanan Medis & Poliklinik</span>
                    <h3 class="card-title mb-1 fw-bold">{{ $totalLayanan ?? 0 }}</h3>
                    <small class="text-muted">Fasilitas & poli aktif</small>
                </div>
            </div>
        </div>

        <!-- Card 3: Infografis & FAQ -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar avatar-md bg-label-info rounded p-2 d-flex align-items-center justify-content-center">
                            <i class="bx bx-images fs-3 text-info"></i>
                        </div>
                        <span class="badge bg-label-info rounded-pill fw-semibold">{{ $totalFaq ?? 0 }} FAQ</span>
                    </div>
                    <span class="text-muted d-block small fw-semibold">Infografis & Edukasi</span>
                    <h3 class="card-title mb-1 fw-bold">{{ $totalInfografis ?? 0 }}</h3>
                    <small class="text-muted">Poster & materi publikasi</small>
                </div>
            </div>
        </div>

        <!-- Card 4: Kepuasan Pasien -->
        <div class="col-sm-6 col-xl-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="avatar avatar-md bg-label-warning rounded p-2 d-flex align-items-center justify-content-center">
                            <i class="bx bx-star fs-3 text-warning"></i>
                        </div>
                        <span class="badge bg-label-warning rounded-pill fw-semibold">{{ $avgRating ?? '5.0' }} / 5.0 ⭐</span>
                    </div>
                    <span class="text-muted d-block small fw-semibold">Survei Kepuasan Pasien</span>
                    <h3 class="card-title mb-1 fw-bold">{{ $totalSurveys ?? 0 }}</h3>
                    <small class="text-muted">Total ulasan masyarakat</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Tabel Berita Terbaru & Survei Kepuasan Terbaru (2 Kolom Layout) -->
    <div class="row g-4 mb-4">
        <!-- Kolom Kiri: Berita Terkini -->
        <div class="col-lg-7 col-12">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                        <i class="bx bx-news text-primary"></i>
                        <span>Berita & Artikel Terbaru</span>
                    </h5>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                        <span>Kelola Semua</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Judul Artikel</th>
                                <th style="width: 110px;" class="text-center">Kategori</th>
                                <th style="width: 100px;" class="text-center">Pembaca</th>
                                <th style="width: 100px;" class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($latestArticles ?? [] as $art)
                                <tr>
                                    <td>
                                        <div style="max-width: 280px; white-space: normal;">
                                            <span class="fw-bold d-block mb-1 text-truncate" title="{{ $art->title }}">{{ $art->title }}</span>
                                            <small class="text-muted" style="font-size: 11px;">
                                                <i class="bx bx-calendar me-1"></i>{{ $art->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-label-primary px-2 py-1">
                                            {{ $art->category->name ?? 'Umum' }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-label-secondary px-2 py-1 fw-bold">
                                            <i class="bx bx-show me-1"></i>{{ $art->views_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-xs btn-outline-primary" title="Edit Berita">
                                            <i class="bx bx-edit-alt"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="bx bx-news fs-2 d-block mb-1 opacity-50"></i>
                                        Belum ada berita yang diterbitkan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Survei & Ulasan Terbaru -->
        <div class="col-lg-5 col-12">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-header border-bottom py-3 d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                        <i class="bx bx-star text-warning"></i>
                        <span>Ulasan Pasien Terkini</span>
                    </h5>
                    <a href="{{ route('admin.surveys.index') }}" class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                        <span>Semua Survei</span>
                        <i class="bx bx-chevron-right"></i>
                    </a>
                </div>
                <div class="card-body py-3">
                    <div class="d-flex flex-column gap-3">
                        @forelse($latestSurveys ?? [] as $srv)
                            <div class="p-3 rounded border" style="background: rgba(0, 0, 0, 0.02);">
                                <div class="d-flex align-items-center justify-content-between mb-1">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-xs flex-shrink-0">
                                            <span class="avatar-initial rounded-circle bg-label-primary fw-bold" style="font-size: 10px;">
                                                {{ strtoupper(substr($srv->name ?? $srv->nama ?? 'M', 0, 1)) }}
                                            </span>
                                        </div>
                                        <strong class="small mb-0">{{ $srv->name ?? $srv->nama ?? 'Masyarakat' }}</strong>
                                        <span class="badge bg-label-info px-2 py-0" style="font-size: 10px;">{{ $srv->poli_name ?? $srv->layanan ?? 'Pelayanan' }}</span>
                                    </div>
                                    <div class="text-warning small fw-bold">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="bx {{ $i <= ($srv->rating ?? 5) ? 'bxs-star' : 'bx-star text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-muted small mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.4;">
                                    "{{ $srv->ulasan ?? $srv->pesan ?? 'Sangat puas dengan pelayanan Puskesmas.' }}"
                                </p>
                                <div class="d-flex align-items-center justify-content-between" style="font-size: 11px;">
                                    <span class="text-muted"><i class="bx bx-time me-1"></i>{{ $srv->created_at->diffForHumans() }}</span>
                                    <span class="badge {{ $srv->is_approved ? 'bg-label-success' : 'bg-label-warning' }}" style="font-size: 10px;">
                                        {{ $srv->is_approved ? 'Disetujui' : 'Menunggu' }}
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bx bx-message-square-detail fs-2 d-block mb-1 opacity-50"></i>
                                Belum ada survei kepuasan pasien.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Shortcut Akses Cepat Fitur Manajemen -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <i class="bx bx-grid-alt text-primary"></i>
                <span>Akses Cepat Pengelolaan Fitur</span>
            </h5>
        </div>
        <div class="card-body py-4">
            <div class="row g-3">
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.articles.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-news fs-1 text-primary mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">Kelola Berita</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.layanan.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-plus-medical fs-1 text-success mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">Kelola Layanan</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.dokter.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-user-plus fs-1 text-info mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">Kelola Dokter</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.infografis.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-images fs-1 text-warning mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">Infografis</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.faq.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-help-circle fs-1 text-danger mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">FAQ Pasien</span>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{ route('admin.surveys.index') }}" class="card text-center p-3 h-100 text-decoration-none border shadow-xs hover-elevation transition">
                        <i class="bx bx-star fs-1 text-warning mb-2"></i>
                        <span class="fw-semibold small text-dark d-block">Survei Kepuasan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clockElement = document.getElementById('dashboardClock');
        if (clockElement) {
            setInterval(function() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            }, 1000);
        }
    });
</script>
@endpush
