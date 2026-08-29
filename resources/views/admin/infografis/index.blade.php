@extends('layouts.admin')

@section('title', 'Kelola Infografis - Puskesmas CareLink')

@section('content')

    {{-- Breadcrumb & Page Header (Sneat Standard) --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-bar-chart-alt-2 me-2"></i>Kelola Galeri Infografis
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Infografis</li>
                </ol>
            </nav>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('infografis') }}" target="_blank" class="btn btn-outline-primary d-inline-flex align-items-center gap-1">
                <i class="bx bx-globe"></i>
                <span>Lihat di Website</span>
            </a>
            <a href="{{ route('admin.infografis.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus-circle"></i>
                <span>Tambah Infografis Baru</span>
            </a>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
            <i class="bx bx-check-circle fs-4 me-2"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Statistics Row (Sneat Cards) --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-primary rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-images fs-3 text-primary"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Total Infografis</span>
                        <h4 class="mb-0 fw-bold text-dark">{{ $infografis->total() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-success rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-check-double fs-3 text-success"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Infografis Aktif</span>
                        <h4 class="mb-0 fw-bold text-dark">{{ $infografis->where('is_active', true)->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3 py-3">
                    <div class="avatar avatar-md bg-label-info rounded p-2 d-flex align-items-center justify-content-center">
                        <i class="bx bx-category fs-3 text-info"></i>
                    </div>
                    <div>
                        <span class="text-muted d-block small">Total Kategori</span>
                        <h4 class="mb-0 fw-bold text-dark">{{ $kategoris->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Card --}}
    @if($kategoris->count() > 0)
    <div class="card mb-4">
        <div class="card-body py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="fw-semibold text-muted small me-1"><i class="bx bx-filter-alt me-1"></i>Kategori:</span>
                <span class="badge bg-label-primary px-3 py-2">Semua ({{ $infografis->total() }})</span>
                @foreach($kategoris as $kat)
                    <span class="badge bg-label-secondary px-3 py-2">{{ $kat }}</span>
                @endforeach
            </div>
            <small class="text-muted">Total {{ $infografis->total() }} infografis terdata</small>
        </div>
    </div>
    @endif

    {{-- Infografis Grid Cards (Sneat Standard) --}}
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        @forelse($infografis as $item)
        <div class="col">
            <div class="card h-100 shadow-sm border-0">
                <div class="position-relative" style="aspect-ratio: 16/10; overflow: hidden; background: #f8fafc; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem;">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         class="w-100 h-100" style="object-fit: cover; transition: transform 0.3s ease;"
                         onerror="this.src='{{ asset('admin-assets/images/placeholder.png') }}'">
                    
                    {{-- Badges overlay --}}
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge {{ $item->is_active ? 'bg-label-success' : 'bg-label-secondary' }} shadow-xs">
                            <i class="bx {{ $item->is_active ? 'bxs-circle' : 'bx-circle' }} me-1" style="font-size: 8px;"></i>
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge bg-label-primary shadow-xs">
                            {{ $item->kategori }}
                        </span>
                    </div>
                </div>

                <div class="card-body pb-2">
                    <h5 class="card-title fw-bold mb-2 text-truncate" title="{{ $item->title }}">
                        {{ $item->title }}
                    </h5>
                    @if($item->deskripsi)
                        <p class="card-text text-muted small" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.5;">
                            {{ $item->deskripsi }}
                        </p>
                    @else
                        <p class="card-text text-muted small fst-italic">Tidak ada deskripsi tambahan.</p>
                    @endif
                </div>

                <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-3 d-flex justify-content-between align-items-center gap-2 flex-wrap">
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.infografis.edit', $item) }}"
                           class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                            <i class="bx bx-edit-alt"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.infografis.toggle-status', $item) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} d-inline-flex align-items-center gap-1" title="{{ $item->is_active ? 'Sembunyikan dari publik' : 'Tampilkan ke publik' }}">
                                <i class="bx {{ $item->is_active ? 'bx-hide' : 'bx-show' }}"></i>
                                <span>{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}</span>
                            </button>
                        </form>
                    </div>

                    <form action="{{ route('admin.infografis.destroy', $item) }}" method="POST" class="form-delete d-inline">
                        @csrf @method('DELETE')
                        <button type="button" class="btn btn-sm btn-outline-danger btn-delete d-inline-flex align-items-center" title="Hapus Infografis">
                            <i class="bx bx-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 w-100">
            <div class="card border-0 shadow-sm text-center py-5">
                <div class="card-body">
                    <div class="avatar avatar-xl bg-label-secondary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bx bx-image-alt fs-1 text-muted"></i>
                    </div>
                    <h5 class="fw-bold mb-1">Belum Ada Infografis</h5>
                    <p class="text-muted small mb-3">Silakan tambahkan gambar infografis kesehatan untuk ditampilkan pada galeri publik.</p>
                    <a href="{{ route('admin.infografis.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i class="bx bx-plus-circle"></i>
                        <span>Tambah Infografis Sekarang</span>
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($infografis->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $infografis->links() }}
    </div>
    @endif

@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.form-delete');
            Swal.fire({
                title: 'Hapus Infografis?',
                text: "Infografis ini akan dihapus secara permanen dari server dan database.",
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
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
