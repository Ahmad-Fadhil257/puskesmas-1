@extends('layouts.admin')

@section('title', 'Tambah Layanan - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Layanan Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Kelola Layanan</a></li>
                    <li class="breadcrumb-item active">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
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

    {{-- Form Card Sneat --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Informasi Layanan Medis</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- Nama Layanan --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" for="title">
                            Nama Layanan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('title') is-invalid @enderror"
                            id="title" name="title"
                            value="{{ old('title') }}"
                            placeholder="Contoh: Konsultasi Kesehatan, Layanan Farmasi..."
                            required />
                        <div class="form-text">Nama atau judul kartu layanan medis.</div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tipe Tampilan / Varian --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" for="variant">
                            Tipe Tampilan Kartu <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('variant') is-invalid @enderror" id="variant" name="variant" required>
                            <option value="default" {{ old('variant', 'default') == 'default' ? 'selected' : '' }}>Standar (Abu-abu / Putih)</option>
                            <option value="featured" {{ old('variant') == 'featured' ? 'selected' : '' }}>Unggulan (Hijau Gelap)</option>
                            <option value="emergency" {{ old('variant') == 'emergency' ? 'selected' : '' }}>Darurat (Merah dengan Tombol)</option>
                        </select>
                        <div class="form-text">Pilih gaya tema visual kartu layanan pada landing page.</div>
                        @error('variant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi Layanan --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="description">
                            Deskripsi Layanan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description"
                            rows="3"
                            placeholder="Tuliskan penjelasan singkat mengenai fasilitas, keunggulan, atau alur layanan ini..."
                            required>{{ old('description') }}</textarea>
                        <div class="form-text">Penjelasan ringkas 1–2 kalimat tentang manfaat layanan.</div>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Divider: Ikon --}}
                    <div class="col-12"><hr class="my-1"></div>

                    {{-- Pilihan Ikon Boxicons --}}
                    <div class="col-md-12">
                        <label class="form-label fw-semibold" for="icon">
                            Pilihan Ikon Layanan <span class="text-danger">*</span>
                        </label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i id="iconPreview" class="{{ old('icon', 'bx bx-plus-medical') }} fs-4"></i></span>
                            <input type="text"
                                class="form-control @error('icon') is-invalid @enderror"
                                id="icon" name="icon"
                                value="{{ old('icon', 'bx bx-plus-medical') }}"
                                placeholder="Contoh: bx bx-pulse"
                                onkeyup="updateIconPreview(this.value)"
                                required />
                        </div>
                        <div class="form-text mb-2">Pilih langsung dari daftar ikon di bawah atau ketik nama kelas icon Boxicons.</div>
                        
                        {{-- Quick Icon Pickers --}}
                        <div class="d-flex flex-wrap gap-1 mt-2">
                            <span class="small text-muted w-100 mb-1">Klik untuk Memilih Ikon Cepat:</span>
                            @php
                                $presetIcons = [
                                    'bx bx-plus-medical', 'bx bx-id-card', 'bx bx-pulse', 'bx bx-capsule', 
                                    'bx bx-shield-alt-2', 'bx bx-phone-call', 'bx bx-first-aid', 'bx bx-band-aid',
                                    'bx bx-dna', 'bx bx-clinic', 'bx bx-heart', 'bx bx-health', 'bx bx-test-tube', 'bx bx-user-voice'
                                ];
                            @endphp
                            @foreach($presetIcons as $pIcon)
                                <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1" onclick="pickIcon('{{ $pIcon }}')" title="{{ $pIcon }}">
                                    <i class="{{ $pIcon }} fs-5"></i>
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Divider: Tombol CTA (Opsional / Emergency) --}}
                    <div class="col-12"><hr class="my-1"></div>

                    {{-- Tombol Text --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_text">
                            Teks Tombol Aksi (Opsional)
                        </label>
                        <input type="text"
                            class="form-control @error('btn_text') is-invalid @enderror"
                            id="btn_text" name="btn_text"
                            value="{{ old('btn_text') }}"
                            placeholder="Contoh: Hubungi Kami, Daftar Sekarang..." />
                        <div class="form-text">Wajib diisi jika memilih tipe kartu <strong>Darurat</strong>.</div>
                        @error('btn_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Link --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_link">
                            Tautan Link Tombol (Opsional)
                        </label>
                        <input type="text"
                            class="form-control @error('btn_link') is-invalid @enderror"
                            id="btn_link" name="btn_link"
                            value="{{ old('btn_link') }}"
                            placeholder="Contoh: #kontak, https://wa.me/..." />
                        <div class="form-text">Tautan anchor atau URL yang dibuka saat tombol diklik.</div>
                        @error('btn_link')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol Simpan --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 mt-2 pt-3 border-top">
                            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Simpan Layanan
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

<script>
function updateIconPreview(val) {
    const preview = document.getElementById('iconPreview');
    if (preview) {
        preview.className = (val.trim() || 'bx bx-plus-medical') + ' fs-4';
    }
}

function pickIcon(iconClass) {
    const input = document.getElementById('icon');
    if (input) {
        input.value = iconClass;
        updateIconPreview(iconClass);
    }
}
</script>

@endsection
