@extends('layouts.admin')

@section('title', 'Edit Dokter - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-edit me-2"></i>Edit Dokter
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Kelola Dokter</a></li>
                    <li class="breadcrumb-item active">Edit — {{ $dokter->name }}</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
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

    {{-- Form Card --}}
    <div class="card mb-4">
        <div class="card-header border-bottom py-3">
            <h5 class="mb-0 fw-bold">Edit Data Dokter</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-4">

                    {{-- Nama Dokter --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">
                            Nama Dokter <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="{{ old('name', $dokter->name) }}"
                            placeholder="Contoh: Dr. John Smith, Sp.JP"
                            required />
                        <div class="form-text">Tuliskan nama lengkap beserta gelar dokter.</div>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Spesialisasi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="specialty">
                            Spesialisasi <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('specialty') is-invalid @enderror"
                            id="specialty" name="specialty"
                            value="{{ old('specialty', $dokter->specialty) }}"
                            placeholder="Contoh: Dokter Spesialis Jantung"
                            required />
                        <div class="form-text">Bidang keahlian atau spesialisasi dokter.</div>
                        @error('specialty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Divider --}}
                    <div class="col-12"><hr class="my-1"></div>

                    {{-- Upload Foto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="photo">Foto Dokter</label>
                        <input type="file"
                            class="form-control @error('photo') is-invalid @enderror"
                            id="photo" name="photo"
                            accept="image/png, image/jpeg, image/webp"
                            onchange="previewNewPhoto(this)" />
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP (Maks 3MB).</div>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <div class="mt-3 d-flex align-items-center gap-3 flex-wrap">
                            @if($dokter->photo)
                            <div>
                                <span class="d-block text-muted small mb-1">Foto Saat Ini:</span>
                                <img src="{{ asset($dokter->photo) }}" alt="Foto Saat Ini" class="rounded border" style="height: 110px; object-fit: cover; object-position: top; border-color: #E2F0EC !important;">
                            </div>
                            @endif
                            <div id="newPreviewWrap" style="display: none;">
                                <span class="d-block text-muted small mb-1">Foto Baru:</span>
                                <img id="newPhotoPreview" src="#" alt="Preview Baru" class="rounded border" style="height: 110px; object-fit: cover; border-color: #0A5C45 !important;">
                            </div>
                        </div>
                    </div>

                    {{-- Jadwal Praktek --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jadwal Praktek</label>
                        <div id="jadwalRows">
                            @php $jadwal = $dokter->jadwal_praktek ?? []; @endphp
                            @if(count($jadwal) > 0)
                                @foreach($jadwal as $j)
                                <div class="jadwal-row d-flex gap-2 mb-2 align-items-center">
                                    <div class="custom-dropdown" style="width: 160px;">
                                        <input type="hidden" name="jadwal_hari[]" class="hari-value" value="{{ $j['hari'] ?? '' }}">
                                        <button type="button" class="dropdown-toggle form-control form-control-sm text-start d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
                                            <span class="dropdown-selected">{{ $j['hari'] ?? '-- Hari --' }}</span>
                                            <i class="bx bx-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu-custom">
                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                                <div class="dropdown-item-custom {{ ($j['hari'] ?? '') === $day ? 'active' : '' }}" data-value="{{ $day }}" onclick="selectOption(this)">{{ $day }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="text" name="jadwal_jam[]" class="form-control form-control-sm" placeholder="Contoh: 08:00 - 12:00" style="flex:1;" value="{{ $j['jam'] ?? '' }}">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>
                                </div>
                                @endforeach
                            @else
                                <div class="jadwal-row d-flex gap-2 mb-2 align-items-center">
                                    <div class="custom-dropdown" style="width: 160px;">
                                        <input type="hidden" name="jadwal_hari[]" class="hari-value" value="">
                                        <button type="button" class="dropdown-toggle form-control form-control-sm text-start d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">
                                            <span class="dropdown-selected">-- Hari --</span>
                                            <i class="bx bx-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu-custom">
                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                                <div class="dropdown-item-custom" data-value="{{ $day }}" onclick="selectOption(this)">{{ $day }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <input type="text" name="jadwal_jam[]" class="form-control form-control-sm" placeholder="Contoh: 08:00 - 12:00" style="flex:1;">
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mt-1" onclick="addJadwalRow()">
                            <i class="bx bx-plus"></i> Tambah Jam
                        </button>
                        <div class="form-text">Isi hari dan jam praktik dokter (opsional).</div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-2 mt-2 pt-3 border-top">
                            <a href="{{ route('admin.dokter.index') }}" class="btn btn-outline-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Perbarui Data
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>

<style>
.custom-dropdown { position: relative; }
.custom-dropdown .dropdown-toggle { cursor: pointer; background: #fff; }
.custom-dropdown .dropdown-toggle .dropdown-selected { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.custom-dropdown .dropdown-toggle .bx { transition: transform 0.2s; font-size: 1.1rem; color: #6c757d; }
.custom-dropdown.open .dropdown-toggle .bx { transform: rotate(180deg); }
.custom-dropdown .dropdown-menu-custom {
    display: none; position: absolute; top: 100%; left: 0; right: 0; z-index: 1050;
    background: #fff; border: 1px solid #dee2e6; border-radius: 8px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.12); max-height: 220px; overflow-y: auto;
    margin-top: 4px;
}
.custom-dropdown.open .dropdown-menu-custom { display: block; }
.custom-dropdown .dropdown-item-custom {
    padding: 8px 14px; font-size: 0.8125rem; cursor: pointer; transition: background 0.15s;
}
.custom-dropdown .dropdown-item-custom:first-child { border-radius: 8px 8px 0 0; }
.custom-dropdown .dropdown-item-custom:last-child { border-radius: 0 0 8px 8px; }
.custom-dropdown .dropdown-item-custom:hover { background: #E2F0EC; color: #0A5C45; font-weight: 600; }
</style>

<script>
function previewNewPhoto(input) {
    const wrap = document.getElementById('newPreviewWrap');
    const preview = document.getElementById('newPhotoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrap.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const hariOptions = @php echo json_encode(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']); @endphp;

function toggleDropdown(btn) {
    const wrap = btn.closest('.custom-dropdown');
    const isOpen = wrap.classList.contains('open');
    document.querySelectorAll('.custom-dropdown.open').forEach(d => d.classList.remove('open'));
    if (!isOpen) wrap.classList.add('open');
}

function selectOption(item) {
    const wrap = item.closest('.custom-dropdown');
    wrap.querySelector('.hari-value').value = item.dataset.value;
    wrap.querySelector('.dropdown-selected').textContent = item.textContent;
    wrap.classList.remove('open');
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.custom-dropdown')) {
        document.querySelectorAll('.custom-dropdown.open').forEach(d => d.classList.remove('open'));
    }
});

function addJadwalRow() {
    const container = document.getElementById('jadwalRows');
    const row = document.createElement('div');
    row.className = 'jadwal-row d-flex gap-2 mb-2 align-items-center';

    var options = '';
    for (var i = 0; i < hariOptions.length; i++) {
        options += '<div class="dropdown-item-custom" data-value="' + hariOptions[i] + '" onclick="selectOption(this)">' + hariOptions[i] + '</div>';
    }

    row.innerHTML = '<div class="custom-dropdown" style="width: 160px;">' +
        '<input type="hidden" name="jadwal_hari[]" class="hari-value" value="">' +
        '<button type="button" class="dropdown-toggle form-control form-control-sm text-start d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">' +
        '<span class="dropdown-selected">-- Hari --</span><i class="bx bx-chevron-down"></i></button>' +
        '<div class="dropdown-menu-custom">' + options + '</div></div>' +
        '<input type="text" name="jadwal_jam[]" class="form-control form-control-sm" placeholder="Contoh: 08:00 - 12:00" style="flex:1;">' +
        '<button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>';
    container.appendChild(row);
    row.querySelector('.btn-remove-jadwal').addEventListener('click', function() { row.remove(); });
}

document.querySelectorAll('.btn-remove-jadwal').forEach(function(btn) {
    btn.addEventListener('click', function() { this.closest('.jadwal-row').remove(); });
});
</script>

@endsection
