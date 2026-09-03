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
            @else
                <span class="navbar__brand-text brand-text">Puskesmas</span>
            @endif
        </a>

        <!-- Desktop Menu -->
        <ul class="navbar__menu">
            {{-- 1. BERANDA --}}
            <li>
                <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                    BERANDA
                </a>
            </li>

            {{-- 2. LAYANAN (DROPDOWN DINAMIS) --}}
            <li class="navbar__item-dropdown">
                <a href="javascript:void(0)" class="navbar__dropdown-toggle {{ request()->routeIs('layanan.*') ? 'active' : '' }}" role="button" aria-haspopup="true" aria-expanded="false">
                    <span>LAYANAN</span>
                    <svg class="navbar__dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; margin-top: 1px;">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    @if(isset($navLayanans) && $navLayanans->isNotEmpty())
                        @foreach($navLayanans->filter(fn($item) => !empty($item->slug)) as $navItem)
                            <li>
                                <a href="{{ route('layanan.detail', $navItem->slug) }}" class="navbar__dropdown-item {{ request()->is('layanan/' . $navItem->slug) ? 'active' : '' }}">
                                    <i class="{{ $navItem->icon ?? 'bx bx-plus-medical' }} navbar__dropdown-icon"></i>
                                    <span class="navbar__dropdown-text">{{ $navItem->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </li>

            {{-- 3. INFORMASI PUBLIK (DROPDOWN) --}}
            <li class="navbar__item-dropdown">
                <a href="javascript:void(0)" class="navbar__dropdown-toggle {{ request()->routeIs('blog.*') || request()->routeIs('faq.*') || request()->routeIs('infografis') || request()->routeIs('statistik') ? 'active' : '' }}" role="button" aria-haspopup="true" aria-expanded="false">
                    <span>INFORMASI PUBLIK</span>
                    <svg class="navbar__dropdown-chevron" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px; margin-top: 1px;">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                </a>
                <ul class="navbar__dropdown-menu">
                    <li>
                        <a href="{{ route('blog.index') }}" class="navbar__dropdown-item {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                            <i class="bx bx-news navbar__dropdown-icon"></i>
                            <span class="navbar__dropdown-text">Berita & Artikel</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('infografis') }}" class="navbar__dropdown-item {{ request()->routeIs('infografis') ? 'active' : '' }}">
                            <i class="bx bx-image-alt navbar__dropdown-icon"></i>
                            <span class="navbar__dropdown-text">Infografis</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('faq.index') }}" class="navbar__dropdown-item {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                            <i class="bx bx-help-circle navbar__dropdown-icon"></i>
                            <span class="navbar__dropdown-text">Tanya Jawab (FAQ)</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('statistik') }}" class="navbar__dropdown-item {{ request()->routeIs('statistik') ? 'active' : '' }}">
                            <i class="bx bx-bar-chart-alt-2 navbar__dropdown-icon"></i>
                            <span class="navbar__dropdown-text">Statistik Kesehatan</span>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- 4. KONTAK --}}
            <li>
                <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">
                    KONTAK
                </a>
            </li>

            {{-- 5. SURVEI --}}
            <li>
                <a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">
                    SURVEI
                </a>
            </li>
        </ul>

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
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">BERANDA</a>

        {{-- Mobile Layanan Accordion --}}
        <div class="navbar__mobile-accordion">
            <button type="button" class="navbar__mobile-accordion-toggle {{ request()->routeIs('layanan.*') ? 'active' : '' }}" id="mobileLayananToggle">
                <span>LAYANAN</span>
                <i class="bx bx-chevron-down" id="mobileLayananChevron"></i>
            </button>
            <div class="navbar__mobile-accordion-content" id="mobileLayananContent">
                @if(isset($navLayanans) && $navLayanans->isNotEmpty())
                    @foreach($navLayanans->filter(fn($item) => !empty($item->slug)) as $navItem)
                        <a href="{{ route('layanan.detail', $navItem->slug) }}" class="navbar__mobile-subitem {{ request()->is('layanan/' . $navItem->slug) ? 'active' : '' }}">
                            <i class="{{ $navItem->icon ?? 'bx bx-plus-medical' }}"></i>
                            <span>{{ $navItem->title }}</span>
                        </a>
                    @endforeach
                @endif
            </div>
        </div>

        {{-- Mobile Informasi Publik Accordion --}}
        <div class="navbar__mobile-accordion">
            <button type="button" class="navbar__mobile-accordion-toggle {{ request()->routeIs('blog.*') || request()->routeIs('faq.*') || request()->routeIs('infografis') || request()->routeIs('statistik') ? 'active' : '' }}" id="mobileInfoToggle">
                <span>INFORMASI PUBLIK</span>
                <i class="bx bx-chevron-down" id="mobileInfoChevron"></i>
            </button>
            <div class="navbar__mobile-accordion-content" id="mobileInfoContent">
                <a href="{{ route('blog.index') }}" class="navbar__mobile-subitem {{ request()->routeIs('blog.*') ? 'active' : '' }}">
                    <i class="bx bx-news"></i> <span>Berita & Artikel</span>
                </a>
                <a href="{{ route('infografis') }}" class="navbar__mobile-subitem {{ request()->routeIs('infografis') ? 'active' : '' }}">
                    <i class="bx bx-image-alt"></i> <span>Infografis</span>
                </a>
                <a href="{{ route('faq.index') }}" class="navbar__mobile-subitem {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                    <i class="bx bx-help-circle"></i> <span>Tanya Jawab (FAQ)</span>
                </a>
                <a href="{{ route('statistik') }}" class="navbar__mobile-subitem {{ request()->routeIs('statistik') ? 'active' : '' }}">
                    <i class="bx bx-bar-chart-alt-2"></i> <span>Statistik Kesehatan</span>
                </a>
            </div>
        </div>

        <a href="{{ route('lokasi') }}" class="{{ request()->routeIs('lokasi') ? 'active' : '' }}">KONTAK</a>
        <a href="{{ route('survei.index') }}" class="{{ request()->routeIs('survei.*') ? 'active' : '' }}">SURVEI</a>
    </div>
</header>
