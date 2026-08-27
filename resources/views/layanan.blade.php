@extends('layouts.app')

@section('title', 'Layanan & Poliklinik - Puskesmas')
@section('meta_description', 'Solusi layanan kesehatan komprehensif mulai dari pemeriksaan rutin, dokter spesialis, farmasi, hingga penanganan gawat darurat di Puskesmas.')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/layanan-page.css') }}">
@endpush

@section('content')

@php
    $layanansFormatted = $layanans->map(function($item) use ($appSetting) {
        return [
            'id'              => $item->id,
            'title'           => $item->title,
            'description'     => $item->description,
            'variant'         => $item->variant,
            'tipe_jaminan'    => $item->tipe_jaminan ?? ($item->variant === 'emergency' ? '24 JAM / GAWAT DARURAT' : ($item->variant === 'featured' ? 'POLI UNGGULAN' : 'BPJS & UMUM')),
            'icon'            => $item->icon ?? 'bx bx-plus-medical',
            'custom_icon'     => $item->custom_icon ? asset($item->custom_icon) : '',
            'jam_operasional' => $item->jam_operasional ?? 'Senin - Sabtu: 08.00 - 14.00 WIB',
            'slug'            => $item->slug,
            'tindakan_list'   => $item->tindakan_list,
            'persyaratan'     => $item->persyaratan,
            'btn_text'        => $item->btn_text ? $item->btn_text : 'Hubungi Kami',
            'btn_link'        => $item->btn_link ? $item->btn_link : $appSetting->wa_link,
            'dokters'         => $item->dokters->map(function($d) {
                return [
                    'name'           => $d->name,
                    'specialty'      => $d->specialty,
                    'photo'          => $d->photo ? asset($d->photo) : null,
                    'jadwal_praktek' => $d->jadwal_praktek ?? [],
                ];
            })->values()->toArray(),
        ];
    });
@endphp

{{-- =========================================================================
   HEADER SECTION: FULL WIDTH DARK EMERALD (IJO TUA PERSIS BERITA)
   ========================================================================= --}}
<section class="layanan-full-header">
    <div class="layanan-full-header__decor-pattern" aria-hidden="true"></div>
    <div class="layanan-full-header__glow" aria-hidden="true"></div>

    <div class="layanan-full-header__container">
        <div class="layanan-header-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2v20M2 12h20"/>
            </svg>
            <span>LAYANAN KAMI</span>
        </div>
        <h1 class="layanan-full-header__title">Solusi Layanan Kesehatan Komprehensif</h1>
        <p class="layanan-full-header__subtitle">
            Di Puskesmas kami, kami menawarkan beragam layanan medis yang disesuaikan dengan kebutuhan Anda, mulai dari pemeriksaan rutin hingga perawatan khusus.
        </p>
    </div>
</section>

{{-- =========================================================================
   GRID SECTION: 6 KARTU PERSIS SEPERTI DI GAMBAR
   ========================================================================= --}}
<section class="layanan-grid-section">
    <div class="layanan-grid-container">

        <div class="layanan-cards-grid">
            @forelse($layanans as $item)
                @if($item->variant === 'emergency')
                    {{-- KARTU MERAH: PANGGILAN DARURAT / UGD --}}
                    <div class="layanan-box-card card--emergency" onclick="openLayananModalById({{ $item->id }})">
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                        <a href="{{ $item->btn_link ? $item->btn_link : $appSetting->wa_link }}" 
                           target="_blank" rel="noopener" 
                           class="btn-emergency-pill" 
                           onclick="event.stopPropagation();">
                            <span>{{ $item->btn_text ? $item->btn_text : 'Hubungi kami' }}</span>
                            <i class="bx bx-right-arrow-alt"></i>
                        </a>
                    </div>
                @elseif($item->variant === 'featured')
                    {{-- KARTU HIJAU GELAP: DOKTER SPESIALIS / UNGGULAN --}}
                    <div class="layanan-box-card card--featured" onclick="openLayananModalById({{ $item->id }})">
                        <div class="box-card-icon icon--featured">
                            @if($item->custom_icon)
                                <img src="{{ asset($item->custom_icon) }}" alt="{{ $item->title }}">
                            @else
                                <i class="{{ $item->icon ?? 'bx bx-plus-medical' }}"></i>
                            @endif
                        </div>
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                    </div>
                @else
                    {{-- KARTU STANDAR: LIGHT GRAY DENGAN IKON SOFT GREEN --}}
                    <div class="layanan-box-card card--default" onclick="openLayananModalById({{ $item->id }})">
                        <div class="box-card-icon icon--default">
                            @if($item->custom_icon)
                                <img src="{{ asset($item->custom_icon) }}" alt="{{ $item->title }}">
                            @else
                                <i class="{{ $item->icon ?? 'bx bx-plus-medical' }}"></i>
                            @endif
                        </div>
                        <h3 class="box-card-title">{{ $item->title }}</h3>
                        <p class="box-card-desc">{{ $item->description }}</p>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Belum ada layanan yang ditambahkan.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

