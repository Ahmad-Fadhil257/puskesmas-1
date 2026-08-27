<!-- Floating Navigation Bar -->
<header class="site-header">
    <nav class="navbar">
        <!-- Brand / Logo -->
        <a href="{{ route('home') }}" class="navbar__brand">
            <span class="navbar__brand-icon">
                <img src="{{ $appSetting->logo_url ?? asset('assets/logo/logo-puskesmas.png') }}" alt="Logo" style="height: 36px; width: 36px; object-fit: contain; flex-shrink: 0;">
            </span>
            @if(($appSetting->show_app_name ?? true) && !empty($appSetting->app_name ?? 'Puskesmas'))
                <span class="navbar__brand-text brand-text">{{ $appSetting->app_name }}</span>
            @endif
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar__menu">
            <!-- BERANDA -->
            <li class="nav-item">
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
            </li>

            <!-- PROFIL (Dropdown) -->
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link-dropdown">
                    Profil
                    <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('home') }}#tentang">Tentang Puskesmas</a></li>
                    <li><a href="{{ route('jadwal-dokter') }}">Tenaga Kesehatan</a></li>
                    <li><a href="{{ route('lokasi') }}">Lokasi & Peta</a></li>
                </ul>
            </li>

            <!-- LAYANAN (Dropdown) -->
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link-dropdown {{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                    Layanan
                    <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('layanan.index') }}">Semua Layanan</a></li>
                    <li><a href="{{ route('jadwal-dokter') }}">Jadwal Dokter</a></li>
                    <li><a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener">Janji Temu</a></li>
                </ul>
            </li>

            <!-- INFORMASI PUBLIK (Dropdown) -->
            <li class="nav-item has-dropdown">
                <a href="#" class="nav-link-dropdown {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    Informasi Publik
                    <svg class="dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                    </svg>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('blog.index') }}">Berita & Info</a></li>
                </ul>
            </li>

            <!-- KONTAK -->
            <li class="nav-item">
                <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">Kontak</a>
            </li>

            <!-- SURVEI -->
            <li class="nav-item">
                <a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">Survei</a>
            </li>
        </ul>

        <!-- Desktop CTA -->
        <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-nav-cta">Janji Temu</a>

        <!-- Mobile Toggle Button -->
        <button class="navbar__toggle" id="mobileToggle" aria-label="Toggle navigation" aria-expanded="false">
            <svg id="iconOpen" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="iconClose" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </nav>

    <!-- Mobile Dropdown Menu -->
    <div class="navbar__mobile" id="mobileMenu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

        <!-- Mobile Profil Accordion -->
        <div class="mobile-accordion">
            <button class="mobile-accordion__btn">
                Profil
                <svg class="mobile-accordion__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                </svg>
            </button>
            <div class="mobile-accordion__body">
                <a href="{{ route('home') }}#tentang">Tentang Puskesmas</a>
                <a href="{{ route('lokasi') }}">Lokasi & Peta</a>
            </div>
        </div>

        <!-- Mobile Layanan Accordion -->
        <div class="mobile-accordion">
            <button class="mobile-accordion__btn {{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                Layanan
                <svg class="mobile-accordion__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                </svg>
            </button>
            <div class="mobile-accordion__body">
                <a href="{{ route('layanan.index') }}">Semua Layanan</a>
                <a href="{{ route('jadwal-dokter') }}">Jadwal Dokter</a>
            </div>
        </div>

        <!-- Mobile Informasi Publik Accordion -->
        <div class="mobile-accordion">
            <button class="mobile-accordion__btn {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                Informasi Publik
                <svg class="mobile-accordion__chevron" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6"/>
                </svg>
            </button>
            <div class="mobile-accordion__body">
                <a href="{{ route('blog.index') }}">Berita & Info</a>
            </div>
        </div>

        <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">Kontak</a>
        <a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">Survei</a>
        <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-nav-cta">Janji Temu</a>
    </div>
</header>
