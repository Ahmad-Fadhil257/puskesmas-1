@extends('layouts.admin')

@section('title', 'Edit Infografis')

@section('content')
<div class="content-wrapper" style="max-width:720px;">

    <div class="mb-4">
        <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 mb-3">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
        <h4 class="fw-bold mb-0" style="color:#111827;">Edit Infografis</h4>
        <p class="text-muted mb-0 small">Perbarui informasi dan gambar infografis.</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <div class="card border-0 shadow-sm" style="border-radius:16px;">
        <div class="card-body p-4">
            <form action="{{ route('admin.infografis.update', $infografis) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Infografis <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $infografis->title) }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror"
                           value="{{ old('kategori', $infografis->kategori) }}" required
                           list="kategoriList" placeholder="Pilih atau ketik kategori">
                    <datalist id="kategoriList">
                        <option value="Umum">
                        <option value="Kesehatan Ibu & Anak">
                        <option value="Gizi & Nutrisi">
                        <option value="Penyakit Menular">
                        <option value="Hidup Sehat">
                        <option value="Statistik Pelayanan">
                        <option value="Program Kesehatan">
                    </datalist>
                    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Deskripsi singkat (opsional, maks. 500 karakter)...">{{ old('deskripsi', $infografis->deskripsi) }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Infografis</label>

                    {{-- Gambar saat ini --}}
                    <div class="mb-2">
                        <p class="text-muted small mb-1">Gambar saat ini:</p>
                        <img src="{{ $infografis->image_url }}" alt="{{ $infografis->title }}"
                             style="max-height:220px;border-radius:10px;border:1px solid #e5e7eb;">
                    </div>

                    <input type="file" name="image" id="imageInput"
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/webp">
                    <div class="form-text">Kosongkan jika tidak ingin mengganti gambar. Format: JPG, PNG, WebP. Maks. 5 MB.</div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror

                    {{-- Preview gambar baru --}}
                    <div id="imagePreviewWrap" class="mt-3 d-none">
                        <p class="text-muted small mb-1">Preview gambar baru:</p>
                        <img id="imagePreview" src="" alt="Preview"
                             style="max-height:220px;border-radius:10px;border:1px solid #e5e7eb;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Urutan Tampil</label>
                        <input type="number" name="order" class="form-control"
                               value="{{ old('order', $infografis->order) }}" min="0">
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                                   {{ old('is_active', $infografis->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Tampilkan di halaman publik</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i class="bx bx-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.getElementById('imageInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('imagePreview').src = e.target.result;
                document.getElementById('imagePreviewWrap').classList.remove('d-none');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
