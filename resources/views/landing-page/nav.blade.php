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
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ url('/#layanan') }}">Layanan</a></li>
            <li><a href="{{ url('/#jadwal') }}">Jadwal Dokter</a></li>
            <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ url('/#tentang') }}">Tentang Kami</a></li>
            <li><a href="{{ url('/#kontak') }}">Kontak</a></li>
        </ul>

        <!-- Desktop CTA -->
        <a href="{{ url('/#janji-temu') }}" class="btn-nav-cta">Janji Temu</a>

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
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ url('/#layanan') }}">Layanan</a>
        <a href="{{ url('/#jadwal') }}">Jadwal Dokter</a>
        <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Berita</a>
        <a href="{{ url('/#tentang') }}">Tentang Kami</a>
        <a href="{{ url('/#kontak') }}">Kontak</a>
        <a href="{{ url('/#janji-temu') }}" class="btn-nav-cta">Janji Temu</a>
    </div>
</header>
