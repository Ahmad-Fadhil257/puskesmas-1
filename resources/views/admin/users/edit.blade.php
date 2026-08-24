@extends('layouts.admin')

@section('title', 'Edit Pengguna - Puskesmas')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-edit me-2"></i>Edit Data Pengguna
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Kelola Pengguna</a></li>
                    <li class="breadcrumb-item active">Edit: {{ $user->name }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    {{-- Form Card Sneat --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Edit Akun: {{ $user->name }}</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Nama Lengkap --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat Email --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="email">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kata Sandi (Opsional) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="password">Kata Sandi Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah kata sandi">
                        <div class="form-text">Biarkan kosong jika kata sandi tidak ingin diganti.</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Role / Peran --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="role">Peran / Hak Akses <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                            <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Akses Penuh)</option>
                            <option value="staf" {{ old('role', $user->role) === 'staf' ? 'selected' : '' }}>Staf Puskesmas</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="phone">Nomor Telepon / WhatsApp</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Switch --}}
                    <div class="col-md-6 d-flex align-items-center pt-3">
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $user->is_active) ? 'checked' : '' }} {{ $user->id === Auth::id() ? 'disabled' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                Status Akun Aktif (Dapat Login ke Sistem)
                            </label>
                            @if($user->id === Auth::id())
                                <input type="hidden" name="is_active" value="1">
                                <div class="form-text text-warning small">Akun Anda sendiri tidak dapat dinonaktifkan.</div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
