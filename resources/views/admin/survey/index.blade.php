@extends('layouts.admin')

@section('title', 'Survei Kepuasan Pasien - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-smile me-2"></i>Survei Kepuasan Pasien
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Survei Kepuasan Pasien</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('survei.index') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-link-external"></i>
                <span>Formulir Publik</span>
            </a>
            <a href="{{ url('/#survei-pasien') }}" target="_blank" class="btn btn-outline-secondary d-inline-flex align-items-center gap-1">
                <i class="bx bx-show"></i>
                <span>Lihat di Beranda</span>
            </a>
        </div>
    </div>

    {{-- Alert Session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bx bx-error-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistik Metrik Survei Pasien (4 Cards Sneat) --}}
    <div class="row g-3 mb-4">
        {{-- Card 1: Skor Rata-Rata --}}
        <div class="col-sm-6 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning">
                                <i class="bx bxs-star fs-4"></i>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ number_format($avgRating ?? 5.0, 1) }}</h4>
                        <span class="text-muted small ms-1">/ 5.0</span>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Skor Rata-Rata Kepuasan</p>
                </div>
            </div>
        </div>

        {{-- Card 2: Total Responden Masuk --}}
        <div class="col-sm-6 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary">
                                <i class="bx bx-user-voice fs-4"></i>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalResponden }}</h4>
                        <span class="text-muted small ms-1">Ulasan</span>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Total Responden Masuk</p>
                </div>
            </div>
        </div>

        {{-- Card 3: Ulasan Publik (Ditampilkan di Website) --}}
        <div class="col-sm-6 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success">
                                <i class="bx bx-check-shield fs-4"></i>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalApproved }}</h4>
                        <span class="text-muted small ms-1">Aktif</span>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Ulasan Publik di Beranda</p>
                </div>
            </div>
        </div>

        {{-- Card 4: Ulasan Unggulan (Featured/Pin) --}}
        <div class="col-sm-6 col-lg-3 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info">
                                <i class="bx bxs-award fs-4"></i>
                            </span>
                        </div>
                        <h4 class="ms-1 mb-0">{{ $totalFeatured }}</h4>
                        <span class="text-muted small ms-1">Unggulan</span>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Ulasan Unggulan (Pin)</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Card Sneat --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.surveys.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    {{-- Input Cari --}}
                    <div class="col-md-5 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Cari nama pasien, kontak, atau ulasan..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>

                    {{-- Filter Poli --}}
                    <div class="col-md-3 col-12">
                        <select name="poli" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Semua Poliklinik --</option>
                            @if(isset($availablePolis) && $availablePolis->isNotEmpty())
                                @foreach($availablePolis as $p)
                                    <option value="{{ $p }}" {{ request('poli') == $p ? 'selected' : '' }}>{{ $p }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Filter Rating --}}
                    <div class="col-md-2 col-12">
                        <select name="rating" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Rating</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐ 5 Bintang</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐ 4 Bintang</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐ 3 Bintang</option>
                            <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐ 2 Bintang</option>
                            <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐ 1 Bintang</option>
                        </select>
                    </div>

                    {{-- Tombol Filter & Reset --}}
                    <div class="col-md-2 col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-search me-1"></i> Cari
                        </button>
                        @if(request('search') || request('poli') || request('rating'))
                            <a href="{{ route('admin.surveys.index') }}" class="btn btn-outline-secondary" title="Reset">
                                <i class="bx bx-reset"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table Card Sneat --}}
    <div class="card">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Survei & Evaluasi Pasien ({{ $surveys->total() }} Total)</h5>
            <small class="text-muted">Menampilkan {{ $surveys->firstItem() ?? 0 }} - {{ $surveys->lastItem() ?? 0 }} dari {{ $surveys->total() }} ulasan</small>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="text-center">No</th>
                        <th style="width: 200px;">Nama Pasien</th>
                        <th style="width: 170px;">Layanan / Poli</th>
                        <th style="width: 170px;">Rating</th>
                        <th>Masukan & Ulasan Pasien</th>
                        <th class="text-center" style="width: 90px;">Unggulan</th>
                        <th class="text-center" style="width: 110px;">Status Web</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($surveys as $index => $s)
                    <tr>
                        {{-- Nomor Urut --}}
                        <td class="text-center fw-semibold text-muted">{{ $surveys->firstItem() + $index }}</td>

                        {{-- Responden Pasien --}}
                        <td>
                            <strong class="text-dark d-block fs-6">
                                {{ $s->name }}
                                @if(stripos($s->name, 'Anonim') !== false)
                                    <span class="badge bg-label-secondary ms-1" style="font-size: 10px;">Anonim</span>
                                @endif
                            </strong>
                            <small class="text-muted">{{ $s->created_at->format('d M Y, H:i') }}</small>
                        </td>

                        {{-- Poli / Layanan --}}
                        <td>
                            <span class="badge bg-label-primary">{{ $s->poli_name ?? 'Poli Umum' }}</span>
                            @if($s->email_or_phone)
                                <small class="text-muted d-block mt-1"><i class="bx bx-phone me-1"></i>{{ $s->email_or_phone }}</small>
                            @endif
                        </td>

                        {{-- Rating Bintang: Tampilan 5 Bintang Bersih & Rapi --}}
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <div class="d-inline-flex align-items-center" style="color: #FFAB00; font-size: 16px; gap: 1px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $s->rating)
                                            <i class="bx bxs-star"></i>
                                        @else
                                            <i class="bx bx-star text-muted opacity-50"></i>
                                        @endif
                                    @endfor
                                </div>
                                <span class="fw-bold ms-1" style="font-size: 13px;">{{ $s->rating }}.0</span>
                            </div>
                        </td>

                        {{-- Pesan Ulasan Pasien --}}
                        <td>
                            <span class="text-wrap d-inline-block text-secondary" style="max-width: 360px; font-size: 13px; line-height: 1.4;">
                                "{{ \Illuminate\Support\Str::limit($s->pesan, 90) }}"
                            </span>
                        </td>

                        {{-- Toggle Unggulan (Pin/Featured) --}}
                        <td class="text-center">
                            <form action="{{ route('admin.surveys.toggle-featured', $s->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="btn btn-sm btn-icon {{ $s->is_featured ? 'btn-outline-warning text-warning' : 'btn-outline-secondary' }}" 
                                        title="{{ $s->is_featured ? 'Ulasan Unggulan (Klik untuk batalkan)' : 'Jadikan Unggulan di Beranda' }}">
                                    <i class="bx {{ $s->is_featured ? 'bxs-star fs-5 text-warning' : 'bx-star fs-5' }}"></i>
                                </button>
                            </form>
                        </td>

                        {{-- Toggle Status Tampil (Publik / Draft) --}}
                        <td class="text-center">
                            <form action="{{ route('admin.surveys.toggle', $s->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="badge rounded-pill border-0 {{ $s->is_approved ? 'bg-label-success' : 'bg-label-secondary' }} px-3 py-2 cursor-pointer" 
                                        title="Klik untuk mengubah status publikasi di website">
                                    <i class="bx {{ $s->is_approved ? 'bx-check-circle' : 'bx-hide' }} me-1"></i>
                                    {{ $s->is_approved ? 'Publik' : 'Draft' }}
                                </button>
                            </form>
                        </td>

                        {{-- Aksi: Sesuai Tombol Sneat (Kotak Outline) --}}
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-1">
                                {{-- Tombol Detail Modal --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-info btn-show-survey" 
                                        data-id="{{ $s->id }}" 
                                        title="Lihat Detail Ulasan">
                                    <i class="bx bx-show"></i>
                                </button>

                                {{-- Tombol Edit Modal --}}
                                <button type="button" class="btn btn-sm btn-icon btn-outline-warning btn-edit-survey" 
                                        data-id="{{ $s->id }}" 
                                        title="Edit Ulasan">
                                    <i class="bx bx-edit-alt"></i>
                                </button>

                                {{-- Tombol Hapus (SweetAlert2) --}}
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
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bx bx-user-x display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                            <span>Belum ada data ulasan survei pasien.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Sneat --}}
        @if($surveys->hasPages())
        <div class="card-footer border-top d-flex justify-content-end py-3">
            {{ $surveys->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

{{-- =========================================================================
   MODAL 1: LIHAT DETAIL ULASAN (SNEAT STYLE)
   ========================================================================= --}}
<div class="modal fade" id="modalDetailSurvey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-bottom py-3">
                <h5 class="modal-title fw-bold text-primary">
                    <i class="bx bx-info-circle me-1"></i> Rincian Ulasan Pasien
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body py-4">
                <div class="d-flex align-items-center gap-3 mb-4 p-3 bg-light rounded-3 border">
                    <div id="detail_avatar" class="avatar avatar-md bg-label-primary rounded-circle d-flex align-items-center justify-content-center fw-bold fs-5">
                        --
                    </div>
                    <div>
                        <h6 id="detail_name" class="fw-bold mb-0 text-dark">Nama Pasien</h6>
                        <small id="detail_phone" class="text-muted d-block">Kontak: -</small>
                        <small id="detail_date" class="text-muted d-block">Waktu: -</small>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <label class="small text-muted d-block fw-semibold text-uppercase">Poliklinik / Layanan</label>
                        <span id="detail_poli" class="badge bg-label-primary rounded-pill px-3 py-1 fw-bold fs-7">Poli Umum</span>
                    </div>
                    <div class="col-6">
                        <label class="small text-muted d-block fw-semibold text-uppercase">Tingkat Kepuasan</label>
                        <span id="detail_rating" class="badge bg-label-warning rounded-pill px-3 py-1 fw-bold fs-7">
                            <i class="bx bxs-star me-1"></i> 5.0
                        </span>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="small text-muted d-block fw-semibold text-uppercase mb-1">Status Publikasi</label>
                    <div class="d-flex gap-2">
                        <span id="detail_status_approved" class="badge bg-label-success">Publik</span>
                        <span id="detail_status_featured" class="badge bg-label-warning">Unggulan</span>
                    </div>
                </div>

                <div>
                    <label class="small text-muted d-block fw-semibold text-uppercase mb-1">Masukan & Kritik Saran Lengkap</label>
                    <div id="detail_pesan" class="p-3 bg-light rounded border text-secondary" style="font-size: 13.5px; line-height: 1.6; white-space: pre-wrap;">
                        --
                    </div>
                </div>
            </div>

            <div class="modal-footer border-top py-3">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

{{-- =========================================================================
   MODAL 2: EDIT SURVEI / ULASAN (SNEAT STYLE)
   ========================================================================= --}}
<div class="modal fade" id="modalEditSurvey" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom py-3">
                <h5 class="modal-title fw-bold text-primary">
                    <i class="bx bx-edit me-1"></i> Edit Ulasan Pasien
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEditSurvey" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold" for="edit_name">Nama Pasien <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold" for="edit_phone">No. WhatsApp / Kontak</label>
                            <input type="text" class="form-control" id="edit_phone" name="email_or_phone">
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold" for="edit_poli">Layanan / Poliklinik <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_poli" name="poli_name" required>
                                @if(isset($layanans) && $layanans->isNotEmpty())
                                    @foreach($layanans as $lay)
                                        <option value="{{ $lay->title }}">{{ $lay->title }}</option>
                                    @endforeach
                                @endif
                                <option value="Loket Pendaftaran & Rekam Medis">Loket Pendaftaran & Rekam Medis</option>
                                <option value="Poli Umum">Poli Umum</option>
                                <option value="Poli Gigi & Mulut">Poli Gigi & Mulut</option>
                                <option value="Poli KIA & KB">Poli KIA & KB</option>
                                <option value="Laboratorium Klinis">Laboratorium Klinis</option>
                                <option value="Farmasi & Apotek Obat">Farmasi & Apotek Obat</option>
                                <option value="Layanan UGD 24 Jam">Layanan UGD 24 Jam</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12">
                            <label class="form-label fw-semibold" for="edit_rating">Tingkat Kepuasan (Rating) <span class="text-danger">*</span></label>
                            <select class="form-select" id="edit_rating" name="rating" required>
                                <option value="5">⭐ 5.0 - Sangat Puas</option>
                                <option value="4">⭐ 4.0 - Puas</option>
                                <option value="3">⭐ 3.0 - Cukup</option>
                                <option value="2">⭐ 2.0 - Kurang</option>
                                <option value="1">⭐ 1.0 - Sangat Kurang</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" for="edit_pesan">Kritik, Masukan & Saran Pasien <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="edit_pesan" name="pesan" rows="4" required></textarea>
                        </div>

                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-4 pt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_approved" id="edit_is_approved" value="1">
                                    <label class="form-check-label fw-semibold" for="edit_is_approved">
                                        Publikasikan ke Website (Muncul di Landing Page)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="is_featured" id="edit_is_featured" value="1">
                                    <label class="form-check-label fw-semibold" for="edit_is_featured">
                                        Tandai sebagai Ulasan Unggulan (Pin Pertama)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-top py-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Tampilkan Modal Detail Ulasan via AJAX
    function showSurveyDetail(id) {
        fetch(`{{ url('admin/surveys') }}/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('detail_name').innerText = data.name;
                document.getElementById('detail_phone').innerText = 'Kontak: ' + (data.email_or_phone || '-');
                document.getElementById('detail_date').innerText = 'Waktu: ' + data.created_at;
                document.getElementById('detail_poli').innerText = data.poli_name;
                document.getElementById('detail_rating').innerHTML = `<i class="bx bxs-star text-warning me-1"></i> ${data.rating}.0`;
                document.getElementById('detail_pesan').innerText = `"${data.pesan}"`;
                
                const initials = data.name.substring(0, 2).toUpperCase();
                document.getElementById('detail_avatar').innerText = initials;

                const approvedBadge = document.getElementById('detail_status_approved');
                if (data.is_approved) {
                    approvedBadge.className = 'badge bg-label-success';
                    approvedBadge.innerText = 'Dipublikasikan di Beranda';
                } else {
                    approvedBadge.className = 'badge bg-label-secondary';
                    approvedBadge.innerText = 'Draft (Disembunyikan)';
                }

                const featuredBadge = document.getElementById('detail_status_featured');
                if (data.is_featured) {
                    featuredBadge.style.display = 'inline-block';
                    featuredBadge.className = 'badge bg-label-warning';
                    featuredBadge.innerText = '⭐ Ulasan Unggulan';
                } else {
                    featuredBadge.style.display = 'none';
                }

                const modal = new bootstrap.Modal(document.getElementById('modalDetailSurvey'));
                modal.show();
            })
            .catch(err => {
                console.error('Error fetching survey detail:', err);
            });
    }

    const surveysData = @json($surveys->keyBy('id'));

    // Isi Form Edit dan Buka Modal Edit
    function editSurvey(id) {
        const survey = surveysData[id];
        if (!survey) return;

        const form = document.getElementById('formEditSurvey');
        form.action = `{{ url('admin/surveys') }}/${survey.id}`;

        document.getElementById('edit_name').value = survey.name;
        document.getElementById('edit_phone').value = survey.email_or_phone || '';
        document.getElementById('edit_poli').value = survey.poli_name;
        document.getElementById('edit_rating').value = survey.rating;
        document.getElementById('edit_pesan').value = survey.pesan;
        document.getElementById('edit_is_approved').checked = Boolean(survey.is_approved);
        document.getElementById('edit_is_featured').checked = Boolean(survey.is_featured);

        const modal = new bootstrap.Modal(document.getElementById('modalEditSurvey'));
        modal.show();
    }

    // Event Listener untuk Tombol Detail Modal
    document.querySelectorAll('.btn-show-survey').forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            showSurveyDetail(id);
        });
    });

    // Event Listener untuk Tombol Edit Modal
    document.querySelectorAll('.btn-edit-survey').forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            editSurvey(id);
        });
    });

    // Konfirmasi Hapus SweetAlert2 / Fallback
    document.querySelectorAll('.btn-delete-survey').forEach(function (button) {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Ulasan dari "${name}" akan dihapus permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-survey-form-${id}`).submit();
                    }
                });
            } else {
                if (confirm(`Apakah Anda yakin ingin menghapus data ulasan dari "${name}"?`)) {
                    document.getElementById(`delete-survey-form-${id}`).submit();
                }
            }
        });
    });
</script>
@endpush
