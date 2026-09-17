@extends('layouts.admin')

@section('title', 'Edit Pengguna - Puskesmas')

@section('content')

    @php
        /** @var \App\Models\User $user */
        /** @var array<string, string> $allPages */
    @endphp

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

                    {{-- Konfirmasi Kata Sandi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Ketik ulang kata sandi baru">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="phone">Nomor Telepon</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Contoh: 08123456789">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Peran / Role --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="role">Peran (Role) <span class="text-danger">*</span></label>
                        @if($user->id === Auth::id())
                            <input type="text" class="form-control bg-light" id="role" value="Administrator (Akun Anda Sendiri)" readonly disabled>
                            <input type="hidden" name="role" value="admin">
                        @else
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required onchange="toggleAccessiblePages(this.value)">
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrator (Akses Penuh Seluruh Menu)</option>
                                <option value="staf" {{ old('role', $user->role) === 'staf' ? 'selected' : '' }}>Staf / Petugas (Akses Menu Terbatas)</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        @endif
                    </div>

                    {{-- Status Switch --}}
                    <div class="col-12 d-flex align-items-center pt-2">
                        <div class="form-check form-switch">
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

                    {{-- Container Hak Akses Halaman (Khusus Staf) --}}
                    @php
                        /** @var string $currentRole */
                        $currentRole = old('role', $user->role);
                        /** @var array $userPages */
                        $userPages = (array) (old('accessible_pages', $user->accessible_pages) ?? []);
                    @endphp
                    <div class="col-12" id="accessiblePagesContainer" style="display: {{ $currentRole === 'staf' ? 'block' : 'none' }};">
                        <div class="card bg-light border p-3 mt-2">
                            <label class="form-label fw-bold text-dark mb-2">
                                <i class="bx bx-check-shield text-primary me-1"></i> Pilih Hak Akses Menu untuk Staf:
                            </label>
                            <div class="row g-2">
                                @foreach($allPages as $key => $title)
                                    @if($key === 'users') @continue @endif
                                    <div class="col-md-4 col-sm-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="accessible_pages[]" value="{{ $key }}" id="page_{{ $key }}" {{ in_array($key, $userPages) ? 'checked' : '' }}>
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
                            container.style.display = (role === 'staf') ? 'block' : 'none';
                        }
                    }
                </script>

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
