@extends('layouts.admin')

@section('title', 'Edit Infografis - ' . $infografis->title)

@section('content')

    {{-- Breadcrumb & Page Header (Sneat Standard) --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-edit-alt me-2"></i>Edit Data Infografis
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.infografis.index') }}">Infografis</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                <i class="bx bx-arrow-back"></i>
                <span>Kembali ke Daftar</span>
            </a>
        </div>
    </div>

    {{-- Alert Error Messages --}}
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center mb-1">
                <i class="bx bx-error-circle fs-4 me-2"></i>
                <strong>Periksa Isian Formulir:</strong>
            </div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Form Card (Sneat Vertical Layout) --}}
    <div class="row">
        <div class="col-xl-9 col-lg-10 mx-auto">
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header d-flex justify-content-between align-items-center border-bottom pb-3">
                    <h5 class="mb-0 fw-bold"><i class="bx bx-image-alt me-2 text-primary"></i>Perbarui Data Infografis</h5>
                    <span class="badge {{ $infografis->is_active ? 'bg-label-success' : 'bg-label-secondary' }}">
                        {{ $infografis->is_active ? 'Status: Aktif' : 'Status: Nonaktif' }}
                    </span>
                </div>
                <div class="card-body pt-4">
                    <form action="{{ route('admin.infografis.update', $infografis) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Judul Infografis --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="title">Judul Infografis <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-heading"></i></span>
                                <input type="text" 
                                       name="title" 
                                       id="title" 
                                       class="form-control @error('title') is-invalid @enderror"
                                       value="{{ old('title', $infografis->title) }}" 
                                       placeholder="Contoh: 6 Langkah Cara Mencuci Tangan yang Benar" 
                                       required>
                            </div>
                            @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="kategoriSelect">Kategori Infografis <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text"><i class="bx bx-category"></i></span>
                                <select name="kategori" id="kategoriSelect" class="form-select @error('kategori') is-invalid @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    @php
                                        $standardCats = [
                                            'Umum' => 'Umum & Pencegahan Penyakit',
                                            'Kesehatan Ibu & Anak' => 'Kesehatan Ibu & Anak (KIA)',
                                            'Gizi & Nutrisi' => 'Gizi & Pola Makan Sehat',
                                            'Penyakit Menular' => 'Pencegahan Penyakit Menular',
                                            'Hidup Sehat' => 'Gerakan Masyarakat Hidup Sehat (GERMAS)',
                                            'Statistik Pelayanan' => 'Statistik & Indikator Pelayanan',
                                        ];
                                        $currentCat = old('kategori', $infografis->kategori);
                                        $isCustom = !array_key_exists($currentCat, $standardCats) && !empty($currentCat);
                                    @endphp
                                    @foreach($standardCats as $val => $label)
                                        <option value="{{ $val }}" {{ $currentCat == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                    @if($isCustom)
                                        <option value="{{ $currentCat }}" selected>{{ $currentCat }} (Kategori Tersimpan)</option>
                                    @endif
                                    <option value="custom">+ Kategori Lainnya...</option>
                                </select>
                            </div>
                            <div id="customKategoriWrap" class="mt-2 d-none">
                                <input type="text" id="kategoriCustom" name="kategori_custom"
                                       class="form-control" placeholder="Ketik nama kategori baru di sini...">
                            </div>
                            @error('kategori') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="deskripsi">Deskripsi Singkat / Catatan</label>
                            <textarea name="deskripsi" 
                                      id="deskripsi" 
                                      rows="3" 
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      placeholder="Ringkasan penjelasan mengenai infografis ini (opsional, maks. 500 karakter)...">{{ old('deskripsi', $infografis->deskripsi) }}</textarea>
                            <div class="form-text">Beri keterangan singkat agar masyarakat lebih memahami konteks infografis.</div>
                            @error('deskripsi') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                        </div>

                        {{-- Gambar Saat Ini & Upload Baru --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold" for="imageInput">File Gambar Infografis</label>
                            
                            {{-- Current Image Display --}}
                            <div class="d-flex align-items-center gap-3 p-3 bg-light border rounded mb-2">
                                <img src="{{ $infografis->image_url }}" alt="Saat Ini" 
                                     style="max-height: 100px; max-width: 120px; border-radius: 6px; object-fit: contain;"
                                     onerror="this.src='{{ asset('admin-assets/images/placeholder.png') }}'">
                                <div>
                                    <span class="fw-semibold text-dark d-block">Gambar Sedang Digunakan</span>
                                    <small class="text-muted">Pilih file baru di bawah ini hanya jika Anda ingin menggantinya.</small>
                                </div>
                            </div>

                            <input type="file" 
                                   name="image" 
                                   id="imageInput"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/webp">
                            <div class="form-text">Mendukung format JPG, PNG, atau WebP. Maks. 5 MB.</div>
                            @error('image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            
                            {{-- Live Image Preview --}}
                            <div id="imagePreviewWrap" class="mt-3 d-none">
                                <span class="d-block small text-muted mb-1">Pratinjau Gambar Baru:</span>
                                <div class="p-2 border rounded bg-light d-inline-block">
                                    <img id="imagePreview" src="" alt="Pratinjau" style="max-height: 260px; max-width: 100%; border-radius: 6px; object-fit: contain;">
                                </div>
                            </div>
                        </div>

                        {{-- Urutan & Status Switch --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold" for="order">Nomor Urutan Tampil</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="bx bx-sort"></i></span>
                                    <input type="number" 
                                           name="order" 
                                           id="order" 
                                           class="form-control" 
                                           value="{{ old('order', $infografis->order) }}" 
                                           min="0">
                                </div>
                                <div class="form-text">Angka lebih kecil (misal 0, 1) akan tampil paling awal.</div>
                            </div>
                            <div class="col-md-6 d-flex align-items-end">
                                <div class="card bg-lighter border-0 p-3 w-100 mb-2">
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_active" 
                                               id="isActive" 
                                               value="1"
                                               {{ old('is_active', $infografis->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="isActive">
                                            Status Publikasi Aktif
                                        </label>
                                    </div>
                                    <small class="text-muted ms-4 ps-1 d-block">Tampilkan langsung pada galeri infografis publik.</small>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="pt-3 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-xs">
                                <i class="bx bx-save"></i>
                                <span>Perbarui Infografis</span>
                            </button>
                            <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Preview gambar terpilih baru
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
        const wrap = document.getElementById('customKategoriWrap');
        const customInput = document.getElementById('kategoriCustom');
        if (this.value === 'custom') {
            wrap.classList.remove('d-none');
            customInput.required = true;
            this.name = '';
            customInput.name = 'kategori';
            customInput.focus();
        } else {
            wrap.classList.add('d-none');
            customInput.required = false;
            customInput.name = 'kategori_custom';
            this.name = 'kategori';
        }
    });
</script>
@endpush
