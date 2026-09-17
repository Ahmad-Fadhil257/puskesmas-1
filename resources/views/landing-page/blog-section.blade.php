{{-- Blog & Berita Section --}}
@php
    $articlesList = isset($latestArticles) && $latestArticles->count() > 0 
        ? $latestArticles 
        : \App\Models\Article::published()->take(3)->get();
    $featured = $articlesList->first();
    $sideArticles = $articlesList->slice(1);
@endphp

<section class="blog" id="blog">
    <div class="blog__container">

        {{-- Section Header with "Lihat Semua" --}}
        <div class="blog__header-row">
            <div class="blog__header">
                <div class="blog__badge" data-aos="fade-right">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                        <line x1="9" y1="7" x2="15" y2="7"/>
                        <line x1="9" y1="11" x2="15" y2="11"/>
                    </svg>
                    <span>BLOG & BERITA</span>
                </div>
                <h2 class="blog__title" data-aos="fade-right">Tetap Terinformasi dengan Berita Terbaru</h2>
                <p class="blog__subtitle" data-aos="fade-up">
                    Bagian Blog & Berita kami menyajikan informasi terkini mengenai tips kesehatan, terobosan medis, kabar klinik, dan saran seputar kebugaran.
                </p>
            </div>

            <div class="blog__header-action" data-aos="fade-left">
                <a href="{{ route('blog.index') }}" class="btn-blog-see-all">
                    <span>Lihat Semua</span>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Blog Grid Layout (Sesuai Gambar 3 Figma) --}}
        <div class="blog__grid">

            {{-- Featured Card (Kiri - Banner Besar dengan Overlay) --}}
            @if($featured)
                <article class="blog-card blog-card--featured" data-aos="fade-up">
                    <a href="{{ route('blog.show', $featured->slug) }}" class="blog-card__image-wrap">
                        <img src="{{ $featured->thumbnail_url }}" 
                             alt="{{ $featured->title }}" 
                             class="blog-card__img">
                        <div class="blog-card__overlay"></div>
                    </a>
                    <div class="blog-card__content">
                        <div class="blog-card__meta">
                            <span>{{ strtoupper($featured->formatted_date) }}</span>
                            <span class="blog-card__meta-dot">&bull;</span>
                            <span>{{ strtoupper($featured->category) }}</span>
                            <span class="blog-card__meta-dot">&bull;</span>
                            <span>{{ strtoupper($featured->reading_time) }}</span>
                        </div>
                        <h3 class="blog-card__title">
                            <a href="{{ route('blog.show', $featured->slug) }}">
                                {{ $featured->title }}
                            </a>
                        </h3>
                        <a href="{{ route('blog.show', $featured->slug) }}" class="btn-blog-read">
                            Baca selengkapnya
                        </a>
                    </div>
                </article>
            @endif

            {{-- Right Column (2 Cards Stack Vertikal Sesuai Gambar 3 Figma) --}}
            <div class="blog__sidebar" data-aos="fade-up">
                @foreach($sideArticles as $side)
                    <article class="blog-card blog-card--side">
                        <a href="{{ route('blog.show', $side->slug) }}" class="blog-card__side-img-wrap">
                            <img src="{{ $side->thumbnail_url }}" 
                                 alt="{{ $side->title }}" 
                                 class="blog-card__side-img">
                        </a>
                        <div class="blog-card__side-body">
                            <div class="blog-card__side-meta-row">
                                <span class="blog-card__category-badge">{{ strtoupper($side->category) }}</span>
                                <span class="blog-card__date">{{ $side->formatted_date }}</span>
                            </div>
                            <h3 class="blog-card__side-title">
                                <a href="{{ route('blog.show', $side->slug) }}">
                                    {{ $side->title }}
                                </a>
                            </h3>
                            <a href="{{ route('blog.show', $side->slug) }}" class="blog-card__link-text">
                                <span>Baca Artikel</span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

        </div>

    </div>
</section>
