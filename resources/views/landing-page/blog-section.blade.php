{{-- Blog & Berita Section --}}
<section class="blog" id="blog">
    <div class="blog__container">

        {{-- Section Header --}}
        <div class="blog__header">
            <div class="blog__badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                    <line x1="9" y1="7" x2="15" y2="7"/>
                    <line x1="9" y1="11" x2="15" y2="11"/>
                </svg>
                <span>BLOG & BERITA</span>
            </div>
            <h2 class="blog__title">Tetap Terinformasi dengan Berita Terbaru</h2>
            <p class="blog__subtitle">
                Bagian Blog & Berita kami menyajikan informasi terkini mengenai tips kesehatan, terobosan medis, kabar klinik, dan saran seputar kebugaran.
            </p>
        </div>

        {{-- Blog Grid --}}
        <div class="blog__grid">

            {{-- Featured Card (Kiri) --}}
            <article class="blog-card blog-card--featured">
                <div class="blog-card__image-wrap">
                    <img src="{{ asset('assets/blog/blog-1.png') }}" 
                         alt="Memahami Pentingnya Pemeriksaan Kesehatan Rutin" 
                         class="blog-card__img">
                    <div class="blog-card__overlay"></div>
                </div>
                <div class="blog-card__content">
                    <div class="blog-card__meta">
                        <span>JANUARI 15, 2025</span>
                        <span class="blog-card__meta-dot">&bull;</span>
                        <span>0 KOMEN</span>
                        <span class="blog-card__meta-dot">&bull;</span>
                        <span>BERITA</span>
                    </div>
                    <h3 class="blog-card__title">
                        Memahami Pentingnya Pemeriksaan Kesehatan Rutin
                    </h3>
                    <a href="#blog-detail" class="btn-blog-read">
                        Baca selengkapnya
                    </a>
                </div>
            </article>

            {{-- Right Column (2 Cards) --}}
            <div class="blog__sidebar">

                {{-- Card 2: Kelola Stres --}}
                <article class="blog-card blog-card--side">
                    <div class="blog-card__side-img-wrap">
                        <img src="{{ asset('assets/blog/blog-2.png') }}" 
                             alt="Cara Mengelola Stres dan Meningkatkan Kesejahteraan Mental" 
                             class="blog-card__side-img">
                    </div>
                    <div class="blog-card__side-body">
                        <h3 class="blog-card__side-title">
                            Cara Mengelola Stres dan Meningkatkan Kesejahteraan Mental
                        </h3>
                        <span class="blog-card__date">Selasa - 24 Januari 2025</span>
                    </div>
                </article>

                {{-- Card 3: Perawatan Gawat Darurat --}}
                <article class="blog-card blog-card--side">
                    <div class="blog-card__side-img-wrap">
                        <img src="{{ asset('assets/blog/blog-3.png') }}" 
                             alt="Kemajuan Terbaru dalam Perawatan Gawat Darurat: Hal-Hal yang Perlu Anda Ketahui" 
                             class="blog-card__side-img">
                    </div>
                    <div class="blog-card__side-body">
                        <h3 class="blog-card__side-title">
                            Kemajuan Terbaru dalam Perawatan Gawat Darurat: Hal-Hal yang Perlu Anda Ketahui
                        </h3>
                        <span class="blog-card__date">Selasa - 24 Januari 2025</span>
                    </div>
                </article>

            </div>

        </div>

    </div>
</section>
