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

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('css/layouts/nav.css') }}">
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

    <!-- Floating Operational Badge Styles -->
    <style>
        @keyframes slideInBadge {
            0%   { opacity: 0; transform: translateX(-60px) scale(0.85); }
            60%  { opacity: 1; transform: translateX(6px) scale(1.03); }
            80%  { transform: translateX(-2px) scale(0.99); }
            100% { opacity: 1; transform: translateX(0) scale(1); }
        }

        @keyframes floatBadge {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-6px); }
        }

        @keyframes emeraldPulse {
            0%, 100% {
                box-shadow: 0 4px 18px rgba(10, 92, 69, 0.18), 0 2px 8px rgba(0,0,0,0.07);
                border-color: rgba(10, 92, 69, 0.12);
            }
            50% {
                box-shadow: 0 8px 32px rgba(10, 92, 69, 0.32), 0 2px 12px rgba(0,0,0,0.10);
                border-color: rgba(10, 92, 69, 0.28);
            }
        }

        @keyframes dotPing {
            0%, 100% { opacity: 1; transform: scale(1); }
            50%       { opacity: 0.5; transform: scale(1.6); }
        }

        .operational-badge {
            position: fixed;
            top: 104px;
            left: 20px;
            background: #FFFFFF;
            border-radius: 14px;
            padding: 14px 18px 14px 16px;
            border: 1.5px solid rgba(10, 92, 69, 0.12);
            z-index: 90;
            display: flex;
            flex-direction: column;
            gap: 3px;
            animation:
                slideInBadge 0.65s cubic-bezier(0.34, 1.56, 0.64, 1) forwards,
                floatBadge   4s ease-in-out 0.8s infinite,
                emeraldPulse 4s ease-in-out 0.8s infinite;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .operational-badge__close {
            position: absolute;
            top: 7px;
            right: 9px;
            background: none;
            border: none;
            font-size: 17px;
            color: #9CA3AF;
            cursor: pointer;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
            line-height: 1;
        }

        .operational-badge__close:hover {
            color: #EF4444;
            background: rgba(239, 68, 68, 0.1);
            transform: rotate(90deg);
        }

        .operational-badge__label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 9.5px;
            font-weight: 800;
            color: #0A5C45;
            letter-spacing: 0.11em;
            text-transform: uppercase;
        }

        .operational-badge__dot {
            width: 7px;
            height: 7px;
            background: #22C55E;
            border-radius: 50%;
            animation: dotPing 2s ease-in-out infinite;
            flex-shrink: 0;
        }

        .operational-badge__days {
            font-size: 12.5px;
            font-weight: 600;
            color: #374151;
            line-height: 1.3;
        }

        .operational-badge__hours {
            font-size: 15px;
            font-weight: 800;
            color: #0A5C45;
            line-height: 1.3;
            letter-spacing: -0.02em;
        }

        /* Responsive: hide on mobile */
        @media (max-width: 768px) {
            .operational-badge { display: none; }
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Header / Navigation Bar -->
    @include('landing-page.nav')

    <!-- Main Content Body -->
    <main>
        @yield('content')
    </main>

    <!-- Floating Badge: Jam Operasional — hanya di landing page utama -->
    @if(($appSetting->show_operational_hours ?? true) && request()->routeIs('home'))
    <div class="operational-badge" id="operationalBadge">
        <button class="operational-badge__close" id="closeOperationalBadge" aria-label="Tutup">×</button>
        <span class="operational-badge__label">
            <span class="operational-badge__dot"></span>
            OPERASIONAL
        </span>
        <span class="operational-badge__days">{{ $appSetting->operational_days ?? 'Senin - Sabtu' }}</span>
        <span class="operational-badge__hours">{{ $appSetting->operational_hours ?? '08.00 - 16.00 WIB' }}</span>
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

            // Close operational badge
            document.getElementById('closeOperationalBadge')?.addEventListener('click', function() {
                const badge = document.getElementById('operationalBadge');
                if (badge) {
                    badge.style.animation = 'none';
                    badge.style.opacity = '0';
                    badge.style.transform = 'translateX(-50px) scale(0.8)';
                    setTimeout(() => {
                        badge.style.display = 'none';
                    }, 300);
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
