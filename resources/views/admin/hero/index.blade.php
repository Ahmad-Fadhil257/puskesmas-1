@extends('layouts.admin')

@section('title', 'Kelola Hero Section & Fitur - Puskesmas CareLink')

@section('content')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-layout me-2"></i>Kelola Hero Section & Fitur Keunggulan
            </h4>
            <p class="text-muted mb-0">Atur konten banner utama (headline, deskripsi, foto grid) dan 3 kartu info keunggulan di landing page.</p>
        </div>
        <div>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-show"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- Nav Tabs Sneat --}}
    <div class="nav-align-top mb-4">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <button type="button" class="nav-link active fw-semibold" role="tab" data-bs-toggle="tab" data-bs-target="#tab-hero" aria-controls="tab-hero" aria-selected="true">
                    <i class="bx bx-image-alt me-1"></i> 1. Banner Utama Hero Section
                </button>
            </li>
            <li class="nav-item">
                <button type="button" class="nav-link fw-semibold" role="tab" data-bs-toggle="tab" data-bs-target="#tab-cards" aria-controls="tab-cards" aria-selected="false">
                    <i class="bx bx-grid-alt me-1"></i> 2. Tiga Kartu Keunggulan (Info Cards)
                </button>
            </li>
        </ul>

        <div class="tab-content border-0 p-0 pt-4">

            {{-- TAB 1: HERO SECTION FORM --}}
            <div class="tab-pane fade show active" id="tab-hero" role="tabpanel">
                <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4">
                        {{-- Kolom Kiri: Teks & Tombol --}}
                        <div class="col-lg-7">
                            <div class="card h-100">
                                <div class="card-header border-bottom py-3">
                                    <h5 class="mb-0 fw-bold"><i class="bx bx-edit-alt me-2 text-primary"></i>Teks & Tombol Hero</h5>
                                </div>
                                <div class="card-body pt-4">
                                    {{-- Badge Teks --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="badge_text">Teks Badge Sambutan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('badge_text') is-invalid @enderror" id="badge_text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" required placeholder="Contoh: Selamat Datang Di Puskesmas CareLink">
                                        @error('badge_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Judul Utama (H1) --}}
                                    <div class="mb-3">
                                        <label class="form-label fw-semibold" for="title">Judul Utama Banner (Headline H1) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $hero->title) }}" required placeholder="Contoh: Melayani Kesehatan Masyarakat dengan Sepenuh Hati">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold" for="description">Deskripsi Penjelasan</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Jelaskan pelayanan dan komitmen puskesmas...">{{ old('description', $hero->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <h6 class="fw-bold text-dark border-top pt-3 mb-3">Pengaturan Dua Tombol Aksi (CTA)</h6>

                                    <div class="row g-3">
                                        {{-- Tombol Utama (Hijau/Oranye) --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="btn_primary_text">Label Tombol 1 (Utama) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_primary_text" name="btn_primary_text" value="{{ old('btn_primary_text', $hero->btn_primary_text) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="btn_primary_link">Tautan / Link Tombol 1 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_primary_link" name="btn_primary_link" value="{{ old('btn_primary_link', $hero->btn_primary_link) }}" required>
                                        </div>

                                        {{-- Tombol Kedua (Sekunder) --}}
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="btn_secondary_text">Label Tombol 2 (Sekunder) <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_secondary_text" name="btn_secondary_text" value="{{ old('btn_secondary_text', $hero->btn_secondary_text) }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold" for="btn_secondary_link">Tautan / Link Tombol 2 <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="btn_secondary_link" name="btn_secondary_link" value="{{ old('btn_secondary_link', $hero->btn_secondary_link) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Kolom Kanan: 4 Foto Grid Hero --}}
                        <div class="col-lg-5">
                            <div class="card h-100">
                                <div class="card-header border-bottom py-3">
                                    <h5 class="mb-0 fw-bold"><i class="bx bx-images me-2 text-primary"></i>4 Foto Grid Banner</h5>
                                </div>
                                <div class="card-body pt-4">
                                    <p class="text-muted small mb-3">Unggah gambar baru untuk mengganti foto stagger di hero (Format: JPG/PNG/WEBP, Maks: 3MB per foto).</p>

                                    <div class="row g-3">
                                        {{-- Foto 1 (Baris Atas Kiri) --}}
                                        <div class="col-6">
                                            <label class="form-label fw-semibold small">Foto 1 (Atas-Kiri)</label>
                                            <div class="mb-2 text-center bg-light rounded p-1 border">
                                                <img id="preview-img-1" src="{{ $hero->image_1_url }}" alt="Foto 1" class="img-fluid rounded" style="height: 90px; object-fit: cover; width: 100%;">
                                            </div>
                                            <input type="file" name="image_1" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-img-1')">
                                        </div>

                                        {{-- Foto 2 (Baris Atas Kanan) --}}
                                        <div class="col-6">
                                            <label class="form-label fw-semibold small">Foto 2 (Atas-Kanan)</label>
                                            <div class="mb-2 text-center bg-light rounded p-1 border">
                                                <img id="preview-img-2" src="{{ $hero->image_2_url }}" alt="Foto 2" class="img-fluid rounded" style="height: 90px; object-fit: cover; width: 100%;">
                                            </div>
                                            <input type="file" name="image_2" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-img-2')">
                                        </div>

                                        {{-- Foto 3 (Baris Bawah Kiri) --}}
                                        <div class="col-6">
                                            <label class="form-label fw-semibold small">Foto 3 (Bawah-Kiri)</label>
                                            <div class="mb-2 text-center bg-light rounded p-1 border">
                                                <img id="preview-img-3" src="{{ $hero->image_3_url }}" alt="Foto 3" class="img-fluid rounded" style="height: 90px; object-fit: cover; width: 100%;">
                                            </div>
                                            <input type="file" name="image_3" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-img-3')">
                                        </div>

                                        {{-- Foto 4 (Baris Bawah Kanan) --}}
                                        <div class="col-6">
                                            <label class="form-label fw-semibold small">Foto 4 (Bawah-Kanan)</label>
                                            <div class="mb-2 text-center bg-light rounded p-1 border">
                                                <img id="preview-img-4" src="{{ $hero->image_4_url }}" alt="Foto 4" class="img-fluid rounded" style="height: 90px; object-fit: cover; width: 100%;">
                                            </div>
                                            <input type="file" name="image_4" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-img-4')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan Hero
                            </button>
                        </div>
                    </div>
                </form>
            </div>


            {{-- TAB 2: TIGA KARTU KEUNGGULAN (INFO CARDS) --}}
            <div class="tab-pane fade" id="tab-cards" role="tabpanel">

                {{-- Live Visual Preview Box (Persis Seperti di Screenshot User) --}}
                <div class="card mb-4 border" style="background-color: #E8F5EE;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="badge bg-primary text-white px-3 py-2 rounded-pill fw-bold">
                                <i class="bx bx-show me-1"></i> Preview Tampilan di Landing Page:
                            </span>
                            <small class="text-muted fw-semibold">Diperbarui otomatis sesuai data di bawah</small>
                        </div>

                        <div class="row g-3">
                            @foreach ($infoCards as $card)
                                <div class="col-md-4">
                                    <div class="p-3 rounded-4 h-100 shadow-sm d-flex align-items-center gap-3 transition-all"
                                         style="{{ $card->is_featured ? 'background-color: #006648; color: #FFFFFF;' : 'background-color: #FFFFFF; color: #1E293B;' }}; border-radius: 16px;">
                                        
                                        {{-- Icon Circle --}}
                                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                                             style="width: 48px; height: 48px; {{ $card->is_featured ? 'background-color: rgba(255,255,255,0.2); color: #FFFFFF;' : 'background-color: #E6F5F1; color: #0A5C45;' }}">
                                            @if($card->icon == 'doctor')
                                                <i class="bx bx-user fs-4"></i>
                                            @elseif($card->icon == 'emergency')
                                                <i class="bx bx-plus-medical fs-4"></i>
                                            @elseif($card->icon == 'clock')
                                                <i class="bx bx-time fs-4"></i>
                                            @elseif($card->icon == 'shield')
                                                <i class="bx bx-shield-quarter fs-4"></i>
                                            @else
                                                <i class="bx bx-check-circle fs-4"></i>
                                            @endif
                                        </div>

                                        {{-- Body --}}
                                        <div>
                                            <h6 class="fw-bold mb-1 {{ $card->is_featured ? 'text-white' : 'text-dark' }}">{{ $card->title }}</h6>
                                            <small class="{{ $card->is_featured ? 'text-white-50' : 'text-muted' }} d-block" style="font-size: 0.82rem; line-height: 1.35;">
                                                {{ $card->description }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Form Edit Masing-Masing Kartu --}}
                <div class="row g-4">
                    @foreach ($infoCards as $index => $card)
                        <div class="col-lg-4">
                            <div class="card h-100 shadow-sm border {{ $card->is_featured ? 'border-primary' : '' }}">
                                <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center {{ $card->is_featured ? 'bg-label-primary' : '' }}">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="bx bx-credit-card-front me-1"></i> Kartu #{{ $card->urutan }}
                                    </h6>
                                    @if($card->is_featured)
                                        <span class="badge bg-primary text-white">Featured (Hijau Gelap)</span>
                                    @else
                                        <span class="badge bg-label-secondary">Kartu Putih</span>
                                    @endif
                                </div>

                                <div class="card-body pt-3">
                                    <form action="{{ route('admin.hero.update-card', $card->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="urutan" value="{{ $card->urutan }}">

                                        {{-- Judul Kartu --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Judul Kartu <span class="text-danger">*</span></label>
                                            <input type="text" name="title" class="form-control form-control-sm" value="{{ old('title', $card->title) }}" required>
                                        </div>

                                        {{-- Deskripsi Kartu --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Deskripsi Singkat <span class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control form-control-sm" rows="3" required>{{ old('description', $card->description) }}</textarea>
                                        </div>

                                        {{-- Ikon --}}
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold small">Pilihan Ikon</label>
                                            <select name="icon" class="form-select form-select-sm">
                                                <option value="doctor" {{ $card->icon == 'doctor' ? 'selected' : '' }}>Dokter / Tenaga Medis (bx-user)</option>
                                                <option value="emergency" {{ $card->icon == 'emergency' ? 'selected' : '' }}>Gawat Darurat / Plus (bx-plus-medical)</option>
                                                <option value="clock" {{ $card->icon == 'clock' ? 'selected' : '' }}>Waktu 24 Jam (bx-time)</option>
                                                <option value="shield" {{ $card->icon == 'shield' ? 'selected' : '' }}>Perlindungan / BPJS (bx-shield)</option>
                                                <option value="heart" {{ $card->icon == 'heart' ? 'selected' : '' }}>Kesehatan Hati (bx-heart)</option>
                                            </select>
                                        </div>

                                        {{-- Checkbox Highlight Featured --}}
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured-{{ $card->id }}" {{ $card->is_featured ? 'checked' : '' }}>
                                            <label class="form-check-label small fw-semibold" for="featured-{{ $card->id }}">
                                                Mode Highlight (Warna Hijau Gelap)
                                            </label>
                                        </div>

                                        <div class="text-end pt-2 border-top">
                                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                                <i class="bx bx-save me-1"></i> Simpan Kartu #{{ $card->urutan }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
    </div>

@push('scripts')
<script>
    // Live Image Preview Helper
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush

@endsection
