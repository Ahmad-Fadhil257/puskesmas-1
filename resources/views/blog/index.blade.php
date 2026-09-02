@extends('layouts.app')

@section('title', 'Rilis Berita & Artikel Kesehatan - Puskesmas CareLink')
@section('meta_description', 'Temukan berbagai artikel kesehatan terbaru, tips medis, gizi & nutrisi, serta rilis informasi kegiatan pelayanan terkini dari Puskesmas CareLink.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog/blog-public.css') }}?v={{ time() }}">
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL WATERMARK
   ========================================================================= --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Berita & Artikel</span>
        </div>
        <h1 class="subpage-header__title" data-aos="fade-right">Rilis Berita & Informasi Terkini</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Kumpulan edukasi kesehatan, tips medis terpercaya, dan warta kegiatan terkini dari Puskesmas CareLink
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN CONTENT WRAPPER
   ========================================================================= --}}
<div class="blog-magazine-wrapper">
    <div class="blog-magazine-container">

        {{-- 1. MODERN CATEGORY PILLS TABS + SEARCH BAR HEADER --}}
        <div class="blog-magazine-nav-card" data-aos="fade-up">
            <form action="{{ route('blog.index') }}" method="GET" id="blogSearchFilterForm" class="blog-nav-form">
                <div class="blog-nav-row">
                    {{-- Left: Horizontal Scrollable Category Pills --}}
                    <div class="blog-pills-scroll-wrapper">
                        <a href="{{ route('blog.index', array_filter(['search' => request('search')])) }}" 
                           class="blog-pill-btn {{ !request('category') ? 'active' : '' }}">
                           <i class="bx bx-grid-alt me-1"></i> Semua Artikel
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('blog.index', array_filter(['search' => request('search'), 'category' => $cat])) }}" 
                               class="blog-pill-btn {{ request('category') == $cat ? 'active' : '' }}">
                               {{ $cat }}
                            </a>
                        @endforeach
                    </div>

                    {{-- Right: Search Input Bar --}}
                    <div class="blog-nav-search-wrap">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="blog-search-box">
                            <i class="bx bx-search search-icon"></i>
                            <input type="text" 
                                   name="search" 
                                   placeholder="Cari berita atau kata kunci..." 
                                   value="{{ request('search') }}"
                                   autocomplete="off">
                            @if(request('search'))
                                <a href="{{ route('blog.index', array_filter(['category' => request('category')])) }}" 
                                   class="search-clear-btn" 
                                   title="Hapus pencarian">&times;</a>
                            @endif
                            <button type="submit" class="btn-blog-search-submit">Cari</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        {{-- 2. FEATURED MAGAZINE HERO SECTION (Halaman 1 tanpa filter) --}}
        @if($articles->currentPage() == 1 && !request('search') && !request('category') && $articles->count() >= 3)
            @php
                $heroFeatured = $articles->first();
                $heroSides = $articles->slice(1, 2);
                $gridArticles = $articles->slice(3);
            @endphp

            <div class="blog-editorial-hero" data-aos="fade-up">
                <div class="row g-4">
                    {{-- Hero Kiri (Banner Utama Besar 16:9) --}}
                    <div class="col-lg-7 col-12">
                        <article class="magazine-hero-card">
                            <a href="{{ route('blog.show', $heroFeatured->slug) }}" class="magazine-hero-card__thumb">
                                <img src="{{ $heroFeatured->thumbnail_url }}" alt="{{ $heroFeatured->title }}" class="magazine-hero-card__img">
                                <div class="magazine-hero-card__gradient"></div>
                                <span class="magazine-hero-card__badge">
                                    <i class="bx bx-bookmark-heart me-1"></i> {{ strtoupper($heroFeatured->category) }}
                                </span>
                            </a>
                            <div class="magazine-hero-card__content">
                                <div class="magazine-hero-card__meta">
                                    <span><i class="bx bx-calendar me-1"></i>{{ $heroFeatured->formatted_date }}</span>
                                    <span class="meta-divider">•</span>
                                    <span><i class="bx bx-time-five me-1"></i>{{ $heroFeatured->reading_time }}</span>
                                    <span class="meta-divider">•</span>
                                    <span><i class="bx bx-user me-1"></i>{{ $heroFeatured->author }}</span>
                                </div>
                                <h2 class="magazine-hero-card__title">
                                    <a href="{{ route('blog.show', $heroFeatured->slug) }}">
                                        {{ $heroFeatured->title }}
                                    </a>
                                </h2>
                                <p class="magazine-hero-card__excerpt">
                                    {{ Str::limit(strip_tags($heroFeatured->excerpt), 130) }}
                                </p>
                            </div>
                        </article>
                    </div>

                    {{-- Hero Kanan (2 Artikel Unggulan Stack) --}}
                    <div class="col-lg-5 col-12 d-flex flex-column gap-3">
                        @foreach($heroSides as $side)
                            <article class="magazine-side-card flex-grow-1">
                                <a href="{{ route('blog.show', $side->slug) }}" class="magazine-side-card__thumb">
                                    <img src="{{ $side->thumbnail_url }}" alt="{{ $side->title }}" class="magazine-side-card__img">
                                    <span class="magazine-side-card__badge">{{ strtoupper($side->category) }}</span>
                                </a>
                                <div class="magazine-side-card__body">
                                    <div class="magazine-side-card__meta">
                                        <span><i class="bx bx-calendar me-1"></i>{{ $side->formatted_date }}</span>
                                        <span class="meta-divider">•</span>
                                        <span><i class="bx bx-time-five me-1"></i>{{ $side->reading_time }}</span>
                                    </div>
                                    <h3 class="magazine-side-card__title">
                                        <a href="{{ route('blog.show', $side->slug) }}">
                                            {{ $side->title }}
                                        </a>
                                    </h3>
                                    <a href="{{ route('blog.show', $side->slug) }}" class="magazine-read-link">
                                        <span>Baca Selengkapnya</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            @php $gridArticles = $articles; @endphp
        @endif


        {{-- 3. EDITORIAL ARTICLES CATALOG GRID (3 KOLOM) --}}
        @if(isset($gridArticles) && $gridArticles->count() > 0)
            <div class="blog-catalog-section mt-4">
                @if(request('category') || request('search'))
                    <div class="blog-search-results-header mb-4 d-flex align-items-center justify-content-between">
                        <h5 class="fw-bold mb-0 text-dark">
                            <i class="bx bx-news me-2 text-primary"></i>
                            @if(request('category'))
                                Kategori: <span class="text-primary">{{ request('category') }}</span>
                            @else
                                Hasil Pencarian: "<span class="text-primary">{{ request('search') }}</span>"
                            @endif
                            <small class="text-muted fs-6 ms-2">({{ $articles->total() }} Artikel Ditemukan)</small>
                        </h5>
                        <a href="{{ route('blog.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="bx bx-reset me-1"></i> Reset Filter
                        </a>
                    </div>
                @endif

                <div class="row g-4">
                    @foreach($gridArticles as $index => $item)
                        <div class="col-lg-4 col-md-6 col-12 d-flex">
                            <article class="magazine-card w-100" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 60, 450) }}">
                                {{-- Thumbnail & Overlay Badges --}}
                                <a href="{{ route('blog.show', $item->slug) }}" class="magazine-card__thumb-wrap">
                                    <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="magazine-card__img" loading="lazy">
                                    <span class="magazine-card__cat-badge">
                                        {{ $item->category }}
                                    </span>
                                    <span class="magazine-card__read-badge">
                                        <i class="bx bx-time-five me-1"></i>{{ $item->reading_time }}
                                    </span>
                                </a>

                                {{-- Body Content --}}
                                <div class="magazine-card__body">
                                    <div class="magazine-card__meta">
                                        <span class="meta-date">
                                            <i class="bx bx-calendar me-1"></i>{{ $item->formatted_date }}
                                        </span>
                                        <span class="meta-views">
                                            <i class="bx bx-show me-1"></i>{{ number_format($item->views_count ?? 0) }} dibaca
                                        </span>
                                    </div>

                                    <h2 class="magazine-card__title">
                                        <a href="{{ route('blog.show', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h2>

                                    <p class="magazine-card__excerpt">
                                        {{ Str::limit(strip_tags($item->excerpt), 110) }}
                                    </p>
                                </div>

                                {{-- Footer --}}
                                <div class="magazine-card__footer">
                                    <div class="magazine-card__author">
                                        <div class="author-avatar">
                                            {{ strtoupper(substr($item->author ?? 'P', 0, 1)) }}
                                        </div>
                                        <span class="author-name">{{ Str::limit($item->author ?? 'Admin', 16) }}</span>
                                    </div>
                                    <a href="{{ route('blog.show', $item->slug) }}" class="magazine-card__btn-read">
                                        <span>Baca</span>
                                        <i class="bx bx-right-arrow-alt icon-arrow"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="blog-pagination-wrapper mt-5 d-flex justify-content-center">
                    {{ $articles->links() }}
                </div>
            </div>
        @elseif($articles->count() == 0)
            <div class="blog-empty-state text-center py-5 my-4">
                <div class="avatar avatar-xl bg-label-secondary mx-auto mb-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="bx bx-news fs-1 text-muted"></i>
                </div>
                <h4 class="fw-bold mb-2 text-dark">Artikel Tidak Ditemukan</h4>
                <p class="text-muted mb-4" style="max-width: 480px; margin: 0 auto;">
                    Maaf, tidak ada rilis berita atau artikel kesehatan yang sesuai dengan kata kunci atau kategori yang Anda pilih.
                </p>
                <a href="{{ route('blog.index') }}" class="btn btn-primary px-4 rounded-pill">
                    <i class="bx bx-reset me-1"></i> Tampilkan Semua Artikel
                </a>
            </div>
        @endif

    </div>
</div>

@endsection
