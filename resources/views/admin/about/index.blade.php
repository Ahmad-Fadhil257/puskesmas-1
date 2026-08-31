@extends('layouts.admin')

@section('title', 'Kelola Tentang Kami - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-info-circle me-2"></i>Kelola Tentang Kami
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Tentang Kami</li>
                </ol>
            </nav>
        </div>
        <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
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

    @if (isset($errors) && $errors->any())
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
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Informasi & Pengaturan Tentang Kami (About Section)</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- 1. INFORMASI UTAMA --}}
                    <div class="col-12">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bx bx-edit-alt me-1"></i> Informasi & Deskripsi Utama
                        </h6>
                    </div>

                    {{-- Label Badge Kecil --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" for="badge_label">
                            Label Badge Kecil <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('badge_label') is-invalid @enderror" 
                               id="badge_label" 
                               name="badge_label" 
                               value="{{ old('badge_label', $about->badge_label) }}" 
                               placeholder="Contoh: Tentang Kami" 
                               required>
                        <div class="form-text">Label kecil dengan ikon yang berada di atas judul utama.</div>
                        @error('badge_label')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul Utama (Heading H2) --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" for="title">
                            Judul Utama (Headline) <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $about->title) }}" 
                               placeholder="Masukkan headline utama tentang puskesmas..." 
                               required>
                        <div class="form-text">Kalimat headline utama yang menonjolkan komitmen puskesmas.</div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Lengkap --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="description">
                            Deskripsi Lengkap <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Tuliskan penjelasan mengenai profil, layanan, dan dedikasi puskesmas..." 
                                  required>{{ old('description', $about->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- 2. FOTO & VISUAL KOLASE --}}
                    <div class="col-12">
                        <hr class="my-3">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bx bx-image-alt me-1"></i> Foto Kolase Bertingkat (Staggered Photos)
                        </h6>
                    </div>

                    {{-- Foto 1: Foto Utama (Kiri) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="image_main">
                            Foto Utama (Sisi Kiri / Depan)
                        </label>
                        <input type="file" 
                               class="form-control @error('image_main') is-invalid @enderror" 
                               id="image_main" 
                               name="image_main" 
                               accept="image/*" 
                               onchange="previewImage(event, 'mainImagePreview', 'mainPreviewContainer')">
                        <div class="form-text">Format: JPG, PNG, WEBP (Maks 4MB). Biarkan kosong jika tidak ingin mengubah.</div>
                        @error('image_main')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Current & Preview Box --}}
                        <div class="mt-3 d-flex align-items-center gap-3">
                            <div>
                                <span class="d-block fs-tiny text-muted mb-1">Foto Saat Ini:</span>
                                <img src="{{ $about->image_main_url }}" 
                                     alt="Foto Utama" 
                                     class="rounded" 
                                     style="max-height: 110px; object-fit: cover; border: 1px solid #E2F0EC;">
                            </div>
                            <div id="mainPreviewContainer" style="display: none;">
                                <span class="d-block fs-tiny text-muted mb-1">Foto Baru:</span>
                                <img id="mainImagePreview" 
                                     src="#" 
                                     alt="Preview" 
                                     class="rounded" 
                                     style="max-height: 110px; object-fit: cover; border: 1px solid #0A5C45;">
                            </div>
                        </div>

                        @if($about->image_main)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="reset_image_main" id="reset_image_main" value="1">
                                <label class="form-check-label text-muted small" for="reset_image_main">
                                    Reset ke foto default
                                </label>
                            </div>
                        @endif
                    </div>

                    {{-- Foto 2: Foto Aksen (Kanan) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="image_accent">
                            Foto Aksen (Sisi Kanan / Belakang)
                        </label>
                        <input type="file" 
                               class="form-control @error('image_accent') is-invalid @enderror" 
                               id="image_accent" 
                               name="image_accent" 
                               accept="image/*" 
                               onchange="previewImage(event, 'accentImagePreview', 'accentPreviewContainer')">
                        <div class="form-text">Format: JPG, PNG, WEBP (Maks 4MB). Biarkan kosong jika tidak ingin mengubah.</div>
                        @error('image_accent')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Current & Preview Box --}}
                        <div class="mt-3 d-flex align-items-center gap-3">
                            <div>
                                <span class="d-block fs-tiny text-muted mb-1">Foto Saat Ini:</span>
                                <img src="{{ $about->image_accent_url }}" 
                                     alt="Foto Aksen" 
                                     class="rounded" 
                                     style="max-height: 110px; object-fit: cover; border: 1px solid #E2F0EC;">
                            </div>
                            <div id="accentPreviewContainer" style="display: none;">
                                <span class="d-block fs-tiny text-muted mb-1">Foto Baru:</span>
                                <img id="accentImagePreview" 
                                     src="#" 
                                     alt="Preview" 
                                     class="rounded" 
                                     style="max-height: 110px; object-fit: cover; border: 1px solid #0A5C45;">
                            </div>
                        </div>

                        @if($about->image_accent)
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="reset_image_accent" id="reset_image_accent" value="1">
                                <label class="form-check-label text-muted small" for="reset_image_accent">
                                    Reset ke foto default
                                </label>
                            </div>
                        @endif
                    </div>

                    {{-- 3. VISI & MISI PUSKESMAS --}}
                    <div class="col-12">
                        <hr class="my-3">
                        <h6 class="fw-bold mb-3 text-primary">
                            <i class="bx bx-target-lock me-1"></i> Visi & Misi Puskesmas
                        </h6>
                    </div>

                    {{-- Visi Kami --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded">
                            <label class="form-label fw-semibold text-dark" for="visi_title">
                                <i class="bx bx-show text-primary me-1"></i> Judul Visi <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('visi_title') is-invalid @enderror" 
                                   id="visi_title" 
                                   name="visi_title" 
                                   value="{{ old('visi_title', $about->visi_title) }}" 
                                   placeholder="Contoh: Visi Kami" 
                                   required>
                            @error('visi_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="form-label fw-semibold text-dark mt-3" for="visi_text">
                                Penjelasan Visi <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('visi_text') is-invalid @enderror" 
                                      id="visi_text" 
                                      name="visi_text" 
                                      rows="3" 
                                      placeholder="Uraikan visi puskesmas..." 
                                      required>{{ old('visi_text', $about->visi_text) }}</textarea>
                            @error('visi_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Misi Kami --}}
                    <div class="col-md-6">
                        <div class="p-3 border rounded">
                            <label class="form-label fw-semibold text-dark" for="misi_title">
                                <i class="bx bx-flag text-primary me-1"></i> Judul Misi <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('misi_title') is-invalid @enderror" 
                                   id="misi_title" 
                                   name="misi_title" 
                                   value="{{ old('misi_title', $about->misi_title) }}" 
                                   placeholder="Contoh: Misi Kami" 
                                   required>
                            @error('misi_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label class="form-label fw-semibold text-dark mt-3" for="misi_text">
                                Penjelasan Misi <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('misi_text') is-invalid @enderror" 
                                      id="misi_text" 
                                      name="misi_text" 
                                      rows="3" 
                                      placeholder="Uraikan misi puskesmas..." 
                                      required>{{ old('misi_text', $about->misi_text) }}</textarea>
                            @error('misi_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
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

@endsection

@push('scripts')
<script>
function previewImage(event, previewId, containerId) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            const container = document.getElementById(containerId);
            if (preview) {
                preview.src = e.target.result;
            }
            if (container) {
                container.style.display = 'block';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
