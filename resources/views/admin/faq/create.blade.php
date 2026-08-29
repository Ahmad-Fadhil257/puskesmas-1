@extends('layouts.admin')

@section('title', 'Tambah FAQ Baru - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Pertanyaan FAQ Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">Tanya Jawab (FAQ)</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-2 shadow-xs">
                <i class="bx bx-arrow-back"></i>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header border-bottom py-3">
            <h5 class="card-title mb-0 fw-bold">Informasi Pertanyaan &amp; Jawaban</h5>
        </div>
        <div class="card-body pt-4">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background-color: #FCE8E6; color: #C5221F; border-left: 4px solid #C5221F !important; border-radius: 8px;">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bx bx-error-circle fs-4 me-2"></i>
                        <span class="fw-bold">Mohon periksa kembali isian formulir:</span>
                    </div>
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf

                <div class="row g-4">
                    {{-- Pertanyaan --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="pertanyaan">
                            Pertanyaan <span class="text-danger">*</span>
                        </label>
                        <input type="text" 
                               class="form-control @error('pertanyaan') is-invalid @enderror" 
                               id="pertanyaan" 
                               name="pertanyaan" 
                               value="{{ old('pertanyaan') }}" 
                               placeholder="Contoh: Bagaimana cara mendaftar berobat menggunakan BPJS Kesehatan?" 
                               required>
                        @error('pertanyaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-6 col-12">
                        <label class="form-label fw-semibold" for="kategori">
                            Kategori Pertanyaan <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('kategori') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-text small">Pilih salah satu topik kategori untuk memudahkan pencarian oleh masyarakat.</div>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Urutan Prioritas --}}
                    <div class="col-md-3 col-6">
                        <label class="form-label fw-semibold" for="urutan">
                            Urutan Tampil
                        </label>
                        <input type="number" 
                               class="form-control @error('urutan') is-invalid @enderror" 
                               id="urutan" 
                               name="urutan" 
                               value="{{ old('urutan', $nextOrder) }}" 
                               min="1">
                        <div class="form-text small">Angka lebih kecil tampil lebih atas.</div>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Aktif --}}
                    <div class="col-md-3 col-6">
                        <label class="form-label fw-semibold d-block">Status Publikasi</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Aktif &amp; Ditampilkan</label>
                        </div>
                    </div>

                    {{-- Jawaban Lengkap --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="jawaban">
                            Jawaban Lengkap <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('jawaban') is-invalid @enderror" 
                                  id="jawaban" 
                                  name="jawaban" 
                                  rows="6" 
                                  placeholder="Tuliskan penjelasan dan langkah-langkah jawaban secara ramah, informatif, dan mudah dipahami..." 
                                  required>{{ old('jawaban') }}</textarea>
                        <div class="form-text small">Gunakan kalimat yang jelas dan cantumkan persyaratan berkas yang diperlukan jika ada.</div>
                        @error('jawaban')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Pertanyaan
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection
