<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name') . ' - Melayani Kesehatan Masyarakat')</title>
    <meta name="description" content="@yield('meta_description', 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.')">

    <!-- Boxicons Font Icons -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/layouts/nav.css') }}?v={{ file_exists(public_path('css/layouts/nav.css')) ? filemtime(public_path('css/layouts/nav.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/info-cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/nilai-nilai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/layanan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/dokter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/cara.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/testimoni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/subpage-header.css') }}?v={{ file_exists(public_path('css/landing-page/subpage-header.css')) ? filemtime(public_path('css/landing-page/subpage-header.css')) : time() }}">
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/typography-animations.css') }}">

    @stack('styles')
</head>
<body>

    <!-- Header / Navigation Bar -->
    @include('landing-page.nav')

    <!-- Main Content Body -->
    <main>
        @yield('content')
    </main>

    <!-- Floating Badge: Jam Operasional (Circular Medical Seal) — hanya di landing page utama -->
    @if(($appSetting->show_operational_hours ?? true) && request()->routeIs('home'))
    <div class="operational-circle-badge" id="operationalBadge" role="complementary" aria-label="Jam Operasional Puskesmas">
        <button type="button" class="operational-circle-badge__close" id="closeOperationalBadge" aria-label="Tutup pemberitahuan" title="Tutup">
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>

        <!-- Outer Rotating Circular Text Ring (Jarak Lebih Pas & Rapi Mengitari Lingkaran) -->
        <div class="operational-circle-badge__spinner">
            <svg viewBox="0 0 150 150" class="operational-circle-badge__svg-ring" aria-hidden="true">
                <defs>
                    <path id="circleTextPath" d="M 75, 75 m -57, 0 a 57,57 0 1,1 114,0 a 57,57 0 1,1 -114,0" />
                </defs>
                <circle cx="75" cy="75" r="68" fill="none" stroke="rgba(10, 92, 69, 0.14)" stroke-width="1.2" stroke-dasharray="3.5 3" />
                <text font-size="8.6" font-weight="800" fill="#0A5C45" letter-spacing="2.2px">
                    <textPath href="#circleTextPath" startOffset="0%">
                        {{ $appSetting->operational_badge_text ?? '• JAM OPERASIONAL • PUSKESMAS BUKA •' }}
                    </textPath>
                </text>
            </svg>
        </div>

        <!-- Inner Core Disc (Bersih: Hanya Ikon Jam + Hari + Waktu) -->
        <div class="operational-circle-badge__core">
            <i class="bx bx-time-five operational-circle-badge__icon"></i>
            <span class="operational-circle-badge__days">{{ $appSetting->operational_days ?? 'Senin - Sabtu' }}</span>
            <span class="operational-circle-badge__hours">{{ $appSetting->operational_hours ?? '08.00 - 16.00 WIB' }}</span>
        </div>
    </div>
    @endif

    <!-- Footer -->
    @include('landing-page.footer')

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('mobileToggle');
            const menu = document.getElementById('mobileMenu');
            const iconOpen = document.getElementById('iconOpen');
            const iconClose = document.getElementById('iconClose');
            const header = document.querySelector('.site-header');

            if (toggle && menu) {
                toggle.addEventListener('click', function () {
                    const isOpen = menu.classList.toggle('open');
                    toggle.setAttribute('aria-expanded', isOpen);
                    iconOpen.style.display = isOpen ? 'none' : 'block';
                    iconClose.style.display = isOpen ? 'block' : 'none';
                });

                menu.querySelectorAll('a').forEach(function (link) {
                    link.addEventListener('click', function () {
                        menu.classList.remove('open');
                        toggle.setAttribute('aria-expanded', 'false');
                        iconOpen.style.display = 'block';
                        iconClose.style.display = 'none';
                    });
                });
            }

            // Sticky navbar effect
            if (header) {
                window.addEventListener('scroll', function () {
                    header.classList.toggle('scrolled', window.scrollY > 50);
                }, { passive: true });
            }

            // ── Mobile Accordion Dropdowns Helper ─────────────────────────────
            function setupMobileAccordion(toggleId, contentId) {
                const toggle = document.getElementById(toggleId);
                const content = document.getElementById(contentId);
                if (toggle && content) {
                    toggle.addEventListener('click', function (e) {
                        e.stopPropagation();
                        const isOpen = content.classList.toggle('open');
                        toggle.classList.toggle('open', isOpen);
                    });
                }
            }
            setupMobileAccordion('mobileProfilToggle', 'mobileProfilContent');
            setupMobileAccordion('mobileLayananToggle', 'mobileLayananContent');
            setupMobileAccordion('mobileInfoToggle', 'mobileInfoContent');

            // ── Close dropdown when clicking outside ─────────────────────────
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.navbar__item-dropdown') && !e.target.closest('.has-dropdown')) {
                    document.querySelectorAll('.has-dropdown.is-open').forEach(function (el) {
                        el.classList.remove('is-open');
                    });
                }
            });

            // ── Close Operational Badge ──────────────────────────────────────
            document.getElementById('closeOperationalBadge')?.addEventListener('click', function() {
                const badge = document.getElementById('operationalBadge');
                if (badge) {
                    badge.style.animation = 'none';
                    badge.style.opacity = '0';
                    badge.style.transform = 'scale(0.3) rotate(-40deg)';
                    setTimeout(() => {
                        badge.style.display = 'none';
                    }, 250);
                }
            });
        });
    </script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 700,
            once: true,
            offset: 60,
            easing: 'ease-out-cubic'
        });
    </script>
    <script src="{{ asset('js/typography-animations.js') }}" defer></script>
    @stack('scripts')
</body>
</html>
