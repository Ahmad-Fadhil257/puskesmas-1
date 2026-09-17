@extends('layouts.admin')
@section('title', 'Edit Data Kunjungan')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold py-1 mb-1" style="color:#0A5C45;">
            <i class="bx bx-edit me-2"></i>Edit Data Kunjungan — {{ $item->bulan_label }} {{ $item->tahun }}
        </h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.statistik.index') }}">Statistik</a></li>
                <li class="breadcrumb-item active">Edit Kunjungan</li>
            </ol>
        </nav>
    </div>
    <a href="{{ route('admin.statistik.index') }}" class="btn btn-outline-secondary">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
</div>

<div class="card border-0 shadow-sm" style="max-width:560px;">
    <div class="card-body p-4">
        <form action="{{ route('admin.statistik.kunjungan.update', $item->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Tahun <span class="text-danger">*</span></label>
                    <select name="tahun" class="form-select @error('tahun') is-invalid @enderror" required>
                        @foreach($tahunList as $t)
                            <option value="{{ $t }}" {{ old('tahun', $item->tahun) == $t ? 'selected' : '' }}>{{ $t }}</option>
                        @endforeach
                    </select>
                    @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Bulan <span class="text-danger">*</span></label>
                    <select name="bulan" class="form-select @error('bulan') is-invalid @enderror" required>
                        @foreach($bulanList as $num => $nama)
                            <option value="{{ $num }}" {{ old('bulan', $item->bulan) == $num ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                    @error('bulan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Total Kunjungan <span class="text-danger">*</span></label>
                <input type="number" name="jumlah_kunjungan" class="form-control @error('jumlah_kunjungan') is-invalid @enderror"
                       value="{{ old('jumlah_kunjungan', $item->jumlah_kunjungan) }}" min="0" required>
                @error('jumlah_kunjungan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pasien Baru <span class="text-danger">*</span></label>
                    <input type="number" name="kunjungan_baru" class="form-control @error('kunjungan_baru') is-invalid @enderror"
                           value="{{ old('kunjungan_baru', $item->kunjungan_baru) }}" min="0" required>
                    @error('kunjungan_baru')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Pasien Lama <span class="text-danger">*</span></label>
                    <input type="number" name="kunjungan_lama" class="form-control @error('kunjungan_lama') is-invalid @enderror"
                           value="{{ old('kunjungan_lama', $item->kunjungan_lama) }}" min="0" required>
                    @error('kunjungan_lama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="bx bx-save me-1"></i> Perbarui Data
                </button>
                <a href="{{ route('admin.statistik.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>

@endsection
