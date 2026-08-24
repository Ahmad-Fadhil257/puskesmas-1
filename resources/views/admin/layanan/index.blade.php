@extends('layouts.admin')

@section('title', 'Kelola Layanan - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-briefcase-alt-2 me-2"></i>Kelola Layanan Kami
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Layanan</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus"></i>
                <span>Tambah Layanan</span>
            </a>
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
            <form action="{{ route('admin.layanan.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-9 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama layanan atau deskripsi..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search me-1"></i> Cari
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary" title="Reset">
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
            <h5 class="mb-0 fw-bold">Daftar Layanan Medis ({{ $totalLayanan }} Total)</h5>
            <small class="text-muted">Menampilkan {{ $layanans->firstItem() ?? 0 }} - {{ $layanans->lastItem() ?? 0 }} dari {{ $layanans->total() }} layanan</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th style="width: 80px;" class="text-center">Ikon</th>
                        <th>Nama Layanan</th>
                        <th style="width: 160px;">Tipe Tampilan</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($layanans as $index => $item)
                    <tr>
                        <td class="text-center fw-semibold text-muted">{{ $layanans->firstItem() + $index }}</td>
                        <td class="text-center">
                            <div class="avatar avatar-sm mx-auto">
                                <span class="avatar-initial rounded {{ $item->variant === 'emergency' ? 'bg-label-danger' : ($item->variant === 'featured' ? 'bg-label-success' : 'bg-label-primary') }} fs-5">
                                    {!! $item->icon_html !!}
                                </span>
                            </div>
                        </td>
                        <td>
                            <strong class="text-dark d-block fs-6">{{ $item->title }}</strong>
                            <small class="text-muted text-truncate d-inline-block" style="max-width: 380px;">{{ $item->description }}</small>
                        </td>
                        <td>
                            @if($item->variant === 'featured')
                                <span class="badge bg-label-success rounded-pill px-2 py-1">
                                    <i class="bx bx-star me-1"></i> Unggulan (Hijau)
                                </span>
                            @elseif($item->variant === 'emergency')
                                <span class="badge bg-label-danger rounded-pill px-2 py-1">
                                    <i class="bx bx-alarm-exclamation me-1"></i> Darurat (Merah)
                                </span>
                            @else
                                <span class="badge bg-label-secondary rounded-pill px-2 py-1">
                                    Standar
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                {{-- Edit Button --}}
                                <a href="{{ route('admin.layanan.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-warning" title="Edit Layanan">
                                    <i class="bx bx-edit-alt"></i>
                                </a>

                                {{-- Delete Button (SweetAlert2) --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-layanan" 
                                        data-id="{{ $item->id }}" 
                                        data-name="{{ $item->title }}"
                                        title="Hapus Layanan">
                                    <i class="bx bx-trash"></i>
                                </button>

                                <form id="delete-form-{{ $item->id }}" action="{{ route('admin.layanan.destroy', $item->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bx bx-briefcase display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                            <span>Belum ada data layanan. <a href="{{ route('admin.layanan.create') }}">Tambah sekarang</a>.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($layanans->hasPages())
        <div class="card-footer border-top d-flex justify-content-end py-3">
            {{ $layanans->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-layanan').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Hapus Layanan?',
                    html: `Apakah Anda yakin ingin menghapus layanan <strong>"${name}"</strong>? Tindakan ini tidak dapat dibatalkan.`,
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
