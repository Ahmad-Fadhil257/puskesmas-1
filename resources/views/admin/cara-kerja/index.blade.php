@extends('layouts.admin')

@section('title', 'Kelola Cara Kerja - Puskesmas CareLink')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Kelola Cara Kerja</h4>
            <small class="text-muted">Kelola langkah-langkah proses layanan kesehatan</small>
        </div>
        <a href="{{ route('admin.cara-kerja.create') }}" class="btn btn-primary rounded-pill">
            <i class="bx bx-plus me-1"></i> Tambah Langkah
        </a>
    </div>

    <!-- Data Table Card -->
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title fw-bold m-0">Daftar Langkah Cara Kerja</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="80">Urutan</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $item)
                        <tr>
                            <td>
                                <span class="badge bg-label-primary fw-bold fs-6">
                                    {{ str_pad($item->urutan, 2, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td><strong>{{ $item->judul }}</strong></td>
                            <td>{{ Str::limit($item->deskripsi, 80) }}</td>
                            <td>
                                <a href="{{ route('admin.cara-kerja.edit', $item->id) }}" class="btn btn-xs btn-outline-primary rounded-pill me-1">
                                    <i class="bx bx-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.cara-kerja.destroy', $item->id) }}" method="POST" id="delete-form-{{ $item->id }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-xs btn-outline-danger rounded-pill" onclick="confirmDelete('delete-form-{{ $item->id }}', 'langkah ini')">
                                        <i class="bx bx-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="bx bx-info-circle fs-1 d-block mb-2"></i>
                                Belum ada data langkah cara kerja.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
