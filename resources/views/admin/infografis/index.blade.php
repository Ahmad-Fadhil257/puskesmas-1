@extends('layouts.admin')

@section('title', 'Kelola Infografis - Puskesmas Sukaluyu')

@section('content')

    {{-- Breadcrumb & Header Sneat --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-images me-2"></i>Kelola Galeri Infografis
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Infografis</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('infografis') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1 shadow-xs">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
            {{-- Tombol Tambah Infografis --}}
            <a href="{{ route('admin.infografis.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-xs">
                <i class="bx bx-plus-circle"></i>
                <span>Tambah Infografis</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4 shadow-sm border-0" role="alert" style="background-color: #E6F4EA; color: #137333; border-left: 4px solid #137333 !important; border-radius: 8px;">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4 shadow-sm border-0" role="alert" style="background-color: #FCE8E6; color: #C5221F; border-left: 4px solid #C5221F !important; border-radius: 8px;">
            <div class="d-flex align-items-center mb-1">
                <i class="bx bx-error-circle fs-4 me-2"></i>
                <strong>Terdapat kesalahan pada isian form:</strong>
            </div>
            <ul class="mb-0 ps-4 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistics Row (Sneat Cards) --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-primary rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-images fs-3 text-primary"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small fw-semibold">Total Infografis</span>
                        <h4 class="mb-0 fw-bold">{{ $totalInfografis }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-success rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-check-double fs-3 text-success"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small fw-semibold">Infografis Aktif</span>
                        <h4 class="mb-0 fw-bold">{{ $totalActive }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-info rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-category fs-3 text-info"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small fw-semibold">Total Kategori</span>
                        <h4 class="mb-0 fw-bold">{{ $kategoris->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Card --}}
    <div class="card mb-4 border-0 shadow-sm">
        <div class="card-body py-3">
            <form action="{{ route('admin.infografis.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-5 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari judul atau topik infografis..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <select name="kategori" class="form-select">
                            <option value="">-- Semua Kategori --</option>
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-12 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-filter-alt me-1"></i> Filter
                        </button>
                        @if(request()->hasAny(['search', 'kategori', 'status']))
                            <a href="{{ route('admin.infografis.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="bx bx-reset"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table Card --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header border-bottom py-3 d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0 fw-bold d-flex align-items-center gap-2">
                <i class="bx bx-list-ul text-primary"></i>
                <span>Daftar Infografis Puskesmas</span>
            </h5>
            <small class="text-muted">Total: {{ $infografis->total() }} Data</small>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Poster</th>
                        <th>Judul Infografis</th>
                        <th style="width: 140px;">Kategori</th>
                        <th style="width: 90px;" class="text-center">Urutan</th>
                        <th style="width: 110px;" class="text-center">Status</th>
                        <th style="width: 150px;">Tanggal Unggah</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($infografis as $item)
                        <tr>
                            {{-- Poster Thumbnail (Full Uncropped) --}}
                            <td>
                                <div class="position-relative d-flex align-items-center justify-content-center rounded overflow-hidden shadow-xs cursor-pointer"
                                     style="width: 75px; height: 95px; background: rgba(0, 0, 0, 0.05); border: 1px solid rgba(148, 163, 184, 0.3);"
                                     data-preview-img="{{ $item->image_url }}"
                                     data-preview-title="{{ $item->title }}"
                                     onclick="previewImage(this.dataset.previewImg, this.dataset.previewTitle)"
                                     title="Klik untuk melihat poster penuh">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                         data-fallback="{{ asset('assets/images/infografis-placeholder.svg') }}"
                                         class="w-100 h-100" style="object-fit: contain; padding: 2px;"
                                         onerror="this.onerror=null; this.src=this.dataset.fallback;">
                                    <span class="position-absolute bottom-0 end-0 bg-dark bg-opacity-75 text-white px-1 rounded-top" style="font-size: 10px;">
                                        <i class="bx bx-zoom-in"></i>
                                    </span>
                                </div>
                            </td>

                            {{-- Judul --}}
                            <td>
                                <div style="max-width: 380px; white-space: normal;">
                                    <span class="fw-bold d-block fs-6 text-dark">{{ $item->title }}</span>
                                </div>
                            </td>

                            {{-- Kategori Badge --}}
                            <td>
                                <span class="badge bg-label-primary px-3 py-2 fw-semibold">
                                    {{ $item->kategori ?? 'Umum' }}
                                </span>
                            </td>

                            {{-- Order --}}
                            <td class="text-center">
                                <span class="badge bg-label-secondary fw-bold px-2 py-1">
                                    {{ $item->order }}
                                </span>
                            </td>

                            {{-- Status Aktif/Nonaktif --}}
                            <td class="text-center">
                                <form action="{{ route('admin.infografis.toggle-status', $item) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" 
                                            class="badge border-0 {{ $item->is_active ? 'bg-label-success' : 'bg-label-secondary' }} px-3 py-2 cursor-pointer"
                                            title="Klik untuk mengubah status">
                                        <i class="bx {{ $item->is_active ? 'bxs-circle text-success' : 'bx-circle text-secondary' }} me-1" style="font-size: 8px;"></i>
                                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Tanggal --}}
                            <td>
                                <span class="text-muted small d-block">{{ $item->created_at->format('d M Y') }}</span>
                                <small class="text-muted" style="font-size: 11px;">{{ $item->created_at->format('H:i') }} WIB</small>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="d-inline-flex gap-1">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.infografis.edit', $item->id) }}" 
                                       class="btn btn-sm btn-icon btn-outline-warning"
                                       title="Edit Infografis">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <button type="button" 
                                            class="btn btn-sm btn-icon btn-outline-danger btn-delete-infografis"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            title="Hapus Infografis">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.infografis.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="avatar avatar-xl bg-label-secondary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bx bx-images fs-1 text-muted"></i>
                                </div>
                                <h6 class="fw-bold mb-1">Belum Ada Data Infografis</h6>
                                <p class="text-muted small mb-3">Tidak ada data infografis yang ditemukan sesuai filter atau pencarian Anda.</p>
                                <a href="{{ route('admin.infografis.create') }}" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1">
                                    <i class="bx bx-plus-circle"></i>
                                    <span>Tambah Infografis Baru</span>
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($infografis->hasPages())
            <div class="card-footer d-flex flex-column align-items-center justify-content-center gap-2 py-3 border-top">
                <small class="text-muted">Halaman {{ $infografis->currentPage() }} dari {{ $infografis->lastPage() }}</small>
                <div>
                    {{ $infografis->links() }}
                </div>
            </div>
        @endif
    </div>

    {{-- =========================================================================
       LIGHTBOX PREVIEW POSTER (Untuk Melihat Poster Ukuran Penuh)
       ========================================================================= --}}
    <div class="modal fade" id="modalPreviewPoster" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header border-bottom py-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2 overflow-hidden me-2">
                        <i class="bx bx-image text-primary fs-4"></i>
                        <h6 class="modal-title fw-bold text-truncate mb-0" id="modalPreviewTitle">Pratinjau Infografis</h6>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a id="modalPreviewOpenNew" href="" target="_blank" class="btn btn-sm btn-outline-primary d-none d-sm-inline-flex align-items-center gap-1">
                            <i class="bx bx-link-external"></i>
                            <span>Buka Asli</span>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                <div class="modal-body p-3 text-center d-flex align-items-center justify-content-center" style="background: rgba(0, 0, 0, 0.9); min-height: 60vh;">
                    <img id="modalPreviewImgSrc" src="" alt="Pratinjau Poster" class="img-fluid rounded shadow" style="max-height: 82vh; max-width: 100%; object-fit: contain; margin: 0 auto;">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Preview gambar besar di modal lightbox (Full Uncropped)
    function previewImage(url, title) {
        if (!url) return;
        const img = document.getElementById('modalPreviewImgSrc');
        if (img) img.src = url;
        const titleEl = document.getElementById('modalPreviewTitle');
        if (titleEl) titleEl.innerText = title || 'Pratinjau Infografis';
        const openBtn = document.getElementById('modalPreviewOpenNew');
        if (openBtn) openBtn.href = url;
        const modalEl = document.getElementById('modalPreviewPoster');
        if (modalEl) {
            if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();
            } else if (typeof $ !== 'undefined' && $.fn.modal) {
                $(modalEl).modal('show');
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // SweetAlert Delete Confirmation
        document.querySelectorAll('.btn-delete-infografis').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title') || 'infografis ini';
                const form = document.getElementById('delete-form-' + id);
                
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        title: 'Hapus Infografis?',
                        text: `"${title}" akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: '<i class="bx bx-trash me-1"></i> Ya, Hapus',
                        cancelButtonText: 'Batal',
                        reverseButtons: true,
                        customClass: {
                            confirmButton: 'btn btn-danger me-2',
                            cancelButton: 'btn btn-outline-secondary'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.isConfirmed && form) {
                            form.submit();
                        }
                    });
                } else {
                    if (confirm(`Yakin ingin menghapus infografis "${title}"?`)) {
                        if (form) form.submit();
                    }
                }
            });
        });
    });
</script>
@endpush
