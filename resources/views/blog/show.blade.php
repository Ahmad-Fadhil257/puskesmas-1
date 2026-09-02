@extends('layouts.app')

@section('title', $article->title . ' - Puskesmas CareLink')
@section('meta_description', Str::limit(strip_tags($article->excerpt ?? $article->content), 150))

@push('styles')
<link rel="stylesheet" href="{{ asset('css/blog/blog-public.css') }}?v={{ time() }}">
@endpush

@section('content')

{{-- =========================================================================
   SUBPAGE HEADER: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header" data-aos="fade-down">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        {{-- Breadcrumb Navigasi --}}
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <a href="{{ route('blog.index') }}">Berita & Artikel</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">{{ Str::limit($article->title, 35) }}</span>
        </div>

        {{-- Badge Kategori --}}
        <div class="mt-2 mb-2" data-aos="fade-right">
            <span class="article-header-category-pill">{{ strtoupper($article->category) }}</span>
        </div>

        {{-- Judul Artikel Utama Header --}}
        <h1 class="subpage-header__title" data-aos="fade-right">{{ $article->title }}</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Dipublikasikan oleh {{ $article->author }} pada {{ $article->formatted_date }} • {{ $article->reading_time }} • {{ number_format($article->views_count ?? 0) }} kali dibaca
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN READER CONTENT CONTAINER
   ========================================================================= --}}
<div class="article-reader-wrapper">
    <div class="article-reader-container">

        {{-- 1. HERO IMAGE BANNER BESAR ROUNDED (12px Border Radius) --}}
        <div class="article-hero-banner" data-aos="zoom-in" data-aos-delay="100">
            <img src="{{ $article->thumbnail_url }}" alt="{{ $article->title }}" class="article-hero-banner__img">
            <div class="article-hero-banner__overlay"></div>
            <div class="article-hero-banner__badge">
                <i class="bx bx-bookmark-heart me-1"></i> {{ strtoupper($article->category) }}
            </div>
        </div>

        {{-- 2. LAYOUT 2 KOLOM: KARTU KONTEN OVERLAP (KIRI) + SIDEBAR STICKY (KANAN) --}}
        <div class="article-reader-grid">
            
            {{-- KOLOM KIRI (70%): KARTU PUTIH MENGAMBANG OVERLAP --}}
            <main class="article-reader-main">
                <article class="article-stack-card" data-aos="fade-up" data-aos-delay="200">
                    {{-- Baris Meta Info Ringkas --}}
                    <div class="article-stack-card__meta">
                        <span class="meta-item">
                            <i class="bx bx-user text-primary me-1"></i> {{ $article->author }}
                        </span>
                        <span class="meta-sep">•</span>
                        <span class="meta-item">
                            <i class="bx bx-calendar text-primary me-1"></i> {{ $article->formatted_date }}
                        </span>
                        <span class="meta-sep">•</span>
                        <span class="meta-item">
                            <i class="bx bx-time-five text-primary me-1"></i> {{ $article->reading_time }}
                        </span>
                        <span class="meta-sep">•</span>
                        <span class="meta-item">
                            <i class="bx bx-show text-primary me-1"></i> {{ number_format($article->views_count ?? 0) }} kali dibaca
                        </span>
                    </div>

                    <hr class="article-stack-card__divider">

                    {{-- Isi Teks & Gambar Artikel --}}
                    <div class="article-stack-card__body">
                        {!! $article->content !!}
                    </div>

                    {{-- Bottom Action: Kembali & Share Mobile --}}
                    <div class="article-stack-card__footer">
                        <a href="{{ route('blog.index') }}" class="btn-back-to-articles">
                            <i class="bx bx-arrow-back me-1"></i> Kembali ke Berita & Artikel
                        </a>

                        <div class="article-footer-share d-md-none">
                            <span class="share-label me-2">Bagikan:</span>
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn-share-icon btn-share-wa" title="Bagikan ke WhatsApp">
                                <i class="bx bxl-whatsapp"></i>
                            </a>
                            <button type="button" class="btn-share-icon btn-share-copy btn-copy-trigger" title="Salin Tautan">
                                <i class="bx bx-link"></i>
                            </button>
                        </div>
                    </div>
                </article>
            </main>

            {{-- KOLOM KANAN (30%): SIDEBAR STICKY READER --}}
            <aside class="article-reader-sidebar">
                <div class="article-sticky-box" data-aos="fade-up" data-aos-delay="300">
                    
                    {{-- Widget 1: Profil Penulis --}}
                    <div class="sidebar-widget-card">
                        <div class="widget-author-wrap">
                            <div class="widget-author-avatar">
                                {{ strtoupper(substr($article->author ?? 'P', 0, 1)) }}
                            </div>
                            <div class="widget-author-info">
                                <span class="author-label">Penulis Artikel</span>
                                <h6 class="author-name">{{ $article->author }}</h6>
                                <span class="badge bg-label-primary px-2 py-1" style="font-size: 0.72rem;">
                                    <i class="bx bx-check-shield me-1"></i> Tim Puskesmas
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Widget 2: Bagikan Artikel --}}
                    <div class="sidebar-widget-card">
                        <h6 class="widget-card-title">
                            <i class="bx bx-share-alt me-1 text-primary"></i> Bagikan Artikel
                        </h6>
                        <p class="widget-card-desc">Bagikan informasi kesehatan bermanfaat ini kepada keluarga dan teman Anda.</p>
                        <div class="widget-share-buttons">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" rel="noopener noreferrer" class="btn-sidebar-share btn-share-whatsapp">
                                <i class="bx bxl-whatsapp fs-5"></i>
                                <span>Kirim via WhatsApp</span>
                            </a>
                            <button type="button" class="btn-sidebar-share btn-share-copy-link btn-copy-trigger">
                                <i class="bx bx-copy fs-5"></i>
                                <span>Salin Tautan Berita</span>
                            </button>
                        </div>
                    </div>

                    {{-- Widget 3: Artikel Terkait Ringkas (Topik Serupa) --}}
                    @if(isset($relatedArticles) && $relatedArticles->count() > 0)
                        <div class="sidebar-widget-card">
                            <h6 class="widget-card-title">
                                <i class="bx bx-bookmark-alt me-1 text-primary"></i> Topik Serupa
                            </h6>
                            <div class="widget-mini-articles-list">
                                @foreach($relatedArticles->take(4) as $mini)
                                    <a href="{{ route('blog.show', $mini->slug) }}" class="mini-article-item">
                                        <img src="{{ $mini->thumbnail_url }}" alt="{{ $mini->title }}" class="mini-article-thumb">
                                        <div class="mini-article-info">
                                            <span class="mini-article-date">{{ $mini->formatted_date }}</span>
                                            <h6 class="mini-article-title">{{ Str::limit($mini->title, 48) }}</h6>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>
            </aside>

        </div>

    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyBtns = document.querySelectorAll('.btn-copy-trigger');
        copyBtns.forEach(function(btn) {
            btn.addEventListener('click', function () {
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
                            title: 'Tautan berita berhasil disalin ke clipboard!'
                        });
                    } else {
                        alert('Tautan berita berhasil disalin!');
                    }
                });
            });
        });
    });
</script>
@endpush

@endsection
