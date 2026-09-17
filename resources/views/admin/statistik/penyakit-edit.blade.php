@extends('layouts.admin')
@section('title', 'Edit Data Penyakit')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold py-1 mb-1" style="color:#0A5C45;">
            <i class="bx bx-edit me-2"></i>Edit Data Penyakit
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.statistik.index') }}">Statistik</a></li>
                <li class="breadcrumb-item active">Edit Penyakit</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.statistik.index') }}" class="btn btn-outline-secondary">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm" style="max-width:640px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.statistik.penyakit.update', $item->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Penyakit <span class="text-danger">*</span></label>
                <input type="text" name="nama_penyakit" class="form-control @error('nama_penyakit') is-invalid @enderror"
                       value="{{ old('nama_penyakit', $item->nama_penyakit) }}" required>
                @error('nama_penyakit')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Jumlah Kasus <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_kasus" class="form-control @error('jumlah_kasus') is-invalid @enderror"
                           value="{{ old('jumlah_kasus', $item->jumlah_kasus) }}" min="0" required>
                    @error('jumlah_kasus')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Kode ICD-10</label>
                    <input type="text" name="kode_icd" class="form-control @error('kode_icd') is-invalid @enderror"
                           value="{{ old('kode_icd', $item->kode_icd) }}" maxlength="20">
                    @error('kode_icd')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Tahun <span class="text-danger">*</span></label>
                    <select name="tahun" class="form-select @error('tahun') is-invalid @enderror" required>
                        @foreach($tahunList as $t)
                            <option value="{{ $t }}" {{ old('tahun', $item->tahun) == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Urutan <span class="text-danger">*</span></label>
                    <input type="number" name="urutan" class="form-control @error('urutan') is-invalid @enderror"
                           value="{{ old('urutan', $item->urutan) }}" min="1" max="100" required>
                    @error('urutan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Warna (HEX)</label>
                    <div class="input-group">
                        <input type="color" name="warna" id="colorPicker" class="form-control form-control-color"
                               value="{{ old('warna', $item->warna ?? '#0A5C45') }}" style="width:50px;">
                        <input type="text" id="colorText" class="form-control"
                               value="{{ old('warna', $item->warna ?? '#0A5C45') }}" readonly>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="is_active" id="isActive" value="1"
                           {{ old('is_active', $item->is_active ? '1' : '') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold" for="isActive">Tampilkan di halaman publik</label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger px-4">
                    <i class="bx bx-save me-1"></i> Perbarui Data
                </button>
                <a href="{{ route('admin.statistik.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const colorPicker = document.getElementById('colorPicker');
    const colorText   = document.getElementById('colorText');
    colorPicker.addEventListener('input', () => { colorText.value = colorPicker.value; });
</script>
@endpush
