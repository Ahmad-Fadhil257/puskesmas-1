@extends('layouts.admin')

@section('title', 'Kelola Infografis')

@section('content')
<div class="content-wrapper">

    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
        <div>
            <h4 class="fw-bold mb-0" style="color:#111827;">Kelola Infografis</h4>
            <p class="text-muted mb-0 small">Kelola galeri infografis yang ditampilkan di halaman publik.</p>
        </div>
        <a href="{{ route('admin.infografis.create') }}" class="btn btn-success d-inline-flex align-items-center gap-2">
            <i class="bx bx-plus-circle"></i> Tambah Infografis
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bx bx-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter Cepat Kategori --}}
    @if($kategoris->count() > 0)
    <div class="d-flex flex-wrap gap-2 mb-4">
        <span class="badge bg-secondary px-3 py-2">Kategori:</span>
        @foreach($kategoris as $kat)
            <span class="badge bg-light text-dark border px-3 py-2">{{ $kat }}</span>
        @endforeach
    </div>
    @endif

    <div class="row g-3">
        @forelse($infografis as $item)
        <div class="col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius:14px; overflow:hidden;">
                <div style="position:relative; aspect-ratio:4/3; overflow:hidden; background:#f3f4f6;">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         style="width:100%;height:100%;object-fit:cover;"
                         onerror="this.src='{{ asset('admin-assets/images/placeholder.png') }}'">
                    {{-- Status badge --}}
                    <span class="badge position-absolute top-0 start-0 m-2 {{ $item->is_active ? 'bg-success' : 'bg-secondary' }}"
                          style="font-size:11px;">
                        {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                    <span class="badge bg-dark bg-opacity-75 position-absolute top-0 end-0 m-2" style="font-size:11px;">
                        {{ $item->kategori }}
                    </span>
                </div>
                <div class="card-body pb-2">
                    <h6 class="fw-bold mb-1" style="font-size:14px; line-height:1.4;">{{ $item->title }}</h6>
                    @if($item->deskripsi)
                        <p class="text-muted mb-0" style="font-size:12.5px; line-height:1.5; display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                            {{ $item->deskripsi }}
                        </p>
                    @endif
                </div>
                <div class="card-footer bg-transparent border-top-0 pt-0 pb-3 px-3 d-flex gap-2 flex-wrap">
                    <a href="{{ route('admin.infografis.edit', $item) }}"
                       class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1">
                        <i class="bx bx-edit-alt"></i> Edit
                    </a>
                    <form action="{{ route('admin.infografis.toggle-status', $item) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $item->is_active ? 'btn-outline-warning' : 'btn-outline-success' }} d-inline-flex align-items-center gap-1">
                            <i class="bx {{ $item->is_active ? 'bx-hide' : 'bx-show' }}"></i>
                            {{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.infografis.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Hapus infografis ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger d-inline-flex align-items-center gap-1">
                            <i class="bx bx-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bx bx-image-alt display-4 mb-2 d-block text-muted"></i>
            <p class="text-muted">Belum ada infografis. Klik <strong>Tambah Infografis</strong> untuk memulai.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($infografis->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $infografis->links() }}
    </div>
    @endif

</div>
@endsection
