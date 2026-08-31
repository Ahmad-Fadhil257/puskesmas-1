@extends('layouts.admin')

@section('title', 'Kelola Berita & Artikel - Puskesmas CareLink')

@section('content')

    {{-- Page Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-news me-2"></i>Kelola Berita & Artikel Edukasi
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Berita & Artikel</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-2">
                <i class="bx bx-plus-circle"></i>
                <span>Tulis Artikel Baru</span>
            </a>
        </div>
    </div>

    {{-- Filter & Search Card --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.articles.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari judul, kategori, atau penulis..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-outline-primary">Filter</button>
                    @if(request('search'))
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Reset</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Articles Data Table Card --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Artikel ({{ $articles->total() }} Total)</h5>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 70px;">Foto</th>
                        <th>Judul & Kategori</th>
                        <th>Penulis</th>
                        <th>Dibaca</th>
                        <th>Status</th>
                        <th>Tanggal Rilis</th>
                        <th class="text-center" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($articles as $item)
                        <tr>
                            <td>
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="rounded" style="width: 58px; height: 42px; object-fit: cover; border: 1px solid #E2F0EC;">
                            </td>
                            <td>
                                <div class="fw-bold text-dark text-truncate" style="max-width: 320px;" title="{{ $item->title }}">
                                    {{ $item->title }}
                                </div>
                                <span class="badge bg-label-primary fs-tiny">{{ $item->category }}</span>
                                <span class="text-muted fs-tiny ms-1">&bull; {{ $item->reading_time }}</span>
                            </td>
                            <td>
                                <span class="fw-semibold">{{ $item->author }}</span>
                            </td>
                            <td>
                                <span class="badge bg-label-info">
                                    <i class="bx bx-show me-1"></i>{{ $item->views_count }}
                                </span>
                            </td>
                            <td>
                                @if($item->is_published)
                                    <span class="badge bg-label-success">Published</span>
                                @else
                                    <span class="badge bg-label-secondary">Draft</span>
                                @endif
                            </td>
                            <td>
                                <span class="text-muted">{{ $item->formatted_date }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    {{-- Lihat di Web Publik --}}
                                    <a href="{{ route('blog.show', $item->slug) }}" target="_blank" class="btn btn-sm btn-icon btn-outline-info" title="Lihat di Web">
                                        <i class="bx bx-link-external"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.articles.edit', $item->id) }}" class="btn btn-sm btn-icon btn-outline-warning" title="Edit Artikel">
                                        <i class="bx bx-edit-alt"></i>
                                    </a>

                                    {{-- Hapus --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-article" 
                                            data-id="{{ $item->id }}" 
                                            data-title="{{ $item->title }}"
                                            title="Hapus Artikel">
                                        <i class="bx bx-trash"></i>
                                    </button>

                                    <form id="delete-form-{{ $item->id }}" action="{{ route('admin.articles.destroy', $item->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bx bx-folder-open display-4 mb-2 d-block"></i>
                                    Belum ada artikel berita yang ditemukan.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
            <div class="card-footer py-3 d-flex justify-content-end">
                {{ $articles->links() }}
            </div>
        @endif
    </div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.btn-delete-article').forEach(function (button) {
            button.addEventListener('click', function () {
                const articleId = this.getAttribute('data-id');
                const articleTitle = this.getAttribute('data-title');

                Swal.fire({
                    title: 'Hapus Artikel?',
                    html: `Apakah Anda yakin ingin menghapus artikel <strong>"${articleTitle}"</strong>? Tindakan ini tidak dapat dibatalkan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'btn btn-danger me-2',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${articleId}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
