@extends('layouts.app')

@section('title', 'Infografis Kesehatan - ' . ($appSetting->app_name ?? 'Puskesmas'))
@section('meta_description', 'Kumpulan infografis kesehatan, data statistik pelayanan, dan informasi publik Puskesmas dalam format visual yang mudah dipahami.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/infografis.css') }}">
@endpush

@section('content')

{{-- =========================================================================
   SUBPAGE HEADER
   ========================================================================= --}}
<section class="subpage-header" data-aos="fade-down">
    <img src="{{ asset('assets/botanical-clean.png') }}?v={{ file_exists(public_path('assets/botanical-clean.png')) ? filemtime(public_path('assets/botanical-clean.png')) : time() }}" alt="" class="subpage-header__watermark" aria-hidden="true">
    <div class="subpage-header__container">
        <div class="subpage-header__breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span>Informasi Publik</span>
            <span class="subpage-header__breadcrumb-sep">•</span>
            <span class="subpage-header__breadcrumb-current">Infografis</span>
        </div>
        <h1 class="subpage-header__title">Infografis Kesehatan</h1>
        <p class="subpage-header__subtitle">
            Visualisasi data dan informasi kesehatan masyarakat yang disajikan secara menarik dan mudah dipahami.
        </p>
    </div>
</section>

{{-- =========================================================================
   KONTEN UTAMA
   ========================================================================= --}}
<div class="infografis-wrapper">
    <div class="infografis-container">

        {{-- Filter Kategori --}}
        @if($kategoris->count() > 1)
        <div class="infografis-filter" id="infografisFilter" data-aos="fade-up">
            <button class="infografis-filter-btn active" data-filter="semua">Semua</button>
            @foreach($kategoris as $kat)
                <button class="infografis-filter-btn" data-filter="{{ $kat }}">{{ $kat }}</button>
            @endforeach
        </div>
        @endif

        {{-- Grid Infografis --}}
        @if($infografis->count() > 0)
        <div class="infografis-grid" id="infografisGrid">
            @foreach($infografis as $index => $item)
            <div class="infografis-card" data-kategori="{{ $item->kategori }}" data-aos="fade-up" data-aos-delay="{{ min($index * 70, 450) }}">
                {{-- Thumbnail --}}
                <div class="infografis-card__thumb">
                    <img src="{{ $item->image_url }}"
                         alt="{{ $item->title }}"
                         loading="lazy"
                         onerror="this.parentElement.innerHTML='<div class=\'infografis-card__thumb-placeholder\'><i class=\'bx bx-image\'></i><span>Infografis</span></div>'">
                    <span class="infografis-card__badge">{{ $item->kategori }}</span>
                    {{-- Overlay aksi --}}
                    <div class="infografis-card__overlay">
                        <button class="infografis-overlay-btn"
                                onclick="openModal('{{ $item->image_url }}', '{{ addslashes($item->title) }}', '{{ addslashes($item->deskripsi ?? '') }}')"
                                title="Lihat Besar">
                            <i class="bx bx-zoom-in"></i>
                        </button>
                        <a href="{{ $item->image_url }}" download="{{ Str::slug($item->title) }}.jpg"
                           class="infografis-overlay-btn" title="Unduh">
                            <i class="bx bx-download"></i>
                        </a>
                    </div>
                </div>
                {{-- Body --}}
                <div class="infografis-card__body">
                    <h2 class="infografis-card__title">{{ $item->title }}</h2>
                    @if($item->deskripsi)
                        <p class="infografis-card__desc">{{ $item->deskripsi }}</p>
                    @endif
                    <div class="infografis-card__footer">
                        <span class="infografis-card__date">
                            <i class="bx bx-calendar-alt"></i>
                            {{ $item->created_at->translatedFormat('d M Y') }}
                        </span>
                        <a href="{{ $item->image_url }}" download="{{ Str::slug($item->title) }}.jpg"
                           class="infografis-card__dl">
                            <i class="bx bx-download"></i> Unduh
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Empty state (ditampilkan JS saat filter kosong) --}}
        <div class="infografis-empty" id="infografisEmpty">
            <i class="bx bx-image-alt"></i>
            <p>Tidak ada infografis untuk kategori ini.</p>
        </div>

        @else
        {{-- Belum ada data --}}
        <div class="infografis-empty" style="display:block;">
            <i class="bx bx-image-alt"></i>
            <p>Belum ada infografis yang dipublikasikan. Silakan kembali lagi nanti.</p>
        </div>
        @endif

    </div>
</div>

{{-- =========================================================================
   MODAL LIGHTBOX
   ========================================================================= --}}
<div class="infografis-modal-backdrop" id="infografisModalBackdrop" onclick="closeModalOnBackdrop(event)">
    <div class="infografis-modal" id="infografisModal">
        <button class="infografis-modal-close" onclick="closeModal()" aria-label="Tutup">
            <i class="bx bx-x"></i>
        </button>
        <img src="" alt="" id="modalImg">
        <div class="infografis-modal-info">
            <h3 id="modalTitle"></h3>
            <p id="modalDesc"></p>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // ====== FILTER KATEGORI ======
    const filterBtns = document.querySelectorAll('.infografis-filter-btn');
    const cards      = document.querySelectorAll('.infografis-card');
    const emptyState = document.getElementById('infografisEmpty');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const filter = btn.dataset.filter;
            let visible  = 0;

            cards.forEach(card => {
                const match = filter === 'semua' || card.dataset.kategori === filter;
                card.style.display = match ? '' : 'none';
                if (match) visible++;
            });

            emptyState.style.display = visible === 0 ? 'block' : 'none';
        });
    });

    // ====== LIGHTBOX MODAL ======
    function openModal(imgSrc, title, desc) {
        document.getElementById('modalImg').src    = imgSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDesc').textContent  = desc;
        document.getElementById('infografisModalBackdrop').classList.add('open');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('infografisModalBackdrop').classList.remove('open');
        document.body.style.overflow = '';
        // Reset src setelah animasi selesai
        setTimeout(() => { document.getElementById('modalImg').src = ''; }, 300);
    }

    function closeModalOnBackdrop(e) {
        if (e.target === document.getElementById('infografisModalBackdrop')) closeModal();
    }

    // Tutup dengan tombol Escape
    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closeModal();
    });
</script>
@endpush
