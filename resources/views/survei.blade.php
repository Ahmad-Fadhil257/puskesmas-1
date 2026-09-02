@extends('layouts.app')

@section('title', 'Survei Kepuasan Pasien - ' . config('app.name'))
@section('meta_description', 'Berikan penilaian dan masukan Anda mengenai mutu pelayanan kesehatan di Puskesmas melalui Formulir Survei Kepuasan Pasien.')

@push('styles')
    {{-- Terpisah ke file CSS eksternal --}}
    <link rel="stylesheet" href="{{ asset('css/pages/survei.css') }}?v={{ file_exists(public_path('css/pages/survei.css')) ? filemtime(public_path('css/pages/survei.css')) : time() }}">
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
            <span class="subpage-header__breadcrumb-current">Survei Kepuasan Pasien</span>
        </div>
        <h1 class="subpage-header__title" data-aos="fade-right">Survei Kepuasan Pasien</h1>
        <p class="subpage-header__subtitle" data-aos="fade-up">
            Partisipasi Anda sangat berarti bagi peningkatan mutu, transparansi, dan pelayanan kesehatan Puskesmas. Mohon luangkan waktu 1 menit untuk mengisi evaluasi singkat ini.
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN 2-COLUMN SECTION (VISUAL ILUSTRASI + FORM EVALUASI)
   ========================================================================= --}}
