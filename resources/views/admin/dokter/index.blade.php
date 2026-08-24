@extends('layouts.admin')

@section('title', 'Kelola Dokter - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-user-plus me-2"></i>Kelola Dokter
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Dokter</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus"></i>
                <span>Tambah Dokter</span>
            </a>
        </div>
    </div>

    {{-- Stat Cards Sneat --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-group"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalDokter }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Total Dokter</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check-circle"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalAktif }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Dokter Aktif</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-hide"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalNonAktif }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Dokter Nonaktif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Filter & Search Card Sneat --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.dokter.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-9 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama atau spesialisasi dokter..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search me-1"></i> Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary" title="Reset">
                                <i class="bx bx-reset"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table Card Sneat --}}
    <div class="card">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Dokter ({{ $totalDokter }} Total)</h5>
            <small class="text-muted">Menampilkan {{ $dokters->firstItem() ?? 0 }} - {{ $dokters->lastItem() ?? 0 }} dari {{ $dokters->total() }} dokter</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="width: 80px;" class="text-center">Foto</th>
                        <th>Nama Dokter</th>
                        <th>Spesialisasi</th>
                        <th class="text-center" style="width: 140px;">Status</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($dokters as $index => $dokter)
                    <tr>
                        <td class="text-center fw-semibold text-muted">{{ $dokters->firstItem() + $index }}</td>
                        <td class="text-center">
                            @if($dokter->photo)
                                <img src="{{ asset($dokter->photo) }}" alt="{{ $dokter->name }}" class="rounded" style="width: 46px; height: 46px; object-fit: cover; object-position: top; border: 1px solid #E2F0EC;">
                            @else
                                <div class="avatar avatar-sm mx-auto">
                                    <span class="avatar-initial rounded bg-label-primary fw-bold">
                                        {{ strtoupper(substr($dokter->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </td>
                        <td>
                            <strong class="text-dark d-block fs-6">{{ $dokter->name }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ $dokter->specialty }}</span>
                        </td>
                        <td class="text-center">
                            @if($dokter->is_active)
                                <span class="badge bg-label-success rounded-pill px-3 py-1">
                                    <i class="bx bx-check-circle me-1"></i> Aktif
                                </span>
                            @else
                                <span class="badge bg-label-danger rounded-pill px-3 py-1">
                                    <i class="bx bx-x-circle me-1"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                {{-- Toggle Status Button --}}
                                <form action="{{ route('admin.dokter.toggle-status', $dokter->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-icon {{ $dokter->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}" 
                                            title="{{ $dokter->is_active ? 'Nonaktifkan Dokter' : 'Aktifkan Dokter' }}">
                                        <i class="bx {{ $dokter->is_active ? 'bx-block' : 'bx-check' }}"></i>
                                    </button>
                                </form>

                                {{-- Edit Button --}}
                                <a href="{{ route('admin.dokter.edit', $dokter->id) }}" class="btn btn-sm btn-icon btn-outline-warning" title="Edit Dokter">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                {{-- Delete Button (SweetAlert2) --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-dokter" 
                                        data-id="{{ $dokter->id }}" 
                                        data-name="{{ $dokter->name }}"
                                        title="Hapus Dokter">
                                    <i class="bx bx-trash"></i>
                                </button>

                                <form id="delete-form-{{ $dokter->id }}" action="{{ route('admin.dokter.destroy', $dokter->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bx bx-user-x display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                            <span>Belum ada data dokter. <a href="{{ route('admin.dokter.create') }}">Tambah sekarang</a>.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($dokters->hasPages())
        <div class="card-footer border-top d-flex justify-content-end py-3">
            {{ $dokters->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-dokter').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Hapus Dokter?',
                    html: `Apakah Anda yakin ingin menghapus data dokter <strong>"${name}"</strong>? Foto dan data terkait akan dihapus secara permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${id}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
