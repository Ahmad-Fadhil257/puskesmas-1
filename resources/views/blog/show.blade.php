@extends('layouts.app')

@section('title', $article->title . ' - Puskesmas CareLink')
@section('meta_description', Str::limit(strip_tags($article->excerpt ?? $article->content), 150))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog/blog-public.css') }}">
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        {{-- Breadcrumbs Navigasi --}}
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <a href="{{ route('blog.index') }}">Berita & Artikel</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">{{ Str::limit($article->title, 35) }}</span>
        </div>

        {{-- Category Badge --}}
        <span class="article-header-category-pill" data-aos="fade-right">{{ strtoupper($article->category) }}</span>

        {{-- Large Article Title --}}
        <h1 class="article-header-main-title" data-aos="fade-right">{{ $article->title }}</h1>

        {{-- Metadata Row --}}
        <div class="article-header-meta-row" data-aos="fade-up">
            <span class="meta-item">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <strong>{{ $article->author }}</strong>
            </span>
            <span class="dot">&bull;</span>
            <span class="meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                {{ $article->formatted_date }}
            </span>
            <span class="dot">&bull;</span>
            <span class="meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
                {{ $article->reading_time }}
            </span>
            <span class="dot">&bull;</span>
            <span class="meta-item">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                </svg>
                {{ $article->views_count }} kali dibaca
            </span>
        </div>
    </div>
</section>

{{-- Content Container --}}
<div class="blog-content-wrapper">
    <div class="blog-content-container">

        {{-- Kartu 1: Konten Utama Artikel (Card Terpisah Latar Putih) --}}
        <article class="article-main-card" data-aos="fade-up">
            {{-- Featured Image Banner --}}
            <div class="article-featured-image">
                <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}">
            </div>

            {{-- Article Content Body --}}
            <div class="article-body-content">
                {!! $article->content !!}
            </div>

            {{-- Action Bar: Back & Share --}}
            <div class="article-actions-bar">
                <a href="{{ route('blog.index') }}" class="btn-back-catalog">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline>
                    </svg>
                    <span>Kembali ke Semua Berita</span>
                </a>

                <div class="share-links">
                    <span class="share-links__label">Bagikan:</span>
                    
                    {{-- WhatsApp Share --}}
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-btn" title="Bagikan ke WhatsApp">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                        </svg>
                    </a>

                    {{-- Copy Link --}}
                    <button type="button" class="share-btn" id="btnCopyLink" title="Salin Tautan">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </article>

        {{-- Kartu 2: Direkomendasikan untuk Anda (Card Terpisah Maksimal 6 Artikel) --}}
        @if(isset($relatedArticles) && $relatedArticles->count() > 0)
            <section class="article-related-card" data-aos="fade-up">
                <div class="article-related-card__header">
                    <h3 class="article-related-card__title">Direkomendasikan untuk Anda</h3>
                    <p class="article-related-card__subtitle">Rekomendasi bacaan edukasi kesehatan seputar topik <strong>{{ $article->category }}</strong> untuk Anda dan keluarga.</p>
                </div>

                <div class="articles-grid">
                    @foreach($relatedArticles as $index => $rel)
                        <article class="article-card" data-aos="fade-up" data-aos-delay="{{ min($index * 80, 450) }}">
                            <a href="{{ route('blog.show', $rel->slug) }}" class="article-card__thumb-wrap">
                                <img src="{{ $rel->thumbnail_url }}" alt="{{ $rel->title }}" class="article-card__img" loading="lazy">
                                <span class="article-card__category">{{ $rel->category }}</span>
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
                                        <span>{{ $rel->formatted_date }}</span>
                                        <span>&bull;</span>
                                        <span>{{ $rel->reading_time }}</span>
                                    </div>
                                    <h4 class="article-card__title">
                                        <a href="{{ route('blog.show', $rel->slug) }}">
                                            {{ $rel->title }}
                                        </a>
                                    </h4>
                                </div>
                                <div class="article-card__footer">
                                    <span class="article-card__author">{{ $rel->author }}</span>
                                    <a href="{{ route('blog.show', $rel->slug) }}" class="article-card__read-more">
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
            </section>
        @endif

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnCopy = document.getElementById('btnCopyLink');
        if (btnCopy) {
            btnCopy.addEventListener('click', function () {
                navigator.clipboard.writeText(window.location.href).then(function () {
                    if (typeof Swal !== 'undefined') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2500,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: 'success',
                            title: 'Tautan artikel berhasil disalin!'
                        });
                    } else {
                        alert('Tautan artikel berhasil disalin!');
                    }
                });
            });
        }
    });
</script>
@endpush

@endsection
