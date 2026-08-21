@extends('layouts.admin')

@section('title', 'Dashboard Utama - Puskesmas CareLink')

@section('content')

    <!-- Flash Alert Success Login -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <!-- Banner Sambutan -->
        <div class="col-lg-8 mb-4 order-0">
            <div class="card h-100">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary fw-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 🏥</h5>
                            <p class="mb-4 text-muted">
                                Sistem manajemen pelayanan Puskesmas CareLink aktif dan berjalan normal. Hari ini terdapat <span class="fw-bold text-dark">24 antrean pasien</span> yang sedang berjalan.
                            </p>
                            <a href="#tabel-antrean" class="btn btn-sm btn-primary rounded-pill">
                                <i class="bx bx-list-ul me-1"></i> Pantau Antrean Hari Ini
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="{{ asset('admin-assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="Petugas Puskesmas" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Cepat Status Pelayanan -->
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-primary">
                                        <i class="bx bx-user-check"></i>
                                    </span>
                                </div>
                                <span class="badge bg-label-success rounded-pill">+12%</span>
                            </div>
                            <span class="fw-semibold d-block mb-1 text-muted">Pasien Hari Ini</span>
                            <h3 class="card-title mb-1 text-dark fw-bold">128</h3>
                            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> Meningkat</small>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <span class="avatar-initial rounded bg-label-warning">
                                        <i class="bx bx-time-five"></i>
                                    </span>
                                </div>
                                <span class="badge bg-label-warning rounded-pill">Aktif</span>
                            </div>
                            <span class="fw-semibold d-block mb-1 text-muted">Antrean Berjalan</span>
                            <h3 class="card-title mb-1 text-dark fw-bold">24</h3>
                            <small class="text-muted">Sedang diproses</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Baris Kedua: Dokter Bertugas & Poli -->
        <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2 fw-bold text-dark">Kapasitas Poli Hari Ini</h5>
                        <small class="text-muted">Status kuota layanan poliklinik</small>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-3 pb-1 align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-plus-medical"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-bold">Poli Umum</h6>
                                    <small class="text-muted">dr. Hendra Pratama</small>
                                </div>
                                <div class="user-progress">
                                    <span class="badge bg-label-primary">45 / 50 Pasien</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1 align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-smile"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-bold">Poli Gigi & Mulut</h6>
                                    <small class="text-muted">drg. Siti Aminah</small>
                                </div>
                                <div class="user-progress">
                                    <span class="badge bg-label-info">18 / 30 Pasien</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1 align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-heart"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-bold">Poli KIA & KB</h6>
                                    <small class="text-muted">Bidan Rina Marlina</small>
                                </div>
                                <div class="user-progress">
                                    <span class="badge bg-label-success">22 / 35 Pasien</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex align-items-center">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-shield-quarter"></i></span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0 fw-bold">IGD 24 Jam</h6>
                                    <small class="text-muted">Tim Medis Siaga</small>
                                </div>
                                <div class="user-progress">
                                    <span class="badge bg-label-danger">Siaga 24 Jam</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Tabel Antrean Pasien Terkini -->
        <div class="col-12 col-md-12 col-lg-8 order-2 order-md-3 mb-4" id="tabel-antrean">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title fw-bold m-0 text-dark">Antrean Pasien Terkini</h5>
                        <small class="text-muted">Pembaruan otomatis dari loket pendaftaran</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary rounded-pill">
                        <i class="bx bx-plus me-1"></i> Tambah Antrean
                    </button>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No. Antrean</th>
                                <th>Nama Pasien</th>
                                <th>Poli Tujuan</th>
                                <th>Dokter</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td><span class="badge bg-label-primary fw-bold">A-012</span></td>
                                <td><strong>Budi Santoso</strong><br><small class="text-muted">NIK: 3201************</small></td>
                                <td>Poli Umum</td>
                                <td>dr. Hendra Pratama</td>
                                <td><span class="badge bg-warning text-dark">Sedang Diperiksa</span></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-primary rounded-pill">Panggil</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-label-primary fw-bold">A-013</span></td>
                                <td><strong>Nurul Hidayah</strong><br><small class="text-muted">NIK: 3201************</small></td>
                                <td>Poli Umum</td>
                                <td>dr. Hendra Pratama</td>
                                <td><span class="badge bg-secondary">Menunggu</span></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-primary rounded-pill">Panggil</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-label-info fw-bold">B-005</span></td>
                                <td><strong>Ahmad Fauzi</strong><br><small class="text-muted">NIK: 3201************</small></td>
                                <td>Poli Gigi</td>
                                <td>drg. Siti Aminah</td>
                                <td><span class="badge bg-secondary">Menunggu</span></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-primary rounded-pill">Panggil</button>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-label-success fw-bold">C-008</span></td>
                                <td><strong>Dewi Lestari</strong><br><small class="text-muted">NIK: 3201************</small></td>
                                <td>Poli KIA & KB</td>
                                <td>Bidan Rina Marlina</td>
                                <td><span class="badge bg-success">Selesai</span></td>
                                <td>
                                    <button class="btn btn-xs btn-outline-success rounded-pill" disabled>Selesai</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
