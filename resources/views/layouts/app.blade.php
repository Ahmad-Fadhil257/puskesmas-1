<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name') . ' - Melayani Kesehatan Masyarakat')</title>
    <meta name="description" content="@yield('meta_description', 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.')">

    <!-- Boxicons Font Icons -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendor/fonts/boxicons.css') }}">
    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/layouts/nav.css') }}?v={{ file_exists(public_path('css/layouts/nav.css')) ? filemtime(public_path('css/layouts/nav.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/info-cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/nilai-nilai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/layanan.css') }}?v={{ file_exists(public_path('css/landing-page/layanan.css')) ? filemtime(public_path('css/landing-page/layanan.css')) : time() }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/dokter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/cara.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/testimoni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/statistik.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/subpage-header.css') }}?v={{ file_exists(public_path('css/landing-page/subpage-header.css')) ? filemtime(public_path('css/landing-page/subpage-header.css')) : time() }}">
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

            // ── Mobile Accordion Dropdowns Helper (Exclusive Accordion + Smooth) ──
            const mobileAccordions = [
                { toggle: document.getElementById('mobileLayananToggle'), content: document.getElementById('mobileLayananContent') },
                { toggle: document.getElementById('mobileInfoToggle'), content: document.getElementById('mobileInfoContent') },
                { toggle: document.getElementById('mobileProfilToggle'), content: document.getElementById('mobileProfilContent') }
            ].filter(function (item) { return item.toggle && item.content; });

            mobileAccordions.forEach(function (item) {
                item.toggle.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const willOpen = !item.content.classList.contains('open');

                    // Tutup SEMUA accordion lain agar hanya 1 yang terbuka
                    mobileAccordions.forEach(function (other) {
                        other.content.classList.remove('open');
                        other.toggle.classList.remove('open');
                    });

                    // Jika sebelumnya tertutup, sekarang buka
                    if (willOpen) {
                        item.content.classList.add('open');
                        item.toggle.classList.add('open');
                    }
                });
            });

            // ── Close dropdown when clicking outside ─────────────────────────
            document.addEventListener('click', function (e) {
                if (!e.target.closest('.navbar__item-dropdown') && !e.target.closest('.has-dropdown')) {
                    document.querySelectorAll('.has-dropdown.is-open').forEach(function (el) {
                        el.classList.remove('is-open');
                    });
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
