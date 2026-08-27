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

            {{-- Dropdown Layanan --}}
            <li class="navbar__item-dropdown">
                <a href="{{ route('layanan.index') }}" class="navbar__dropdown-toggle {{ request()->routeIs('layanan.*') ? 'active' : '' }}">
                    <span>Layanan</span>
                    <i class="bx bx-chevron-down navbar__dropdown-chevron"></i>
                </a>
                <ul class="navbar__dropdown-menu">
                    @if(isset($navLayanans) && $navLayanans->isNotEmpty())
                        @foreach($navLayanans as $navItem)
                            <li>
                                <a href="{{ route('layanan.detail', $navItem->slug) }}" class="navbar__dropdown-item {{ request()->is('layanan/' . $navItem->slug) ? 'active' : '' }}">
                                    <i class="{{ $navItem->icon ?? 'bx bx-plus-medical' }} navbar__dropdown-icon"></i>
                                    <span class="navbar__dropdown-text">{{ $navItem->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                    <li class="navbar__dropdown-divider"></li>
                    <li>
                        <a href="{{ route('layanan.index') }}" class="navbar__dropdown-item navbar__dropdown-all {{ request()->routeIs('layanan.index') ? 'active' : '' }}">
                            <i class="bx bx-grid-alt navbar__dropdown-icon"></i>
                            <span class="navbar__dropdown-text"><strong>Lihat Semua Layanan</strong></span>
                            <i class="bx bx-right-arrow-alt ms-auto"></i>
                        </a>
                    </li>
                </ul>
            </li>

            <li><a href="{{ route('jadwal-dokter') }}" class="{{ request()->routeIs('jadwal-dokter') ? 'active' : '' }}">Jadwal Dokter</a></li>
            <li><a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">Survei Kepuasan</a></li>
            <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Berita</a></li>
            <li><a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">Lokasi</a></li>
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
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>

        {{-- Mobile Layanan Accordion --}}
        <div class="navbar__mobile-accordion">
            <button type="button" class="navbar__mobile-accordion-toggle {{ request()->routeIs('layanan.*') ? 'active' : '' }}" id="mobileLayananToggle">
                <span>Layanan</span>
                <i class="bx bx-chevron-down" id="mobileLayananChevron"></i>
            </button>
            <div class="navbar__mobile-accordion-content" id="mobileLayananContent">
                @if(isset($navLayanans) && $navLayanans->isNotEmpty())
                    @foreach($navLayanans as $navItem)
                        <a href="{{ route('layanan.detail', $navItem->slug) }}" class="navbar__mobile-subitem {{ request()->is('layanan/' . $navItem->slug) ? 'active' : '' }}">
                            <i class="{{ $navItem->icon ?? 'bx bx-plus-medical' }}"></i>
                            <span>{{ $navItem->title }}</span>
                        </a>
                    @endforeach
                @endif
                <a href="{{ route('layanan.index') }}" class="navbar__mobile-subitem navbar__mobile-subitem-all {{ request()->routeIs('layanan.index') ? 'active' : '' }}">
                    <i class="bx bx-grid-alt"></i>
                    <span><strong>Lihat Semua Layanan →</strong></span>
                </a>
            </div>
        </div>

        <a href="{{ route('jadwal-dokter') }}" class="{{ request()->routeIs('jadwal-dokter') ? 'active' : '' }}">Jadwal Dokter</a>
        <a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">Survei Kepuasan</a>
        <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Berita</a>
        <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">Lokasi</a>
        <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-nav-cta">Janji Temu</a>
    </div>
</header>
