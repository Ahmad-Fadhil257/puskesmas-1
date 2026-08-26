@extends('layouts.admin')

@section('title', 'Survei Kepuasan Masyarakat & Testimoni - Puskesmas CareLink')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-smile me-2"></i>Survei Kepuasan Masyarakat & Testimoni
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Survei & Testimoni</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#addSurveyModal">
                <i class="bx bx-plus"></i>
                <span>Tambah Testimoni</span>
            </button>
            <a href="{{ url('/#testimoni') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
        </div>
    </div>

    {{-- Alert Success / Errors --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- STATISTIK IKM (Indeks Kepuasan Masyarakat) - DISEMBUNYIKAN --}}
    {{--
    <div class="row g-3 mb-4">
        <div class="col-md-4 col-12">
            <div class="card shadow-sm border h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-warning rounded d-flex align-items-center justify-content-center p-2" style="width: 52px; height: 52px;">
                        <i class="bx bxs-star fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block">Indeks Kepuasan (IKM)</span>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="mb-0 fw-bolder text-dark">{{ $avgRating }}</h3>
                            <span class="text-muted small">/ 5.0</span>
                            <span class="badge bg-label-success ms-1">Mutu A (Sangat Baik)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card shadow-sm border h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-success rounded d-flex align-items-center justify-content-center p-2" style="width: 52px; height: 52px;">
                        <i class="bx bx-happy-beaming fs-2 text-success"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block">Tingkat Kepuasan Pasien</span>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="mb-0 fw-bolder text-dark">{{ $satisfactionPct }}%</h3>
                            <span class="text-success small fw-semibold">Puas & Sangat Puas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card shadow-sm border h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-primary rounded d-flex align-items-center justify-content-center p-2" style="width: 52px; height: 52px;">
                        <i class="bx bx-user-voice fs-2 text-primary"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block">Total Responden Survei</span>
                        <div class="d-flex align-items-baseline gap-2">
                            <h3 class="mb-0 fw-bolder text-dark">{{ $totalResponden }}</h3>
                            <span class="text-muted small">Ulasan Masuk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- TABEL DATA SURVEI & TESTIMONI --}}
    <div class="card shadow-sm border">
        <div class="card-header border-bottom py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div>
                <h5 class="mb-0 fw-bold">
                    <i class="bx bx-list-ul me-1 text-primary"></i> Daftar Ulasan & Hasil Survei Kepuasan
                </h5>
                <small class="text-muted">Ulasan yang disetujui (Aktif) akan tampil pada carousel testimoni di landing page.</small>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Responden Pasien</th>
                        <th>Layanan / Poli</th>
                        <th>Rating</th>
                        <th style="min-width: 320px;">Pesan & Masukan Testimoni</th>
                        <th class="text-center" style="width: 140px;">Tampil di Web</th>
                        <th class="text-center" style="width: 110px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($surveys as $s)
                    <tr>
                        {{-- Responden Pasien --}}
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ $s->avatar_url }}" alt="{{ $s->name }}" class="rounded-circle" style="width: 38px; height: 38px; object-fit: cover;">
                                <div>
                                    <strong class="text-dark d-block">{{ $s->name }}</strong>
                                    <small class="text-muted">{{ $s->created_at->format('d M Y, H:i') }}</small>
                                </div>
                            </div>
                        </td>

                        {{-- Poli / Layanan --}}
                        <td>
                            <span class="badge bg-label-primary px-2 py-1">{{ $s->poli_name ?? 'Poli Umum' }}</span>
                        </td>

                        {{-- Rating Bintang --}}
                        <td>
                            <div class="d-flex text-warning">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="bx {{ $i <= $s->rating ? 'bxs-star' : 'bx-star text-muted opacity-50' }}" style="font-size: 16px;"></i>
                                @endfor
                            </div>
                        </td>

                        {{-- Pesan Testimoni --}}
                        <td>
                            <p class="mb-0 text-wrap small text-secondary" style="max-width: 420px; line-height: 1.5;">
                                "{{ $s->pesan }}"
                            </p>
                        </td>

                        {{-- Toggle Status Tampil --}}
                        <td class="text-center">
                            <form action="{{ route('admin.surveys.toggle', $s->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="badge border-0 {{ $s->is_approved ? 'bg-label-success' : 'bg-label-secondary' }} rounded-pill px-2 py-1 cursor-pointer" title="Klik untuk mengubah status publikasi">
                                    <i class="bx {{ $s->is_approved ? 'bx-check-circle' : 'bx-x-circle' }} me-1"></i>
                                    {{ $s->is_approved ? 'Publik' : 'Disembunyikan' }}
                                </button>
                            </form>
                        </td>

                        {{-- Aksi --}}
                        <td>
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                {{-- Edit Button --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editSurveyModal-{{ $s->id }}" title="Edit Testimoni">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                {{-- Delete Button --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-survey" 
                                        data-id="{{ $s->id }}" 
                                        data-name="{{ $s->name }}"
                                        title="Hapus Ulasan">
                                    <i class="bx bx-trash"></i>
                                </button>

                                <form id="delete-survey-form-{{ $s->id }}" action="{{ route('admin.surveys.destroy', $s->id) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>

                    {{-- MODAL EDIT SURVEI / TESTIMONI --}}
                    <div class="modal fade" id="editSurveyModal-{{ $s->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">
                                        <i class="bx bx-edit me-1 text-primary"></i> Edit Testimoni Pasien
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.surveys.update', $s->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" for="name_{{ $s->id }}">Nama Pasien / Responden <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="name_{{ $s->id }}" name="name" value="{{ $s->name }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" for="poli_{{ $s->id }}">Layanan / Poli yang Dikunjungi <span class="text-danger">*</span></label>
                                            <select class="form-select" id="poli_{{ $s->id }}" name="poli_name" required>
                                                <option value="Poli Umum" {{ $s->poli_name == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                                                <option value="Poli Gigi & Mulut" {{ $s->poli_name == 'Poli Gigi & Mulut' || $s->poli_name == 'Poli Gigi' ? 'selected' : '' }}>Poli Gigi & Mulut</option>
                                                <option value="Poli KIA & KB" {{ $s->poli_name == 'Poli KIA & KB' || $s->poli_name == 'Poli KIA/KB' ? 'selected' : '' }}>Poli KIA & KB</option>
                                                <option value="Layanan Farmasi & Obat" {{ $s->poli_name == 'Layanan Farmasi & Obat' ? 'selected' : '' }}>Layanan Farmasi & Obat</option>
                                                <option value="Laboratorium Klinis" {{ $s->poli_name == 'Laboratorium Klinis' ? 'selected' : '' }}>Laboratorium Klinis</option>
                                                <option value="Layanan UGD 24 Jam" {{ $s->poli_name == 'Layanan UGD 24 Jam' || $s->poli_name == 'UGD 24 Jam' ? 'selected' : '' }}>Layanan UGD 24 Jam</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" for="rating_{{ $s->id }}">Rating Kepuasan <span class="text-danger">*</span></label>
                                            <select class="form-select" id="rating_{{ $s->id }}" name="rating" required>
                                                <option value="5" {{ $s->rating == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ 5 Bintang (Sangat Puas)</option>
                                                <option value="4" {{ $s->rating == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ 4 Bintang (Puas)</option>
                                                <option value="3" {{ $s->rating == 3 ? 'selected' : '' }}>⭐⭐⭐ 3 Bintang (Cukup)</option>
                                                <option value="2" {{ $s->rating == 2 ? 'selected' : '' }}>⭐⭐ 2 Bintang (Kurang)</option>
                                                <option value="1" {{ $s->rating == 1 ? 'selected' : '' }}>⭐ 1 Bintang (Tidak Puas)</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-semibold" for="pesan_{{ $s->id }}">Pesan / Ulasan Testimoni <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="pesan_{{ $s->id }}" name="pesan" rows="3" required>{{ $s->pesan }}</textarea>
                                        </div>

                                        <div class="form-check form-switch mt-2">
                                            <input class="form-check-input" type="checkbox" id="is_approved_{{ $s->id }}" name="is_approved" value="1" {{ $s->is_approved ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="is_approved_{{ $s->id }}">Tampilkan di Landing Page (Publik)</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <div class="d-flex flex-column align-items-center">
                                <i class="bx bx-smile display-4 text-muted mb-2"></i>
                                <span class="text-muted fw-semibold">Belum ada data survei atau testimoni masuk.</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($surveys->hasPages())
        <div class="card-footer py-3 d-flex justify-content-end">
            {{ $surveys->links() }}
        </div>
        @endif
    </div>

</div>

{{-- MODAL TAMBAH TESTIMONI BARU --}}
<div class="modal fade" id="addSurveyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    <i class="bx bx-plus-circle me-1 text-primary"></i> Tambah Testimoni Pasien
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.surveys.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_name">Nama Pasien / Responden <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="add_name" name="name" placeholder="Contoh: Rina Anggraini" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_poli">Layanan / Poli yang Dikunjungi <span class="text-danger">*</span></label>
                        <select class="form-select" id="add_poli" name="poli_name" required>
                            <option value="Poli Umum">Poli Umum</option>
                            <option value="Poli Gigi & Mulut">Poli Gigi & Mulut</option>
                            <option value="Poli KIA & KB">Poli KIA & KB</option>
                            <option value="Layanan Farmasi & Obat">Layanan Farmasi & Obat</option>
                            <option value="Laboratorium Klinis">Laboratorium Klinis</option>
                            <option value="Layanan UGD 24 Jam">Layanan UGD 24 Jam</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_rating">Rating Kepuasan <span class="text-danger">*</span></label>
                        <select class="form-select" id="add_rating" name="rating" required>
                            <option value="5" selected>⭐⭐⭐⭐⭐ 5 Bintang (Sangat Puas)</option>
                            <option value="4">⭐⭐⭐⭐ 4 Bintang (Puas)</option>
                            <option value="3">⭐⭐⭐ 3 Bintang (Cukup)</option>
                            <option value="2">⭐⭐ 2 Bintang (Kurang)</option>
                            <option value="1">⭐ 1 Bintang (Tidak Puas)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="add_pesan">Pesan / Ulasan Testimoni <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="add_pesan" name="pesan" rows="3" placeholder="Tuliskan ulasan atau testimoni pengalaman berobat..." required></textarea>
                    </div>

                    <div class="form-check form-switch mt-2">
                        <input class="form-check-input" type="checkbox" id="add_is_approved" name="is_approved" value="1" checked>
                        <label class="form-check-label fw-semibold" for="add_is_approved">Tampilkan di Landing Page (Publik)</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Testimoni</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
{{-- SweetAlert2 JS --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete-survey');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const form = document.getElementById(`delete-survey-form-${id}`);

                Swal.fire({
                    title: 'Hapus Ulasan?',
                    text: `Apakah Anda yakin ingin menghapus testimoni dari "${name}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