<div class="survei-content-wrapper">
    <div class="survei-container">

        {{-- Alert Notifikasi Sukses --}}
        @if(session('survey_success'))
            <div class="survei-alert-success" data-aos="fade-down">
                <div class="survei-alert-icon">
                    <i class="bx bx-check"></i>
                </div>
                <div>
                    <h4 class="survei-alert-title">Evaluasi Berhasil Dikirim!</h4>
                    <p class="survei-alert-desc">{{ session('survey_success') }}</p>
                </div>
            </div>
        @endif

        <div class="survei-main-grid">

            <div class="survei-visual-card" data-aos="fade-right">
                <div class="survei-visual-blob"></div>
                <img src="{{ asset('assets/img/survey-illustration.jpg') }}?v={{ file_exists(public_path('assets/img/survey-illustration.jpg')) ? filemtime(public_path('assets/img/survey-illustration.jpg')) : time() }}" 
                     alt="Survei Kepuasan Pasien" 
                     class="survei-visual-img">
                
                <div class="survei-visual-floating-badge">
                    <div style="display: flex; align-items: center; gap: 4px; color: #F59E0B; font-weight: 800; font-size: 15px;">
                        <i class="bx bxs-star"></i>
                        <span>{{ $avgRating ?? '4.9' }}</span>
                    </div>
                    <span style="display: inline-block; width: 4px; height: 4px; background: #CBD5E1; border-radius: 50%;"></span>
                    <span style="font-size: 13px; font-weight: 700; color: #0A5C45;">{{ $satisfactionPct ?? '98' }}% Sangat Puas</span>
                </div>

                <div style="margin-top: 20px; z-index: 2; position: relative;">
                    <h4 style="font-size: 17px; font-weight: 800; color: #122822; margin: 0 0 6px 0;">Penilaian Anda Sangat Berarti</h4>
                    <p style="font-size: 13.5px; color: #64748B; margin: 0; max-width: 320px; line-height: 1.5;">
                        Setiap masukan dan evaluasi membantu kami terus meningkatkan kualitas pelayanan kesehatan masyarakat.
                    </p>
                </div>
            </div>

            {{-- =============================================================
               KOLOM KANAN: FORMULIR EVALUASI RINGKAS & BERSIH
               ============================================================= --}}
            <div class="survei-form-card" data-aos="fade-left">

                <div class="form-header-box">
                    <h3 class="form-header-title">Beri Penilaian Pelayanan</h3>
                    <p class="form-header-sub">Pilih tingkat kepuasan Anda dan berikan ulasan jujur tentang pengalaman berobat Anda.</p>
                </div>
                @if ($errors->any())
                    <div style="background: #FEF2F2; border: 1px solid #FCA5A5; border-left: 4px solid #EF4444; border-radius: 12px; padding: 12px 16px; margin-bottom: 24px;">
                        <strong style="color: #B91C1C; font-size: 13.5px; display: block; margin-bottom: 2px;">Mohon periksa isian formulir:</strong>
                        <ul style="margin: 0; padding-left: 18px; font-size: 13px; color: #B91C1C;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('survei.store') }}" method="POST">
                    @csrf

                    {{-- 1. PILIHAN RATING MENGGUNAKAN ICON --}}
                    <div style="margin-bottom: 24px;">
                        <label class="form-section-label">
                            Bagaimana kepuasan pelayanan Puskesmas secara keseluruhan? <span class="required-star">*</span>
                        </label>
                        <div class="rating-grid">
                            {{-- 5: Sangat Puas --}}
                            <label class="rating-card">
                                <input type="radio" name="rating" value="5" {{ old('rating', '5') == '5' ? 'checked' : '' }} style="display: none;">
                                <i class="bx bxs-laugh rating-icon"></i>
                                <span class="rating-label">Sangat Puas</span>
                            </label>

                            {{-- 4: Puas --}}
                            <label class="rating-card">
                                <input type="radio" name="rating" value="4" {{ old('rating') == '4' ? 'checked' : '' }} style="display: none;">
                                <i class="bx bxs-smile rating-icon"></i>
                                <span class="rating-label">Puas</span>
                            </label>

                            {{-- 3: Cukup --}}
                            <label class="rating-card">
                                <input type="radio" name="rating" value="3" {{ old('rating') == '3' ? 'checked' : '' }} style="display: none;">
                                <i class="bx bxs-meh rating-icon"></i>
                                <span class="rating-label">Cukup</span>
                            </label>

                            {{-- 2: Kurang --}}
                            <label class="rating-card">
                                <input type="radio" name="rating" value="2" {{ old('rating') == '2' ? 'checked' : '' }} style="display: none;">
                                <i class="bx bxs-sad rating-icon"></i>
                                <span class="rating-label">Kurang</span>
                            </label>
                        </div>
                    </div>

                    {{-- 2. POLI / LAYANAN YANG DIKUNJUNGI --}}
                    <div style="margin-bottom: 24px; position: relative; z-index: 30;">
                        <label class="form-section-label" for="poli_name_hidden">
                            Layanan / Poliklinik yang Dikunjungi <span class="required-star">*</span>
                        </label>

                        {{-- Hidden input untuk submit form --}}
                        <input type="hidden" name="poli_name" id="poli_name_hidden"
                               value="{{ old('poli_name', '') }}" required>

                        {{-- Custom Dropdown --}}
                        @php
                            $oldPoli = old('poli_name', '');
                            $poliLabels = [
                                'Loket Pendaftaran & Rekam Medis' => 'Loket Pendaftaran & Rekam Medis',
                                'Poli Umum' => 'Poli Umum',
                                'Poli Gigi & Mulut' => 'Poli Gigi & Mulut',
                                'Poli KIA & KB' => 'Poli KIA & KB (Ibu, Anak, Imunisasi)',
                                'Laboratorium Klinis' => 'Laboratorium Klinis',
                                'Farmasi & Apotek Obat' => 'Farmasi & Apotek Obat',
                                'Layanan UGD 24 Jam' => 'Layanan Gawat Darurat (UGD 24 Jam)',
                            ];
                        @endphp
                        <div class="survei-custom-dropdown" id="surveiPoliDropdown">
                            <div class="survei-custom-dropdown__selected" id="surveiPoliSelected">
                                <span id="surveiPoliLabel" class="{{ (!$oldPoli || !isset($poliLabels[$oldPoli])) ? 'placeholder' : '' }}">
                                    {{ $oldPoli && isset($poliLabels[$oldPoli]) ? $poliLabels[$oldPoli] : '-- Pilih Poliklinik / Ruang Pelayanan --' }}
                                </span>
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#0A5C45" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="survei-dropdown-chevron"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                            <div class="survei-custom-dropdown__options" id="surveiPoliOptions">
                                @if(isset($layanans) && $layanans->isNotEmpty())
                                    @foreach($layanans as $lay)
                                        <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == $lay->title ? 'active' : '' }}"
                                           data-value="{{ $lay->title }}">{{ $lay->title }}</a>
                                    @endforeach
                                @endif
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Loket Pendaftaran & Rekam Medis' ? 'active' : '' }}" data-value="Loket Pendaftaran & Rekam Medis">Loket Pendaftaran & Rekam Medis</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Poli Umum' ? 'active' : '' }}" data-value="Poli Umum">Poli Umum</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Poli Gigi & Mulut' ? 'active' : '' }}" data-value="Poli Gigi & Mulut">Poli Gigi & Mulut</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Poli KIA & KB' ? 'active' : '' }}" data-value="Poli KIA & KB">Poli KIA & KB (Ibu, Anak, Imunisasi)</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Laboratorium Klinis' ? 'active' : '' }}" data-value="Laboratorium Klinis">Laboratorium Klinis</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Farmasi & Apotek Obat' ? 'active' : '' }}" data-value="Farmasi & Apotek Obat">Farmasi & Apotek Obat</a>
                                <a href="#" class="survei-custom-dropdown__option {{ old('poli_name') == 'Layanan UGD 24 Jam' ? 'active' : '' }}" data-value="Layanan UGD 24 Jam">Layanan Gawat Darurat (UGD 24 Jam)</a>
                            </div>
                        </div>
                    </div>

                    {{-- 3. MASUKAN, KRITIK & SARAN --}}
                    <div style="margin-bottom: 24px;">
                        <label class="form-section-label" for="pesan">
                            Kritik, Masukan & Saran Evaluasi <span class="required-star">*</span>
                        </label>
                        <textarea name="pesan" 
                                  id="pesan"
                                  rows="4" 
                                  placeholder="Tulis masukan atau pengalaman Anda berobat di sini..." 
                                  required 
                                  class="form-input-control" 
                                  style="resize: vertical;">{{ old('pesan') }}</textarea>
                    </div>

                    {{-- 4. IDENTITAS PENGIRIM & OPSI ANONIM --}}
                    <div class="anonymous-box">
                        <label class="anonymous-label" for="is_anonymous">
                            <input type="checkbox" name="is_anonymous" id="is_anonymous" value="1" {{ old('is_anonymous') ? 'checked' : '' }} onchange="handleAnonymousToggle(this)">
                            <span>Kirim sebagai <strong>Pasien Anonim</strong> (Rahasiakan Nama & Kontak Saya)</span>
                        </label>
                    </div>

                    <div id="identityFieldsRow" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px; transition: opacity 0.2s ease;">
                        <div>
                            <label class="form-section-label" for="name" id="nameLabel">
                                Nama Lengkap <span class="required-star" id="nameRequiredStar">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name"
                                   value="{{ old('name') }}" 
                                   placeholder="Contoh: Budi Santoso" 
                                   class="form-input-control">
                        </div>

                        <div>
                            <label class="form-section-label" for="email_or_phone">
                                Nomor WhatsApp / Telepon <span style="font-weight: 500; color: #64748B; font-size: 12px;">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="email_or_phone" 
                                   id="email_or_phone"
                                   value="{{ old('email_or_phone') }}" 
                                   placeholder="Contoh: 081234567xxx" 
                                   class="form-input-control">
                        </div>
                    </div>

                    {{-- 5. GOOGLE RECAPTCHA --}}
                    <div style="margin-bottom: 24px;">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                        @error('g-recaptcha-response')
                            <span style="color: #EF4444; font-size: 12.5px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- 6. TOMBOL SUBMIT --}}
                    <button type="submit" class="btn-submit-survei">
                        <i class="bx bx-paper-plane" style="font-size: 18px;"></i>
                        <span>Kirim Penilaian Pelayanan</span>
                    </button>
                    <p style="text-align: center; font-size: 12px; color: #64748B; margin: 10px 0 0 0;">
                        <i class="bx bx-lock-alt me-1"></i> Data Anda tersimpan aman dan digunakan untuk evaluasi mutu Puskesmas.
                    </p>
                </form>

            </div>

        </div>

    </div>
