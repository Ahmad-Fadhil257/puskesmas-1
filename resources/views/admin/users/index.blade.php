@extends('layouts.admin')

@section('title', 'Kelola Pengguna - Puskesmas')

@section('content')

@push('styles')
<style>
    .modal-content .form-control,
    .modal-content .form-select {
        color: #FFFFFF !important;
    }
    .modal-content .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7) !important;
    }
    .modal-content .form-control:focus,
    .modal-content .form-select:focus {
        color: #FFFFFF !important;
    }
</style>
@endpush

    {{-- Breadcrumb & Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
        <div>
            <h4 class="fw-bold py-1 mb-1" style="color: #0A5C45;">
                <i class="bx bx-user-pin me-2"></i>Kelola Pengguna Sistem
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Kelola Pengguna</li>
                </ol>
            </nav>
        </div>
        <div>
            {{-- Tombol Tambah Pengguna (Membuka Popup Modal Sneat) --}}
            <button type="button" class="btn btn-primary d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#modalCreateUser">
                <i class="bx bx-user-plus"></i>
                <span>Tambah Pengguna Baru</span>
            </button>
        </div>
    </div>

    {{-- Stat Cards Sneat --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-primary h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-group"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalUsers }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Total Pengguna</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-success h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-shield-quarter"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalAdmin }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Administrator</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-info h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-id-card"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalStaf }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Staf Puskesmas</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="card card-border-shadow-warning h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-user-check"></i></span>
                        </div>
                        <h4 class="ms-1 mb-0 fw-bold">{{ $totalActive }}</h4>
                    </div>
                    <p class="mb-0 text-muted small fw-semibold">Akun Aktif</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter & Search Card --}}
    <div class="card mb-4">
        <div class="card-body py-3">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-7 col-12">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau telepon..." value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <select name="status" class="form-select">
                            <option value="">-- Semua Status --</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bx bx-filter-alt me-1"></i> Filter
                        </button>
                        @if(request()->hasAny(['search', 'status']))
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary" title="Reset Filter">
                                <i class="bx bx-reset"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Data Table Sneat --}}
    <div class="card">
        <div class="card-header border-bottom py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Daftar Pengguna Sistem</h5>
            <small class="text-muted">Menampilkan {{ $users->firstItem() ?? 0 }} - {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} akun</small>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th>Pengguna</th>
                        <th>Kontak</th>
                        <th class="text-center">Peran Akun</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($users as $index => $item)
                        <tr class="{{ $item->id === Auth::id() ? 'table-light-primary' : '' }}">
                            <td class="text-center fw-semibold text-muted">
                                @if($item->id === Auth::id())
                                    <span class="badge bg-primary text-white rounded-pill px-2 py-1">#1</span>
                                @else
                                    {{ $users->firstItem() + $index }}
                                @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar avatar-sm flex-shrink-0">
                                        <span class="avatar-initial rounded-circle bg-label-primary fw-bold">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block fs-6">
                                            {{ $item->name }}
                                            @if($item->id === Auth::id())
                                                <span class="badge bg-label-success ms-1" style="font-size: 0.72rem;">(Akun Anda)</span>
                                            @endif
                                        </strong>
                                        <small class="text-muted">{{ $item->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-muted small">
                                    <i class="bx bx-phone me-1"></i> {{ $item->phone ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                @if($item->role === 'admin')
                                    <span class="badge bg-label-primary rounded-pill px-3 py-1">
                                        <i class="bx bx-shield-quarter me-1"></i> Administrator
                                    </span>
                                @else
                                    <span class="badge bg-label-info rounded-pill px-3 py-1">
                                        <i class="bx bx-id-card me-1"></i> Staf Puskesmas
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($item->is_active)
                                    <span class="badge bg-label-success rounded-pill px-3 py-1">
                                        <i class="bx bx-check-circle me-1"></i> Aktif
                                    </span>
                                @else
                                    <span class="badge bg-label-danger rounded-pill px-3 py-1">
                                        <i class="bx bx-x-circle me-1"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center gap-1">
                                    {{-- Toggle Status Button --}}
                                    @if($item->id !== Auth::id())
                                        <form action="{{ route('admin.users.toggle-status', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-icon {{ $item->is_active ? 'btn-outline-secondary' : 'btn-outline-success' }}" 
                                                    title="{{ $item->is_active ? 'Nonaktifkan Akun' : 'Aktifkan Akun' }}">
                                                <i class="bx {{ $item->is_active ? 'bx-block' : 'bx-check' }}"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Edit Button (Buka Popup Modal) --}}
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalEditUser-{{ $item->id }}" title="Edit Pengguna">
                                        <i class="bx bx-edit-alt"></i>
                                    </button>

                                    {{-- Delete Button --}}
                                    @if($item->id !== Auth::id())
                                        <button type="button" class="btn btn-sm btn-icon btn-outline-danger btn-delete-user"
                                                data-id="{{ $item->id }}"
                                                data-name="{{ $item->name }}"
                                                title="Hapus Pengguna">
                                            <i class="bx bx-trash"></i>
                                        </button>

                                        <form id="delete-user-form-{{ $item->id }}" action="{{ route('admin.users.destroy', $item->id) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="bx bx-user-x display-4 mb-2 d-block" style="color: #94A3B8;"></i>
                                    Tidak ada data pengguna yang sesuai.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="card-footer d-flex flex-column align-items-center justify-content-center gap-2 py-3 border-top">
                <small class="text-muted">Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}</small>
                <div>
                    {{ $users->links() }}
                </div>
            </div>
        @endif
    </div>


    {{-- ====== SNEAT MODAL: TAMBAH PENGGUNA BARU ====== --}}
    <div class="modal fade" id="modalCreateUser" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-bottom py-3">
                        <h5 class="modal-title fw-bold" id="modalCreateLabel">
                            <i class="bx bx-user-plus me-1 text-primary"></i> Tambah Pengguna Baru
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body py-4">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Contoh: dr. Hendra Pratama" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="yuri@gmail.com" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="••••••••" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kontak</label>
                            <input type="text" name="phone" class="form-control" placeholder="Contoh: 08123456789">
                        </div>
                        <div class="form-check form-switch pt-2">
                            <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="createIsAdmin" checked onchange="toggleRoleLabel(this, 'createRoleBadge')">
                            <label class="form-check-label fw-semibold" for="createIsAdmin">
                                Peran Akun: <span id="createRoleBadge" class="badge bg-label-primary ms-1">Administrator (Akses Penuh)</span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer border-top py-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bx bx-save me-1"></i> Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ====== SNEAT MODALS: EDIT DATA PENGGUNA ====== --}}
    @foreach ($users as $item)
        <div class="modal fade" id="modalEditUser-{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel-{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form action="{{ route('admin.users.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header border-bottom py-3">
                            <h5 class="modal-title fw-bold" id="modalEditLabel-{{ $item->id }}">
                                <i class="bx bx-edit me-1 text-primary"></i> Edit Pengguna: {{ $item->name }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $item->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kata Sandi Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                                <div class="form-text">Biarkan kosong jika kata sandi tidak ingin diubah.</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Kontak</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $item->phone) }}" placeholder="Contoh: 08123456789">
                            </div>
                            <div class="d-flex flex-column gap-2 pt-2">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_admin" value="1" id="editIsAdmin-{{ $item->id }}" {{ $item->role === 'admin' ? 'checked' : '' }} {{ $item->id === Auth::id() ? 'disabled' : '' }} onchange="toggleRoleLabel(this, 'editRoleBadge-{{ $item->id }}')">
                                    @if($item->id === Auth::id())
                                        <input type="hidden" name="is_admin" value="1">
                                    @endif
                                    <label class="form-check-label fw-semibold" for="editIsAdmin-{{ $item->id }}">
                                        Peran Akun: 
                                        @if($item->role === 'admin')
                                            <span id="editRoleBadge-{{ $item->id }}" class="badge bg-label-primary ms-1">Administrator (Akses Penuh)</span>
                                        @else
                                            <span id="editRoleBadge-{{ $item->id }}" class="badge bg-label-info ms-1">Staf Puskesmas</span>
                                        @endif
                                    </label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="editIsActive-{{ $item->id }}" {{ $item->is_active ? 'checked' : '' }} {{ $item->id === Auth::id() ? 'disabled' : '' }}>
                                    @if($item->id === Auth::id())
                                        <input type="hidden" name="is_active" value="1">
                                    @endif
                                    <label class="form-check-label fw-semibold" for="editIsActive-{{ $item->id }}">
                                        Status Akun Aktif (Dapat Login)
                                    </label>
                                    @if($item->id === Auth::id())
                                        <div class="form-text text-warning small">Akun Anda sendiri tidak dapat dinonaktifkan.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top py-2">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bx bx-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@push('scripts')
<script>
    function toggleRoleLabel(checkbox, badgeId) {
        const badge = document.getElementById(badgeId);
        if (!badge) return;
        if (checkbox.checked) {
            badge.className = 'badge bg-label-primary ms-1';
            badge.textContent = 'Administrator (Akses Penuh)';
        } else {
            badge.className = 'badge bg-label-info ms-1';
            badge.textContent = 'Staf Puskesmas';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Delete confirmation
        document.querySelectorAll('.btn-delete-user').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Hapus Pengguna?',
                    html: `Apakah Anda yakin ingin menghapus akun <strong>"${name}"</strong>? Tindakan ini tidak dapat dibatalkan.`,
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
                        document.getElementById(`delete-user-form-${id}`).submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
