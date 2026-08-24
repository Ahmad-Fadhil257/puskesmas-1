<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero__inner">

        <!-- Left Column: Text & CTA -->
        <div class="hero__content">
            <!-- Badge -->
            <div class="hero__badge">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span>Selamat Datang Di Puskesmas CareLink</span>
            </div>

            <!-- Headline H1 (48px) -->
            <h1 class="hero__title">
                Melayani Kesehatan Masyarakat dengan Sepenuh Hati
            </h1>

            <!-- Description (20px) -->
            <p class="hero__desc">
                Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.
            </p>

            <!-- Dual Action Buttons -->
            <div class="hero__actions">
                <a href="#janji-temu" class="btn-primary">Janji Temu Online</a>
                <a href="#layanan" class="btn-secondary">Layanan Kami</a>
            </div>
        </div>

        <!-- Right Column: Staggered Photos - Mobile Carousel -->
        <div class="hero__carousel-clip">

            <div class="hero__grid-wrapper" id="heroCarousel">
                <!-- Row Atas (Geser Kanan 50px) -->
                <div class="hero__grid-row hero__grid-row--top">
                    <img src="{{ asset('assets/hero/image 5.png') }}"
                         alt="Pemeriksaan Kesehatan di Puskesmas CareLink"
                         class="hero__img"
                         loading="lazy">
                    <img src="{{ asset('assets/hero/image 6.png') }}"
                         alt="Konsultasi Kesehatan Ibu dan Anak"
                         class="hero__img"
                         loading="lazy">
                </div>

                <!-- Row Bawah (Geser Kiri 50px) -->
                <div class="hero__grid-row hero__grid-row--bottom">
                    <img src="{{ asset('assets/hero/image 4.png') }}"
                         alt="Ruang Tunggu dan Lobi Puskesmas"
                         class="hero__img"
                         loading="lazy">
                    <img src="{{ asset('assets/hero/image 1.png') }}"
                         alt="Pelayanan Imunisasi Bayi dan Balita"
                         class="hero__img"
                         loading="lazy">
                </div>
            </div>

            <!-- Dots Indicator -->
            <div class="hero__dots" id="heroDots">
                <span class="hero__dot hero__dot--active"></span>
                <span class="hero__dot"></span>
                <span class="hero__dot"></span>
                <span class="hero__dot"></span>
            </div>
        </div>

        <script>
        (function() {
            var carousel = document.getElementById('heroCarousel');
            var dots     = document.querySelectorAll('#heroDots .hero__dot');
            var current  = 0;

            // Sync dots saat digeser manual
            carousel.addEventListener('scroll', function() {
                var idx = Math.round(carousel.scrollLeft / carousel.offsetWidth);
                if (idx !== current) {
                    current = idx;
                    dots.forEach(function(d, i) {
                        d.classList.toggle('hero__dot--active', i === current);
                    });
                }
            });
        })();
        </script>

    </div>
</section>
