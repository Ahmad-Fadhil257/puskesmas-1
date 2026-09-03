@extends('layouts.admin')

@section('title', 'Kelola Hero & Fitur - Puskesmas')

@section('content')

    {{-- Breadcrumb & Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-layout me-2"></i>Kelola Hero Section & Fitur
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Hero Section & Fitur</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- CARD 1: BANNER UTAMA HERO SECTION --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">
                <i class="bx bx-slider-alt me-2 text-primary"></i>Konten Banner Utama Hero
            </h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">
                    {{-- Teks Badge --}}
                    <div class="col-md-4">
                        <label class="form-label fw-semibold" for="badge_text">Teks Badge Sambutan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('badge_text') is-invalid @enderror" id="badge_text" name="badge_text" value="{{ old('badge_text', $hero->badge_text) }}" required placeholder="Contoh: Selamat Datang Di Puskesmas">
                        @error('badge_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul Utama (H1) --}}
                    <div class="col-md-8">
                        <label class="form-label fw-semibold" for="title">Judul Utama Banner (Headline H1) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $hero->title) }}" required placeholder="Contoh: Melayani Kesehatan Masyarakat dengan Sepenuh Hati">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <label class="form-label fw-semibold" for="description">Deskripsi Penjelasan <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required placeholder="Jelaskan komitmen pelayanan puskesmas...">{{ old('description', $hero->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Section Divider --}}
                    <div class="col-12 pt-2">
                        <div class="divider text-start my-2">
                            <div class="divider-text fw-bold text-dark">PENGATURAN TOMBOL AKSI (CALL TO ACTION)</div>
                        </div>
                    </div>

                    {{-- Tombol 1 (Utama) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_primary_text">Label Tombol 1 (Utama) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="btn_primary_text" name="btn_primary_text" value="{{ old('btn_primary_text', $hero->btn_primary_text) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_primary_link">Tautan / Link Tombol 1 <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="btn_primary_link" name="btn_primary_link" value="{{ old('btn_primary_link', $hero->btn_primary_link) }}" required>
                    </div>

                    {{-- Tombol 2 (Sekunder) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_secondary_text">Label Tombol 2 (Sekunder) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="btn_secondary_text" name="btn_secondary_text" value="{{ old('btn_secondary_text', $hero->btn_secondary_text) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="btn_secondary_link">Tautan / Link Tombol 2 <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="btn_secondary_link" name="btn_secondary_link" value="{{ old('btn_secondary_link', $hero->btn_secondary_link) }}" required>
                        <div class="form-text small">Default: <code>#layanan</code> atau <code>/layanan</code> (otomatis membuka halaman informasi poliklinik).</div>
                    </div>

                    {{-- Section Divider Foto Grid --}}
                    <div class="col-12 pt-2">
                        <div class="divider text-start my-2">
                            <div class="divider-text fw-bold text-dark">4 FOTO GRID BANNER (STAGGERED IMAGES)</div>
                        </div>
                    </div>

                    {{-- 4 Foto Grid --}}
                    <div class="col-md-3 col-6">
                        <div class="card border p-2 h-100 text-center">
                            <label class="form-label fw-semibold small mb-2">Foto 1 (Atas Kiri)</label>
                            <img id="preview-1" src="{{ $hero->image_1_url }}" alt="Foto 1" class="rounded mb-2 img-fluid" style="height: 100px; width: 100%; object-fit: cover;">
                            <input type="file" name="image_1" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-1')">
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card border p-2 h-100 text-center">
                            <label class="form-label fw-semibold small mb-2">Foto 2 (Atas Kanan)</label>
                            <img id="preview-2" src="{{ $hero->image_2_url }}" alt="Foto 2" class="rounded mb-2 img-fluid" style="height: 100px; width: 100%; object-fit: cover;">
                            <input type="file" name="image_2" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-2')">
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card border p-2 h-100 text-center">
                            <label class="form-label fw-semibold small mb-2">Foto 3 (Bawah Kiri)</label>
                            <img id="preview-3" src="{{ $hero->image_3_url }}" alt="Foto 3" class="rounded mb-2 img-fluid" style="height: 100px; width: 100%; object-fit: cover;">
                            <input type="file" name="image_3" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-3')">
                        </div>
                    </div>

                    <div class="col-md-3 col-6">
                        <div class="card border p-2 h-100 text-center">
                            <label class="form-label fw-semibold small mb-2">Foto 4 (Bawah Kanan)</label>
                            <img id="preview-4" src="{{ $hero->image_4_url }}" alt="Foto 4" class="rounded mb-2 img-fluid" style="height: 100px; width: 100%; object-fit: cover;">
                            <input type="file" name="image_4" class="form-control form-control-sm" accept="image/*" onchange="previewImage(this, 'preview-4')">
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan Hero
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- CARD 2: TIGA KARTU KEUNGGULAN (INFO CARDS) DENGAN TABEL SNEAT --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">
                <i class="bx bx-grid-alt me-2 text-primary"></i>Daftar Tiga Kartu Keunggulan (Info Cards)
            </h5>
            <small class="text-muted">3 Kartu fitur di bawah banner hero</small>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 80px;" class="text-center">Urutan</th>
                        <th style="width: 100px;" class="text-center">Ikon</th>
                        <th style="width: 240px;">Judul Kartu</th>
                        <th>Deskripsi</th>
                        <th style="width: 170px;" class="text-center">Tipe Tampilan</th>
                        <th style="width: 100px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($infoCards as $card)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-label-primary fw-bold fs-6 rounded-pill px-3 py-2">
                                    Kartu #{{ $card->urutan }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="avatar-initial rounded-circle bg-label-primary p-2 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    @php
                                        $iconMap = [
                                            'doctor' => 'bx bx-user',
                                            'emergency' => 'bx bx-plus-medical',
                                            'clock' => 'bx bx-time',
                                            'shield' => 'bx bx-shield-quarter',
                                            'heart' => 'bx bx-heart',
                                        ];
                                        $iconClass = $iconMap[$card->icon] ?? 'bx bx-heart';
                                    @endphp
                                    <i class="{{ $iconClass }} fs-4"></i>
                                </span>
                            </td>
                            <td>
                                <strong class="text-dark fs-6">{{ $card->title }}</strong>
                            </td>
                            <td>
                                <p class="text-muted mb-0 text-wrap" style="max-width: 450px; line-height: 1.45;">
                                    {{ $card->description }}
                                </p>
                            </td>
                            <td class="text-center">
                                @if($card->is_featured)
                                    <span class="badge bg-primary text-white px-3 py-2 rounded-pill">
                                        <i class="bx bx-star me-1"></i> Highlight (Hijau Gelap)
                                    </span>
                                @else
                                    <span class="badge bg-label-secondary px-3 py-2 rounded-pill">
                                        Standar (Putih)
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditCard-{{ $card->id }}" title="Edit Kartu">
                                    <i class="bx bx-edit-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- SNEAT MODALS: EDIT UNTUK SETIAP KARTU KEUNGGULAN --}}
    @foreach ($infoCards as $card)
        <div class="modal fade" id="modalEditCard-{{ $card->id }}" tabindex="-1" aria-labelledby="modalLabel-{{ $card->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.hero.update-card', $card->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="urutan" value="{{ $card->urutan }}">

                        <div class="modal-header border-bottom py-3">
                            <h5 class="modal-title fw-bold" id="modalLabel-{{ $card->id }}">
                                <i class="bx bx-edit me-1 text-primary"></i> Edit Kartu #{{ $card->urutan }}: {{ $card->title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Judul Kartu <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $card->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Deskripsi Singkat <span class="text-danger">*</span></label>
                                <textarea name="description" class="form-control" rows="3" required>{{ old('description', $card->description) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Pilihan Ikon</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text">
                                        @if($card->icon == 'doctor')
                                            <i class="bx bx-user fs-4"></i>
                                        @elseif($card->icon == 'emergency')
                                            <i class="bx bx-plus-medical fs-4"></i>
                                        @elseif($card->icon == 'clock')
                                            <i class="bx bx-time fs-4"></i>
                                        @elseif($card->icon == 'shield')
                                            <i class="bx bx-shield-quarter fs-4"></i>
                                        @else
                                            <i class="bx bx-heart fs-4"></i>
                                        @endif
                                    </span>
                                    <input type="hidden" name="icon" value="{{ $card->icon }}" id="iconInput-{{ $card->id }}">
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="small text-muted w-100 mb-1">Klik untuk Memilih Ikon:</span>
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1 icon-pick-btn {{ $card->icon == 'doctor' ? 'active' : '' }}" data-card="{{ $card->id }}" data-icon="doctor" onclick="pickHeroIcon('{{ $card->id }}', 'doctor', this)" title="Dokter / Tenaga Medis">
                                        <i class="bx bx-user fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1 icon-pick-btn {{ $card->icon == 'emergency' ? 'active' : '' }}" data-card="{{ $card->id }}" data-icon="emergency" onclick="pickHeroIcon('{{ $card->id }}', 'emergency', this)" title="Pelayanan Gawat Darurat">
                                        <i class="bx bx-plus-medical fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1 icon-pick-btn {{ $card->icon == 'clock' ? 'active' : '' }}" data-card="{{ $card->id }}" data-icon="clock" onclick="pickHeroIcon('{{ $card->id }}', 'clock', this)" title="24/7 Siap Melayani">
                                        <i class="bx bx-time fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1 icon-pick-btn {{ $card->icon == 'shield' ? 'active' : '' }}" data-card="{{ $card->id }}" data-icon="shield" onclick="pickHeroIcon('{{ $card->id }}', 'shield', this)" title="Perlindungan & BPJS">
                                        <i class="bx bx-shield-quarter fs-5"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 py-1 icon-pick-btn {{ $card->icon == 'heart' ? 'active' : '' }}" data-card="{{ $card->id }}" data-icon="heart" onclick="pickHeroIcon('{{ $card->id }}', 'heart', this)" title="Kesehatan Prima">
                                        <i class="bx bx-heart fs-5"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="form-check form-switch pt-2">
                                <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featuredSwitch-{{ $card->id }}" {{ $card->is_featured ? 'checked' : '' }}>
                                <label class="form-check-label fw-semibold" for="featuredSwitch-{{ $card->id }}">
                                    Jadikan Kartu Highlight (Background Hijau Gelap)
                                </label>
                            </div>
                        </div>

                        <div class="modal-footer border-top py-2">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@push('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    const heroIconMap = {
        'doctor': 'bx bx-user',
        'emergency': 'bx bx-plus-medical',
        'clock': 'bx bx-time',
        'shield': 'bx bx-shield-quarter',
        'heart': 'bx bx-heart',
    };

    function pickHeroIcon(cardId, iconKey, btn) {
        const input = document.getElementById('iconInput-' + cardId);
        if (input) input.value = iconKey;

        const btns = btn.parentElement.querySelectorAll('.icon-pick-btn');
        btns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const span = btn.closest('.mb-3').querySelector('.input-group-text i');
        if (span) span.className = (heroIconMap[iconKey] || 'bx bx-heart') + ' fs-4';
    }
</script>
@endpush

@endsection
