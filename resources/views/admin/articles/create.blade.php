@extends('layouts.admin')

@section('title', 'Tulis Artikel Baru - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tulis Artikel Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Kelola Berita</a></li>
                    <li class="breadcrumb-item active">Tulis Baru</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Informasi & Konten Artikel</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    {{-- Judul Artikel --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" for="title">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: 5 Langkah Menjaga Kesehatan Jantung Sejak Dini" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" for="category">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penulis --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="author">Nama Penulis / Dokter <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', 'Tim Medis CareLink') }}" required>
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Estimasi Waktu Baca --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="reading_time">Estimasi Waktu Baca <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('reading_time') is-invalid @enderror" id="reading_time" name="reading_time" value="{{ old('reading_time', '3 Menit') }}" placeholder="Contoh: 3 Menit" required>
                        @error('reading_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Upload Thumbnail Image --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="thumbnail">Foto Sampul / Thumbnail (Maks 3MB)</label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(event)">
                        <div class="form-text">Format didukung: JPG, PNG, WEBP. Jika dikosongkan, gambar default akan digunakan.</div>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview Box --}}
                        <div class="mt-2" id="previewContainer" style="display: none;">
                            <img id="imagePreview" src="#" alt="Preview" class="rounded" style="max-height: 180px; object-fit: cover; border: 1px solid #E2F0EC;">
                        </div>
                    </div>

                    {{-- Excerpt / Ringkasan Singkat --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="excerpt">Ringkasan Singkat (Excerpt)</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="2" placeholder="Ringkasan 1-2 kalimat yang tampil di kartu katalog...">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konten Lengkap --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="content">Isi Lengkap Artikel <span class="text-danger">*</span></label>
                        <div class="form-text mb-2">Gunakan toolbar di atas kotak untuk membuat judul sub-bagian, menebalkan teks, menambah daftar, dll — tanpa perlu menulis kode HTML.</div>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="12" hidden>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Publikasi --}}
                    <div class="col-md-12">
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_published">Publikasikan langsung ke website (Published)</label>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Terbitkan Artikel
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<!-- CKEditor 5 (WYSIWYG Editor) -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        ClassicEditor
            .create(document.querySelector('#content'), {
                toolbar: {
                    items: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', 'insertTable', '|', 'undo', 'redo']
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraf', class: 'ck-heading_paragraph' },
                        { model: 'heading2', view: 'h2', title: 'Judul Besar (H2)', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Judul Sedang (H3)', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Judul Kecil (H4)', class: 'ck-heading_heading4' }
                    ]
                },
                language: 'id'
            })
            .then(editor => {
                editor.ui.getEditableElement().style.border = '1px solid #d9dee3';
                editor.ui.getEditableElement().style.borderRadius = '0.375rem';
                editor.ui.getEditableElement().style.minHeight = '350px';
            })
            .catch(error => {
                console.error(error);
            });
    });

    function previewThumbnail(event) {
        const input = event.target;
        const container = document.getElementById('previewContainer');
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            container.style.display = 'none';
        }
    }
</script>
@endpush

@endsection
