{{-- Dokter Kami Section with Swiper Carousel --}}
<section class="dokter-section" id="dokter-kami">
    {{-- Swiper CSS CDN --}}
    @once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @endonce

    <div class="dokter-container">

        {{-- ---- HEADER ---- --}}
        <div class="dokter-header">

            <div class="dokter-label" data-aos="fade-right">
                {{-- Ikon dokter/orang --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.77C4.484 10.426 5.980 10 8 10c.145 0 .288.004.43.01a4.5 4.5 0 0 1 .288-.97C8.51 9.015 8.27 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                </svg>
                DOKTER KAMI
            </div>

            <h2 class="dokter-title" data-aos="fade-right">Kenali Dokter Spesialis Kami</h2>

            <p class="dokter-subtitle" data-aos="fade-up">
                Tim dokter spesialis kami berdedikasi untuk memberikan<br>
                layanan ahli di berbagai bidang medis.
            </p>

        </div>
        {{-- END HEADER --}}

        {{-- ---- SLIDER WRAPPER ---- --}}
        <div class="dokter-slider-wrapper" data-aos="fade-up">

            {{-- Navigation Arrows --}}
            <button class="dokter__nav-btn dokter__nav-btn--prev" id="dokterPrevBtn" aria-label="Dokter Sebelumnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <button class="dokter__nav-btn dokter__nav-btn--next" id="dokterNextBtn" aria-label="Dokter Berikutnya">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>

            {{-- Swiper Container --}}
            <div class="swiper dokter-swiper">
                <div class="swiper-wrapper">

                    @forelse($dokters as $dokter)
                    <div class="swiper-slide">
                        <div class="dokter-card">
                            <div class="dokter-photo-wrap">
                                @if($dokter->photo)
                                    <img src="{{ $dokter->photo_url }}" alt="{{ $dokter->name }}" loading="lazy">
                                @else
                                    {{-- Placeholder avatar jika tidak ada foto --}}
                                    <div class="dokter-no-photo">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="width:48px;height:48px;opacity:0.4;">
                                            <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm-5 8s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <h3 class="dokter-name">{{ $dokter->name }}</h3>
                            <p class="dokter-specialty">{{ $dokter->specialty }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="swiper-slide">
                        <p class="text-center" style="color: rgba(255,255,255,0.6); padding: 40px 0; width: 100%;">
                            Belum ada data dokter yang ditampilkan.
                        </p>
                    </div>
                    @endforelse

                </div>
            </div>

            {{-- Pagination Dots --}}
            <div class="swiper-pagination dokter__pagination" id="dokterPagination"></div>

        </div>
        {{-- END SLIDER WRAPPER --}}

    </div>

    {{-- Swiper JS CDN --}}
    @once
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @endonce

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const count = {{ $dokters->count() }};
            const dokterSwiper = new Swiper('.dokter-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 16,
                loop: count > 4,
                speed: 600,
                grabCursor: true,
                autoplay: count > 4 ? {
                    delay: 4000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,
                navigation: {
                    nextEl: '#dokterNextBtn',
                    prevEl: '#dokterPrevBtn',
                },
                pagination: {
                    el: '#dokterPagination',
                    clickable: true,
                    dynamicBullets: false,
                },
                breakpoints: {
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 24,
                    }
                }
            });
        });
    </script>
</section>
