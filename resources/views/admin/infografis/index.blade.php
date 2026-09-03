@extends('layouts.admin')

@section('title', 'Kelola Infografis - Puskesmas CareLink')

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
            {{-- Tombol Tambah Infografis (Membuka Modal Pop-Up Sneat) --}}
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-xs" data-bs-toggle="modal" data-bs-target="#modalCreateInfografis">
                <i class="bx bx-plus-circle"></i>
                <span>Tambah Infografis</span>
            </button>
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
                                     onclick="previewImage('{{ $item->image_url }}', '{{ addslashes($item->title) }}')"
                                     title="Klik untuk melihat poster penuh">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                         class="w-100 h-100" style="object-fit: contain; padding: 2px;"
                                         onerror="this.onerror=null; this.src='{{ asset('assets/images/infografis-placeholder.svg') }}'">
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
                                    {{-- Tombol Edit Modal --}}
                                    <button type="button" 
                                            class="btn btn-sm btn-icon btn-outline-primary btn-edit-infografis"
                                            data-id="{{ $item->id }}"
                                            data-title="{{ $item->title }}"
                                            data-kategori="{{ $item->kategori }}"
                                            data-order="{{ $item->order }}"
                                            data-is-active="{{ $item->is_active ? '1' : '0' }}"
                                            data-image="{{ $item->image_url }}"
                                            data-action="{{ route('admin.infografis.update', $item->id) }}"
                                            title="Edit Infografis">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.infografis.destroy', $item) }}" method="POST" class="form-delete d-inline">
                                        @csrf @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete" title="Hapus Infografis">
                                            <i class="bx bx-trash"></i>
                                        </button>
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
                                <button type="button" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modalCreateInfografis">
                                    <i class="bx bx-plus-circle"></i>
                                    <span>Tambah Infografis Baru</span>
                                </button>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($infografis->hasPages())
            <div class="card-footer d-flex justify-content-between align-items-center py-3 border-top">
                <small class="text-muted">Halaman {{ $infografis->currentPage() }} dari {{ $infografis->lastPage() }}</small>
                {{ $infografis->links() }}
            </div>
        @endif
    </div>


    {{-- =========================================================================
       MODAL 1: TAMBAH INFOGRAFIS BARU (Sneat Popup)
       ========================================================================= --}}
    <div class="modal fade" id="modalCreateInfografis" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.infografis.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header border-bottom py-3">
                        <h5 class="modal-title fw-bold" id="modalCreateLabel">
                            <i class="bx bx-image-add me-2 text-primary"></i> Tambah Infografis Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <div class="row g-3">
                            {{-- Judul --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="create_title">Judul Infografis <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="create_title" class="form-control" placeholder="Contoh: 5 Langkah Pencegahan Demam Berdarah (DBD)" value="{{ old('title') }}" required>
                            </div>

                            {{-- Kategori & Urutan --}}
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="create_kategori">Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="kategori" id="create_kategori" list="kategoriList" class="form-control" placeholder="Pilih atau ketik kategori..." value="{{ old('kategori', 'Umum') }}" required>
                                <datalist id="kategoriList">
                                    <option value="Umum">
                                    <option value="Promosi Kesehatan">
                                    <option value="Pelayanan & Alur">
                                    <option value="Imunisasi & Vaksin">
                                    <option value="Kesehatan Ibu & Anak">
                                    <option value="Penyakit Menular">
                                    <option value="Gaya Hidup Sehat">
                                    <option value="Statistik & Laporan">
                                </datalist>
                                <div class="form-text">Pilih dari rekomendasi atau ketik kategori baru.</div>
                            </div>

                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="create_order">Nomor Urutan Tampil</label>
                                <input type="number" name="order" id="create_order" class="form-control" placeholder="0" min="0" value="{{ old('order', 0) }}">
                                <div class="form-text">Semakin kecil angkanya, semakin awal muncul di galeri.</div>
                            </div>

                            {{-- Upload Poster dengan Live Preview --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="create_image">File Poster / Gambar Infografis <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="create_image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp" required onchange="previewImageInput(this, '#create_previewWrap', '#create_previewImg')">
                                <div class="form-text">Format yang didukung: JPG, PNG, WEBP. Maksimal ukuran file: 5 MB.</div>

                                {{-- Live Preview Box --}}
                                <div id="create_previewWrap" class="mt-3 p-3 rounded text-center" style="display: none; background: rgba(0, 0, 0, 0.06); border: 1.5px dashed rgba(148, 163, 184, 0.4);">
                                    <span class="text-muted small fw-semibold d-block mb-2"><i class="bx bx-check-circle text-success me-1"></i>Pratinjau Poster Terpilih:</span>
                                    <img id="create_previewImg" src="" alt="Pratinjau Poster" class="img-fluid rounded shadow-sm" style="max-height: 280px; object-fit: contain;">
                                </div>
                            </div>

                            {{-- Status Aktif Switch --}}
                            <div class="col-12 pt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="create_is_active" checked>
                                    <label class="form-check-label fw-semibold" for="create_is_active">
                                        Publikasikan Langsung ke Website (Status Aktif)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top py-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Simpan Infografis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- =========================================================================
       MODAL 2: EDIT INFOGRAFIS (Sneat Dynamic Popup)
       ========================================================================= --}}
    <div class="modal fade" id="modalEditInfografis" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form id="formEditInfografis" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header border-bottom py-3">
                        <h5 class="modal-title fw-bold" id="modalEditLabel">
                            <i class="bx bx-edit me-2 text-primary"></i> Edit Infografis
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body py-4">
                        <div class="row g-3">
                            {{-- Judul --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="edit_title">Judul Infografis <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="edit_title" class="form-control" required>
                            </div>

                            {{-- Kategori & Urutan --}}
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="edit_kategori">Kategori <span class="text-danger">*</span></label>
                                <input type="text" name="kategori" id="edit_kategori" list="kategoriListEdit" class="form-control" required>
                                <datalist id="kategoriListEdit">
                                    <option value="Umum">
                                    <option value="Promosi Kesehatan">
                                    <option value="Pelayanan & Alur">
                                    <option value="Imunisasi & Vaksin">
                                    <option value="Kesehatan Ibu & Anak">
                                    <option value="Penyakit Menular">
                                    <option value="Gaya Hidup Sehat">
                                    <option value="Statistik & Laporan">
                                </datalist>
                            </div>

                            <div class="col-md-6 col-12">
                                <label class="form-label fw-semibold" for="edit_order">Nomor Urutan Tampil</label>
                                <input type="number" name="order" id="edit_order" class="form-control" min="0">
                            </div>

                            {{-- Poster Saat Ini & Upload Gambar Baru --}}
                            <div class="col-12">
                                <label class="form-label fw-semibold" for="edit_image">Ganti File Poster / Gambar</label>
                                <input type="file" name="image" id="edit_image" class="form-control" accept="image/jpeg,image/png,image/jpg,image/webp" onchange="previewImageInput(this, '#edit_newPreviewWrap', '#edit_newPreviewImg')">
                                <div class="form-text">Biarkan kosong jika tidak ingin mengubah poster saat ini. Format: JPG, PNG, WEBP (Maks 5 MB).</div>

                                <div class="row g-3 mt-1">
                                    {{-- Poster Saat Ini --}}
                                    <div class="col-sm-6 col-12" id="edit_currentWrap">
                                        <div class="p-2 rounded text-center h-100" style="background: rgba(0, 0, 0, 0.06); border: 1px solid rgba(148, 163, 184, 0.3);">
                                            <span class="text-muted small fw-semibold d-block mb-1">Poster Saat Ini:</span>
                                            <img id="edit_currentImg" src="" alt="Poster Saat Ini" class="img-fluid rounded shadow-xs" style="max-height: 180px; object-fit: contain;">
                                        </div>
                                    </div>

                                    {{-- Pratinjau Poster Baru --}}
                                    <div class="col-sm-6 col-12" id="edit_newPreviewWrap" style="display: none;">
                                        <div class="p-2 rounded text-center h-100" style="background: rgba(16, 185, 129, 0.1); border: 1.5px dashed #10B981;">
                                            <span class="text-success small fw-semibold d-block mb-1"><i class="bx bx-check me-1"></i>Poster Baru Terpilih:</span>
                                            <img id="edit_newPreviewImg" src="" alt="Poster Baru" class="img-fluid rounded shadow-xs" style="max-height: 180px; object-fit: contain;">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Status Aktif Switch --}}
                            <div class="col-12 pt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="edit_is_active">
                                    <label class="form-check-label fw-semibold" for="edit_is_active">
                                        Publikasikan Langsung ke Website (Status Aktif)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer border-top py-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Perbarui Infografis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- =========================================================================
       MODAL 3: LIGHTBOX PREVIEW POSTER (Untuk Melihat Poster Ukuran Penuh)
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
    // Preview gambar lokal dari file input
    function previewImageInput(input, wrapSelector, imgSelector) {
        const wrap = document.querySelector(wrapSelector);
        const img = document.querySelector(imgSelector);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                if (wrap) wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            if (wrap) wrap.style.display = 'none';
        }
    }

    // Preview gambar besar di modal lightbox (Full Uncropped)
    function previewImage(url, title) {
        if (!url) return;
        const img = document.getElementById('modalPreviewImgSrc');
        img.src = url;
        document.getElementById('modalPreviewTitle').innerText = title || 'Pratinjau Infografis';
        const openBtn = document.getElementById('modalPreviewOpenNew');
        if (openBtn) openBtn.href = url;
        const modalEl = document.getElementById('modalPreviewPoster');
        const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Handle Edit Infografis Modal
        const editButtons = document.querySelectorAll('.btn-edit-infografis');
        const modalEditElement = document.getElementById('modalEditInfografis');
        const editModal = new bootstrap.Modal(modalEditElement);

        editButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const kategori = this.getAttribute('data-kategori');
                const order = this.getAttribute('data-order');
                const isActive = this.getAttribute('data-is-active') === '1';
                const image = this.getAttribute('data-image');
                const action = this.getAttribute('data-action');

                // Isi nilai ke form modal edit
                document.getElementById('formEditInfografis').action = action;
                document.getElementById('edit_title').value = title || '';
                document.getElementById('edit_kategori').value = kategori || 'Umum';
                document.getElementById('edit_order').value = order || 0;
                document.getElementById('edit_is_active').checked = isActive;

                // Reset preview upload baru
                document.getElementById('edit_image').value = '';
                document.getElementById('edit_newPreviewWrap').style.display = 'none';
                document.getElementById('edit_newPreviewImg').src = '';

                // Tampilkan poster saat ini
                if (image) {
                    document.getElementById('edit_currentImg').src = image;
                    document.getElementById('edit_currentWrap').style.display = 'block';
                } else {
                    document.getElementById('edit_currentWrap').style.display = 'none';
                }

                // Tampilkan modal edit
                editModal.show();
            });
        });

        // SweetAlert Delete Confirmation
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
    });
</script>
@endpush
