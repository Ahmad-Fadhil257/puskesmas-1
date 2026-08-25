@extends('layouts.admin')

@section('title', 'Edit Dokter - ' . $dokter->name)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-edit-alt me-2"></i>Edit Dokter: {{ $dokter->name }}
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Kelola Dokter</a></li>
                    <li class="breadcrumb-item active">Edit Dokter</li>
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
                <span class="fw-bold">Terdapat beberapa kesalahan:</span>
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
            <h5 class="mb-0 fw-bold">Informasi Dokter & Jadwal Praktek</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.dokter.update', $dokter->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row g-3">

                    {{-- Nama Dokter --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="{{ old('name', $dokter->name) }}"
                            placeholder="Contoh: dr. Budi Santoso, Sp.A"
                            required />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Spesialisasi --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="specialty">Spesialisasi / Poli <span class="text-danger">*</span></label>
                        <div class="custom-dropdown">
                            <input type="hidden" name="specialty" id="specialty" value="{{ old('specialty', $dokter->specialty) }}" required>
                            <button type="button" class="dropdown-toggle text-start d-flex align-items-center justify-content-between" id="specialtyDropdownBtn" onclick="toggleDropdown(this)">
                                <span class="dropdown-selected">
                                    {{ old('specialty', $dokter->specialty) }}
                                </span>
                                <i class="bx bx-chevron-down chevron-icon"></i>
                            </button>
                            <div class="dropdown-menu-custom">
                                @php
                                    $spList = [
                                        'Dokter Umum',
                                        'Spesialis Gigi dan Mulut',
                                        'Spesialis Anak',
                                        'Spesialis Kebidanan & Kandungan',
                                        'Spesialis Penyakit Dalam',
                                        'Spesialis Jantung dan Pembuluh Darah',
                                        'Spesialis Bedah Umum',
                                        'Spesialis Mata',
                                        'Spesialis THT-KL',
                                        'Spesialis Kulit dan Kelamin',
                                        'Spesialis Saraf',
                                        'Spesialis Kedokteran Jiwa (Psikiatri)',
                                        'Konselor Gizi & Dietetik',
                                    ];
                                @endphp
                                @foreach($spList as $sp)
                                    <div class="dropdown-item-custom {{ old('specialty', $dokter->specialty) == $sp ? 'active' : '' }}" data-value="{{ $sp }}" onclick="selectOption(this)">
                                        {{ $sp }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @error('specialty')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Upload Foto --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="photo">Ganti Foto Dokter</label>
                        <input type="file"
                            class="form-control @error('photo') is-invalid @enderror"
                            id="photo" name="photo"
                            accept="image/png, image/jpeg, image/webp"
                            onchange="previewPhoto(this)" />
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks 3MB.</div>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <div class="d-flex align-items-center gap-3 mt-3">
                            @if($dokter->photo)
                            <div id="currentPhotoWrap">
                                <span class="d-block text-muted small mb-1">Foto Saat Ini:</span>
                                <img src="{{ asset($dokter->photo) }}" alt="{{ $dokter->name }}" class="rounded border" style="height: 110px; object-fit: cover; object-position: top;">
                            </div>
                            @endif
                            <div id="newPreviewWrap" style="display: none;">
                                <span class="d-block text-muted small mb-1">Foto Baru:</span>
                                <img id="newPhotoPreview" src="#" alt="Preview Baru" class="rounded border" style="height: 110px; object-fit: cover; border-color: #0A5C45 !important;">
                            </div>
                        </div>
                    </div>

                    {{-- Jadwal Praktek (Time Input) --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jadwal Praktek</label>
                        <div id="jadwalRows">
                            @php $jadwal = $dokter->jadwal_praktek ?? []; @endphp
                            @if(count($jadwal) > 0)
                                @foreach($jadwal as $j)
                                @php
                                    $mulai = $j['mulai'] ?? '';
                                    $selesai = $j['selesai'] ?? '';
                                    if (!$mulai && !empty($j['jam'])) {
                                        $cleanJam = str_ireplace('wib', '', $j['jam']);
                                        $parts = explode('-', $cleanJam);
                                        $rawM = trim($parts[0] ?? '');
                                        $rawS = trim($parts[1] ?? '');
                                        // Standardize to HH:MM format
                                        if (preg_match('/^(\d{1,2})[\.:](\d{2})/', $rawM, $mMatch)) {
                                            $mulai = sprintf('%02d:%02d', $mMatch[1], $mMatch[2]);
                                        }
                                        if (preg_match('/^(\d{1,2})[\.:](\d{2})/', $rawS, $sMatch)) {
                                            $selesai = sprintf('%02d:%02d', $sMatch[1], $sMatch[2]);
                                        }
                                    }
                                @endphp
                                <div class="jadwal-row d-flex gap-2 mb-2 align-items-center flex-wrap flex-sm-nowrap">
                                    <div class="custom-dropdown" style="width: 140px; flex-shrink: 0;">
                                        <input type="hidden" name="jadwal_hari[]" class="hari-value" value="{{ $j['hari'] ?? '' }}">
                                        <button type="button" class="dropdown-toggle text-start d-flex align-items-center" onclick="toggleDropdown(this)">
                                            <span class="dropdown-selected">{{ $j['hari'] ?? '-- Hari --' }}</span>
                                        </button>
                                        <div class="dropdown-menu-custom">
                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                                <div class="dropdown-item-custom {{ ($j['hari'] ?? '') === $day ? 'active' : '' }}" data-value="{{ $day }}" onclick="selectOption(this)">{{ $day }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-1" style="flex: 1;">
                                        <input type="time" name="jadwal_mulai[]" class="form-control form-control-sm" value="{{ $mulai }}" title="Jam Mulai">
                                        <span class="text-muted small px-1">s/d</span>
                                        <input type="time" name="jadwal_selesai[]" class="form-control form-control-sm" value="{{ $selesai }}" title="Jam Selesai">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>
                                </div>
                                @endforeach
                            @else
                                <div class="jadwal-row d-flex gap-2 mb-2 align-items-center flex-wrap flex-sm-nowrap">
                                    <div class="custom-dropdown" style="width: 140px; flex-shrink: 0;">
                                        <input type="hidden" name="jadwal_hari[]" class="hari-value" value="Senin">
                                        <button type="button" class="dropdown-toggle text-start d-flex align-items-center" onclick="toggleDropdown(this)">
                                            <span class="dropdown-selected">Senin</span>
                                        </button>
                                        <div class="dropdown-menu-custom">
                                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $day)
                                                <div class="dropdown-item-custom {{ $day === 'Senin' ? 'active' : '' }}" data-value="{{ $day }}" onclick="selectOption(this)">{{ $day }}</div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center gap-1" style="flex: 1;">
                                        <input type="time" name="jadwal_mulai[]" class="form-control form-control-sm" value="08:00" title="Jam Mulai">
                                        <span class="text-muted small px-1">s/d</span>
                                        <input type="time" name="jadwal_selesai[]" class="form-control form-control-sm" value="12:00" title="Jam Selesai">
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>
                                </div>
                            @endif
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-success mt-1" onclick="addJadwalRow()">
                            <i class="bx bx-plus"></i> Tambah Jam
                        </button>
                        <div class="form-text">Pilih hari dan tentukan jam mulai & jam selesai praktik.</div>
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

<script>
function previewPhoto(input) {
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
</script>

<style>
.custom-dropdown { position: relative; }
.custom-dropdown .dropdown-toggle {
    cursor: pointer; background: #fff; border: 1px solid #dee2e6;
    border-radius: 10px; padding: 8px 32px 8px 14px; font-size: 0.8125rem;
    transition: border-color 0.2s, box-shadow 0.2s; width: 100%; min-height: 31px;
    position: relative;
}
.dark-style .custom-dropdown .dropdown-toggle { background: #1f2937; border-color: #374151; color: #f3f4f6; }
.custom-dropdown .dropdown-toggle:hover { border-color: #BBE4D8; }
.dark-style .custom-dropdown .dropdown-toggle:hover { border-color: #0A5C45; }
.custom-dropdown .dropdown-toggle:focus { border-color: #0A5C45; box-shadow: 0 0 0 3px rgba(10,92,69,0.1); outline: none; }
.custom-dropdown .dropdown-toggle .chevron-icon {
    position: absolute; right: 12px; top: 50%; transform: translateY(-50%);
    font-size: 1.1rem; color: #6b7280; transition: transform 0.2s;
}
.custom-dropdown.open .dropdown-toggle .chevron-icon { transform: translateY(-50%) rotate(180deg); }
.custom-dropdown .dropdown-placeholder { color: #9ca3af; }
.custom-dropdown .dropdown-menu-custom {
    display: none; position: absolute; top: calc(100% + 4px); left: 0; right: 0; z-index: 1050;
    background: #fff; border: 1px solid #E2F0EC; border-radius: 12px;
    box-shadow: 0 8px 24px rgba(10,92,69,0.12); max-height: 220px; overflow-y: auto;
    padding: 6px;
}
.dark-style .custom-dropdown .dropdown-menu-custom { background: #1f2937; border-color: #374151; box-shadow: 0 8px 24px rgba(0,0,0,0.4); }
.custom-dropdown.open .dropdown-menu-custom { display: block; animation: ddFadeIn 0.2s ease; }
@keyframes ddFadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }
.custom-dropdown .dropdown-item-custom {
    padding: 9px 14px; font-size: 0.8125rem; cursor: pointer; font-weight: 500;
    border-radius: 8px; transition: background 0.15s, color 0.15s; color: #122822;
}
.dark-style .custom-dropdown .dropdown-item-custom { color: #e5e7eb; }
.custom-dropdown .dropdown-item-custom:hover { background: #E8F5F1; color: #0A5C45; }
.dark-style .custom-dropdown .dropdown-item-custom:hover { background: #064e3b; color: #a7f3d0; }
.custom-dropdown .dropdown-item-custom.active { background: #0A5C45; color: #fff; font-weight: 600; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar { width: 5px; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar-track { background: transparent; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar-thumb { background: #C5E5DD; border-radius: 10px; }
.dark-style .custom-dropdown .dropdown-menu-custom::-webkit-scrollbar-thumb { background: #064e3b; }
</style>

<script>
const hariOptions = @php echo json_encode(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu']); @endphp;

function toggleDropdown(btn) {
    const wrap = btn.closest('.custom-dropdown');
    const isOpen = wrap.classList.contains('open');
    document.querySelectorAll('.custom-dropdown.open').forEach(d => d.classList.remove('open'));
    if (!isOpen) wrap.classList.add('open');
}

function selectOption(item) {
    const wrap = item.closest('.custom-dropdown');
    const inputTarget = wrap.querySelector('input[type="hidden"]');
    if (inputTarget) {
        inputTarget.value = item.dataset.value;
    }
    const selected = wrap.querySelector('.dropdown-selected');
    if (selected) {
        selected.textContent = item.textContent;
        selected.classList.remove('dropdown-placeholder');
    }
    wrap.querySelectorAll('.dropdown-item-custom').forEach(i => i.classList.remove('active'));
    item.classList.add('active');
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
    row.className = 'jadwal-row d-flex gap-2 mb-2 align-items-center flex-wrap flex-sm-nowrap';

    var options = '';
    for (var i = 0; i < hariOptions.length; i++) {
        options += '<div class="dropdown-item-custom' + (i === 0 ? ' active' : '') + '" data-value="' + hariOptions[i] + '" onclick="selectOption(this)">' + hariOptions[i] + '</div>';
    }

    row.innerHTML = '<div class="custom-dropdown" style="width: 140px; flex-shrink: 0;">' +
        '<input type="hidden" name="jadwal_hari[]" class="hari-value" value="Senin">' +
        '<button type="button" class="dropdown-toggle text-start d-flex align-items-center" onclick="toggleDropdown(this)">' +
        '<span class="dropdown-selected">Senin</span></button>' +
        '<div class="dropdown-menu-custom">' + options + '</div></div>' +
        '<div class="d-flex align-items-center gap-1" style="flex: 1;">' +
        '<input type="time" name="jadwal_mulai[]" class="form-control form-control-sm" value="08:00" title="Jam Mulai">' +
        '<span class="text-muted small px-1">s/d</span>' +
        '<input type="time" name="jadwal_selesai[]" class="form-control form-control-sm" value="12:00" title="Jam Selesai"></div>' +
        '<button type="button" class="btn btn-sm btn-outline-danger btn-remove-jadwal" title="Hapus"><i class="bx bx-x"></i></button>';
    container.appendChild(row);
    row.querySelector('.btn-remove-jadwal').addEventListener('click', function() { row.remove(); });
}

document.querySelectorAll('.btn-remove-jadwal').forEach(function(btn) {
    btn.addEventListener('click', function() { this.closest('.jadwal-row').remove(); });
});
</script>

@endsection
