@extends('layouts.admin')

@section('title', 'Edit Cara Kerja - Puskesmas CareLink')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Edit Langkah Cara Kerja</h4>
            <small class="text-muted">Perbarui informasi langkah proses layanan</small>
        </div>
        <a href="{{ route('admin.cara-kerja.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="bx bx-arrow-back me-1"></i> Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.cara-kerja.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Urutan -->
                <div class="mb-3">
                    <label for="urutan" class="form-label fw-semibold">Nomor Urutan <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('urutan') is-invalid @enderror"
                           id="urutan" name="urutan" value="{{ old('urutan', $item->urutan) }}"
                           min="1" required placeholder="Contoh: 1, 2, 3...">
                    @error('urutan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Judul -->
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul Langkah <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                           id="judul" name="judul" value="{{ old('judul', $item->judul) }}"
                           required placeholder="Contoh: Buat Janji Temu">
                    @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label for="deskripsi" class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                              id="deskripsi" name="deskripsi" rows="4" required
                              placeholder="Jelaskan langkah ini secara detail...">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="bx bx-save me-1"></i> Perbarui
                    </button>
                    <a href="{{ route('admin.cara-kerja.index') }}" class="btn btn-outline-secondary rounded-pill">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection
