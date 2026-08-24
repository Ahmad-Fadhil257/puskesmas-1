@extends('layouts.admin')

@section('title', 'Tambah Langkah Cara Kerja - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Langkah Cara Kerja
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.cara-kerja.index') }}">Kelola Cara Kerja</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.cara-kerja.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    {{-- Form Card Sneat --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Informasi Langkah Alur Pelayanan</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.cara-kerja.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- Nomor Urutan --}}
                    <div class="col-md-3">
                        <label class="form-label fw-semibold" for="urutan">Nomor Urutan <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', 1) }}" min="1" placeholder="Contoh: 1, 2, 3..." required>
                        <div class="form-text">Urutan tampilan pada landing page.</div>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul Langkah --}}
                    <div class="col-md-9">
                        <label class="form-label fw-semibold" for="judul">Judul Langkah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" placeholder="Contoh: Buat Janji Temu" required>
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="deskripsi">Deskripsi Langkah <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" placeholder="Jelaskan instruksi atau alur yang harus dilakukan pasien pada langkah ini..." required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.cara-kerja.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Langkah
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
