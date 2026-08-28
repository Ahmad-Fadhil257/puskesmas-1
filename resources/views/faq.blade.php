@extends('layouts.app')

@section('title', 'Tanya Jawab Seputar Pelayanan (FAQ) - ' . ($appSetting->app_name ?? 'Puskesmas'))
@section('meta_description', 'Jawaban atas pertanyaan umum seputar pendaftaran, syarat BPJS Kesehatan, jadwal poliklinik, dan alur rujukan di ' . ($appSetting->app_name ?? 'Puskesmas') . '.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page/subpage-header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pages/faq.css') }}">
@endpush

@section('content')

{{-- =========================================================================
   HEADER SECTION: CLEAN MINT SUBPAGE HEADER WITH BOTANICAL ORNAMENT
   ========================================================================= --}}
<section class="subpage-header">
    <img src="{{ asset('assets/botanical-clean.png') }}" alt="" class="subpage-header__watermark" aria-hidden="true">

    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb" data-aos="fade-right">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span>Informasi Publik</span>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Tanya Jawab (FAQ)</span>
        </div>
        <h1 class="subpage-header__title" data-aos="fade-right">Tanya Jawab Seputar Pelayanan (FAQ)</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Temukan panduan dan jawaban resmi atas pertanyaan yang sering diajukan masyarakat mengenai persyaratan berobat, kepesertaan BPJS, alur rujukan, hingga pelayanan gawat darurat.
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN CONTENT: SEARCH BAR, CATEGORY PILLS, & INTERACTIVE ACCORDIONS
   ========================================================================= --}}
