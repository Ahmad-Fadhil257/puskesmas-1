@extends('layouts.admin')

@section('title', 'Kelola Kontak - Puskesmas CareLink')

@section('content')

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Kelola Kontak</h4>
            <small class="text-muted">Kelola informasi kontak yang tampil di footer website & tombol Janji Temu (WhatsApp)</small>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-bold m-0">Informasi Kontak</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.kontak.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Alamat</label>
                    <input type="text"
                           class="form-control @error('alamat') is-invalid @enderror"
                           name="alamat"
                           value="{{ old('alamat', $kontak->alamat) }}"
                           required placeholder="Contoh: Jl. Kesehatan No. 123, Jakarta Selatan, 12345">
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           name="email"
                           value="{{ old('email', $kontak->email) }}"
                           required placeholder="Contoh: info@puskemascarelink.go.id">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nomor Telepon / WhatsApp</label>
                    <input type="text"
                           class="form-control @error('telepon') is-invalid @enderror"
                           name="telepon"
                           value="{{ old('telepon', $kontak->telepon) }}"
                           required placeholder="Contoh: 6281235890101 atau 081235890101">
                    @error('telepon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Nomor ini juga digunakan untuk tombol "Janji Temu" &amp; "Janji Temu Online" (redirect ke WhatsApp).</small>
                </div>

                <button type="submit" class="btn btn-primary rounded-pill">
                    <i class="bx bx-save me-1"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>

@endsection
