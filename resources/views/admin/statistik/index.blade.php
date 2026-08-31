@extends('layouts.admin')

@section('title', 'Kelola Statistik Kesehatan')

@section('content')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-bar-chart-alt-2 me-2"></i>Kelola Statistik Kesehatan
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Statistik</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('statistik') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-link-external"></i> Lihat Halaman Publik
            </a>
            <a href="{{ route('admin.statistik.penyakit.create') }}" class="btn btn-danger d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus-circle"></i> Tambah Penyakit
            </a>
            <a href="{{ route('admin.statistik.kunjungan.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus-circle"></i> Tambah Kunjungan
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center mb-4" role="alert"
             style="background-color:#E6F4EA;color:#137333;border-left:4px solid #137333!important;border-radius:8px;">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Year Filter --}}
    <div class="mb-4 d-flex gap-2 align-items-center flex-wrap">
        <span class="fw-bold text-muted small text-uppercase">Filter Tahun:</span>
        @foreach($tahunList as $t)
            <a href="{{ route('admin.statistik.index', ['tahun' => $t]) }}"
               class="btn btn-sm {{ $tahunFilter == $t ? 'btn-success' : 'btn-outline-secondary' }}">
                {{ $t }}
            </a>
        @endforeach
    </div>

    {{-- KPI Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <i class="bx bx-user-check fs-2 text-success mb-1"></i>
                    <h4 class="fw-bold mb-0 text-success">{{ number_format($totalKunjungan) }}</h4>
                    <small class="text-muted">Total Kunjungan</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <i class="bx bx-user-plus fs-2 text-primary mb-1"></i>
                    <h4 class="fw-bold mb-0 text-primary">{{ number_format($totalBaru) }}</h4>
                    <small class="text-muted">Pasien Baru</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <i class="bx bx-user fs-2 text-info mb-1"></i>
                    <h4 class="fw-bold mb-0 text-info">{{ number_format($totalLama) }}</h4>
                    <small class="text-muted">Pasien Lama</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center py-3">
                    <i class="bx bx-heart-circle fs-2 text-danger mb-1"></i>
                    <h4 class="fw-bold mb-0 text-danger">{{ number_format($totalKasusPenyakit) }}</h4>
                    <small class="text-muted">Total Kasus Penyakit</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- ── Tabel Penyakit ─────────────────────────────────────────────────── --}}
        <div class="col-12 col-xl-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color:#0A5C45;">
                        <i class="bx bx-list-ol me-2"></i>10 Penyakit Terbanyak — {{ $tahunFilter }}
                    </h6>
                    <a href="{{ route('admin.statistik.penyakit.create') }}" class="btn btn-sm btn-outline-danger">
                        <i class="bx bx-plus"></i> Tambah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width:40px" class="text-center">No</th>
                                <th>Nama Penyakit</th>
                                <th class="text-center" style="width:110px">Kasus</th>
                                <th class="text-center" style="width:80px">Status</th>
                                <th class="text-center" style="width:90px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penyakit as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge bg-label-secondary fw-bold">#{{ $item->urutan }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="rounded-circle d-inline-block"
                                              style="width:12px;height:12px;background:{{ $item->warna_display }};flex-shrink:0;"></span>
                                        <div>
                                            <div class="fw-semibold text-dark" style="max-width:260px;white-space:normal;font-size:.875rem;">
                                                {{ $item->nama_penyakit }}
                                            </div>
                                            @if($item->kode_icd)
                                                <small class="text-muted">ICD: {{ $item->kode_icd }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center fw-bold text-danger">{{ number_format($item->jumlah_kasus) }}</td>
                                <td class="text-center">
                                    @if($item->is_active)
                                        <span class="badge bg-label-success">Aktif</span>
                                    @else
                                        <span class="badge bg-label-secondary">Non-aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.statistik.penyakit.edit', $item->id) }}"
                                           class="btn btn-sm btn-icon btn-outline-warning" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.statistik.penyakit.destroy', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus data penyakit ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bx bx-data d-block fs-1 mb-2"></i>
                                    Belum ada data penyakit untuk tahun {{ $tahunFilter }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- ── Tabel Kunjungan ─────────────────────────────────────────────────── --}}
        <div class="col-12 col-xl-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0" style="color:#0A5C45;">
                        <i class="bx bx-line-chart me-2"></i>Kunjungan Pasien — {{ $tahunFilter }}
                    </h6>
                    <a href="{{ route('admin.statistik.kunjungan.create') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bx bx-plus"></i> Tambah
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Bulan</th>
                                <th class="text-center">Total</th>
                                <th class="text-center">Baru</th>
                                <th class="text-center">Lama</th>
                                <th class="text-center" style="width:70px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kunjungan as $item)
                            <tr>
                                <td class="fw-semibold text-success">{{ $item->bulan_label }}</td>
                                <td class="text-center fw-bold">{{ number_format($item->jumlah_kunjungan) }}</td>
                                <td class="text-center text-primary fw-semibold">{{ number_format($item->kunjungan_baru) }}</td>
                                <td class="text-center" style="color:#8B5CF6; font-weight:600;">{{ number_format($item->kunjungan_lama) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('admin.statistik.kunjungan.edit', $item->id) }}"
                                           class="btn btn-sm btn-icon btn-outline-warning" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form action="{{ route('admin.statistik.kunjungan.destroy', $item->id) }}" method="POST"
                                              onsubmit="return confirm('Hapus data kunjungan bulan {{ $item->bulan_label }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger" title="Hapus">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bx bx-data d-block fs-1 mb-2"></i>
                                    Belum ada data kunjungan untuk tahun {{ $tahunFilter }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($kunjungan->isNotEmpty())
                        <tfoot class="table-success">
                            <tr>
                                <td class="fw-bold">Total</td>
                                <td class="text-center fw-bold">{{ number_format($totalKunjungan) }}</td>
                                <td class="text-center fw-bold">{{ number_format($totalBaru) }}</td>
                                <td class="text-center fw-bold">{{ number_format($totalLama) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