</div>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function handleAnonymousToggle(checkbox) {
        const wrap = document.getElementById('identityFieldsRow');
        const nameInput = document.getElementById('name');
        const phoneInput = document.getElementById('email_or_phone');
        const nameStar = document.getElementById('nameRequiredStar');

        if (checkbox.checked) {
            wrap.style.opacity = '0.4';
            wrap.style.pointerEvents = 'none';
            nameInput.removeAttribute('required');
            nameInput.value = '';
            phoneInput.value = '';
            if (nameStar) nameStar.style.display = 'none';
        } else {
            wrap.style.opacity = '1';
            wrap.style.pointerEvents = 'auto';
            nameInput.setAttribute('required', 'required');
            if (nameStar) nameStar.style.display = 'inline';
        }
    }

    // Init state on load
    document.addEventListener('DOMContentLoaded', function() {
        const anonCheckbox = document.getElementById('is_anonymous');
        if (anonCheckbox) {
            handleAnonymousToggle(anonCheckbox);
        }

        // ── Custom Poli Dropdown ─────────────────────────────────────────────
        const dropdown   = document.getElementById('surveiPoliDropdown');
        const selected   = document.getElementById('surveiPoliSelected');
        const optionsBox = document.getElementById('surveiPoliOptions');
        const labelEl    = document.getElementById('surveiPoliLabel');
        const hiddenInput = document.getElementById('poli_name_hidden');

        if (!dropdown || !selected || !optionsBox) return;

        // Mark placeholder styling on init
        if (!hiddenInput.value) {
            labelEl.classList.add('placeholder');
        }

        // Toggle open/close
        selected.addEventListener('click', function(e) {
            e.stopPropagation();
            const isOpen = optionsBox.classList.contains('show');
            optionsBox.classList.toggle('show', !isOpen);
            dropdown.classList.toggle('open', !isOpen);
        });

        // Handle option click
        optionsBox.querySelectorAll('.survei-custom-dropdown__option').forEach(function(opt) {
            opt.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const value = this.dataset.value;
                const text  = this.textContent.trim();

                // Update hidden input
                hiddenInput.value = value;

                // Update label
                labelEl.textContent = text;
                labelEl.classList.remove('placeholder');

                // Update active class
                optionsBox.querySelectorAll('.survei-custom-dropdown__option').forEach(o => o.classList.remove('active'));
                this.classList.add('active');

                // Close
                optionsBox.classList.remove('show');
                dropdown.classList.remove('open');
            });
        });

        // Close on outside click
        document.addEventListener('click', function() {
            optionsBox.classList.remove('show');
            dropdown.classList.remove('open');
        });
    });
</script>
@endpush
@endsection
