@extends('layouts.app')

@section('title', 'Rilis Berita & Informasi Terkini - Puskesmas CareLink')
@section('meta_description', 'Temukan berbagai artikel kesehatan, tips medis, pola hidup sehat, dan rilis informasi kegiatan terkini dari Puskesmas CareLink.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog/blog-public.css') }}">
@endpush

@section('content')

{{-- Full Width Dark Emerald Header (Fill Semua Sesuai Referensi Dinkes) --}}
<section class="blog-full-header">
    <div class="blog-full-header__decor-pattern" aria-hidden="true"></div>
    <div class="blog-full-header__glow" aria-hidden="true"></div>

    <div class="blog-full-header__container">
        <h1 class="blog-full-header__title" data-aos="fade-right">Rilis Berita & Informasi Terkini</h1>
        <p class="blog-full-header__subtitle" data-aos="fade-up">
            Informasi seputar kesehatan terkini dan kegiatan pelayanan yang dilaksanakan oleh Puskesmas CareLink
        </p>
    </div>
</section>

{{-- Main Content Container --}}
<div class="blog-content-wrapper">
    <div class="blog-content-container">

        {{-- Search & Filter Controls (2 Kolom Seperti Gambar 2 Dinkes) --}}
        <div class="blog-filter-card" data-aos="fade-up">
            <form action="{{ route('blog.index') }}" method="GET" class="blog-filter-form">
                <div class="blog-filter-form__grid">
                    {{-- Kolom Kiri: Cari Album / Kegiatan / Artikel --}}
                    <div class="blog-filter-col">
                        <label class="blog-filter-label" for="search-input">Cari Album / Kegiatan / Artikel</label>
                        <div class="blog-search-input-group">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6E857E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            <input type="text" id="search-input" name="search" placeholder="Cari nama artikel atau kegiatan..." value="{{ request('search') }}">
                            @if(request('search'))
                                <a href="{{ route('blog.index', ['category' => request('category')]) }}" class="search-clear-btn" title="Hapus pencarian">&times;</a>
                            @endif
                            <button type="submit" class="btn-dinkes-search">
                                <span>Cari</span>
                            </button>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Filter Kategori --}}
                    <div class="blog-filter-col">
                        <label class="blog-filter-label" for="category-select">Filter Kategori</label>
                        <div class="blog-select-group">
                            <select id="category-select" name="category" onchange="this.form.submit()" class="blog-category-select">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0A5C45" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="select-chevron">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        {{-- Top Highlight / Featured Row (Ditampilkan jika halaman 1 dan tanpa pencarian) --}}
        @if($articles->currentPage() == 1 && !request('search') && !request('category') && $articles->count() >= 3)
            @php
                $heroFeatured = $articles->first();
                $heroSides = $articles->slice(1, 2);
                $gridArticles = $articles->slice(3);
            @endphp

            <div class="blog-highlights-grid">
                {{-- Highlight Kiri (Banner Besar) --}}
                <article class="blog-card blog-card--featured" data-aos="fade-up">
                    <a href="{{ route('blog.show', $heroFeatured->slug) }}" class="blog-card__image-wrap">
                        <img src="{{ $heroFeatured->thumbnail_url }}" alt="{{ $heroFeatured->title }}" class="blog-card__img">
                        <div class="blog-card__overlay"></div>
                    </a>
                    <div class="blog-card__content">
                        <div class="blog-card__meta">
                            <span>{{ strtoupper($heroFeatured->formatted_date) }}</span>
                            <span class="blog-card__meta-dot">&bull;</span>
                            <span>{{ strtoupper($heroFeatured->category) }}</span>
                        </div>
                        <h2 class="blog-card__title">
                            <a href="{{ route('blog.show', $heroFeatured->slug) }}">
                                {{ $heroFeatured->title }}
                            </a>
                        </h2>
                        <a href="{{ route('blog.show', $heroFeatured->slug) }}" class="btn-blog-read">
                            Baca selengkapnya
                        </a>
                    </div>
                </article>

                {{-- Highlight Kanan (2 Kartu Stack) --}}
                <div class="blog__sidebar" data-aos="fade-up">
                    @foreach($heroSides as $side)
                        <article class="blog-card blog-card--side">
                            <a href="{{ route('blog.show', $side->slug) }}" class="blog-card__side-img-wrap">
                                <img src="{{ $side->thumbnail_url }}" alt="{{ $side->title }}" class="blog-card__side-img">
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
        @else
            @php $gridArticles = $articles; @endphp
        @endif

        {{-- Catalog Grid Section (3 Kolom Seperti Dinkes) --}}
        @if(isset($gridArticles) && $gridArticles->count() > 0)
            <div class="articles-catalog-section">
                <div class="articles-grid">
                    @foreach($gridArticles as $item)
                        <article class="article-card" data-aos="fade-up">
                            <a href="{{ route('blog.show', $item->slug) }}" class="article-card__thumb-wrap">
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="article-card__img" loading="lazy">
                                <span class="article-card__category">{{ $item->category }}</span>
                            </a>
                            <div class="article-card__body">
                                <div>
                                    <div class="article-card__meta">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#6E857E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        <span>{{ $item->formatted_date }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $item->reading_time }}</span>
                                    </div>
                                    <h2 class="article-card__title">
                                        <a href="{{ route('blog.show', $item->slug) }}">
                                            {{ $item->title }}
                                        </a>
                                    </h2>
                                    <p class="article-card__excerpt">
                                        {{ Str::limit($item->excerpt, 110) }}
                                    </p>
                                </div>
                                <div class="article-card__footer">
                                    <span class="article-card__author">{{ $item->author }}</span>
                                    <a href="{{ route('blog.show', $item->slug) }}" class="article-card__read-more">
                                        <span>Baca Artikel</span>
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                {{-- Pagination Links --}}
                <div class="blog-pagination-wrapper">
                    {{ $articles->links() }}
                </div>
            </div>
        @elseif($articles->count() == 0)
            <div class="blog-empty-state">
                <svg width="56" height="56" viewBox="0 0 24 24" fill="none" stroke="#6E857E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <h3>Artikel Tidak Ditemukan</h3>
                <p>Maaf, tidak ada rilis berita atau informasi yang sesuai dengan kata kunci pencarian Anda.</p>
                <a href="{{ route('blog.index') }}" class="btn-reset-filter">Reset Filter & Pencarian</a>
            </div>
        @endif

    </div>
</div>

@endsection
