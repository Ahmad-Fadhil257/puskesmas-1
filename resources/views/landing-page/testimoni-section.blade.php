{{-- Testimoni Pasien Section (Full Width & Swiper Infinite Carousel like Madtive.com) --}}
<section class="testimonials" id="testimoni">

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
                <span>TESTIMONI PASIEN</span>
            </div>
            <h2 class="testimonials__title">
                Simak Kesaksian Mereka yang Mempercayai Care Link
            </h2>
            <p class="testimonials__subtitle">
                Pengalaman pasien kami berbicara banyak hal. Simak bagaimana CareLink telah memberikan perawatan ahli yang penuh kepedulian serta membawa perubahan positif dalam hidup mereka.
            </p>
        </div>

        {{-- Swiper Slider Wrapper --}}
        <div class="testimonials__slider-wrapper">

            {{-- Slider Navigation Arrows (Sisi Kiri & Kanan ala Madtive) --}}
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

                    {{-- Slide 1 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150&auto=format&fit=crop&q=80" alt="Samantha Elizabeth">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Samantha Elizabeth</h4>
                                        <span class="testimonial-card__location">Jakarta</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Saya mendapatkan pengalaman yang sangat baik di CareLink saat mengalami situasi darurat baru-baru ini. Timnya sangat suportif dan penuh perhatian, serta saya mendapatkan penanganan yang cepat. Saya benar-benar merasa diperhatikan dan ditenangkan selama seluruh proses tersebut."
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 2 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=150&auto=format&fit=crop&q=80" alt="Olivia Marie">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Olivia Marie</h4>
                                        <span class="testimonial-card__location">Bandung</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "CareLink telah menjadi andalan saya untuk konsultasi kesehatan, dan saya selalu terkesan dengan profesionalisme serta kepedulian tulus dari para dokternya. Mereka meluangkan waktu untuk mendengarkan dan memberikan penjelasan, sehingga setiap kunjungan terasa personal."
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 3 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=150&auto=format&fit=crop&q=80" alt="Jessica Claire">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Jessica Claire</h4>
                                        <span class="testimonial-card__location">Cirebon</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Para spesialis di CareLink memberikan panduan yang saya butuhkan untuk mengelola kondisi kesehatan saya. Keahlian dan dukungan mereka yang tepat waktu sangat membantu proses pemulihan saya, dan saya bersyukur atas perawatan menyeluruh yang saya terima."
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 4 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80" alt="Budi Santoso">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Budi Santoso</h4>
                                        <span class="testimonial-card__location">Surabaya</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Sistem antrean online dan keramahan petugas puskesmas CareLink benar-benar luar biasa. Waktu tunggu sangat singkat dan fasilitas poli gigi sangat bersih serta modern. Sangat direkomendasikan!"
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 5 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?w=150&auto=format&fit=crop&q=80" alt="Ratna Dewi">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Ratna Dewi</h4>
                                        <span class="testimonial-card__location">Semarang</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Pelayanan posyandu dan pemeriksaan anak di CareLink sangat humanis. Dokter dan bidan selalu memberikan edukasi gizi yang mudah dipahami oleh para ibu muda seperti saya."
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Slide 6 --}}
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-card__content">
                                <div class="testimonial-card__header">
                                    <div class="testimonial-card__avatar">
                                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80" alt="Hendra Wijaya">
                                    </div>
                                    <div class="testimonial-card__info">
                                        <h4 class="testimonial-card__name">Hendra Wijaya</h4>
                                        <span class="testimonial-card__location">Yogyakarta</span>
                                    </div>
                                    <div class="testimonial-card__quote-badge">
                                        <svg viewBox="0 0 24 24"><path d="M4.583 17.321C3.553 16.227 3 15 3 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C9.591 11.69 11 13.166 11 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179zm10 0C13.553 16.227 13 15 13 13.011c0-3.5 2.457-6.637 6.03-8.188l.893 1.378c-3.335 1.804-3.987 4.145-4.247 5.621.537-.278 1.24-.375 1.929-.311C19.591 11.69 21 13.166 21 15c0 1.933-1.567 3.5-3.5 3.5-1.193 0-2.31-.566-2.917-1.179z"/></svg>
                                    </div>
                                </div>
                                <p class="testimonial-card__quote">
                                    "Aplikasi dan layanan Puskesmas CareLink sangat mempermudah pendaftaran lansia. Ibu saya tidak perlu antre berjam-jam lagi. Sungguh inovasi pelayanan publik yang luar biasa!"
                                </p>
                            </div>
                            <div class="testimonial-card__stars" aria-label="5 dari 5 bintang">
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Slider Pagination Dots (Gaya Madtive.com) --}}
            <div class="swiper-pagination testimonials__pagination" id="testiPagination"></div>

        </div>

    </div>

    {{-- Swiper JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    {{-- Swiper Carousel Initialization --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const testiSwiper = new Swiper('.testimoni-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 700,
                grabCursor: true,
                autoplay: {
                    delay: 4500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                navigation: {
                    nextEl: '#testiNextBtn',
                    prevEl: '#testiPrevBtn',
                },
                pagination: {
                    el: '#testiPagination',
                    clickable: true,
                    dynamicBullets: false,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1.5,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 24,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    }
                }
            });
        });
    </script>
</section>
