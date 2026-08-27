@extends('layouts.app')

@section('title', 'Survei Kepuasan Masyarakat (SKM) - ' . config('app.name'))
@section('meta_description', 'Berikan penilaian dan masukan Anda mengenai mutu pelayanan kesehatan di Puskesmas melalui Formulir Survei Kepuasan Masyarakat (SKM).')

@push('styles')
<style>
/* Full Width Dark Emerald Header */
.survei-full-header {
    width: 100%;
    margin-top: -95px;
    padding-top: 130px;
    padding-bottom: 55px;
    padding-left: 24px;
    padding-right: 24px;
    background: linear-gradient(135deg, #0A5C45 0%, #064E3B 60%, #043628 100%);
    position: relative;
    overflow: hidden;
    isolation: isolate;
    box-shadow: 0 12px 36px rgba(0, 50, 35, 0.18);
    text-align: left;
    box-sizing: border-box;
}

.survei-full-header__glow {
    position: absolute;
    top: -50px;
    right: -50px;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(52, 211, 153, 0.22) 0%, transparent 70%);
    border-radius: 50%;
    filter: blur(45px);
    pointer-events: none;
    z-index: -1;
}

.survei-full-header__decor-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(rgba(255, 255, 255, 0.10) 1.2px, transparent 1.2px),
        linear-gradient(to right, rgba(255, 255, 255, 0.02) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
    background-size: 24px 24px;
    opacity: 0.75;
    pointer-events: none;
    z-index: -1;
}

.survei-full-header__container {
    max-width: 1200px;
    margin: 0 auto;
    width: 100%;
}

.survei-header-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #92e4c8;
    background: rgba(255, 255, 255, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 16px;
    border-radius: 9999px;
    margin-bottom: 16px;
}

.survei-full-header__title {
    font-size: clamp(1.75rem, 3.5vw, 2.5rem);
    font-weight: 800;
    color: #FFFFFF;
    margin: 0 0 12px 0;
    line-height: 1.2;
    letter-spacing: -0.02em;
}

.survei-full-header__subtitle {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
    max-width: 680px;
    margin: 0;
}

.survei-content-wrapper {
    background: #F8FAFC;
    padding: 56px 24px 88px;
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
}

/* 2-Column Grid Layout */
.survei-main-grid {
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: 40px;
    align-items: center;
    max-width: 1140px;
    margin: 0 auto;
}

@media (max-width: 991px) {
    .survei-main-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
}

/* Left Visual Side */
.survei-visual-card {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 24px;
}

.survei-visual-blob {
    position: absolute;
    width: 320px;
    height: 320px;
    background: #D8F3E5;
    border-radius: 50% 40% 60% 50% / 50% 60% 40% 50%;
    z-index: 0;
    opacity: 0.8;
}

.survei-visual-img {
    position: relative;
    z-index: 1;
    max-width: 100%;
    width: 360px;
    height: auto;
    border-radius: 20px;
    object-fit: cover;
    box-shadow: 0 16px 36px rgba(10, 92, 69, 0.12);
}

.survei-visual-floating-badge {
    position: relative;
    z-index: 2;
    margin-top: -24px;
    background: #FFFFFF;
    border: 1px solid #D6E8E2;
    border-radius: 9999px;
    padding: 10px 20px;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
}

/* Right Form Card */
.survei-form-card {
    background: #FFFFFF;
    border-radius: 20px;
    padding: 36px 32px;
    border: 1px solid #E2E8F0;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.04);
}

