@extends('layouts.admin')

@section('title', 'Kelola Nilai-Nilai & Mitra - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-star me-2"></i>Kelola Nilai-Nilai & Kemitraan
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Nilai-Nilai & Mitra</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#addMitraModal">
                <i class="bx bx-plus"></i>
                <span>Tambah Mitra Baru</span>
            </button>
            <a href="{{ url('/#nilai-nilai') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- Alert Success / Errors --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center mb-1">
                <i class="bx bx-error-circle fs-4 me-2"></i>
                <span class="fw-bold">Terdapat beberapa kesalahan pengisian:</span>
            </div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">

        {{-- =========================================================================
           CARD 1: PENGATURAN HEADLINE & BANNER NILAI-NILAI
           ========================================================================= --}}
        <div class="col-12">
            <div class="card shadow-sm border">
                <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">
                        <i class="bx bx-edit-alt me-1 text-primary"></i> 1. Banner Headline Nilai-Nilai
                    </h5>
                    <span class="badge bg-label-primary">Landing Page Banner</span>
                </div>
                <div class="card-body pt-4">
                    <form action="{{ route('admin.nilai.update-banner') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            {{-- Label Badge Atas --}}
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold" for="badge_text">
                                    Label Badge Atas <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('badge_text') is-invalid @enderror" 
                                       id="badge_text" 
                                       name="badge_text" 
                                       value="{{ old('badge_text', $nilai->badge_text) }}" 
                                       placeholder="Contoh: NILAI - NILAI KAMI" 
                                       required>
                                <div class="form-text">Teks kecil di atas judul banner hijau.</div>
                                @error('badge_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Judul Utama (Headline) --}}
                            <div class="col-md-8 col-12">
                                <label class="form-label fw-semibold" for="title">
                                    Judul Headline Utama <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('title') is-invalid @enderror" 
                                          id="title" 
                                          name="title" 
                                          rows="2" 
                                          placeholder="Masukkan headline utama nilai-nilai kemitraan..." 
                                          required>{{ old('title', $nilai->title) }}</textarea>
                                <div class="form-text">Kalimat headline yang terpampang besar di tengah banner hijau.</div>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-end pt-2">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bx bx-save me-1"></i> Simpan Banner
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- =========================================================================
           CARD 2: DAFTAR LOGO MITRA & PARTNER (CRUD LENGKAP)
           ========================================================================= --}}
        <div class="col-12">
            <div class="card shadow-sm border">
                <div class="card-header border-bottom py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <div>
                        <h5 class="mb-0 fw-bold">
                            <i class="bx bx-buildings me-1 text-primary"></i> 2. Daftar Mitra & Partner Terpercaya ({{ $mitras->count() }} Total)
                        </h5>
                        <small class="text-muted">Logo mitra yang aktif akan tampil di dalam kapsul putih pada banner nilai-nilai.</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#addMitraModal">
                        <i class="bx bx-plus"></i> Tambah Mitra
                    </button>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 100px;" class="text-center">Urutan</th>
                                <th style="width: 120px;" class="text-center">Logo</th>
                                <th>Nama Mitra / Instansi</th>
                                <th>Tautan Website</th>
                                <th style="width: 120px;" class="text-center">Status</th>
                                <th class="text-center" style="width: 110px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($mitras as $index => $m)
                            <tr>
                                {{-- Urutan & Panah Reorder --}}
                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <span class="badge bg-label-primary px-2 py-1 fw-bold fs-7">#{{ $m->order }}</span>
                                        <div class="btn-group-vertical btn-group-xs">
                                            {{-- Panah Naik --}}
                                            <form action="{{ route('admin.nilai.mitra.reorder', $m->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="direction" value="up">
                                                <button type="submit" class="btn btn-xs btn-outline-secondary py-0 px-1" title="Geser ke Atas" {{ $index === 0 ? 'disabled' : '' }}>
                                                    <i class="bx bx-chevron-up" style="font-size: 14px;"></i>
                                                </button>
                                            </form>
                                            {{-- Panah Turun --}}
                                            <form action="{{ route('admin.nilai.mitra.reorder', $m->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="direction" value="down">
                                                <button type="submit" class="btn btn-xs btn-outline-secondary py-0 px-1" title="Geser ke Bawah" {{ $index === $mitras->count() - 1 ? 'disabled' : '' }}>
                                                    <i class="bx bx-chevron-down" style="font-size: 14px;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>

                                {{-- Preview Logo --}}
                                <td class="text-center">
                                    <div class="p-2 rounded border d-inline-flex align-items-center justify-content-center bg-white" style="width: 80px; height: 44px;">
                                        <img src="{{ $m->logo_url }}" alt="{{ $m->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    </div>
                                </td>

                                {{-- Nama Mitra --}}
                                <td>
                                    <strong class="text-dark d-block fs-6">{{ $m->name }}</strong>
                                </td>

                                {{-- URL Website --}}
                                <td>
                                    @if($m->url)
                                        <a href="{{ $m->url }}" target="_blank" rel="noopener" class="text-primary small d-inline-flex align-items-center gap-1">
                                            <i class="bx bx-link-external"></i> {{ Str::limit($m->url, 35) }}
                                        </a>
                                    @else
                                        <span class="text-muted small fst-italic">-</span>
                                    @endif
                                </td>

                                {{-- Status Aktif/Nonaktif --}}
                                <td class="text-center">
                                    <form action="{{ route('admin.nilai.mitra.toggle-status', $m->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="badge border-0 {{ $m->is_active ? 'bg-label-success' : 'bg-label-secondary' }} rounded-pill px-2 py-1 cursor-pointer" title="Klik untuk mengubah status">
                                            <i class="bx {{ $m->is_active ? 'bx-check-circle' : 'bx-x-circle' }} me-1"></i>
                                            {{ $m->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </button>
                                    </form>
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        {{-- Edit Button (Modal Trigger) --}}
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editMitraModal-{{ $m->id }}" title="Edit Mitra">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>

                                        {{-- Delete Button (SweetAlert2) --}}
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-mitra" 
                                                data-id="{{ $m->id }}" 
                                                data-name="{{ $m->name }}"
                                                title="Hapus Mitra">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                        <form id="delete-mitra-form-{{ $m->id }}" action="{{ route('admin.nilai.mitra.destroy', $m->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- MODAL EDIT MITRA --}}
                            <div class="modal fade" id="editMitraModal-{{ $m->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">
                                                <i class="bx bx-edit me-1 text-primary"></i> Edit Mitra: {{ $m->name }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.nilai.mitra.update', $m->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="name_{{ $m->id }}">Nama Mitra / Instansi <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" id="name_{{ $m->id }}" name="name" value="{{ $m->name }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="url_{{ $m->id }}">Tautan Website (Opsional)</label>
                                                    <input type="url" class="form-control" id="url_{{ $m->id }}" name="url" value="{{ $m->url }}" placeholder="https://contoh-mitra.com">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="order_{{ $m->id }}">Urutan Tampilan <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" id="order_{{ $m->id }}" name="order" value="{{ $m->order }}" min="1" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold" for="logo_{{ $m->id }}">Ganti Logo Mitra</label>
                                                    <input type="file" class="form-control" id="logo_{{ $m->id }}" name="logo" accept="image/png, image/jpeg, image/webp, image/svg+xml">
                                                    <div class="form-text">Biarkan kosong jika tidak ingin mengganti logo saat ini.</div>
                                                    <div class="mt-2 p-2 rounded border bg-light d-inline-block">
                                                        <small class="text-muted d-block mb-1">Logo Saat Ini:</small>
                                                        <img src="{{ $m->logo_url }}" alt="{{ $m->name }}" style="max-height: 40px; max-width: 120px; object-fit: contain;">
                                                    </div>
                                                </div>

                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input" type="checkbox" id="is_active_{{ $m->id }}" name="is_active" value="1" {{ $m->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-semibold" for="is_active_{{ $m->id }}">Tampilkan di Website (Aktif)</label>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="bx bx-buildings display-4 text-muted mb-2"></i>
                                        <span class="text-muted fw-semibold">Belum ada data mitra terdaftar.</span>
                                        <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#addMitraModal">
                                            <i class="bx bx-plus me-1"></i> Tambah Mitra Pertama
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>

{{-- =========================================================================
   MODAL TAMBAH MITRA BARU
   ========================================================================= --}}
<div class="modal fade" id="addMitraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="bx bx-plus-circle me-1 text-primary"></i> Tambah Mitra / Partner Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.nilai.mitra.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_name">Nama Mitra / Instansi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="add_name" name="name" placeholder="Contoh: BPJS Kesehatan, Kemenkes RI..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_url">Tautan Website (Opsional)</label>
                        <input type="url" class="form-control" id="add_url" name="url" placeholder="https://contoh-mitra.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_order">Urutan Tampilan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="add_order" name="order" value="{{ $nextOrder }}" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_logo">Logo Mitra <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="add_logo" name="logo" accept="image/png, image/jpeg, image/webp, image/svg+xml" required>
                        <div class="form-text">Format: PNG, JPG, WEBP, SVG. Maks 3MB. Disarankan background transparan.</div>
                    </div>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="add_is_active" name="is_active" value="1" checked>
                        <label class="form-check-label fw-semibold" for="add_is_active">Tampilkan di Website (Aktif)</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Mitra</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-mitra');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const form = document.getElementById(`delete-mitra-form-${id}`);

                Swal.fire({
                    title: 'Hapus Mitra?',
                    text: `Apakah Anda yakin ingin menghapus logo mitra "${name}"?`,
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
