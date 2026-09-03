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
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">

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
   MAIN CONTENT: 2-COLUMN SEARCH & FILTER CARD (KONSISTEN PERSIS DENGAN BERITA)
   ========================================================================= --}}
<div class="faq-content-wrapper">
    <div class="faq-container">

        {{-- Search Card (Tanpa Kategori, Bersih & Responsif) --}}
        <div class="faq-filter-card" data-aos="fade-up">
            <div class="faq-search-wrapper">
                <label class="faq-filter-label" for="faqSearchInput">Cari Pertanyaan / Kata Kunci</label>
                <div class="faq-search-input-group">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#6E857E" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" 
                           id="faqSearchInput" 
                           placeholder="Ketik topik atau kata kunci pertanyaan, misal: BPJS, rujukan, jadwal loket, IGD..." 
                           autocomplete="off">
                    <button type="button" id="faqSearchClear" class="faq-search-clear-btn" title="Hapus pencarian">&times;</button>
                    <button type="button" id="btnFaqSearch" class="btn-faq-search">
                        <span>Cari</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Accordion List --}}
        <div class="faq-accordion-list" id="faqAccordionList">
            @forelse($faqs as $index => $faq)
                <div class="faq-item" 
                     data-aos="fade-up"
                     data-aos-delay="{{ min($index * 60, 400) }}"
                     data-question="{{ strtolower($faq->pertanyaan) }}" 
                     data-answer="{{ strtolower(strip_tags($faq->jawaban)) }}">
                    
                    <button type="button" 
                            class="faq-header-btn" 
                            aria-expanded="false" 
                            id="faq-header-{{ $faq->id }}" 
                            aria-controls="faq-body-{{ $faq->id }}">
                        <div class="faq-header-content">
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
                        <div class="faq-body-collapse-inner">
                            <div class="faq-body-content">
                                {!! nl2br(e($faq->jawaban)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-5 bg-white rounded-3 border" style="border-radius: 12px !important;">
                    <i class="bx bx-help-circle display-4 text-muted mb-2"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Informasi FAQ</h5>
                    <p class="text-muted small">Informasi tanya jawab sedang dipersiapkan oleh pihak pengelola.</p>
                </div>
            @endforelse
        </div>

        {{-- Empty Search State (Client-side) --}}
        <div class="faq-empty-state" id="faqEmptyState">
            <i class="bx bx-search-alt"></i>
            <h4>Pertanyaan Tidak Ditemukan</h4>
            <p>Maaf, kami tidak menemukan pertanyaan yang cocok dengan kata kunci atau topik yang Anda pilih.</p>
            <button type="button" class="btn-faq-search" id="btnResetSearch">
                <span>Tampilkan Semua Pertanyaan</span>
            </button>
        </div>

        {{-- Help CTA Card (Informasi & Lokasi) --}}
        <div class="faq-help-card" data-aos="fade-up">
            <div class="faq-help-info">
                <h3>Belum Menemukan Jawaban yang Anda Cari?</h3>
                <p>
                    Kunjungi langsung loket informasi Puskesmas kami atau lihat informasi kontak dan jadwal pelayanan pada halaman lokasi kami.
                </p>
            </div>
            <div>
                <a href="{{ route('lokasi') }}" class="btn-faq-wa" style="background: #0A5C45;">
                    <i class="bx bx-map-pin fs-5"></i>
                    <span>Informasi & Lokasi Layanan</span>
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
    const faqItems = document.querySelectorAll('.faq-item');
    const emptyState = document.getElementById('faqEmptyState');
    const btnResetSearch = document.getElementById('btnResetSearch');
    const btnFaqSearch = document.getElementById('btnFaqSearch');

    let currentSearchTerm = '';

    // 1. Accordion Toggle
    faqItems.forEach(item => {
        const btn = item.querySelector('.faq-header-btn');
        btn.addEventListener('click', function() {
            const isOpen = item.classList.contains('is-open');

            // Tutup accordion lain agar bersih dan rapi
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

    // 2. Filter Logic (Live Search)
    function applyFilter() {
        let visibleCount = 0;

        faqItems.forEach(item => {
            const itemQ = item.getAttribute('data-question') || '';
            const itemA = item.getAttribute('data-answer') || '';

            const matchesSearch = (!currentSearchTerm || itemQ.includes(currentSearchTerm) || itemA.includes(currentSearchTerm));

            if (matchesSearch) {
                if (item.style.display === 'none' || item.style.display === '') {
                    item.classList.remove('animate-fade-in');
                    void item.offsetWidth;
                    item.classList.add('animate-fade-in');
                }
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

    // 3. Live Search Input
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearchTerm = this.value.trim().toLowerCase();
            if (currentSearchTerm.length > 0) {
                searchClear.style.display = 'inline-flex';
            } else {
                searchClear.style.display = 'none';
            }
            applyFilter();
        });
    }

    if (btnFaqSearch) {
        btnFaqSearch.addEventListener('click', function() {
            applyFilter();
        });
    }

    // 4. Clear Search Button
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchTerm = '';
            searchClear.style.display = 'none';
            searchInput.focus();
            applyFilter();
        });
    }

    // 5. Reset Button on Empty State
    if (btnResetSearch) {
        btnResetSearch.addEventListener('click', function() {
            if (searchInput) searchInput.value = '';
            currentSearchTerm = '';
            if (searchClear) searchClear.style.display = 'none';
            applyFilter();
        });
    }
});
</script>
@endpush