/* Rating Pill Buttons */
.rating-pill-group {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

@media (max-width: 576px) {
    .rating-pill-group {
        grid-template-columns: repeat(2, 1fr);
    }
}

.rating-pill-item {
    cursor: pointer;
    border: 1.5px solid #E2E8F0;
    border-radius: 10px;
    padding: 12px 8px;
    text-align: center;
    background: #FFFFFF;
    transition: all 0.2s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}

.rating-pill-item:hover {
    border-color: #0A5C45;
    background: #F8FAF9;
}

.rating-pill-item:has(input:checked) {
    border-color: #0A5C45 !important;
    background: #E6F5F1 !important;
    box-shadow: 0 2px 8px rgba(10, 92, 69, 0.15);
}

.rating-pill-item:has(input:checked) .rating-pill-text {
    color: #0A5C45 !important;
    font-weight: 800 !important;
}

/* Submit Button */
.btn-submit-survei {
    width: 100%;
    background: #00A86B;
    color: #FFFFFF;
    border: none;
    border-radius: 10px;
    padding: 14px 20px;
    font-family: inherit;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s ease;
    box-shadow: 0 4px 14px rgba(0, 168, 107, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-submit-survei:hover {
    background: #008f5b;
    box-shadow: 0 6px 18px rgba(0, 168, 107, 0.4);
    transform: translateY(-1px);
}
</style>
@endpush

@section('content')

{{-- =========================================================================
   FULL WIDTH DARK EMERALD HEADER (IJO TUA PERSIS BERITA & LAYANAN)
   ========================================================================= --}}
<section class="survei-full-header">
    <div class="survei-full-header__decor-pattern" aria-hidden="true"></div>
    <div class="survei-full-header__glow" aria-hidden="true"></div>

    <div class="survei-full-header__container">
        <div class="survei-header-badge">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                <polyline points="14 2 14 8 20 8"></polyline>
                <line x1="16" y1="13" x2="8" y2="13"></line>
                <line x1="16" y1="17" x2="8" y2="17"></line>
                <polyline points="10 9 9 9 8 9"></polyline>
            </svg>
            <span>SURVEI KEPUASAN MASYARAKAT</span>
        </div>
        <h1 class="survei-full-header__title">Survei Kepuasan Masyarakat (SKM)</h1>
        <p class="survei-full-header__subtitle">
            Partisipasi Anda sangat berarti bagi peningkatan mutu, transparansi, dan pelayanan kesehatan Puskesmas. Mohon luangkan waktu untuk mengisi formulir evaluasi berikut.
        </p>
    </div>
</section>

{{-- =========================================================================
   MAIN 2-COLUMN SECTION (SESUAI GAMBAR REFERENSI)
   ========================================================================= --}}
<div class="survei-content-wrapper">
    <div style="max-width: 1140px; margin: 0 auto; width: 100%;">

        {{-- Alert Notifikasi Sukses --}}
        @if(session('survey_success'))
            <div style="margin-bottom: 32px; background: #FFFFFF; border-left: 6px solid #00A86B; border-radius: 16px; padding: 20px 24px; box-shadow: 0 10px 30px rgba(0, 168, 107, 0.12); display: flex; align-items: center; gap: 16px;">
                <div style="width: 44px; height: 44px; border-radius: 50%; background: #E6F5F1; display: flex; align-items: center; justify-content: center; font-size: 22px; color: #00A86B; flex-shrink: 0;">
                    <i class="bx bx-check"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 2px 0; color: #0A5C45; font-size: 15px; font-weight: 800;">Survei Berhasil Dikirim!</h4>
                    <p style="margin: 0; color: #40564F; font-size: 13.5px; line-height: 1.5;">{{ session('survey_success') }}</p>
                </div>
            </div>
        @endif

        {{-- Main 2-Column Grid --}}
        <div class="survei-main-grid">

            {{-- Kolom Kiri: Visual Gambar / Ilustrasi + Badge Rating --}}
            <div class="survei-visual-card">
                <div class="survei-visual-blob"></div>
                <img src="{{ asset('assets/img/survey-illustration.jpg') }}" alt="Survei Kepuasan Pasien" class="survei-visual-img" onerror="this.src='{{ asset('assets/img/stethoscope.png') }}'">
                
                <div class="survei-visual-floating-badge">
                    <div style="display: flex; align-items: center; gap: 4px; color: #F59E0B; font-weight: 800; font-size: 15px;">
                        <i class="bx bxs-star"></i>
                        <span>{{ $avgRating ?? '5.0' }}</span>
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

            {{-- Kolom Kanan: Formulir Survei (Persis Gambar 2) --}}
            <div class="survei-form-card">
                
                @if ($errors->any())
                    <div style="background: #FEF2F2; border-left: 4px solid #EF4444; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px;">
                        <strong style="color: #B91C1C; font-size: 13px; display: block; margin-bottom: 2px;">Harap perbaiki beberapa isian:</strong>
                        <ul style="margin: 0; padding-left: 18px; font-size: 12.5px; color: #B91C1C;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('survei.store') }}" method="POST">
                    @csrf

                    {{-- Baris 1: Nama Lengkap & No WhatsApp (2 Kolom) --}}
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 20px;">
                        <div>
                            <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">
                                Nama Lengkap <span style="font-weight: 500; color: #64748B; font-size: 12px;">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Nama Lengkap Anda" 
                                   style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1.5px solid #E2E8F0; font-family: inherit; font-size: 13.5px; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                                   onfocus="this.style.borderColor='#00A86B'" onblur="this.style.borderColor='#E2E8F0'">
                        </div>

                        <div>
                            <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">
                                Nomor WhatsApp <span style="font-weight: 500; color: #64748B; font-size: 12px;">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   name="email_or_phone" 
                                   value="{{ old('email_or_phone') }}" 
                                   placeholder="Contoh: 081234567xxx" 
                                   style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1.5px solid #E2E8F0; font-family: inherit; font-size: 13.5px; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                                   onfocus="this.style.borderColor='#00A86B'" onblur="this.style.borderColor='#E2E8F0'">
                        </div>
                    </div>

                    {{-- Baris 2: Layanan / Poli yang Dikunjungi --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">
                            Layanan / Poliklinik yang Dikunjungi <span style="color: #EF4444;">*</span>
                        </label>
                        <select name="poli_name" required style="width: 100%; padding: 10px 14px; border-radius: 8px; border: 1.5px solid #E2E8F0; font-family: inherit; font-size: 13.5px; box-sizing: border-box; outline: none; background: #FFFFFF; cursor: pointer;">
                            <option value="Poli Umum" {{ old('poli_name') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                            <option value="Poli Gigi & Mulut" {{ old('poli_name') == 'Poli Gigi & Mulut' ? 'selected' : '' }}>Poli Gigi & Mulut</option>
                            <option value="Poli KIA & KB" {{ old('poli_name') == 'Poli KIA & KB' ? 'selected' : '' }}>Poli KIA & KB (Kesehatan Ibu & Anak)</option>
                            <option value="Layanan Farmasi & Obat" {{ old('poli_name') == 'Layanan Farmasi & Obat' ? 'selected' : '' }}>Layanan Farmasi & Apotek Obat</option>
                            <option value="Laboratorium Klinis" {{ old('poli_name') == 'Laboratorium Klinis' ? 'selected' : '' }}>Laboratorium Klinis</option>
                            <option value="Layanan UGD 24 Jam" {{ old('poli_name') == 'Layanan UGD 24 Jam' ? 'selected' : '' }}>Layanan UGD 24 Jam</option>
                        </select>
                    </div>

                    {{-- Baris 3: Rating Kualitas Pelayanan (4 Pill Buttons Persis Gambar 2) --}}
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1E293B; margin-bottom: 8px;">
                            Bagaimana kualitas pelayanan Puskesmas menurut Anda? <span style="color: #EF4444;">*</span>
                        </label>

                        <div class="rating-pill-group">
                            {{-- Sangat Puas (5) --}}
                            <label class="rating-pill-item">
                                <input type="radio" name="rating" value="5" {{ old('rating', '5') == '5' ? 'checked' : '' }} style="display: none;">
                                <span class="rating-pill-text" style="font-size: 13px; font-weight: 700; color: #334155;">Sangat Puas</span>
                            </label>

                            {{-- Puas (4) --}}
                            <label class="rating-pill-item">
                                <input type="radio" name="rating" value="4" {{ old('rating') == '4' ? 'checked' : '' }} style="display: none;">
                                <span class="rating-pill-text" style="font-size: 13px; font-weight: 700; color: #334155;">Puas</span>
                            </label>

                            {{-- Cukup (3) --}}
                            <label class="rating-pill-item">
                                <input type="radio" name="rating" value="3" {{ old('rating') == '3' ? 'checked' : '' }} style="display: none;">
                                <span class="rating-pill-text" style="font-size: 13px; font-weight: 700; color: #334155;">Cukup</span>
                            </label>

                            {{-- Kurang (2) --}}
                            <label class="rating-pill-item">
                                <input type="radio" name="rating" value="2" {{ old('rating') == '2' ? 'checked' : '' }} style="display: none;">
                                <span class="rating-pill-text" style="font-size: 13px; font-weight: 700; color: #334155;">Kurang</span>
                            </label>
                        </div>
                    </div>

                    {{-- Baris 4: Masukan dan Keluhan --}}
                    <div style="margin-bottom: 24px;">
                        <label style="display: block; font-size: 13.5px; font-weight: 700; color: #1E293B; margin-bottom: 6px;">
                            Masukan dan keluhan <span style="color: #EF4444;">*</span>
                        </label>
                        <textarea name="pesan" 
                                  rows="4" 
                                  placeholder="Tulis masukan atau keluhan Anda di sini....." 
                                  required 
                                  style="width: 100%; padding: 12px 14px; border-radius: 8px; border: 1.5px solid #E2E8F0; font-family: inherit; font-size: 13.5px; box-sizing: border-box; outline: none; resize: vertical; transition: border-color 0.2s;"
                                  onfocus="this.style.borderColor='#00A86B'" onblur="this.style.borderColor='#E2E8F0'">{{ old('pesan') }}</textarea>
                    </div>

                    {{-- Baris 4.5: Google reCAPTCHA --}}
                    <div style="margin-bottom: 24px;">
                        <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY', '6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI') }}"></div>
                        @error('g-recaptcha-response')
                            <span style="color: #EF4444; font-size: 12.5px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Baris 5: Tombol Kirim Real-Time --}}
                    <button type="submit" class="btn-submit-survei">
                        <span>Kirim Penilaian Real–Time</span>
                    </button>
                </form>
            </div>

        </div>

    </div>
</div>

@push('scripts')
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
@endsection
