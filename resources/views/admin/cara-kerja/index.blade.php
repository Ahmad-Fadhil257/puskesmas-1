@extends('layouts.admin')

@section('title', 'Kelola Cara Kerja - Puskesmas CareLink')

@section('content')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-list-check me-2"></i>Kelola Alur Cara Kerja
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Cara Kerja</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.cara-kerja.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus-circle"></i>
                <span>Tambah Langkah Baru</span>
            </a>
        </div>
    </div>

    {{-- Data Table Card Sneat --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center border-bottom py-3">
            <h5 class="mb-0 fw-bold">Daftar Langkah Pelayanan ({{ $data->count() }} Total)</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 90px;" class="text-center">Urutan</th>
                        <th style="width: 250px;">Judul Langkah</th>
                        <th>Deskripsi Alur Pelayanan</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-label-primary fw-bolder fs-6 px-3 py-2 rounded-pill">
                                    Langkah {{ str_pad($item->urutan, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-dark fs-6">{{ $item->judul }}</span>
                            </td>
                            <td>
                                <p class="text-muted mb-0 text-wrap" style="max-width: 500px; line-height: 1.5;">
                                    {{ $item->deskripsi }}
                                </p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.cara-kerja.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-warning" title="Edit Langkah">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>

                                    {{-- Hapus --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-cara-kerja" 
                                            data-id="{{ $item->id }}" 
                                            data-title="{{ $item->judul }}"
                                            title="Hapus Langkah">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.cara-kerja.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bx bx-folder-open display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                                    Belum ada data langkah cara kerja yang ditambahkan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-cara-kerja').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Langkah?',
                    html: `Apakah Anda yakin ingin menghapus langkah <strong>"${title}"</strong>? Tindakan ini tidak dapat dibatalkan.`,
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
