@extends('layouts.admin')

@section('title', 'Kelola Tanya Jawab (FAQ) - Puskesmas CareLink')

@section('content')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-help-circle me-2"></i>Kelola Tanya Jawab (FAQ)
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tanya Jawab (FAQ)</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('faq.index') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-2 shadow-xs">
                <i class="bx bx-link-external"></i>
                <span>Lihat Halaman Publik</span>
            </a>
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-xs">
                <i class="bx bx-plus-circle"></i>
                <span>Tambah FAQ Baru</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 d-flex align-items-center mb-4" role="alert" style="background-color: #E6F4EA; color: #137333; border-left: 4px solid #137333 !important; border-radius: 8px;">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Stats Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-primary rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-help-circle fs-3 text-primary"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Total Pertanyaan</span>
                        <h4 class="mb-0 fw-bold text-dark">{{ $totalFaq }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-success rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-check-double fs-3 text-success"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">FAQ Ditampilkan (Aktif)</span>
                        <h4 class="mb-0 fw-bold text-success">{{ $totalActive }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-info rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-category fs-3 text-info"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Kategori Layanan</span>
                        <h4 class="mb-0 fw-bold text-info">{{ count($categories) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Toolbar & Data Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header border-bottom py-3">
            <form action="{{ route('admin.faq.index') }}" method="GET" class="row g-2 align-items-center">
                {{-- Search Bar --}}
                <div class="col-md-5 col-12">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari pertanyaan atau jawaban..." value="{{ $search }}">
                        @if($search)
                            <a href="{{ route('admin.faq.index', array_filter(['kategori' => $categoryFilter, 'status' => $statusFilter])) }}" class="input-group-text text-muted" title="Hapus pencarian">
                                <i class="bx bx-x"></i>
                            </a>
                        @endif
                    </div>
                </div>

                {{-- Filter Kategori --}}
                <div class="col-md-3 col-6">
                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ $categoryFilter === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Status --}}
                <div class="col-md-2 col-6">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Status --</option>
                        <option value="active" {{ $statusFilter === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $statusFilter === 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </div>

                {{-- Submit & Reset --}}
                <div class="col-md-2 col-12 d-flex gap-1">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bx bx-filter-alt"></i> Filter
                    </button>
                    @if($search || $categoryFilter || $statusFilter)
                        <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-secondary" title="Reset filter">
                            <i class="bx bx-reset"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;" class="text-center">No</th>
                        <th style="min-width: 280px;">Pertanyaan & Kategori</th>
                        <th style="min-width: 320px;">Ringkasan Jawaban</th>
                        <th style="width: 110px;" class="text-center">Status</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $item)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-label-secondary fw-bold px-2 py-1 rounded">
                                    #{{ $item->urutan }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark fs-6 mb-1 text-wrap" style="max-width: 380px;">
                                    {{ $item->pertanyaan }}
                                </div>
                                <span class="badge bg-label-primary small">
                                    <i class="bx bx-tag me-1"></i>{{ $item->kategori }}
                                </span>
                            </td>
                            <td>
                                <p class="text-muted mb-0 text-wrap small" style="max-width: 460px; line-height: 1.5;">
                                    {{ Str::limit($item->jawaban, 140) }}
                                </p>
                            </td>
                            <td class="text-center">
                                <div class="form-check form-switch d-inline-block">
                                    <input class="form-check-input switch-faq-status cursor-pointer" 
                                           type="checkbox" 
                                           data-id="{{ $item->id }}" 
                                           {{ $item->is_active ? 'checked' : '' }}
                                           title="Klik untuk ubah status aktif">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="{{ route('admin.faq.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-warning" title="Edit Pertanyaan">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-faq" 
                                            data-id="{{ $item->id }}" 
                                            data-question="{{ $item->pertanyaan }}"
                                            title="Hapus Pertanyaan">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bx bx-help-circle display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                                    <h6 class="fw-bold mb-1">Belum Ada Pertanyaan FAQ</h6>
                                    <p class="small mb-3">Tambahkan pertanyaan umum seputar Puskesmas agar memudahkan masyarakat.</p>
                                    <a href="{{ route('admin.faq.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bx bx-plus me-1"></i> Tambah Pertanyaan Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($faqs->hasPages())
            <div class="card-footer border-top d-flex justify-content-between align-items-center py-3">
                <div class="text-muted small">
                    Menampilkan {{ $faqs->firstItem() }} - {{ $faqs->lastItem() }} dari {{ $faqs->total() }} pertanyaan
                </div>
                <div>
                    {{ $faqs->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Konfirmasi Hapus dengan SweetAlert2
    const deleteButtons = document.querySelectorAll('.btn-delete-faq');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.getAttribute('data-id');
            const question = this.getAttribute('data-question');

            Swal.fire({
                title: 'Hapus Pertanyaan FAQ?',
                html: `Apakah Anda yakin ingin menghapus pertanyaan:<br><strong class="text-danger">"${question}"</strong>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-danger me-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        });
    });

    // 2. Toggle Status AJAX
    const statusSwitches = document.querySelectorAll('.switch-faq-status');
    statusSwitches.forEach(switchEl => {
        switchEl.addEventListener('change', function() {
            const id = this.getAttribute('data-id');
            const isChecked = this.checked;

            fetch(`/admin/faq/${id}/toggle-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'success',
                        title: data.is_active ? 'FAQ diaktifkan di halaman publik' : 'FAQ dinonaktifkan'
                    });
                }
            })
            .catch(err => {
                switchEl.checked = !isChecked;
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Gagal memperbarui status FAQ. Silakan coba kembali.'
                });
            });
        });
    });
});
</script>
@endpush
