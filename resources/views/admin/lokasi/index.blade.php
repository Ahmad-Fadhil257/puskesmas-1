@extends('layouts.admin')

@section('title', 'Kelola Lokasi & Peta - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-map-pin me-2"></i>Kelola Lokasi & Peta Puskesmas
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Lokasi & Peta</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('lokasi') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 shadow-xs">
            <i class="bx bx-link-external"></i>
            <span>Lihat Halaman Publik</span>
        </a>
    </div>

    {{-- Alert Success / Errors (handled by Toastr via layout) --}}
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

    <form action="{{ route('admin.lokasi.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">

            {{-- Kolom Kiri: Landmark, Link Google Maps, dan Layanan Darurat UGD --}}
            <div class="col-lg-6 col-12">

                {{-- Card Pengaturan Navigasi --}}
                <div class="card shadow-sm border mb-4">
                    <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center bg-light">
                        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-primary" style="color: #0A5C45 !important;">
                            <i class="bx bx-navigation fs-4"></i> Pengaturan Navigasi Peta
                        </h5>
                        <span class="badge bg-label-primary">Peta Utama</span>
                    </div>
                    <div class="card-body pt-4">

                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="landmark">
                                Patokan / Landmark Sekitar
                            </label>
                            <input type="text"
                                   class="form-control @error('landmark') is-invalid @enderror"
                                   id="landmark" name="landmark"
                                   placeholder="Contoh: Dekat Kantor Kecamatan, 200m dari Alun-Alun"
                                   value="{{ old('landmark', $setting->landmark) }}" style="border-radius: 8px;">
                            @error('landmark')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-1 text-muted">Membantu pengunjung menemukan lokasi fisik Puskesmas dengan lebih mudah.</div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold" for="maps_link">
                                Link Langsung Google Maps
                            </label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" style="border-radius: 8px 0 0 8px;"><i class="bx bx-map-alt text-primary"></i></span>
                                <input type="text"
                                       class="form-control @error('maps_link') is-invalid @enderror"
                                       id="maps_link" name="maps_link"
                                       placeholder="https://maps.google.com/?q=..."
                                       value="{{ old('maps_link', $setting->maps_link) }}" style="border-radius: 0 8px 8px 0;">
                            </div>
                            @error('maps_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-1 text-muted">Tautan untuk tombol "Buka di Google Maps" di website. Jika kosong, akan otomatis dicari berdasarkan alamat di identitas aplikasi.</div>
                        </div>

                    </div>
                </div>

                {{-- Card Layanan UGD --}}
                <div class="card shadow-sm border">
                    <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center bg-light">
                        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-danger" style="color: #dc2626 !important;">
                            <i class="bx bx-plus-medical fs-4"></i> Layanan UGD / Darurat
                        </h5>
                        <span class="badge bg-label-danger">Darurat</span>
                    </div>
                    <div class="card-body pt-4">

                        <div class="mb-2">
                            <label class="form-label fw-semibold" for="emergency_info">
                                Info Layanan Darurat (UGD)
                            </label>
                            <input type="text"
                                   class="form-control @error('emergency_info') is-invalid @enderror"
                                   id="emergency_info" name="emergency_info"
                                   placeholder="Contoh: 24 Jam Setiap Hari"
                                   value="{{ old('emergency_info', $setting->emergency_info) }}" style="border-radius: 8px;">
                            @error('emergency_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text mt-1 text-muted">Akan ditampilkan sebagai lencana UGD di halaman Lokasi.</div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Embed Peta & Live Preview --}}
            <div class="col-lg-6 col-12">

                {{-- Card Embed Peta --}}
                <div class="card shadow-sm border mb-4">
                    <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center bg-light">
                        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-info" style="color: #0284c7 !important;">
                            <i class="bx bx-code-block fs-4"></i> Integrasi Google Maps Iframe
                        </h5>
                        <span class="badge bg-label-info">Google Maps</span>
                    </div>
                    <div class="card-body pt-4">

                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="maps_iframe_url">
                                HTML Iframe / URL Embed Peta
                            </label>
                            <textarea class="form-control font-monospace @error('maps_iframe_url') is-invalid @enderror"
                                      id="maps_iframe_url" name="maps_iframe_url"
                                      rows="4"
                                      placeholder='Tempel tag <iframe> atau URL embed Google Maps Anda di sini...'
                                      style="border-radius: 8px; font-size: 13px;">{{ old('maps_iframe_url', $setting->maps_iframe_url) }}</textarea>
                            @error('maps_iframe_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alert Panduan --}}
                        <div class="alert alert-primary d-flex align-items-start gap-2 p-3 mb-0 shadow-xs border-0" role="alert" style="background-color: #E8F0FE; color: #1967D2; border-radius: 8px;">
                            <i class="bx bx-info-circle flex-shrink-0 mt-1 fs-5"></i>
                            <div class="small">
                                <strong class="d-block mb-1">Panduan Pengisian:</strong>
                                <ol class="mb-0 ps-3">
                                    <li>Buka <a href="https://www.google.com/maps" target="_blank" class="fw-semibold text-decoration-underline" style="color: #1967D2;">Google Maps</a> dan cari Puskesmas Anda.</li>
                                    <li>Klik tombol <strong>Bagikan / Share</strong> → Pilih tab <strong>Sematkan Peta</strong>.</li>
                                    <li>Klik <strong>Salin HTML</strong> dan tempelkan kodenya pada kolom di atas.</li>
                                </ol>
                                <span class="d-block mt-2 text-dark font-weight-semibold">Catatan: Jika dikosongkan, sistem akan otomatis melakukan pencarian Google Maps berdasarkan alamat lengkap yang diatur pada pengaturan identitas.</span>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Preview Peta Live --}}
                <div class="card shadow-sm border">
                    <div class="card-header border-bottom py-3 d-flex align-items-center justify-content-between bg-light">
                        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-success" style="color: #0A5C45 !important;">
                            <i class="bx bx-show fs-4"></i> Preview Peta Aktif
                        </h5>
                        <span class="badge bg-label-success">Live View</span>
                    </div>
                    <div class="card-body p-3">
                        <div class="ratio ratio-16x9 border rounded overflow-hidden shadow-xs" style="min-height: 280px; border-radius: 12px !important;">
                            <iframe
                                src="{{ $setting->embed_map_url }}"
                                style="border: none;"
                                loading="lazy"
                                allowfullscreen
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                    <div class="card-footer py-3 border-top d-flex justify-content-between align-items-center bg-light">
                        <span class="small text-muted"><i class="bx bx-check-double me-1"></i> Tampilan di halaman publik</span>
                        <a href="{{ $setting->direct_maps_link }}" target="_blank" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 shadow-sm">
                            <i class="bx bx-map-pin"></i>
                            <span>Uji Navigasi Google Maps</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('lokasi') }}" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2">
                <i class="bx bx-show"></i>
                <span>Lihat Tampilan Publik</span>
            </a>
            <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow">
                <i class="bx bx-save"></i>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

@endsection