{{-- =========================================================================
   POPUP MODAL DETAIL SPESIFIK (DOKTER, JAM, TINDAKAN, SYARAT)
   ========================================================================= --}}
<div id="layananModalOverlay" class="layanan-modal-overlay" onclick="handleModalOverlayClick(event)">
    <div class="layanan-modal-dialog">
        {{-- Close Button --}}
        <button type="button" class="layanan-modal-close" onclick="closeLayananModal()" aria-label="Tutup">&times;</button>

        {{-- Modal Header --}}
        <div class="layanan-modal-header" id="modalHeaderSection">
            <div class="modal-icon-badge" id="modalIconWrap">
                <i class="bx bx-plus-medical" id="modalIcon"></i>
            </div>
            <div>
                <span class="modal-badge-pill" id="modalBadge">BPJS & UMUM</span>
                <h3 class="modal-title" id="modalTitle">Nama Layanan</h3>
            </div>
        </div>

        {{-- Modal Body --}}
        <div class="layanan-modal-body">
            {{-- Jam Operasional --}}
            <div class="modal-info-strip">
                <i class="bx bx-time-five text-primary"></i>
                <span class="fw-bold text-dark small text-uppercase">Jam Operasional:</span>
                <span id="modalJamOperasional" class="badge bg-white text-dark border px-2 py-1 ms-auto"></span>
            </div>

            {{-- Deskripsi Pelayanan --}}
            <div class="modal-section-group">
                <label class="modal-label"><i class="bx bx-info-circle me-1"></i> Deskripsi & Cakupan Pelayanan</label>
                <p id="modalDesc" class="modal-desc"></p>
            </div>

            {{-- Dokter Penanggung Jawab --}}
            <div class="modal-section-group" id="modalDoctorsSection">
                <label class="modal-label"><i class="bx bx-user-pin me-1"></i> Tenaga Medis / Spesialisasi Terkait</label>
                <div id="modalDoktersContainer" class="modal-doctors-list"></div>
            </div>

            {{-- Tindakan Medis --}}
            <div class="modal-section-group" id="modalProceduresSection">
                <label class="modal-label"><i class="bx bx-check-double me-1"></i> Tindakan / Pemeriksaan yang Dilayani</label>
                <div id="modalProceduresList" class="modal-procedures-grid"></div>
            </div>

            {{-- Persyaratan Kunjungan --}}
            <div class="modal-section-group" id="modalRequirementsSection">
                <label class="modal-label"><i class="bx bx-file me-1"></i> Persyaratan Kunjungan Pasien</label>
                <ul id="modalRequirementsList" class="modal-req-list"></ul>
            </div>
        </div>

        {{-- Modal Footer --}}
        <div class="layanan-modal-footer">
            <a href="#" id="modalDetailBtn" class="btn-modal-secondary">
                <i class="bx bx-file-blank me-1"></i> Detail Halaman
            </a>
            <a href="{{ route('jadwal-dokter') }}" class="btn-modal-secondary">
                <i class="bx bx-calendar me-1"></i> Jadwal Dokter
            </a>
            <a href="{{ $appSetting->wa_link }}" target="_blank" rel="noopener" id="modalPrimaryBtn" class="btn-modal-primary">
                <i class="bx bxl-whatsapp me-1"></i> <span id="modalPrimaryBtnText">Hubungi / Buat Janji</span>
            </a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const layanansDataset = @json($layanansFormatted);

    /* Open Modal by ID */
    function openLayananModalById(id) {
        const data = layanansDataset.find(x => Number(x.id) === Number(id));
        if (!data) return;

        document.getElementById('modalTitle').textContent = data.title;
        document.getElementById('modalDesc').textContent = data.description;
        document.getElementById('modalJamOperasional').textContent = data.jam_operasional || 'Senin - Sabtu: 08.00 - 14.00 WIB';

        const badgeEl = document.getElementById('modalBadge');
        const iconWrap = document.getElementById('modalIconWrap');

        badgeEl.textContent = data.tipe_jaminan || (data.variant === 'emergency' ? '24 JAM / GAWAT DARURAT' : (data.variant === 'featured' ? 'POLI UNGGULAN' : 'BPJS & UMUM'));
        if (data.variant === 'emergency') {
            badgeEl.className = 'modal-badge-pill badge-pill--red';
            iconWrap.className = 'modal-icon-badge icon-emergency';
        } else if (data.variant === 'featured') {
            badgeEl.className = 'modal-badge-pill badge-pill--emerald';
            iconWrap.className = 'modal-icon-badge icon-featured';
        } else {
            badgeEl.className = 'modal-badge-pill badge-pill--slate';
            iconWrap.className = 'modal-icon-badge icon-default';
        }

        if (data.custom_icon) {
            iconWrap.innerHTML = '<img src="' + data.custom_icon + '" alt="' + data.title + '" style="width:24px;height:24px;object-fit:contain;">';
        } else {
            iconWrap.innerHTML = '<i class="' + data.icon + '"></i>';
        }

        // Render Dokter
        const docsContainer = document.getElementById('modalDoktersContainer');
        docsContainer.innerHTML = '';
        if (data.dokters && data.dokters.length > 0) {
            data.dokters.forEach(doc => {
                const docCard = document.createElement('div');
                docCard.className = 'modal-doc-row';
                docCard.innerHTML = `
                    <div class="modal-doc-avatar">
                        ${doc.photo ? `<img src="${doc.photo}" alt="${doc.name}">` : `<i class="bx bx-user"></i>`}
                    </div>
                    <div>
                        <div class="modal-doc-name">${doc.name}</div>
                        <div class="modal-doc-spec text-muted"><i class="bx bx-badge-check text-success"></i> ${doc.specialty}</div>
                    </div>
                `;
                docsContainer.appendChild(docCard);
            });
        } else {
            docsContainer.innerHTML = `
                <div class="modal-doc-row">
                    <div class="modal-doc-avatar"><i class="bx bx-check-shield text-success"></i></div>
                    <div>
                        <div class="modal-doc-name">Tim Medis & Staf Ahli Puskesmas</div>
                        <div class="modal-doc-spec text-muted">Pelayanan profesional terstandar operasional Puskesmas</div>
                    </div>
                </div>
            `;
        }

        // Render Tindakan
        const procList = document.getElementById('modalProceduresList');
        procList.innerHTML = '';
        if (data.tindakan_list && data.tindakan_list.length > 0) {
            data.tindakan_list.forEach(tindakan => {
                const item = document.createElement('div');
                item.className = 'modal-proc-pill';
                item.innerHTML = `<i class="bx bx-check-circle text-success"></i> <span>${tindakan}</span>`;
                procList.appendChild(item);
            });
        } else {
            procList.innerHTML = `<p class="text-muted small">Pemeriksaan dan tindakan medis sesuai prosedur standar Puskesmas.</p>`;
        }

        // Render Persyaratan
        const reqList = document.getElementById('modalRequirementsList');
        reqList.innerHTML = '';
        if (data.persyaratan) {
            const lines = data.persyaratan.split(/\r?\n/).filter(l => l.trim().length > 0);
            lines.forEach(line => {
                const li = document.createElement('li');
                li.innerHTML = `<i class="bx bx-check text-primary"></i> <span>${line}</span>`;
                reqList.appendChild(li);
            });
        } else {
            reqList.innerHTML = `
                <li><i class="bx bx-check text-primary"></i> <span>Membawa e-KTP / Kartu Identitas Pasien.</span></li>
                <li><i class="bx bx-check text-primary"></i> <span>Membawa Kartu BPJS Kesehatan / KIS aktif (bagi peserta BPJS).</span></li>
                <li><i class="bx bx-check text-primary"></i> <span>Membawa Kartu Berobat Puskesmas (bagi pasien lama).</span></li>
            `;
        }

        // Primary Button
        const primaryBtn = document.getElementById('modalPrimaryBtn');
        primaryBtn.href = data.btn_link || '{{ $appSetting->wa_link }}';
        document.getElementById('modalPrimaryBtnText').textContent = data.btn_text || 'Hubungi / Buat Janji';

        // Detail Page Link
        const detailBtn = document.getElementById('modalDetailBtn');
        if (detailBtn && data.slug) {
            detailBtn.href = '/layanan/' + data.slug;
        }

        const modal = document.getElementById('layananModalOverlay');
        modal.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeLayananModal() {
        const modal = document.getElementById('layananModalOverlay');
        if (modal) {
            modal.classList.remove('show');
            document.body.style.overflow = '';
        }
    }

    function handleModalOverlayClick(e) {
        if (e.target.id === 'layananModalOverlay') {
            closeLayananModal();
        }
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLayananModal();
        }
    });
</script>
@endpush

@endsection
