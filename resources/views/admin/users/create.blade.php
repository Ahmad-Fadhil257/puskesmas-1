@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru - Puskesmas')

@section('content')

    @php
        /** @var array<string, string> $allPages */
    @endphp

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-user-plus me-2"></i>Tambah Pengguna Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Kelola Pengguna</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    {{-- Error Alert Banner --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-start">
                <i class="bx bx-error-circle me-2 fs-4 mt-1"></i>
                <div>
                    <strong>Terdapat kesalahan pengisian data:</strong>
                    <ul class="mb-0 mt-1 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Card Sneat --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Informasi Akun Pengguna</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    {{-- Nama Lengkap --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: dr. Hendra Pratama" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat Email --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="email">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="nama@puskesmas.go.id" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kata Sandi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="password">Kata Sandi (Password) <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 6 karakter" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Kata Sandi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="password_confirmation">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang kata sandi" required>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="phone">Nomor Telepon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Contoh: 08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Peran / Role --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="role">Peran (Role) <span class="text-danger">*</span></label>
                        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required onchange="toggleAccessiblePages(this.value)">
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Akses Penuh Seluruh Menu)</option>
                            <option value="staf" {{ old('role', 'staf') === 'staf' ? 'selected' : '' }}>Staf / Petugas (Akses Menu Terbatas)</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Switch --}}
                    <div class="col-12 d-flex align-items-center pt-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                Status Akun Aktif (Dapat Login ke Sistem)
                            </label>
                        </div>
                    </div>

                    {{-- Container Hak Akses Halaman (Khusus Staf) --}}
                    <div class="col-12 {{ old('role', 'staf') === 'staf' ? '' : 'd-none' }}" id="accessiblePagesContainer">
                        <div class="card bg-light border p-3 mt-2">
                            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                                <label class="form-label fw-bold text-dark mb-0">
                                    <i class="bx bx-check-shield text-primary me-1"></i> Pilih Hak Akses Menu untuk Staf:
                                </label>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-primary btn-sm py-1 px-2" onclick="setAllPermissions(true)">
                                        <i class="bx bx-check-double me-1"></i> Pilih Semua
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-1 px-2" onclick="setAllPermissions(false)">
                                        <i class="bx bx-x me-1"></i> Hapus Semua
                                    </button>
                                </div>
                            </div>
                            <div class="row g-2">
                                @foreach($allPages as $key => $title)
                                    @if($key === 'users') @continue @endif
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input permission-checkbox" type="checkbox" name="accessible_pages[]" value="{{ $key }}" id="page_{{ $key }}" {{ in_array($key, old('accessible_pages', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="page_{{ $key }}">
                                                {{ $title }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <small class="text-muted mt-2 d-block">
                                * Centang modul atau halaman yang diizinkan untuk dikelola oleh petugas ini.
                            </small>
                        </div>
                    </div>
                </div>

                <script>
                    function toggleAccessiblePages(role) {
                        const container = document.getElementById('accessiblePagesContainer');
                        if (container) {
                            if (role === 'staf') {
                                container.classList.remove('d-none');
                            } else {
                                container.classList.add('d-none');
                            }
                        }
                    }

                    function setAllPermissions(checked) {
                        const container = document.getElementById('accessiblePagesContainer');
                        if (!container) return;
                        const checkboxes = container.querySelectorAll('.permission-checkbox');
                        checkboxes.forEach(function(cb) {
                            cb.checked = checked;
                        });
                    }
                </script>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
