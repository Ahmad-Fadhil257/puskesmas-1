@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Layanan Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Kelola Layanan</a></li>
                    <li class="breadcrumb-item active">Tambah Layanan</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                <i class="bx bx-arrow-back"></i> Kembali
            </a>
        </div>
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

    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            
            {{-- KOLOM KIRI --}}
            <div class="col-lg-7 col-12">

                {{-- Card 1: Identitas & Tampilan Atas Layanan --}}
                <div class="card mb-4">
                    <div class="card-header border-bottom py-3">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bx bx-id-card me-1"></i> 1. Identitas & Header Layanan
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        <div class="row g-3">
                            {{-- Nama Layanan --}}
                            <div class="col-md-8 col-12">
                                <label class="form-label fw-semibold" for="title">
                                    Nama Layanan / Poli <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title"
                                    value="{{ old('title') }}"
                                    placeholder="Contoh: Konsultasi Kesehatan, Poli Umum..."
                                    required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Urutan Tampilan --}}
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold" for="order">
                                    Nomor Urut <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                    class="form-control @error('order') is-invalid @enderror"
                                    id="order" name="order"
                                    value="{{ old('order', $nextOrder) }}"
                                    min="1"
                                    required />
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sub-judul / Tagline Singkat --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="subtitle">
                                    Sub-judul / Tagline Singkat
                                </label>
                                <input type="text"
                                    class="form-control @error('subtitle') is-invalid @enderror"
                                    id="subtitle" name="subtitle"
                                    value="{{ old('subtitle', 'Fasilitas dan tenaga kesehatan profesional siap memberikan pelayanan terbaik untuk kesehatan Anda dan keluarga.') }}"
                                    placeholder="Kalimat pengantar di bawah nama layanan..." />
                                <small class="text-muted">Tampil tepat di bawah nama layanan pada kartu atas.</small>
                            </div>

                            {{-- Pilihan Ikon --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="icon">
                                    Ikon Layanan (Boxicons) <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text"><i id="iconPreview" class="{{ old('icon', 'bx bx-clinic') }} fs-5 text-primary"></i></span>
                                    <input type="text"
                                        class="form-control @error('icon') is-invalid @enderror"
                                        id="icon" name="icon"
                                        value="{{ old('icon', 'bx bx-clinic') }}"
                                        placeholder="Contoh: bx bx-clinic, bx bx-id-card, bx bx-plus-medical..."
                                        oninput="document.getElementById('iconPreview').className = this.value + ' fs-5 text-primary';"
                                        required />
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Preset Ikon Populer (Klik untuk pilih):</small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-clinic')"><i class="bx bx-clinic me-1"></i>Klinik</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-id-card')"><i class="bx bx-id-card me-1"></i>Konsultasi</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-plus-medical')"><i class="bx bx-plus-medical me-1"></i>Medis</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-heart')"><i class="bx bx-heart me-1"></i>Jantung</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-female')"><i class="bx bx-female me-1"></i>KIA/Ibu</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-capsule')"><i class="bx bx-capsule me-1"></i>Farmasi/Obat</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-test-tube')"><i class="bx bx-test-tube me-1"></i>Laboratorium</button>
                                        <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setIconPreset('bx bx-first-aid')"><i class="bx bx-first-aid me-1"></i>UGD</button>
                                    </div>
                                </div>
                            </div>

                            {{-- Foto / Banner Layanan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="image">
                                    Foto / Banner Layanan <small class="text-muted">(Opsional)</small>
                                </label>
                                <input type="file" 
                                    class="form-control @error('image') is-invalid @enderror" 
                                    id="image" name="image" 
                                    accept="image/jpeg,image/png,image/jpg,image/webp">
                                <small class="text-muted d-block mt-1">Unggah foto ruangan atau tim poli (JPG, PNG, WEBP, Maks. 3MB). Jika kosong, kartu atas otomatis memakai ikon & sub-judul standar.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Deskripsi & Ruang Lingkup Layanan --}}
                <div class="card mb-4">
                    <div class="card-header border-bottom py-3">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bx bx-detail me-1"></i> 2. Deskripsi & Ruang Lingkup Layanan
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        <label class="form-label fw-semibold" for="description">
                            Rincian Cakupan Pelayanan <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                            id="description" name="description"
                            rows="4"
                            placeholder="Contoh: Panduan profesional untuk menjaga gaya hidup sehat, mengelola kondisi kronis, dan banyak lagi."
                            required>{{ old('description') }}</textarea>
                        <div class="form-text">Tuliskan penjelasan ruang lingkup layanan yang disediakan bagi pasien.</div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN --}}
            <div class="col-lg-5 col-12">

                {{-- Card 3: Jadwal Operasional Pelayanan --}}
                <div class="card mb-4">
                    <div class="card-header border-bottom py-3">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bx bx-time me-1"></i> 3. Jadwal Operasional Pelayanan
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        {{-- Jadwal Pendaftaran Loket --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="jadwal_pendaftaran">
                                <i class="bx bx-id-card me-1 text-secondary"></i> Jadwal Pendaftaran Loket
                            </label>
                            <textarea class="form-control"
                                id="jadwal_pendaftaran" name="jadwal_pendaftaran"
                                rows="3"
                                placeholder="Senin - Kamis : 07.30 - 12.00 WIB&#10;Jumat : 07.30 - 10.30 WIB&#10;Sabtu : 07.30 - 11.30 WIB">{{ old('jadwal_pendaftaran', "Senin - Kamis : 07.30 - 12.00 WIB\nJumat : 07.30 - 10.30 WIB\nSabtu : 07.30 - 11.30 WIB") }}</textarea>
                            <div class="form-text">Format: <code>Hari : Jam</code> (1 baris per hari).</div>
                        </div>

                        {{-- Jadwal Pemeriksaan Medis --}}
                        <div>
                            <label class="form-label fw-semibold" for="jam_operasional">
                                <i class="bx bx-stethoscope me-1 text-secondary"></i> Jadwal Pemeriksaan Medis
                            </label>
                            <textarea class="form-control"
                                id="jam_operasional" name="jam_operasional"
                                rows="3"
                                placeholder="Senin - Kamis : 08.00 - 14.00 WIB&#10;Jumat : 08.00 - 14.00 WIB&#10;Sabtu : 08.00 - 13.30 WIB">{{ old('jam_operasional', "Senin - Kamis : 08.00 - 14.00 WIB\nJumat : 08.00 - 14.00 WIB\nSabtu : 08.00 - 13.30 WIB") }}</textarea>
                            <div class="form-text">Format: <code>Hari : Jam</code> (1 baris per hari).</div>
                        </div>
                    </div>
                </div>

                {{-- Card 4: Persyaratan Berobat Pasien --}}
                <div class="card mb-4">
                    <div class="card-header border-bottom py-3">
                        <h6 class="mb-0 fw-bold text-primary">
                            <i class="bx bx-info-circle me-1"></i> 4. Persyaratan Berobat Pasien
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        <label class="form-label fw-semibold" for="persyaratan">
                            Persyaratan Berobat Umum / BPJS
                        </label>
                        <textarea class="form-control"
                            id="persyaratan" name="persyaratan"
                            rows="3"
                            placeholder="Membawa KTP / Kartu Keluarga (KK), Kartu Indonesia Sehat (KIS/BPJS) aktif bagi peserta jaminan kesehatan, serta Kartu Rekam Medis Puskesmas bagi pasien ulangan.">{{ old('persyaratan', 'Membawa KTP / Kartu Keluarga (KK), Kartu Indonesia Sehat (KIS/BPJS) aktif bagi peserta jaminan kesehatan, serta Kartu Rekam Medis Puskesmas bagi pasien ulangan.') }}</textarea>
                        <div class="form-text">Tuliskan dokumen persyaratan yang perlu dibawa pasien. Kontak WhatsApp pendaftaran otomatis terhubung dengan nomor resmi Puskesmas di menu Identitas & Logo.</div>
                    </div>
                </div>

                {{-- Tombol Simpan --}}
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Simpan Layanan
                    </button>
                </div>

            </div>

        </div>
    </form>

@push('scripts')
<script>
    function setIconPreset(val) {
        document.getElementById('icon').value = val;
        document.getElementById('iconPreview').className = val + ' fs-5 text-primary';
    }
</script>
@endpush
@endsection
