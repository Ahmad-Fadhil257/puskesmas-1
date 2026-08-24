<!-- Floating Navigation Bar -->
<header class="site-header">
    <nav class="navbar">
        <!-- Brand / Logo -->
        <a href="{{ url('/') }}" class="navbar__brand">
            Puskesmas CareLink
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar__menu">
            <li><a href="#home" class="active">Home</a></li>
            <li><a href="#layanan">Layanan</a></li>
            <li><a href="#jadwal">Jadwal Dokter</a></li>
            <li><a href="#berita">Berita</a></li>
        </ul>

        <!-- Desktop CTA -->
        <a href="{{ $kontak->wa_link }}" target="_blank" rel="noopener" class="btn-nav-cta">Janji Temu</a>

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
        <a href="#home" class="active">Home</a>
        <a href="#layanan">Layanan</a>
        <a href="#jadwal">Jadwal Dokter</a>
        <a href="#berita">Berita</a>
        <a href="{{ $kontak->wa_link }}" target="_blank" rel="noopener" class="btn-nav-cta">Janji Temu</a>
    </div>
</header>
