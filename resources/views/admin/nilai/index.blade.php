@extends('layouts.admin')

@section('title', 'Kelola Nilai-Nilai & Mitra - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-star me-2"></i>Kelola Nilai-Nilai & Mitra
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Nilai-Nilai & Mitra</li>
                </ol>
            </nav>
        </div>
        <a href="{{ url('/#nilai-nilai') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
            <i class="bx bx-globe"></i>
            <span>Lihat di Website</span>
        </a>
    </div>

    {{-- Alert Success / Errors --}}
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

    {{-- Form Card Sneat --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Pengaturan Bagian Nilai-Nilai & Kemitraan</h5>
            <span class="badge bg-label-primary">Landing Page</span>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.nilai.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- 1. INFORMASI & HEADLINE --}}
                    <div class="col-12">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bx bx-edit-alt me-1"></i> 1. Label Badge & Headline Utama
                        </h6>
                    </div>

                    {{-- Label Badge --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" for="badge_text">
                            Label Badge Atas <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('badge_text') is-invalid @enderror" 
                               id="badge_text" 
                               name="badge_text" 
                               value="{{ old('badge_text', $nilai->badge_text) }}" 
                               placeholder="Contoh: NILAI - NILAI KAMI" 
                               required>
                        <div class="form-text">Teks kecil di atas headline utama.</div>
                        @error('badge_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul Utama (Headline) --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" for="title">
                            Judul Headline Utama <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('title') is-invalid @enderror" 
                                  id="title" 
                                  name="title" 
                                  rows="2" 
                                  placeholder="Masukkan headline utama nilai-nilai kemitraan..." 
                                  required>{{ old('title', $nilai->title) }}</textarea>
                        <div class="form-text">Kalimat headline yang terpampang besar di tengah banner hijau.</div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. LOGO MITRA KERJASAMA --}}
                    <div class="col-12">
                        <hr class="my-2">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bx bx-building-house me-1"></i> 2. Logo Mitra Kerjasama (Pill Putih)
                        </h6>
                        <p class="text-muted small mb-0">Tiga logo mitra yang ditampilkan di dalam kotak pill putih. Format: PNG transparan, JPG, WEBP, atau SVG. Rekomendasi tinggi logo 40px–60px.</p>
                    </div>

                    {{-- Mitra 1 --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded h-100 bg-light">
                            <h6 class="fw-semibold text-dark mb-2">Mitra 1</h6>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_1_name">Nama Mitra 1</label>
                                <input type="text" class="form-control form-control-sm" id="logo_1_name" name="logo_1_name" value="{{ old('logo_1_name', $nilai->logo_1_name) }}" placeholder="Contoh: BPJS Kesehatan">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_1">Unggah Logo 1</label>
                                <input type="file" class="form-control form-control-sm" id="logo_1" name="logo_1" accept="image/*" onchange="previewLogo(event, 'logo1Preview', 'logo1Wrap')">
                            </div>

                            {{-- Preview Box --}}
                            <div class="p-2 bg-white rounded border d-flex align-items-center justify-content-center" style="min-height: 70px;">
                                <img id="logo1Preview" src="{{ $nilai->logo_1_url }}" alt="Logo 1" style="max-height: 48px; max-width: 100%; object-fit: contain;">
                            </div>

                            @if($nilai->logo_1)
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="reset_logo_1" id="reset_logo_1" value="1">
                                    <label class="form-check-label text-muted small" for="reset_logo_1">
                                        Reset ke logo default
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Mitra 2 --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded h-100 bg-light">
                            <h6 class="fw-semibold text-dark mb-2">Mitra 2</h6>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_2_name">Nama Mitra 2</label>
                                <input type="text" class="form-control form-control-sm" id="logo_2_name" name="logo_2_name" value="{{ old('logo_2_name', $nilai->logo_2_name) }}" placeholder="Contoh: Kementerian Kesehatan RI">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_2">Unggah Logo 2</label>
                                <input type="file" class="form-control form-control-sm" id="logo_2" name="logo_2" accept="image/*" onchange="previewLogo(event, 'logo2Preview', 'logo2Wrap')">
                            </div>

                            {{-- Preview Box --}}
                            <div class="p-2 bg-white rounded border d-flex align-items-center justify-content-center" style="min-height: 70px;">
                                <img id="logo2Preview" src="{{ $nilai->logo_2_url }}" alt="Logo 2" style="max-height: 48px; max-width: 100%; object-fit: contain;">
                            </div>

                            @if($nilai->logo_2)
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="reset_logo_2" id="reset_logo_2" value="1">
                                    <label class="form-check-label text-muted small" for="reset_logo_2">
                                        Reset ke logo default
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Mitra 3 --}}
                    <div class="col-md-4">
                        <div class="p-3 border rounded h-100 bg-light">
                            <h6 class="fw-semibold text-dark mb-2">Mitra 3</h6>
                            
                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_3_name">Nama Mitra 3</label>
                                <input type="text" class="form-control form-control-sm" id="logo_3_name" name="logo_3_name" value="{{ old('logo_3_name', $nilai->logo_3_name) }}" placeholder="Contoh: Mitra Kesehatan Puskesmas">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-semibold" for="logo_3">Unggah Logo 3</label>
                                <input type="file" class="form-control form-control-sm" id="logo_3" name="logo_3" accept="image/*" onchange="previewLogo(event, 'logo3Preview', 'logo3Wrap')">
                            </div>

                            {{-- Preview Box --}}
                            <div class="p-2 bg-white rounded border d-flex align-items-center justify-content-center" style="min-height: 70px;">
                                <img id="logo3Preview" src="{{ $nilai->logo_3_url }}" alt="Logo 3" style="max-height: 48px; max-width: 100%; object-fit: contain;">
                            </div>

                            @if($nilai->logo_3)
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="reset_logo_3" id="reset_logo_3" value="1">
                                    <label class="form-check-label text-muted small" for="reset_logo_3">
                                        Reset ke logo default
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 mt-3 pt-3 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

<script>
function previewLogo(event, previewId) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            if (preview) {
                preview.src = e.target.result;
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
