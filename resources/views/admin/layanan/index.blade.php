@extends('layouts.admin')

@section('title', 'Kelola Layanan - Puskesmas CareLink')

@section('content')

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


    {{-- Filter & Search Card Sneat --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.layanan.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-9 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama layanan, kategori, atau deskripsi..." value="{{ request('search') }}">
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
            <small class="text-muted">Gunakan tombol panah untuk memindahkan posisi urutan kartu layanan.</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;" class="text-center">Urutan</th>
                        <th style="width: 70px;" class="text-center">Ikon</th>
                        <th>Nama Layanan</th>
                        <th style="width: 220px;">Kategori Layanan</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($layanans as $index => $item)
                    <tr>
                        {{-- Urutan dengan tombol panah naik/turun --}}
                        <td class="text-center">
                            <div class="d-inline-flex align-items-center gap-1">
                                <span class="badge bg-label-primary px-2 py-1 fw-bold fs-7">#{{ $item->order }}</span>
                                <div class="btn-group-vertical btn-group-xs">
                                    {{-- Panah Naik --}}
                                    <form action="{{ route('admin.layanan.reorder', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="direction" value="up">
                                        <button type="submit" class="btn btn-xs btn-outline-secondary py-0 px-1" title="Geser ke Atas" {{ $index === 0 && $layanans->currentPage() === 1 ? 'disabled' : '' }}>
                                            <i class="bx bx-chevron-up" style="font-size: 14px;"></i>
                                        </button>
                                    </form>
                                    {{-- Panah Turun --}}
                                    <form action="{{ route('admin.layanan.reorder', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="direction" value="down">
                                        <button type="submit" class="btn btn-xs btn-outline-secondary py-0 px-1" title="Geser ke Bawah">
                                            <i class="bx bx-chevron-down" style="font-size: 14px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>

                        {{-- Ikon --}}
                        <td class="text-center">
                            <div class="avatar avatar-sm mx-auto">
                                <span class="avatar-initial rounded {{ $item->variant === 'emergency' ? 'bg-label-danger' : ($item->variant === 'featured' ? 'bg-label-success' : 'bg-label-primary') }} fs-5">
                                    {!! $item->icon_html !!}
                                </span>
                            </div>
                        </td>

                        {{-- Nama & Deskripsi --}}
                        <td>
                            <strong class="text-dark d-block fs-6">{{ $item->title }}</strong>
                            <small class="text-muted text-truncate d-inline-block" style="max-width: 420px;">{{ $item->description }}</small>
                        </td>

                        {{-- Kategori Layanan --}}
                        <td>
                            @if($item->variant === 'featured')
                                <span class="badge bg-label-success rounded-pill px-2 py-1">
                                    <i class="bx bx-star me-1"></i> {{ $item->kategori ?? 'Poli Unggulan' }}
                                </span>
                            @elseif($item->variant === 'emergency')
                                <span class="badge bg-label-danger rounded-pill px-2 py-1">
                                    <i class="bx bx-alarm-exclamation me-1"></i> {{ $item->kategori ?? 'Gawat Darurat (UGD)' }}
                                </span>
                            @else
                                <span class="badge bg-label-secondary rounded-pill px-2 py-1">
                                    {{ $item->kategori ?? 'Rawat Jalan (BPJS & Umum)' }}
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
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
                        <td colspan="5" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bx bx-folder-open display-4 text-muted mb-2"></i>
                                <span class="text-muted fw-semibold">Tidak ada data layanan ditemukan.</span>
                                @if(request('search'))
                                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-sm btn-outline-primary mt-2">Reset Pencarian</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($layanans->hasPages())
        <div class="card-footer border-top py-3">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <small class="text-muted">Halaman {{ $layanans->currentPage() }} dari {{ $layanans->lastPage() }}</small>
                <div>
                    {{ $layanans->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-layanan');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const form = document.getElementById(`delete-form-${id}`);

                Swal.fire({
                    title: 'Hapus Layanan?',
                    text: `Apakah Anda yakin ingin menghapus layanan "${name}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
