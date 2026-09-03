@extends('layouts.app')

@section('title', 'Rilis Berita & Informasi Terkini - Puskesmas CareLink')
@section('meta_description', 'Temukan berbagai artikel kesehatan, tips medis, pola hidup sehat, dan rilis informasi kegiatan terkini dari Puskesmas CareLink.')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog/blog-public.css') }}?v={{ time() }}">
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Rilis Berita & Artikel</span>
        </div>
        <h1 class="subpage-header__title" data-aos="fade-right">Rilis Berita & Informasi Terkini</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Informasi seputar kesehatan terkini dan kegiatan pelayanan yang dilaksanakan oleh Puskesmas CareLink
        </p>
    </div>
</section>

{{-- Main Content Container --}}
<div class="blog-content-wrapper">
    <div class="blog-content-container">

        {{-- 1. CLEAN 1-ROW FILTER BAR --}}
        <div class="blog-filterbar" data-aos="fade-up">
            <form action="{{ route('blog.index') }}" method="GET" class="blog-filterbar-form">
                <div class="blog-filterbar-row">
                    
                    {{-- Search Input Group --}}
                    <div class="blog-filterbar-search">
                        <i class="bx bx-search search-icon"></i>
                        <input type="text" name="search" placeholder="Cari berita, tips kesehatan, atau topik medis..." value="{{ request('search') }}" autocomplete="off">
                        @if(request('search'))
                            <a href="{{ route('blog.index', array_filter(['category' => request('category')])) }}" class="search-clear-btn" title="Hapus pencarian">&times;</a>
                        @endif
                        <button type="submit" class="btn-filterbar-submit">
                            <span>Cari</span>
                        </button>
                    </div>

                    {{-- Category Select Dropdown --}}
                    <div class="blog-filterbar-select-wrap">
                        <select name="category" onchange="this.form.submit()" class="blog-filterbar-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <i class="bx bx-chevron-down select-icon"></i>
                    </div>

                    {{-- Reset Filter Icon Button on the Right with Tooltip --}}
                    @if(request('search') || request('category'))
                        <a href="{{ route('blog.index') }}" class="btn-filterbar-reset-icon" title="Reset Filter" data-tooltip="Reset Filter" aria-label="Reset Filter">
                            <i class="bx bx-reset"></i>
                        </a>
                    @endif

                </div>
            </form>
        </div>

        {{-- 2. CONDITIONAL LAYOUT: SEARCH/FILTER/PAGE > 1 ACTIVE vs MOSAIC HOMEPAGE --}}
        @if(request('search') || request('category') || request('page', 1) > 1)
            
            {{-- Grid Standard 3 Kolom untuk Pencarian --}}
            @if($articles->count() > 0)
                <div class="articles-grid mb-4">
                    @foreach($articles as $index => $item)
                        <article class="article-card" data-aos="fade-up" data-aos-delay="{{ min($loop->index * 50, 350) }}">
                            <a href="{{ route('blog.show', $item->slug) }}" class="article-card__thumb-wrap">
                                <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="article-card__img" loading="lazy">
                                <span class="article-card__category">{{ $item->category }}</span>
                            </a>
                            <div class="article-card__body">
                                <div>
                                    <div class="article-card__meta">
                                        <i class="bx bx-calendar me-1"></i>
                                        <span>{{ $item->formatted_date }}</span>
                                        <span>&bull;</span>
                                        <i class="bx bx-time-five me-1"></i>
                                        <span>{{ $item->reading_time }}</span>
                                    </div>
                                    <h2 class="article-card__title">
                                        <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                                    </h2>
                                    <p class="article-card__excerpt">
                                        {{ Str::limit(strip_tags($item->excerpt), 110) }}
                                    </p>
                                </div>
                                <div class="article-card__footer">
                                    <span class="article-card__author">{{ $item->author }}</span>
                                    <a href="{{ route('blog.show', $item->slug) }}" class="article-card__read-more">
                                        <span>Baca Artikel</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="blog-empty-state text-center py-5 my-4">
                    <i class="bx bx-news display-4 text-muted mb-3"></i>
                    <h3 class="fw-bold mb-2 text-dark">Artikel Tidak Ditemukan</h3>
                    <p class="text-muted mb-4">Maaf, tidak ada rilis berita atau informasi yang sesuai dengan kata kunci pencarian Anda.</p>
                    <a href="{{ route('blog.index') }}" class="btn btn-primary px-4 rounded-pill">Reset Filter & Pencarian</a>
                </div>
            @endif

        @else
            {{-- HOMEPAGE BERITA: MOSAIC GRID LAYOUT (OPSI X) --}}
            @if($articles->count() > 0)
                
                @php
                    $allList = $articles->items();
                    $chunkMosaic1 = array_slice($allList, 0, 5); // 5 artikel pertama (Row 1 Odd: Besar Kiri + 4 Kecil Kanan)
                    $chunkMosaic2 = array_slice($allList, 5, 5); // 5 artikel kedua (Row 2 Even: 4 Kecil Kiri + Besar Kanan)
                    $remainingList = array_slice($allList, 10);  // Artikel selebihnya
                @endphp

                <div class="blog-mosaic-wrapper mb-5">
                    
                    {{-- ROW 1: ODD MOSAIC (Kartu Besar Kiri + 4 Kartu Kecil Kanan) --}}
                    @if(count($chunkMosaic1) > 0)
                        @php
                            $big1 = $chunkMosaic1[0];
                            $smalls1 = array_slice($chunkMosaic1, 1);
                        @endphp

                        <div class="blog-mosaic-row blog-mosaic-row--odd" data-aos="fade-up">
                            {{-- KARTU BESAR KIRI --}}
                            <article class="mosaic-card-big">
                                <a href="{{ route('blog.show', $big1->slug) }}" class="mosaic-card-big__img-wrap">
                                    <img src="{{ $big1->thumbnail_url }}" alt="{{ $big1->title }}" class="mosaic-card-big__img">
                                    <div class="mosaic-card-big__overlay"></div>
                                    <span class="mosaic-card-big__badge">{{ strtoupper($big1->category) }}</span>
                                </a>
                                <div class="mosaic-card-big__content">
                                    <div class="mosaic-card-big__meta">
                                        <span><i class="bx bx-calendar me-1"></i>{{ $big1->formatted_date }}</span>
                                        <span>&bull;</span>
                                        <span><i class="bx bx-time-five me-1"></i>{{ $big1->reading_time }}</span>
                                    </div>
                                    <h2 class="mosaic-card-big__title">
                                        <a href="{{ route('blog.show', $big1->slug) }}">{{ $big1->title }}</a>
                                    </h2>
                                    <p class="mosaic-card-big__excerpt">
                                        {{ Str::limit(strip_tags($big1->excerpt), 130) }}
                                    </p>
                                    <a href="{{ route('blog.show', $big1->slug) }}" class="btn-mosaic-read">
                                        <span>Baca Selengkapnya</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </article>

                            {{-- GRID 2x2 KARTU KECIL KANAN --}}
                            <div class="mosaic-small-grid">
                                @foreach($smalls1 as $sm)
                                    <article class="mosaic-card-small">
                                        <a href="{{ route('blog.show', $sm->slug) }}" class="mosaic-card-small__thumb-wrap">
                                            <img src="{{ $sm->thumbnail_url }}" alt="{{ $sm->title }}" class="mosaic-card-small__img">
                                            <span class="mosaic-card-small__badge">{{ $sm->category }}</span>
                                        </a>
                                        <div class="mosaic-card-small__body">
                                            <div class="mosaic-card-small__meta">
                                                <i class="bx bx-calendar me-1"></i>{{ $sm->formatted_date }}
                                            </div>
                                            <h3 class="mosaic-card-small__title">
                                                <a href="{{ route('blog.show', $sm->slug) }}">{{ Str::limit($sm->title, 48) }}</a>
                                            </h3>
                                            <a href="{{ route('blog.show', $sm->slug) }}" class="mosaic-card-small__link">
                                                <span>Baca</span> <i class="bx bx-right-arrow-alt"></i>
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- ROW 2: EVEN MOSAIC (4 Kartu Kecil Kiri + Kartu Besar Kanan) --}}
                    @if(count($chunkMosaic2) > 0)
                        @php
                            $big2 = end($chunkMosaic2);
                            $smalls2 = array_slice($chunkMosaic2, 0, count($chunkMosaic2) - 1);
                        @endphp

                        <div class="blog-mosaic-row blog-mosaic-row--even mt-4 pt-2" data-aos="fade-up">
                            {{-- GRID 2x2 KARTU KECIL KIRI --}}
                            <div class="mosaic-small-grid">
                                @foreach($smalls2 as $sm)
                                    <article class="mosaic-card-small">
                                        <a href="{{ route('blog.show', $sm->slug) }}" class="mosaic-card-small__thumb-wrap">
                                            <img src="{{ $sm->thumbnail_url }}" alt="{{ $sm->title }}" class="mosaic-card-small__img">
                                            <span class="mosaic-card-small__badge">{{ $sm->category }}</span>
                                        </a>
                                        <div class="mosaic-card-small__body">
                                            <div class="mosaic-card-small__meta">
                                                <i class="bx bx-calendar me-1"></i>{{ $sm->formatted_date }}
                                            </div>
                                            <h3 class="mosaic-card-small__title">
                                                <a href="{{ route('blog.show', $sm->slug) }}">{{ Str::limit($sm->title, 48) }}</a>
                                            </h3>
                                            <a href="{{ route('blog.show', $sm->slug) }}" class="mosaic-card-small__link">
                                                <span>Baca</span> <i class="bx bx-right-arrow-alt"></i>
                                            </a>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            {{-- KARTU BESAR KANAN --}}
                            <article class="mosaic-card-big">
                                <a href="{{ route('blog.show', $big2->slug) }}" class="mosaic-card-big__img-wrap">
                                    <img src="{{ $big2->thumbnail_url }}" alt="{{ $big2->title }}" class="mosaic-card-big__img">
                                    <div class="mosaic-card-big__overlay"></div>
                                    <span class="mosaic-card-big__badge">{{ strtoupper($big2->category) }}</span>
                                </a>
                                <div class="mosaic-card-big__content">
                                    <div class="mosaic-card-big__meta">
                                        <span><i class="bx bx-calendar me-1"></i>{{ $big2->formatted_date }}</span>
                                        <span>&bull;</span>
                                        <span><i class="bx bx-time-five me-1"></i>{{ $big2->reading_time }}</span>
                                    </div>
                                    <h2 class="mosaic-card-big__title">
                                        <a href="{{ route('blog.show', $big2->slug) }}">{{ $big2->title }}</a>
                                    </h2>
                                    <p class="mosaic-card-big__excerpt">
                                        {{ Str::limit(strip_tags($big2->excerpt), 130) }}
                                    </p>
                                    <a href="{{ route('blog.show', $big2->slug) }}" class="btn-mosaic-read">
                                        <span>Baca Selengkapnya</span>
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </a>
                                </div>
                            </article>
                        </div>
                    @endif

                </div>

                {{-- SISA ARTIKEL (3 Kolom Grid Jika Ada Lebih dari 10 Artikel) --}}
                @if(count($remainingList) > 0)
                    <div class="articles-catalog-section mt-5 pt-3" data-aos="fade-up">
                        <h4 class="fw-bold mb-4 text-dark">
                            <i class="bx bx-news text-primary me-2"></i>Artikel Kesehatan Lainnya
                        </h4>
                        <div class="articles-grid">
                            @foreach($remainingList as $item)
                                <article class="article-card">
                                    <a href="{{ route('blog.show', $item->slug) }}" class="article-card__thumb-wrap">
                                        <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" class="article-card__img" loading="lazy">
                                        <span class="article-card__category">{{ $item->category }}</span>
                                    </a>
                                    <div class="article-card__body">
                                        <div>
                                            <div class="article-card__meta">
                                                <i class="bx bx-calendar me-1"></i>
                                                <span>{{ $item->formatted_date }}</span>
                                                <span>&bull;</span>
                                                <i class="bx bx-time-five me-1"></i>
                                                <span>{{ $item->reading_time }}</span>
                                            </div>
                                            <h2 class="article-card__title">
                                                <a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a>
                                            </h2>
                                            <p class="article-card__excerpt">
                                                {{ Str::limit(strip_tags($item->excerpt), 110) }}
                                            </p>
                                        </div>
                                        <div class="article-card__footer">
                                            <span class="article-card__author">{{ $item->author }}</span>
                                            <a href="{{ route('blog.show', $item->slug) }}" class="article-card__read-more">
                                                <span>Baca Artikel</span>
                                                <i class="bx bx-right-arrow-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

            @else
                <div class="blog-empty-state text-center py-5 my-4">
                    <i class="bx bx-news display-4 text-muted mb-3"></i>
                    <h3 class="fw-bold mb-2 text-dark">Artikel Tidak Ditemukan</h3>
                    <p class="text-muted mb-4">Maaf, belum ada artikel kesehatan yang tersedia saat ini.</p>
                </div>
            @endif
        @endif

        {{-- Pagination Links --}}
        <div class="blog-pagination-wrapper">
            {{ $articles->links('vendor.pagination.custom') }}
        </div>

    </div>
</div>

@endsection
