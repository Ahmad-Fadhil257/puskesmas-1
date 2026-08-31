@extends('layouts.admin')

@section('title', 'Survei Kepuasan Masyarakat & Testimoni - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-smile me-2"></i>Survei Kepuasan Masyarakat
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Survei & Testimoni</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('survei.index') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-link-external"></i>
                <span>Lihat Form Publik</span>
            </a>
            <a href="{{ url('/#testimoni') }}" target="_blank" class="btn btn-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-show"></i>
                <span>Testimoni Landing Page</span>
            </a>
        </div>
    </div>


    {{-- STATISTIK IKM (Indeks Kepuasan Masyarakat) - DISEMBUNYIKAN --}}
    {{--
    <div class="row g-3 mb-4">
        <div class="col-md-4 col-12">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bx bxs-star fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block text-uppercase" style="letter-spacing: 0.05em; font-size: 11px;">Indeks Kepuasan (IKM)</span>
                        <div class="d-flex align-items-baseline gap-2 mt-1">
                            <h3 class="mb-0 fw-bolder">{{ $avgRating }}</h3>
                            <span class="text-muted small fw-semibold">/ 5.0</span>
                            <span class="badge bg-label-success ms-1 px-2 py-1">Mutu A</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-success rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bx bx-happy-beaming fs-2 text-success"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block text-uppercase" style="letter-spacing: 0.05em; font-size: 11px;">Tingkat Kepuasan</span>
                        <div class="d-flex align-items-baseline gap-2 mt-1">
                            <h3 class="mb-0 fw-bolder">{{ $satisfactionPct }}%</h3>
                            <span class="text-success small fw-semibold">Sangat Puas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar avatar-lg bg-label-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                        <i class="bx bx-user-voice fs-2 text-primary"></i>
                    </div>
                    <div>
                        <span class="text-muted small fw-semibold d-block text-uppercase" style="letter-spacing: 0.05em; font-size: 11px;">Total Responden</span>
                        <div class="d-flex align-items-baseline gap-2 mt-1">
                            <h3 class="mb-0 fw-bolder">{{ $totalResponden }}</h3>
                            <span class="text-muted small fw-semibold">Ulasan Masuk</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    --}}

    {{-- TABEL DATA SURVEI & TESTIMONI --}}
    <div class="card">
        <div class="card-header border-bottom py-3">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <h5 class="mb-1 fw-bold d-flex align-items-center gap-2">
                        <i class="bx bx-conversation text-primary"></i>
                        Daftar Ulasan & Evaluasi Pasien
                    </h5>
                    <small class="text-muted">Pilih ulasan berkualitas untuk ditampilkan ke landing page dengan mengklik tombol status <strong>Publik</strong>.</small>
                </div>

                {{-- FILTER RATING BINTANG --}}
                <div class="d-flex align-items-center gap-1 flex-wrap">
                    <a href="{{ route('admin.surveys.index') }}" 
                       class="btn btn-sm {{ !$ratingFilter ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                        Semua
                        <span class="badge {{ !$ratingFilter ? 'bg-white text-primary' : 'bg-label-secondary' }} ms-1">{{ $totalResponden }}</span>
                    </a>
                    @foreach([5,4,3,2,1] as $star)
                    <a href="{{ route('admin.surveys.index', ['rating' => $star]) }}" 
                       class="btn btn-sm {{ $ratingFilter == $star ? 'btn-warning text-white' : 'btn-outline-warning' }} rounded-pill px-2 d-inline-flex align-items-center gap-1">
                        <i class="bx bxs-star {{ $ratingFilter == $star ? 'text-white' : 'text-warning' }}"></i>
                        <span>{{ $star }}</span>
                        <span class="badge {{ $ratingFilter == $star ? 'bg-white text-warning' : 'bg-label-warning text-dark' }} ms-1">{{ $ratingCounts[$star] }}</span>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 220px;">Responden Pasien</th>
                        <th style="width: 170px;">Layanan / Poli</th>
                        <th style="width: 130px;">Rating</th>
                        <th style="min-width: 320px;">Masukan & Ulasan Pasien</th>
                        <th class="text-center" style="width: 130px;">Status di Web</th>
                        <th class="text-center" style="width: 80px;">Aksi</th>
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
                                    <div class="fw-semibold" style="font-size: 13.5px;">{{ $s->name }}</div>
                                    <small class="text-muted" style="font-size: 11.5px;">
                                        <i class="bx bx-time-five me-1"></i>{{ $s->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        {{-- Poli / Layanan --}}
                        <td>
                            <span class="badge bg-label-primary rounded-pill px-3 py-1 fw-semibold" style="font-size: 12px;">
                                {{ $s->poli_name ?? 'Poli Umum' }}
                            </span>
                        </td>

                        {{-- Rating Bintang --}}
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <span class="badge {{ $s->rating >= 4 ? 'bg-label-warning' : ($s->rating == 3 ? 'bg-label-info' : 'bg-label-danger') }} rounded-pill px-2 py-1 d-inline-flex align-items-center gap-1">
                                    <i class="bx bxs-star text-warning"></i>
                                    <span class="fw-bold">{{ $s->rating }}.0</span>
                                </span>
                            </div>
                        </td>

                        {{-- Pesan Testimoni --}}
                        <td>
                            <p class="mb-0 text-wrap small text-secondary" style="max-width: 440px; line-height: 1.5; font-size: 13px;">
                                "{{ $s->pesan }}"
                            </p>
                        </td>

                        {{-- Toggle Status Tampil --}}
                        <td class="text-center">
                            <form action="{{ route('admin.surveys.toggle', $s->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="badge border-0 rounded-pill px-3 py-2 cursor-pointer {{ $s->is_approved ? 'bg-label-success' : 'bg-label-secondary' }} d-inline-flex align-items-center gap-1" 
                                        title="Klik untuk mengubah status publikasi di landing page"
                                        style="font-size: 12px; font-weight: 600;">
                                    <i class="bx {{ $s->is_approved ? 'bx-check-circle' : 'bx-hide' }}"></i>
                                    <span>{{ $s->is_approved ? 'Publik' : 'Draft' }}</span>
                                </button>
                            </form>
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-survey rounded-circle" 
                                    data-id="{{ $s->id }}" 
                                    data-name="{{ $s->name }}"
                                    title="Hapus Ulasan">
                                <i class="bx bx-trash"></i>
                            </button>

                            <form id="delete-survey-form-{{ $s->id }}" action="{{ route('admin.surveys.destroy', $s->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="d-flex flex-column align-items-center">
                                <div class="avatar avatar-xl bg-label-secondary rounded-circle d-flex align-items-center justify-content-center mb-3">
                                    <i class="bx bx-search-alt display-6 text-muted"></i>
                                </div>
                                <h6 class="fw-bold mb-1">
                                    @if($ratingFilter)
                                        Tidak Ada Ulasan Bintang {{ $ratingFilter }}
                                    @else
                                        Belum Ada Data Survei
                                    @endif
                                </h6>
                                <p class="text-muted small mb-3">
                                    @if($ratingFilter)
                                        Belum ada responden yang memberikan penilaian {{ $ratingFilter }} bintang.
                                    @else
                                        Ulasan dari masyarakat akan masuk secara otomatis setelah mengisi form survei.
                                    @endif
                                </p>
                                @if($ratingFilter)
                                    <a href="{{ route('admin.surveys.index') }}" class="btn btn-sm btn-primary rounded-pill px-3">
                                        <i class="bx bx-refresh me-1"></i> Tampilkan Semua Ulasan
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($surveys->hasPages())
        <div class="card-footer py-3 d-flex justify-content-end border-top">
            {{ $surveys->links() }}
        </div>
        @endif
    </div>


@push('scripts')
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
                    text: `Apakah Anda yakin ingin menghapus ulasan dari "${name}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2 rounded-pill px-3',
                        cancelButton: 'btn btn-secondary rounded-pill px-3'
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
