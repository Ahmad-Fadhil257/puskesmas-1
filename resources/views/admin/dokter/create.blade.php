@extends('layouts.admin')

@section('title', 'Tambah Dokter - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-plus-circle me-2"></i>Tambah Dokter
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Kelola Dokter</a></li>
                    <li class="breadcrumb-item active">Tambah</li>
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
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Form Tambah Data Dokter</h5>
        </div>
        <div class="card-body pt-4">
            <form action="{{ route('admin.dokter.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    {{-- Nama Dokter --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" for="name">
                            Nama Dokter <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name"
                            value="{{ old('name') }}"
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
                            value="{{ old('specialty') }}"
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
                            onchange="previewPhoto(this)" />
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks 3MB.</div>
                        @error('photo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <div id="previewWrap" class="mt-3 d-none">
                            <span class="d-block text-muted small mb-1">Preview:</span>
                            <img id="photoPreview" src="" alt="Preview Foto" class="rounded border" style="height: 140px; object-fit: cover; object-position: top;">
                        </div>
                    </div>

                    {{-- Jadwal Praktek --}}
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Jadwal Praktek</label>
                        <div id="jadwalRows">
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
                                <i class="bx bx-save me-1"></i> Simpan Dokter
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
    const wrap = document.getElementById('previewWrap');
    const preview = document.getElementById('photoPreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            wrap.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<style>
.custom-dropdown { position: relative; }
.custom-dropdown .dropdown-toggle {
    cursor: pointer; background: #fff; border: 1px solid #dee2e6;
    border-radius: 10px; padding: 8px 14px; font-size: 0.8125rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.custom-dropdown .dropdown-toggle:hover { border-color: #BBE4D8; }
.custom-dropdown .dropdown-toggle:focus { border-color: #0A5C45; box-shadow: 0 0 0 3px rgba(10,92,69,0.1); outline: none; }
.custom-dropdown .dropdown-selected { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-weight: 500; color: #122822; }
.custom-dropdown .dropdown-placeholder { color: #6c757d; }
.custom-dropdown .dropdown-toggle .bx { transition: transform 0.25s ease; font-size: 1rem; color: #6c757d; }
.custom-dropdown.open .dropdown-toggle .bx { transform: rotate(180deg); color: #0A5C45; }
.custom-dropdown .dropdown-menu-custom {
    display: none; position: absolute; top: calc(100% + 6px); left: 0; right: 0; z-index: 1050;
    background: #fff; border: 1px solid #E2F0EC; border-radius: 12px;
    box-shadow: 0 8px 24px rgba(10,92,69,0.12); max-height: 220px; overflow-y: auto;
    padding: 6px;
}
.custom-dropdown.open .dropdown-menu-custom { display: block; animation: ddFadeIn 0.2s ease; }
@keyframes ddFadeIn { from { opacity: 0; transform: translateY(-6px); } to { opacity: 1; transform: translateY(0); } }
.custom-dropdown .dropdown-item-custom {
    padding: 9px 14px; font-size: 0.8125rem; cursor: pointer; font-weight: 500;
    border-radius: 8px; transition: background 0.15s, color 0.15s; color: #122822;
}
.custom-dropdown .dropdown-item-custom:hover { background: #E8F5F1; color: #0A5C45; }
.custom-dropdown .dropdown-item-custom.active { background: #0A5C45; color: #fff; font-weight: 600; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar { width: 5px; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar-track { background: transparent; }
.custom-dropdown .dropdown-menu-custom::-webkit-scrollbar-thumb { background: #C5E5DD; border-radius: 10px; }
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
    wrap.querySelector('.hari-value').value = item.dataset.value;
    const selected = wrap.querySelector('.dropdown-selected');
    selected.textContent = item.textContent;
    selected.classList.remove('dropdown-placeholder');
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
    row.className = 'jadwal-row d-flex gap-2 mb-2 align-items-center';

    var options = '';
    for (var i = 0; i < hariOptions.length; i++) {
        options += '<div class="dropdown-item-custom" data-value="' + hariOptions[i] + '" onclick="selectOption(this)">' + hariOptions[i] + '</div>';
    }

    row.innerHTML = '<div class="custom-dropdown" style="width: 160px;">' +
        '<input type="hidden" name="jadwal_hari[]" class="hari-value" value="">' +
        '<button type="button" class="dropdown-toggle form-control form-control-sm text-start d-flex align-items-center justify-content-between" onclick="toggleDropdown(this)">' +
        '<span class="dropdown-selected dropdown-placeholder">-- Hari --</span><i class="bx bx-chevron-down"></i></button>' +
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
