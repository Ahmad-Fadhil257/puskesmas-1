@extends('layouts.admin')

@section('title', 'Tambah Infografis')

@section('content')
<div class="content-wrapper" style="max-width:720px;">

    <div class="mb-4">
        <a href="{{ route('admin.infografis.index') }}" class="btn btn-sm btn-outline-secondary d-inline-flex align-items-center gap-1 mb-3">
            <i class="bx bx-arrow-back"></i> Kembali
        </a>
        <h4 class="fw-bold mb-0" style="color:#111827;">Tambah Infografis</h4>
        <p class="text-muted mb-0 small">Unggah gambar infografis kesehatan untuk ditampilkan di halaman publik.</p>
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
            <form action="{{ route('admin.infografis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Judul Infografis <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" placeholder="Contoh: Cara Mencuci Tangan yang Benar" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <select name="kategori" id="kategoriSelect" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="">-- Pilih atau Ketik Kategori --</option>
                            <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum</option>
                            <option value="Kesehatan Ibu & Anak" {{ old('kategori') == 'Kesehatan Ibu & Anak' ? 'selected' : '' }}>Kesehatan Ibu & Anak</option>
                            <option value="Gizi & Nutrisi" {{ old('kategori') == 'Gizi & Nutrisi' ? 'selected' : '' }}>Gizi & Nutrisi</option>
                            <option value="Penyakit Menular" {{ old('kategori') == 'Penyakit Menular' ? 'selected' : '' }}>Penyakit Menular</option>
                            <option value="Hidup Sehat" {{ old('kategori') == 'Hidup Sehat' ? 'selected' : '' }}>Hidup Sehat</option>
                            <option value="Statistik Pelayanan" {{ old('kategori') == 'Statistik Pelayanan' ? 'selected' : '' }}>Statistik Pelayanan</option>
                            <option value="Program Kesehatan" {{ old('kategori') == 'Program Kesehatan' ? 'selected' : '' }}>Program Kesehatan</option>
                            <option value="custom">+ Kategori Lain...</option>
                        </select>
                        <input type="text" id="kategoriCustom" name="kategori_custom"
                               class="form-control d-none" placeholder="Ketik kategori baru">
                    </div>
                    @error('kategori') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Deskripsi Singkat</label>
                    <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Deskripsi singkat isi infografis (opsional, maks. 500 karakter)...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gambar Infografis <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="imageInput"
                           class="form-control @error('image') is-invalid @enderror"
                           accept="image/jpeg,image/png,image/webp" required>
                    <div class="form-text">Format: JPG, PNG, WebP. Maks. 5 MB. Disarankan resolusi tinggi (min. 800px).</div>
                    @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    {{-- Preview --}}
                    <div id="imagePreviewWrap" class="mt-3 d-none">
                        <img id="imagePreview" src="" alt="Preview" style="max-height:280px;border-radius:10px;border:1px solid #e5e7eb;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-semibold">Urutan Tampil</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}" min="0">
                        <div class="form-text">Angka kecil tampil lebih dahulu.</div>
                    </div>
                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="form-check form-switch mb-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                                   {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Tampilkan di halaman publik</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-2">
                    <button type="submit" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i class="bx bx-save"></i> Simpan Infografis
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
    // Preview gambar
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

    // Toggle kategori custom
    document.getElementById('kategoriSelect').addEventListener('change', function() {
        const custom = document.getElementById('kategoriCustom');
        if (this.value === 'custom') {
            custom.classList.remove('d-none');
            custom.required = true;
            this.name = '';
            custom.name = 'kategori';
        } else {
            custom.classList.add('d-none');
            custom.required = false;
            custom.name = 'kategori_custom';
            this.name = 'kategori';
        }
    });
</script>
@endpush
