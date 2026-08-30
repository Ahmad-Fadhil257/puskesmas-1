{{-- Survei Kepuasan Pasien Section (Full Width & Swiper Carousel) --}}
<section class="testimonials" id="survei-pasien">

    {{-- Swiper CSS CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    {{-- Decorative Ambient Glows & Subtle Pattern --}}
    <div class="testimonials__decor-glow-1" aria-hidden="true"></div>
    <div class="testimonials__decor-glow-2" aria-hidden="true"></div>
    <div class="testimonials__decor-pattern" aria-hidden="true"></div>

    <div class="testimonials__container">

        {{-- Section Header --}}
        <div class="testimonials__header">
            <div class="testimonials__badge">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 14H5.17L4 17.17V4h16v12z"/>
                </svg>
                <span>SURVEI KEPUASAN PASIEN</span>
            </div>
            <h2 class="testimonials__title" data-aos="fade-right">
                Suara & Hasil Evaluasi Masyarakat
            </h2>
            <p class="testimonials__subtitle" data-aos="fade-up">
                Rangkuman penilaian dan ulasan nyata dari masyarakat mengenai kualitas, ketepatan, dan keramahan pelayanan kesehatan di Puskesmas.
            </p>
        </div>

        {{-- Swiper Slider Wrapper --}}
        <div class="testimonials__slider-wrapper">

            {{-- Slider Navigation Arrows --}}
            <button class="testimonials__nav-btn testimonials__nav-btn--prev" id="testiPrevBtn" aria-label="Testimoni Sebelumnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <button class="testimonials__nav-btn testimonials__nav-btn--next" id="testiNextBtn" aria-label="Testimoni Berikutnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            {{-- Swiper Container --}}
            <div class="swiper testimoni-swiper">
                <div class="swiper-wrapper">

                    @forelse($surveys as $s)
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="{{ $s->avatar_url }}" alt="{{ $s->name }}">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">{{ $s->name }}</h4>
                                        <span class="testimonial-card__location">{{ $s->poli_name ?? 'Poli Umum' }}</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "{{ $s->pesan }}"
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="{{ $s->rating }} dari 5 bintang">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg viewBox="0 0 24 24" style="opacity: {{ $i <= $s->rating ? '1' : '0.2' }};"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @empty
                    {{-- Fallback jika belum ada data --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://ui-avatars.com/api/?name=Samantha+Elizabeth&background=0A5C45&color=ffffff" alt="Samantha">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Samantha Elizabeth</h4>
                                        <span class="testimonial-card__location">Poli Umum</span>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Pelayanan dokter sangat ramah, penjelasannya mudah dipahami dan obatnya langsung terasa khasiatnya. Ruang tunggu sangat bersih dan nyaman."
                                </p>
                            </div>
                            <div class="testimonial-card__stars">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>

            {{-- Slider Pagination Dots --}}
            <div class="testimonials__pagination"></div>

        </div>

        {{-- CTA Isi Survei --}}
        <div class="testimonials__cta-wrap">
            <a href="{{ route('survei.index') }}" class="testimonials__cta-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                </svg>
                <span>Beri Penilaian Anda (Isi Survei)</span>
            </a>
        </div>

    </div>
</section>

{{-- Swiper JS CDN --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

{{-- Swiper Carousel Initialization --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swiper = new Swiper('.testimoni-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            speed: 650,
            pagination: {
                el: '.testimonials__pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '#testiNextBtn',
                prevEl: '#testiPrevBtn',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1.5,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 24,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 24,
                },
            },
        });
    });
</script>
