@extends('layouts.admin')

@section('title', 'Pengaturan Identitas & Logo - Puskesmas')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-palette me-2"></i>Pengaturan Identitas & Logo Aplikasi
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Identitas & Logo</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- LIVE PREVIEW CARD --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bx bx-show me-2 text-primary"></i>Pratinjau Langsung (Live Preview) Brand
            </h5>
            <small class="text-muted">Simulasi bagaimana logo & nama aplikasi tampil di berbagai bagian</small>
        </div>
        <div class="card-body pt-4">
            <div class="row g-4">
                {{-- Preview Navbar Terang (Light Mode) --}}
                <div class="col-md-6 col-12">
                    <label class="form-label fw-bold small text-muted text-uppercase">1. Tampilan Navbar Website (Mode Terang)</label>
                    <div class="p-3 rounded-pill d-flex align-items-center justify-content-between border" style="background: #FFFFFF; box-shadow: 0 4px 14px rgba(10,92,69,0.08);">
                        <div class="d-flex align-items-center gap-2 ps-2">
                            <img id="preview-logo-light" src="{{ $setting->logo_url }}" alt="Logo" style="height: 36px; width: 36px; object-fit: contain; flex-shrink: 0;">
                            <span id="preview-text-light" class="fw-bolder fs-5 text-success @if(empty($setting->app_name) || !$setting->show_app_name) d-none @endif">
                                {{ $setting->app_name ?? 'Puskesmas' }}
                            </span>
                        </div>
                        <div class="d-none d-sm-flex gap-3 text-muted small pe-3">
                            <span>Beranda</span>
                            <span>Layanan</span>
                            <span class="badge bg-success rounded-pill px-3">Janji Temu</span>
                        </div>
                    </div>
                </div>

                {{-- Preview Sidebar / Navbar Gelap (Dark Mode) --}}
                <div class="col-md-6 col-12">
                    <label class="form-label fw-bold small text-muted text-uppercase">2. Tampilan Sidebar Admin (Mode Gelap)</label>
                    <div class="p-3 rounded-3 d-flex align-items-center justify-content-between border" style="background: #111827; border-color: #334155 !important;">
                        <div class="d-flex align-items-center gap-2 ps-2">
                            <img id="preview-logo-dark" src="{{ $setting->logo_url }}" alt="Logo" style="height: 36px; width: 36px; object-fit: contain; flex-shrink: 0;">
                            <span id="preview-text-dark" class="fw-bolder fs-5 text-white @if(empty($setting->app_name) || !$setting->show_app_name) d-none @endif">
                                {{ $setting->app_name ?? 'Puskesmas' }}
                            </span>
                        </div>
                        <div class="text-white-50 small pe-3">
                            <i class="bx bx-moon text-warning"></i> Dark Theme
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN FORM CARD --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bx bx-slider me-2 text-primary"></i>Formulir Pengaturan Identitas
            </h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">
                    {{-- Upload Logo Aplikasi --}}
                    <div class="col-md-4 col-12 text-center border-end-md">
                        <label class="form-label fw-bold d-block text-start mb-2">Logo / Gambar Aplikasi <span class="text-muted small">(PNG / JPG / SVG / WEBP)</span></label>
                        <div class="p-3 border rounded-3 bg-light d-flex flex-column align-items-center justify-content-center mb-3">
                            <img id="current-logo-display" src="{{ $setting->logo_url }}" alt="Logo Puskesmas" class="img-fluid rounded mb-2" style="max-height: 120px; object-fit: contain;">
                            <small class="text-muted">Logo yang sedang aktif</small>
                        </div>
                        <input type="file" name="logo" id="logo-input" class="form-control @error('logo') is-invalid @enderror" accept="image/*" onchange="handleLogoChange(this)">
                        @error('logo')
                            <div class="invalid-feedback text-start">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-start small">Rekomendasi format PNG transparan atau SVG. Maks. 3 MB.</div>
                    </div>

                    {{-- Nama & Tampilan Aplikasi --}}
                    <div class="col-md-8 col-12">
                        <div class="row g-3">
                            {{-- Nama Aplikasi (Opsional) --}}
                            <div class="col-12">
                                <label class="form-label fw-bold" for="app_name">
                                    Nama Aplikasi / Teks Brand <span class="text-muted fw-normal">(Opsional)</span>
                                </label>
                                <input type="text" 
                                       class="form-control @error('app_name') is-invalid @enderror" 
                                       id="app_name" 
                                       name="app_name" 
                                       value="{{ old('app_name', $setting->app_name) }}" 
                                       placeholder="Contoh: Puskesmas"
                                       oninput="handleNameChange()">
                                <div class="form-text">
                                    <strong>Tips:</strong> Jika logo yang Anda upload sudah menyertakan tulisan/nama puskesmas, Anda bisa mengosongkan kolom ini atau menonaktifkan toggle di bawah.
                                </div>
                                @error('app_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Switch Tampilkan Teks Nama --}}
                            <div class="col-12">
                                <div class="form-check form-switch p-3 border rounded-3 bg-label-primary">
                                    <input class="form-check-input ms-0 me-3" 
                                           type="checkbox" 
                                           name="show_app_name" 
                                           value="1" 
                                           id="show_app_name" 
                                           {{ old('show_app_name', $setting->show_app_name) ? 'checked' : '' }}
                                           onchange="handleToggleChange()">
                                    <label class="form-check-label fw-bold text-dark" for="show_app_name">
                                        Tampilkan Teks Nama Aplikasi di Samping Logo
                                    </label>
                                    <small class="d-block text-muted mt-1">
                                        Jika dinonaktifkan, hanya gambar logo saja yang akan tampil di Navbar dan Sidebar.
                                    </small>
                                </div>
                            </div>

                            {{-- Divider Kontak --}}
                            <div class="col-12 pt-2">
                                <div class="divider text-start my-1">
                                    <div class="divider-text fw-bold text-dark">KONTAK & ALAMAT PUSKESMAS (FOOTER WEBSITE)</div>
                                </div>
                            </div>

                            {{-- Telepon --}}
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="phone">Nomor Telepon / WhatsApp</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $setting->phone) }}" placeholder="Contoh: 6281235890101 atau 081235890101">
                                <small class="text-muted">Nomor ini juga digunakan untuk tombol "Janji Temu" &amp; "Janji Temu Online" (redirect ke WhatsApp).</small>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="email">Email Resmi Puskesmas</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $setting->email) }}" placeholder="info@puskesmas.go.id">
                            </div>

                            {{-- Alamat --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="address">Alamat Lengkap</label>
                                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Jl. Kesehatan No. 123...">{{ old('address', $setting->address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Pengaturan Identitas
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script>
    function getIsNameVisible() {
        const toggle = document.getElementById('show_app_name');
        return toggle ? toggle.checked : false;
    }

    function getCurrentName() {
        const input = document.getElementById('app_name');
        return input ? input.value.trim() : '';
    }

    function handleLogoChange(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('current-logo-display').src = e.target.result;
                document.getElementById('preview-logo-light').src = e.target.result;
                document.getElementById('preview-logo-dark').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function handleNameChange() {
        updatePreviewVisibility();
    }

    function handleToggleChange() {
        updatePreviewVisibility();
    }

    function updatePreviewVisibility() {
        const textLight = document.getElementById('preview-text-light');
        const textDark = document.getElementById('preview-text-dark');
        const name = getCurrentName();
        const isVisible = getIsNameVisible();

        if (name.length > 0 && isVisible) {
            textLight.textContent = name;
            textDark.textContent = name;
            textLight.classList.remove('d-none');
            textDark.classList.remove('d-none');
        } else {
            textLight.classList.add('d-none');
            textDark.classList.add('d-none');
        }
    }
</script>
@endpush

@endsection
