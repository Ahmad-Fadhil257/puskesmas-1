@extends('layouts.admin')

@section('title', 'Tambah Dokter - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Dokter
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Kelola Dokter</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    {{-- Alert Error --}}
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

    {{-- Form Card --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Form Tambah Data Dokter</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- Nama Dokter --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">
                            Nama Dokter <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="{{ old('name') }}"
                            placeholder="Contoh: Dr. John Smith, Sp.JP"
                            required />
                        <div class="form-text">Tuliskan nama lengkap beserta gelar dokter.</div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Spesialisasi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="specialty">
                            Spesialisasi <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('specialty') is-invalid @enderror"
                            id="specialty" name="specialty"
                            value="{{ old('specialty') }}"
                            placeholder="Contoh: Dokter Spesialis Jantung"
                            required />
                        <div class="form-text">Bidang keahlian atau spesialisasi dokter.</div>
                        @error('specialty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Divider: Foto & Status --}}
                    <div class="col-12"><hr class="my-1"></div>

                    {{-- Upload Foto --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="photo">Foto Dokter</label>
                        <input type="file"
                            class="form-control @error('photo') is-invalid @enderror"
                            id="photo" name="photo"
                            accept="image/png, image/jpeg, image/webp"
                            onchange="previewPhoto(this)" />
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 3MB. Rekomendasi rasio portrait 4:5 agar tampilan rapi.</div>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- Preview --}}
                        <div id="previewWrap" class="mt-3 d-none">
                            <span class="d-block text-muted small mb-1">Preview:</span>
                            <img id="photoPreview" src="" alt="Preview Foto" class="rounded border" style="height: 140px; object-fit: cover; object-position: top;">
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 mt-2 pt-3 border-top">
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Simpan Dokter
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

<script>
function previewPhoto(input) {
    const wrap = document.getElementById('previewWrap');
    const preview = document.getElementById('photoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrap.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
