@extends('layouts.admin')

@section('title', 'Edit Layanan - ' . $layanan->title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-edit-alt me-2"></i>Edit Layanan: {{ $layanan->title }}
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Kelola Layanan</a></li>
                    <li class="breadcrumb-item active">Edit Layanan</li>
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

    <form action="{{ route('admin.layanan.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-4">
            
            {{-- KOLOM KIRI: Informasi Utama Layanan, Kategori, & Jam Operasional --}}
            <div class="col-lg-7 col-12">

                {{-- Card 1: Informasi Utama --}}
                <div class="card mb-4 shadow-sm border">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">
                            <i class="bx bx-info-circle me-1 text-primary"></i> 1. Informasi Utama Layanan / Poli
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
                                    value="{{ old('title', $layanan->title) }}"
                                    required />
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Urutan Tampilan --}}
                            <div class="col-md-4 col-12">
                                <label class="form-label fw-semibold" for="order">
                                    Urutan Tampilan <span class="text-danger">*</span>
                                </label>
                                <input type="number"
                                    class="form-control @error('order') is-invalid @enderror"
                                    id="order" name="order"
                                    value="{{ old('order', $layanan->order ?? 1) }}"
                                    min="1"
                                    required />
                                <small class="text-muted">Posisi nomor urut card.</small>
                                @error('order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Kategori Layanan (Membungkus Label & Tipe Tampilan) --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="kategori">
                                    Kategori Layanan <span class="text-danger">*</span>
                                </label>
                                <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                    <option value="">-- Pilih Kategori Layanan --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ old('kategori', $layanan->kategori ?? 'Rawat Jalan (BPJS & Umum)') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text">Kategori ini otomatis mengatur warna kartu, label jaminan, dan badge modal pasien.</div>
                                @error('kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Deskripsi Layanan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="description">
                                    Deskripsi Singkat Pelayanan <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description"
                                    rows="3"
                                    required>{{ old('description', $layanan->description) }}</textarea>
                                <div class="form-text">Deskripsi yang akan dibaca pasien di kartu layanan.</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ikon Layanan --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="icon">
                                    Ikon Layanan <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light" id="icon-preview">
                                        <i class="{{ old('icon', $layanan->icon ?? 'bx bx-plus-medical') }} text-primary fs-5"></i>
                                    </span>
                                    <input type="text"
                                        class="form-control @error('icon') is-invalid @enderror"
                                        id="icon" name="icon"
                                        value="{{ old('icon', $layanan->icon ?? 'bx bx-plus-medical') }}"
                                        required />
                                </div>
                                <div class="mt-2">
                                    <small class="text-muted d-block mb-1">Pilihan Cepat Ikon Medis:</small>
                                    <div class="d-flex flex-wrap gap-1">
                                        @php
                                            $sampleIcons = ['bx bx-plus-medical', 'bx bx-pulse', 'bx bx-capsule', 'bx bx-injection', 'bx bx-face', 'bx bx-shield-plus', 'bx bx-time-five', 'bx bx-first-aid', 'bx bx-dna', 'bx bx-heart', 'bx bx-asterisk', 'bx bx-phone-call'];
                                        @endphp
                                        @foreach($sampleIcons as $sIcon)
                                            <button type="button" class="btn btn-sm btn-outline-secondary py-1 px-2 icon-picker-btn" onclick="selectIcon('{{ $sIcon }}')">
                                                <i class="{{ $sIcon }}"></i>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                                @error('icon')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Slug URL --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="slug">
                                    Slug URL <small class="text-muted">(Otomatis/Bisa Disesuaikan)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted">/layanan/</span>
                                    <input type="text"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        id="slug" name="slug"
                                        value="{{ old('slug', $layanan->slug) }}"
                                        placeholder="contoh-nama-layanan" />
                                </div>
                                @error('slug')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Foto Tim / Fasilitas Poli --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="image">
                                    Foto Tim Medis / Ruangan Poli <small class="text-muted">(Opsional)</small>
                                </label>
                                @if(!empty($layanan->image))
                                    <div class="mb-2">
                                        <img src="{{ $layanan->image_url }}" alt="Foto Poli" style="max-height: 120px; border-radius: 8px; border: 1px solid #E2E8F0;">
                                        <div class="form-text text-success"><i class="bx bx-check-circle"></i> Foto saat ini terpasang. Unggah baru untuk mengganti.</div>
                                    </div>
                                @endif
                                <input type="file"
                                    class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image"
                                    accept="image/png,image/jpeg,image/jpg,image/webp" />
                                <div class="form-text">Format: JPG, PNG, WEBP. Maks 3 MB. Ditampilkan di halaman detail informasi poli.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Card 2: Jadwal & Jam Pelayanan --}}
                <div class="card mb-4 shadow-sm border">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">
                            <i class="bx bx-time me-1 text-primary"></i> 2. Jadwal & Jam Operasional Poli
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        <label class="form-label fw-semibold" for="jam_operasional">
                            Jam Pelayanan Poli
                        </label>
                        <input type="text"
                            class="form-control @error('jam_operasional') is-invalid @enderror"
                            id="jam_operasional" name="jam_operasional"
                            value="{{ old('jam_operasional', $layanan->jam_operasional) }}" />
                        
                        <div class="mt-2">
                            <small class="text-muted d-block mb-1">Preset Cepat:</small>
                            <div class="d-flex flex-wrap gap-1">
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setJamPreset('24 Jam Nonstop (Setiap Hari)')">24 Jam (UGD)</button>
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setJamPreset('Senin - Sabtu: 08.00 - 14.00 WIB')">Senin - Sabtu (08.00 - 14.00)</button>
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setJamPreset('Senin - Jumat: 08.00 - 13.00 WIB')">Senin - Jumat (08.00 - 13.00)</button>
                                <button type="button" class="btn btn-xs btn-outline-secondary" onclick="setJamPreset('Sesuai Jadwal Dokter Praktek')">Sesuai Jadwal Dokter</button>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-semibold" for="jadwal_pendaftaran">
                                Jadwal Pendaftaran Loket <small class="text-muted">(Opsional)</small>
                            </label>
                            <textarea class="form-control @error('jadwal_pendaftaran') is-invalid @enderror"
                                id="jadwal_pendaftaran" name="jadwal_pendaftaran"
                                rows="3"
                                placeholder="Contoh:&#10;Senin - Kamis: 07.30 - 12.00 WIB&#10;Jumat: 07.30 - 10.30 WIB&#10;Sabtu: 07.30 - 11.30 WIB">{{ old('jadwal_pendaftaran', $layanan->jadwal_pendaftaran) }}</textarea>
                            <div class="form-text">Rincian jam buka loket pendaftaran khusus poli ini. Jika kosong, akan memakai jadwal standar.</div>
                            @error('jadwal_pendaftaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Card 3: Tindakan Medis & Persyaratan --}}
                <div class="card mb-4 shadow-sm border">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">
                            <i class="bx bx-list-check me-1 text-primary"></i> 3. Tindakan & Persyaratan Pasien
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        {{-- Tindakan Medis --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="tindakan_medis">
                                Tindakan / Pemeriksaan yang Dilayani
                            </label>
                            <textarea class="form-control" id="tindakan_medis" name="tindakan_medis" rows="4">{{ old('tindakan_medis', $layanan->tindakan_medis) }}</textarea>
                            <div class="form-text">Pisahkan setiap tindakan dengan baris baru (Enter).</div>
                        </div>

                        {{-- Persyaratan Kunjungan --}}
                        <div>
                            <label class="form-label fw-semibold" for="persyaratan">
                                Persyaratan Dokumen Pasien
                            </label>
                            <textarea class="form-control" id="persyaratan" name="persyaratan" rows="3">{{ old('persyaratan', $layanan->persyaratan) }}</textarea>
                            <div class="form-text">Pisahkan setiap dokumen syarat dengan baris baru (Enter).</div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN: Pemilihan Dokter yang Bertugas & Tombol Aksi --}}
            <div class="col-lg-5 col-12">
                
                {{-- Card 4: Dokter Penanggung Jawab --}}
                <div class="card mb-4 shadow-sm border">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">
                            <i class="bx bx-user-pin me-1 text-primary"></i> 4. Dokter / Spesialis yang Bertugas
                        </h6>
                    </div>
                    <div class="card-body pt-3">
                        <p class="small text-muted mb-3">
                            Centang dokter yang bertugas di poli ini. Hanya dokter yang dicentang yang akan muncul di pop-up detail poli ini.
                        </p>

                        @php
                            $selectedDocs = old('dokter_ids', $layanan->dokter_ids ?? []);
                            if(!is_array($selectedDocs)) $selectedDocs = [];
                        @endphp

                        <div class="doctor-selection-list" style="max-height: 400px; overflow-y: auto;">
                            @forelse($dokters as $doc)
                                <div class="doc-select-card mb-2 p-2 rounded border d-flex align-items-center justify-content-between" style="cursor: pointer;" onclick="toggleDocCheck({{ $doc->id }})">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar avatar-sm rounded-circle overflow-hidden flex-shrink-0" style="background: #E6F5F1;">
                                            @if($doc->photo)
                                                <img src="{{ asset($doc->photo) }}" alt="{{ $doc->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <i class="bx bx-user-md fs-4 text-primary d-flex align-items-center justify-content-center h-100"></i>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="fw-bold small">{{ $doc->name }}</div>
                                            <div class="text-muted" style="font-size: 0.75rem;">
                                                <i class="bx bx-check-circle text-success"></i> {{ $doc->specialty }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check me-2">
                                        <input class="form-check-input doc-checkbox" 
                                               type="checkbox" 
                                               name="dokter_ids[]" 
                                               value="{{ $doc->id }}" 
                                               id="doc_check_{{ $doc->id }}"
                                               {{ in_array($doc->id, $selectedDocs) ? 'checked' : '' }}
                                               onclick="event.stopPropagation();">
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-3 text-muted">
                                    <i class="bx bx-user-x fs-3 d-block mb-1"></i>
                                    Belum ada data dokter aktif.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- Card 5: Tombol Aksi Pasien --}}
                <div class="card mb-4 shadow-sm border">
                    <div class="card-header py-3 border-bottom">
                        <h6 class="mb-0 fw-bold">
                            <i class="bx bx-link-external me-1 text-primary"></i> 5. Tombol Aksi Pasien
                        </h6>
                    </div>
                    <div class="card-body pt-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="btn_text">Teks Tombol Aksi</label>
                            <input type="text"
                                class="form-control"
                                id="btn_text" name="btn_text"
                                value="{{ old('btn_text', $layanan->btn_text) }}"
                                placeholder="Contoh: Janji Temu / Pendaftaran" />
                            <div class="form-text">Tombol otomatis menghubungkan pasien ke WhatsApp Puskesmas.</div>
                        </div>
                    </div>
                </div>

                {{-- Action Submit --}}
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg shadow-sm">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan Layanan
                    </button>
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                        Batal
                    </a>
                </div>

            </div>

        </div>

    </form>
</div>

@push('scripts')
<script>
    function selectIcon(iconClass) {
        document.getElementById('icon').value = iconClass;
        document.getElementById('icon-preview').innerHTML = `<i class="${iconClass} text-primary fs-5"></i>`;
    }

    document.getElementById('icon').addEventListener('input', function() {
        const val = this.value.trim() || 'bx bx-plus-medical';
        document.getElementById('icon-preview').innerHTML = `<i class="${val} text-primary fs-5"></i>`;
    });

    function setJamPreset(text) {
        document.getElementById('jam_operasional').value = text;
    }

    function toggleDocCheck(id) {
        const checkbox = document.getElementById('doc_check_' + id);
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
        }
    }
</script>
@endpush

@endsection
