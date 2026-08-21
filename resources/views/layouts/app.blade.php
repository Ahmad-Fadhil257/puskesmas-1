<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name') . ' - Melayani Kesehatan Masyarakat')</title>
    <meta name="description" content="@yield('meta_description', 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.')">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/layouts/nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/info-cards.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/nilai-nilai.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/cara.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/testimoni.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing-page/footer.css') }}">

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

            if (!toggle || !menu) return;

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
        });
    </script>

    @stack('scripts')
</body>
</html>