<div class="faq-content-wrapper">
    <div class="faq-container">

        {{-- 1. Search Box Bar --}}
        <div class="faq-search-wrapper" data-aos="fade-up">
            <div class="faq-search-bar">
                <i class="bx bx-search faq-search-icon"></i>
                <input type="text" 
                       id="faqSearchInput" 
                       class="faq-search-input" 
                       placeholder="Cari pertanyaan... (contoh: BPJS, rujukan, UGD, jadwal loket)" 
                       aria-label="Cari pertanyaan FAQ">
                <button type="button" id="faqSearchClear" class="faq-search-clear" title="Hapus pencarian">
                    <i class="bx bx-x"></i>
                </button>
            </div>
        </div>

        {{-- 2. Category Filter Pills --}}
        <div class="faq-category-pills" data-aos="fade-up" id="faqCategoryPills">
            <button type="button" class="faq-pill-btn active" data-category="all">
                <span>Semua Topik</span>
                <span class="faq-pill-count">{{ $faqs->count() }}</span>
            </button>
            @foreach($categories as $cat)
                @php
                    $catCount = $faqs->where('kategori', $cat)->count();
                @endphp
                @if($catCount > 0)
                    <button type="button" class="faq-pill-btn" data-category="{{ $cat }}">
                        <span>{{ $cat }}</span>
                        <span class="faq-pill-count">{{ $catCount }}</span>
                    </button>
                @endif
            @endforeach
        </div>

        {{-- 3. Accordion List --}}
        <div class="faq-accordion-list" id="faqAccordionList" data-aos="fade-up">
            @forelse($faqs as $index => $faq)
                <div class="faq-item" 
                     data-category="{{ $faq->kategori }}" 
                     data-question="{{ strtolower($faq->pertanyaan) }}" 
                     data-answer="{{ strtolower(strip_tags($faq->jawaban)) }}">
                    
                    <button type="button" 
                            class="faq-header-btn" 
                            aria-expanded="false" 
                            id="faq-header-{{ $faq->id }}" 
                            aria-controls="faq-body-{{ $faq->id }}">
                        <div class="faq-header-content">
                            <span class="faq-badge-category">{{ $faq->kategori }}</span>
                            <h3 class="faq-question-text">{{ $faq->pertanyaan }}</h3>
                        </div>
                        <div class="faq-toggle-icon-wrap" aria-hidden="true">
                            <i class="bx bx-chevron-down"></i>
                        </div>
                    </button>

                    <div id="faq-body-{{ $faq->id }}" 
                         class="faq-body-collapse" 
                         role="region" 
                         aria-labelledby="faq-header-{{ $faq->id }}">
                        <div class="faq-body-content">
                            {!! nl2br(e($faq->jawaban)) !!}
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-4 border">
                    <i class="bx bx-help-circle display-4 text-muted mb-2"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Informasi FAQ</h5>
                    <p class="text-muted small">Informasi tanya jawab sedang dipersiapkan oleh pihak pengelola.</p>
                </div>
            @endforelse
        </div>

        {{-- 4. Empty Search State (Client-side) --}}
        <div class="faq-empty-state" id="faqEmptyState">
            <i class="bx bx-search-alt"></i>
            <h4>Pertanyaan Tidak Ditemukan</h4>
            <p>Maaf, kami tidak menemukan pertanyaan yang cocok dengan kata kunci yang Anda masukkan.</p>
            <button type="button" class="btn btn-sm btn-outline-primary" id="btnResetSearch">
                <i class="bx bx-refresh me-1"></i> Tampilkan Semua Pertanyaan
            </button>
        </div>

        {{-- 5. WhatsApp Help CTA Card --}}
        <div class="faq-help-card" data-aos="fade-up">
            <div class="faq-help-info">
                <h3>Belum Menemukan Jawaban yang Anda Cari?</h3>
                <p>
                    Tim petugas informasi dan loket layanan kami siap membantu menjawab pertanyaan Anda seputar pelayanan Puskesmas secara ramah dan langsung.
                </p>
            </div>
            <div>
                <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" class="btn-faq-wa">
                    <i class="bx bxl-whatsapp fs-5"></i>
                    <span>Tanya Petugas via WhatsApp</span>
                </a>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('faqSearchInput');
    const searchClear = document.getElementById('faqSearchClear');
    const categoryPills = document.querySelectorAll('.faq-pill-btn');
    const faqItems = document.querySelectorAll('.faq-item');
    const emptyState = document.getElementById('faqEmptyState');
    const btnResetSearch = document.getElementById('btnResetSearch');

    let currentCategory = 'all';
    let currentSearchTerm = '';

    // 1. Accordion Toggle
    faqItems.forEach(item => {
        const btn = item.querySelector('.faq-header-btn');
        btn.addEventListener('click', function() {
            const isOpen = item.classList.contains('is-open');

            // Optional: Close other accordions for sleek accordion feel
            faqItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('is-open')) {
                    otherItem.classList.remove('is-open');
                    otherItem.querySelector('.faq-header-btn').setAttribute('aria-expanded', 'false');
                }
            });

            if (isOpen) {
                item.classList.remove('is-open');
                btn.setAttribute('aria-expanded', 'false');
            } else {
                item.classList.add('is-open');
                btn.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // 2. Filter Logic (Category + Live Search)
    function applyFilter() {
        let visibleCount = 0;

        faqItems.forEach(item => {
            const itemCat = item.getAttribute('data-category');
            const itemQ = item.getAttribute('data-question') || '';
            const itemA = item.getAttribute('data-answer') || '';

            const matchesCategory = (currentCategory === 'all' || itemCat === currentCategory);
            const matchesSearch = (!currentSearchTerm || itemQ.includes(currentSearchTerm) || itemA.includes(currentSearchTerm));

            if (matchesCategory && matchesSearch) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        if (visibleCount === 0 && faqItems.length > 0) {
            emptyState.style.display = 'block';
        } else {
            emptyState.style.display = 'none';
        }
    }

    // 3. Category Click
    categoryPills.forEach(pill => {
        pill.addEventListener('click', function() {
            categoryPills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.getAttribute('data-category');
            applyFilter();
        });
    });

    // 4. Live Search Input
    searchInput.addEventListener('input', function() {
        currentSearchTerm = this.value.trim().toLowerCase();
        if (currentSearchTerm.length > 0) {
            searchClear.style.display = 'flex';
        } else {
            searchClear.style.display = 'none';
        }
        applyFilter();
    });

    // 5. Clear Search Button
    searchClear.addEventListener('click', function() {
        searchInput.value = '';
        currentSearchTerm = '';
        searchClear.style.display = 'none';
        searchInput.focus();
        applyFilter();
    });

    // 6. Reset Button on Empty State
    if (btnResetSearch) {
        btnResetSearch.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchTerm = '';
            searchClear.style.display = 'none';
            categoryPills.forEach(p => p.classList.remove('active'));
            const allPill = document.querySelector('.faq-pill-btn[data-category="all"]');
            if (allPill) allPill.classList.add('active');
            currentCategory = 'all';
            applyFilter();
        });
    }
});
</script>
@endpush
