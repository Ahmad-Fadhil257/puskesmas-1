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
                <span>{{ $hero->badge_text ?? 'Selamat Datang Di Puskesmas CareLink' }}</span>
            </div>

            <!-- Headline H1 (48px) -->
            <h1 class="hero__title">
                {{ $hero->title ?? 'Melayani Kesehatan Masyarakat dengan Sepenuh Hati' }}
            </h1>

            <!-- Description (20px) -->
            <p class="hero__desc">
                {{ $hero->description ?? 'Pelayanan medis komprehensif dengan dokter ahli, fasilitas modern, dan pelayanan penuh kasih sayang. Kesehatan Anda, prioritas kami.' }}
            </p>

            <!-- Dual Action Buttons -->
            <div class="hero__actions">
                <a href="{{ $kontak->wa_link }}" target="_blank" rel="noopener" class="btn-primary">
                    {{ $hero->btn_primary_text ?? 'Janji Temu Online' }}
                </a>
                <a href="{{ $hero->btn_secondary_link ?? '#layanan' }}" class="btn-secondary">
                    {{ $hero->btn_secondary_text ?? 'Layanan Kami' }}
                </a>
            </div>
        </div>

        <!-- Right Column: Staggered Photos (Dinamis dari Database) -->
        <div class="hero__grid-wrapper">
            <!-- Row Atas (Geser Kanan 50px) -->
            <div class="hero__grid-row hero__grid-row--top">
                <img src="{{ isset($hero) ? $hero->image_1_url : asset('assets/hero/image 5.png') }}"
                     alt="Pelayanan Puskesmas CareLink"
                     class="hero__img"
                     loading="lazy">
                <img src="{{ isset($hero) ? $hero->image_2_url : asset('assets/hero/image 6.png') }}"
                     alt="Konsultasi Pasien"
                     class="hero__img"
                     loading="lazy">
            </div>

            <!-- Row Bawah (Geser Kiri 50px) -->
            <div class="hero__grid-row hero__grid-row--bottom">
                <img src="{{ isset($hero) ? $hero->image_3_url : asset('assets/hero/image 4.png') }}"
                     alt="Fasilitas Puskesmas"
                     class="hero__img"
                     loading="lazy">
                <img src="{{ isset($hero) ? $hero->image_4_url : asset('assets/hero/image 1.png') }}"
                     alt="Tenaga Medis CareLink"
                     class="hero__img"
                     loading="lazy">
            </div>
        </div>

    </div>
</section>
