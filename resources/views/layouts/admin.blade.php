<!DOCTYPE html>
<html lang="id" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{ asset('admin-assets') }}/">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('title', 'Dashboard - Puskesmas CareLink')</title>

    <!-- Theme State Early Init (Mencegah kedipan tema) -->
    <script>
        (function () {
            const savedTheme = localStorage.getItem('sneat_theme');
            if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark-style');
                document.documentElement.classList.remove('light-style');
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.classList.add('light-style');
                document.documentElement.classList.remove('dark-style');
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Boxicons Icons -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css') }}" />

    <!-- Sneat Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin-assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- SweetAlert2 & Toastr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Custom Puskesmas CareLink Theme Override (Emerald Green & Dark Mode) -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom-theme.css') }}" />

    <style>
        /* Toastr & SweetAlert2 Custom Positioning (Turun 85px agar tidak tertutup Navbar Admin) */
        #toast-container,
        .toast-top-right {
            top: 85px !important;
            right: 25px !important;
            z-index: 999999 !important;
        }
        .toast {
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.18) !important;
            opacity: 1 !important;
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            padding: 14px 18px 14px 50px !important;
        }
        .toast-success {
            background-color: #0A5C45 !important;
        }
        .toast-error {
            background-color: #DC2626 !important;
        }
        .toast-warning {
            background-color: #F59E0B !important;
        }
        .toast-info {
            background-color: #0284C7 !important;
        }
        .swal2-container {
            z-index: 999999 !important;
        }
        .swal2-container.swal2-top-end,
        .swal2-container.swal2-top-right {
            top: 85px !important;
            right: 25px !important;
        }
        .swal2-popup {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            border-radius: 16px !important;
        }
        .swal2-popup.swal2-toast {
            border-radius: 14px !important;
            padding: 12px 18px !important;
            box-shadow: 0 10px 30px rgba(10, 92, 69, 0.16), 0 2px 6px rgba(0, 0, 0, 0.06) !important;
            border: 1px solid rgba(10, 92, 69, 0.1) !important;
        }
        .swal2-confirm.btn-emerald {
            background-color: #0A5C45 !important;
            border-radius: 12px !important;
            padding: 10px 24px !important;
            font-weight: 700 !important;
        }
        .swal2-cancel.btn-slate {
            background-color: #64748B !important;
            border-radius: 12px !important;
            padding: 10px 20px !important;
            font-weight: 700 !important;
        }
    </style>

    <!-- Helpers -->
    <script src="{{ asset('admin-assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin-assets/js/config.js') }}"></script>

    @stack('styles')
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            
            <!-- ====== SIDEBAR MENU ====== -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <!-- Brand Header -->
                <div class="app-brand demo py-3">
                    <a href="{{ route('dashboard') }}" class="app-brand-link gap-2 align-items-center">
                        <span class="app-brand-logo demo">
                            <img src="{{ $appSetting->logo_url ?? asset('assets/logo/logo-puskesmas.png') }}" alt="Logo" style="height: 36px; width: 36px; object-fit: contain; flex-shrink: 0;">
                        </span>
                        @if(($appSetting->show_app_name ?? true) && !empty($appSetting->app_name ?? 'Puskesmas'))
                            <span class="app-brand-text demo menu-text fw-bolder fs-5 text-capitalize brand-text">{{ $appSetting->app_name }}</span>
                        @endif
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <!-- Menu Navigation -->
                <ul class="menu-inner py-1">
                    <!-- MENU UTAMA -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Menu Utama</span>
                    </li>
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboard">Dashboard</div>
                        </a>
                    </li>

                    <!-- KONTEN & INFORMASI WEBSITE -->
                    @php $user = Auth::user(); @endphp
                    @if($user->canAccessPage('hero') || $user->canAccessPage('layanan') || $user->canAccessPage('articles') || $user->canAccessPage('cara-kerja') || $user->canAccessPage('dokter') || $user->canAccessPage('about') || $user->canAccessPage('nilai') || $user->canAccessPage('surveys'))
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Manajemen Konten</span>
                    </li>
                    @endif
                    @if($user->canAccessPage('hero'))
                    <li class="menu-item {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.hero.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-layout"></i>
                            <div>Kelola Hero & Fitur</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('layanan'))
                    <li class="menu-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.layanan.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-briefcase-alt-2"></i>
                            <div>Kelola Layanan</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('articles'))
                    <li class="menu-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.articles.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-news"></i>
                            <div>Kelola Berita & Info</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('cara-kerja'))
                    <li class="menu-item {{ request()->routeIs('admin.cara-kerja.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.cara-kerja.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-list-check"></i>
                            <div>Kelola Cara Kerja</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('dokter'))
                    <li class="menu-item {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.dokter.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-plus"></i>
                            <div>Kelola Dokter</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('about'))
                    <li class="menu-item {{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.about.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-info-circle"></i>
                            <div>Kelola Tentang Kami</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('nilai'))
                    <li class="menu-item {{ request()->routeIs('admin.nilai.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.nilai.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-star"></i>
                            <div>Kelola Nilai & Mitra</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('surveys'))
                    <li class="menu-item {{ request()->routeIs('admin.surveys.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.surveys.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-message-rounded-detail"></i>
                            <div>Survei Kepuasan Pasien</div>
                        </a>
                    </li>
                    @endif

                    <!-- PENGATURAN & AKUN -->
                    @if($user->canAccessPage('users') || $user->canAccessPage('settings') || $user->canAccessPage('lokasi'))
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Pengaturan Sistem</span>
                    </li>
                    @endif
                    @if($user->canAccessPage('lokasi'))
                    <li class="menu-item {{ request()->routeIs('admin.lokasi.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.lokasi.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-map-pin"></i>
                            <div>Lokasi & Peta</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('users'))
                    <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user-pin"></i>
                            <div>Kelola Pengguna</div>
                        </a>
                    </li>
                    @endif
                    @if($user->canAccessPage('settings'))
                    <li class="menu-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.settings.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-palette"></i>
                            <div>Identitas & Logo</div>
                        </a>
                    </li>
                    @endif
                    <li class="menu-item">
                        <a href="{{ url('/') }}" target="_blank" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-globe"></i>
                            <div>Lihat Landing Page</div>
                        </a>
                    </li>
                </ul>
            </aside>
            <!-- / SIDEBAR MENU -->

            <!-- Layout page -->
            <div class="layout-page">

                <!-- ====== TOP NAVBAR ====== -->
                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search Box -->
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0 text-muted me-2"></i>
                                <input type="text" class="form-control border-0 shadow-none" placeholder="Cari data pasien, poli, atau dokter..." aria-label="Search..." />
                            </div>
                        </div>

                        <!-- Right Actions -->
                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            
                            <!-- Dark / Light Mode Toggle Button -->
                            <li class="nav-item me-3">
                                <a class="nav-link hide-arrow cursor-pointer d-flex align-items-center justify-content-center"
                                   id="themeToggleBtn"
                                   href="javascript:void(0);"
                                   title="Beralih Mode Gelap/Terang"
                                   style="width: 38px; height: 38px; border-radius: 50%;">
                                    <i class="bx bx-moon fs-4" id="themeToggleIcon"></i>
                                </a>
                            </li>

                            <!-- User Profile Dropdown -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <div class="avatar-initial rounded-circle bg-label-primary fw-bold">
                                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <div class="avatar-initial rounded-circle bg-label-primary fw-bold">
                                                            {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block">{{ Auth::user()->name ?? 'Admin Puskesmas' }}</span>
                                                    <small class="text-muted">{{ Auth::user()->email ?? 'admin@carelink.com' }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <!-- Logout Form with SweetAlert2 Confirmation -->
                                        <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                            @csrf
                                            <button type="button" class="dropdown-item text-danger" id="btnLogout">
                                                <i class="bx bx-power-off me-2"></i>
                                                <span class="align-middle">Keluar (Logout)</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- / TOP NAVBAR -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Main Body Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        @yield('content')
                    </div>

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="mb-2 mb-md-0">
                                © {{ date('Y') }} Puskesmas. Sistem Manajemen Pelayanan Kesehatan.
                            </div>
                        </div>
                    </footer>
                    <div class="content-backdrop fade"></div>
                </div>
                <!-- / Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay for Mobile -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Sneat Core & Vendor JS -->
    <script src="{{ asset('admin-assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin-assets/vendor/js/menu.js') }}"></script>

    <!-- Apex Charts -->
    <script src="{{ asset('admin-assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- SweetAlert2 & Toastr JS (Global Modal & Toast) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin-assets/js/main.js') }}"></script>

    <!-- Global Flash Messages & Alert Scripts -->
    <div id="flash-data"
         data-success="{{ session('success') }}"
         data-error="{{ session('error') }}"
         data-info="{{ session('info') }}"
         data-warning="{{ session('warning') }}"
         style="display: none;"></div>

    <script>
        // Global SweetAlert2 Toast Mixin (Modern, Rounded, Animated Icons)
        window.Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: function (toast) {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            // Baca Flash Messages dari Laravel Session
            const flash = document.getElementById('flash-data');
            if (flash) {
                const successMsg = flash.getAttribute('data-success');
                const errorMsg = flash.getAttribute('data-error');
                const infoMsg = flash.getAttribute('data-info');
                const warningMsg = flash.getAttribute('data-warning');

                if (successMsg) {
                    window.Toast.fire({ icon: 'success', title: successMsg });
                }
                if (errorMsg) {
                    window.Toast.fire({ icon: 'error', title: errorMsg });
                }
                if (infoMsg) {
                    window.Toast.fire({ icon: 'info', title: infoMsg });
                }
                if (warningMsg) {
                    window.Toast.fire({ icon: 'warning', title: warningMsg });
                }
            }

            // Dark Mode / Light Mode Toggle Handler
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const themeToggleIcon = document.getElementById('themeToggleIcon');

            function syncThemeIcon() {
                const isDark = document.documentElement.classList.contains('dark-style');
                if (themeToggleIcon) {
                    if (isDark) {
                        themeToggleIcon.classList.remove('bx-moon');
                        themeToggleIcon.classList.add('bx-sun');
                        themeToggleBtn.setAttribute('title', 'Beralih ke Mode Terang');
                    } else {
                        themeToggleIcon.classList.remove('bx-sun');
                        themeToggleIcon.classList.add('bx-moon');
                        themeToggleBtn.setAttribute('title', 'Beralih ke Mode Gelap');
                    }
                }
            }

            syncThemeIcon();

            if (themeToggleBtn) {
                themeToggleBtn.addEventListener('click', function () {
                    const isDark = document.documentElement.classList.contains('dark-style');
                    if (isDark) {
                        document.documentElement.classList.remove('dark-style');
                        document.documentElement.classList.add('light-style');
                        document.documentElement.setAttribute('data-bs-theme', 'light');
                        localStorage.setItem('sneat_theme', 'light');
                    } else {
                        document.documentElement.classList.remove('light-style');
                        document.documentElement.classList.add('dark-style');
                        document.documentElement.setAttribute('data-bs-theme', 'dark');
                        localStorage.setItem('sneat_theme', 'dark');
                    }
                    syncThemeIcon();
                });
            }

            // SweetAlert2 Konfirmasi Logout
            const btnLogout = document.getElementById('btnLogout');
            const logoutForm = document.getElementById('logoutForm');
            if (btnLogout && logoutForm) {
                btnLogout.addEventListener('click', function (e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Konfirmasi Keluar',
                        text: 'Apakah Anda yakin ingin mengakhiri sesi dan keluar dari sistem?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Keluar',
                        cancelButtonText: 'Batal',
                        customClass: {
                            confirmButton: 'btn-emerald',
                            cancelButton: 'btn-slate'
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            logoutForm.submit();
                        }
                    });
                });
            }
        });

        // Helper Global SweetAlert2 untuk konfirmasi hapus data
        window.confirmDelete = function(formId, itemName) {
            itemName = itemName || 'data ini';
            Swal.fire({
                title: 'Hapus Data?',
                text: 'Apakah Anda yakin ingin menghapus ' + itemName + '? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#C53030',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then(function (result) {
                if (result.isConfirmed) {
                    const form = document.getElementById(formId);
                    if (form) form.submit();
                }
            });
        };
    </script>

    @stack('scripts')
</body>
</html>
