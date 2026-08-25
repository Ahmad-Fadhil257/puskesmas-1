@extends('layouts.app')

@section('title', 'Survei Kepuasan Masyarakat (SKM) - ' . config('app.name'))
@section('meta_description', 'Berikan penilaian dan masukan Anda mengenai mutu pelayanan kesehatan di Puskesmas melalui Formulir Survei Kepuasan Masyarakat (SKM).')

@push('styles')
<style>
/* Full Width Dark Emerald Header (Ijo Tua Persis Berita & Layanan) */
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
    padding: 48px 24px 80px;
}

.rating-choice-card:has(input:checked) {
    background: #E6F5F1 !important;
    border-color: #0A5C45 !important;
    box-shadow: 0 4px 14px rgba(10, 92, 69, 0.15) !important;
}

.rating-choice-card:hover {
    border-color: #0A5C45 !important;
    transform: translateY(-2px);
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
   MAIN CONTENT WRAPPER
   ========================================================================= --}}
<div class="survei-content-wrapper">
    <div style="max-width: 1080px; margin: 0 auto; width: 100%;">

        {{-- Alert Notifikasi Sukses --}}
        @if(session('survey_success'))
            <div style="margin-bottom: 32px; background: #FFFFFF; border-left: 6px solid #0A5C45; border-radius: 16px; padding: 20px 24px; box-shadow: 0 10px 30px rgba(10, 92, 69, 0.12); display: flex; align-items: center; gap: 16px;">
                <div style="width: 48px; height: 48px; border-radius: 50%; background: #E6F5F1; display: flex; align-items: center; justify-content: center; font-size: 24px; color: #0A5C45; flex-shrink: 0;">
                    <i class="bx bx-check"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px 0; color: #0A5C45; font-size: 16px; font-weight: 800;">Survei Berhasil Dikirim!</h4>
                    <p style="margin: 0; color: #40564F; font-size: 14px; line-height: 1.5;">{{ session('survey_success') }}</p>
                </div>
            </div>
        @endif

        {{-- STATISTIK IKM (Indeks Kepuasan Masyarakat) --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 40px;">
            {{-- Widget 1: Skor IKM --}}
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(10, 92, 69, 0.06); border: 1px solid #D6E8E2; display: flex; align-items: center; gap: 16px;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #FEF3C7; display: flex; align-items: center; justify-content: center; font-size: 26px; color: #F59E0B; flex-shrink: 0;">
                    <i class="bx bxs-star"></i>
                </div>
                <div>
                    <span style="font-size: 12px; font-weight: 700; color: #6E857E; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 2px;">Indeks Kepuasan (IKM)</span>
                    <div style="display: flex; align-items: baseline; gap: 6px;">
                        <span style="font-size: 28px; font-weight: 800; color: #122822; line-height: 1;">{{ $avgRating }}</span>
                        <span style="font-size: 14px; color: #6E857E; font-weight: 600;">/ 5.0</span>
                    </div>
                    <small style="color: #0A5C45; font-weight: 700; font-size: 12px;">Mutu A (Sangat Baik)</small>
                </div>
            </div>

            {{-- Widget 2: Persentase Kepuasan --}}
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(10, 92, 69, 0.06); border: 1px solid #D6E8E2; display: flex; align-items: center; gap: 16px;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #DCFCE7; display: flex; align-items: center; justify-content: center; font-size: 26px; color: #16A34A; flex-shrink: 0;">
                    <i class="bx bx-happy-beaming"></i>
                </div>
                <div>
                    <span style="font-size: 12px; font-weight: 700; color: #6E857E; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 2px;">Tingkat Kepuasan</span>
                    <div style="display: flex; align-items: baseline; gap: 6px;">
                        <span style="font-size: 28px; font-weight: 800; color: #122822; line-height: 1;">{{ $satisfactionPct }}%</span>
                    </div>
                    <small style="color: #16A34A; font-weight: 700; font-size: 12px;">Pasien Puas & Sangat Puas</small>
                </div>
            </div>

            {{-- Widget 3: Total Responden --}}
            <div style="background: #FFFFFF; border-radius: 20px; padding: 24px; box-shadow: 0 4px 20px rgba(10, 92, 69, 0.06); border: 1px solid #D6E8E2; display: flex; align-items: center; gap: 16px;">
                <div style="width: 52px; height: 52px; border-radius: 14px; background: #E0F2FE; display: flex; align-items: center; justify-content: center; font-size: 26px; color: #0284C7; flex-shrink: 0;">
                    <i class="bx bx-user-voice"></i>
                </div>
                <div>
                    <span style="font-size: 12px; font-weight: 700; color: #6E857E; text-transform: uppercase; letter-spacing: 0.05em; display: block; margin-bottom: 2px;">Total Responden</span>
                    <div style="display: flex; align-items: baseline; gap: 6px;">
                        <span style="font-size: 28px; font-weight: 800; color: #122822; line-height: 1;">{{ $totalResponden }}</span>
                        <span style="font-size: 14px; color: #6E857E; font-weight: 600;">Orang</span>
                    </div>
                    <small style="color: #0284C7; font-weight: 700; font-size: 12px;">Data Terverifikasi</small>
                </div>
            </div>
        </div>

        {{-- FORMULIR SURVEI KEPUASAN (Card Form Utama) --}}
        <div style="background: #FFFFFF; border-radius: 24px; padding: 40px 36px; box-shadow: 0 10px 30px rgba(10, 92, 69, 0.08); border: 1px solid #D6E8E2; margin-bottom: 56px;">
            <div style="border-bottom: 1.5px solid #EDF4F1; padding-bottom: 20px; margin-bottom: 28px;">
                <h3 style="font-size: 22px; font-weight: 800; color: #0A5C45; margin: 0 0 6px 0;">
                    Formulir Evaluasi Pelayanan Pasien
                </h3>
                <p style="font-size: 14px; color: #6E857E; margin: 0;">
                    Silakan isi formulir di bawah ini dengan jujur sesuai pengalaman Anda saat berobat di Puskesmas.
                </p>
            </div>

            @if ($errors->any())
                <div style="background: #FEF2F2; border-left: 5px solid #EF4444; border-radius: 12px; padding: 14px 18px; margin-bottom: 24px;">
                    <strong style="color: #B91C1C; font-size: 14px; display: block; margin-bottom: 4px;">Harap perbaiki beberapa input berikut:</strong>
                    <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #B91C1C;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('survei.store') }}" method="POST">
                @csrf

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 24px;">
                    {{-- Nama --}}
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #122822; margin-bottom: 8px;">
                            Nama Lengkap / Inisial Pasien <span style="color: #E8672C;">*</span>
                        </label>
                        <input type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               placeholder="Contoh: Rina Anggraini / R.A." 
                               required 
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #D6E8E2; font-family: inherit; font-size: 14px; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                               onfocus="this.style.borderColor='#0A5C45'" onblur="this.style.borderColor='#D6E8E2'">
                    </div>

                    {{-- No HP / Email --}}
                    <div>
                        <label style="display: block; font-size: 14px; font-weight: 700; color: #122822; margin-bottom: 8px;">
                            No. WhatsApp / Email <span style="font-size: 12px; color: #6E857E; font-weight: 400;">(Opsional)</span>
                        </label>
                        <input type="text" 
                               name="email_or_phone" 
                               value="{{ old('email_or_phone') }}" 
                               placeholder="Contoh: 08123456789 atau nama@email.com" 
                               style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #D6E8E2; font-family: inherit; font-size: 14px; box-sizing: border-box; outline: none; transition: border-color 0.2s;"
                               onfocus="this.style.borderColor='#0A5C45'" onblur="this.style.borderColor='#D6E8E2'">
                    </div>
                </div>

                {{-- Layanan / Poli --}}
                <div style="margin-bottom: 28px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #122822; margin-bottom: 8px;">
                        Layanan / Poliklinik yang Dikunjungi <span style="color: #E8672C;">*</span>
                    </label>
                    <select name="poli_name" required style="width: 100%; padding: 12px 16px; border-radius: 12px; border: 1.5px solid #D6E8E2; font-family: inherit; font-size: 14px; box-sizing: border-box; outline: none; background: #FFFFFF; cursor: pointer;">
                        <option value="Poli Umum" {{ old('poli_name') == 'Poli Umum' ? 'selected' : '' }}>Poli Umum</option>
                        <option value="Poli Gigi & Mulut" {{ old('poli_name') == 'Poli Gigi & Mulut' ? 'selected' : '' }}>Poli Gigi & Mulut</option>
                        <option value="Poli KIA & KB" {{ old('poli_name') == 'Poli KIA & KB' ? 'selected' : '' }}>Poli KIA & KB (Kesehatan Ibu & Anak)</option>
                        <option value="Layanan Farmasi & Obat" {{ old('poli_name') == 'Layanan Farmasi & Obat' ? 'selected' : '' }}>Layanan Farmasi & Apotek Obat</option>
                        <option value="Laboratorium Klinis" {{ old('poli_name') == 'Laboratorium Klinis' ? 'selected' : '' }}>Laboratorium Klinis</option>
                        <option value="Layanan UGD 24 Jam" {{ old('poli_name') == 'Layanan UGD 24 Jam' ? 'selected' : '' }}>Layanan UGD 24 Jam</option>
                    </select>
                </div>

                {{-- Rating Kepuasan Interaktif (Menggunakan Icon Bersih Tanpa Emoticon) --}}
                <div style="margin-bottom: 28px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #122822; margin-bottom: 8px;">
                        Bagaimana Tingkat Kepuasan Anda Terhadap Pelayanan? <span style="color: #E8672C;">*</span>
                    </label>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(130px, 1fr)); gap: 12px;" id="ratingChoiceGroup">
                        <label class="rating-choice-card" style="cursor: pointer; border: 2px solid #D6E8E2; border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.2s; background: #F8FAF9; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                            <input type="radio" name="rating" value="5" {{ old('rating', '5') == '5' ? 'checked' : '' }} style="display: none;">
                            <i class="bx bxs-smile" style="font-size: 28px; color: #16A34A;"></i>
                            <span style="font-size: 13px; font-weight: 700; color: #122822;">Sangat Puas</span>
                            <span style="font-size: 11px; color: #F59E0B; font-weight: 700;">5 Bintang</span>
                        </label>

                        <label class="rating-choice-card" style="cursor: pointer; border: 2px solid #D6E8E2; border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.2s; background: #F8FAF9; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                            <input type="radio" name="rating" value="4" {{ old('rating') == '4' ? 'checked' : '' }} style="display: none;">
                            <i class="bx bx-smile" style="font-size: 28px; color: #0A5C45;"></i>
                            <span style="font-size: 13px; font-weight: 700; color: #122822;">Puas</span>
                            <span style="font-size: 11px; color: #F59E0B; font-weight: 700;">4 Bintang</span>
                        </label>

                        <label class="rating-choice-card" style="cursor: pointer; border: 2px solid #D6E8E2; border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.2s; background: #F8FAF9; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                            <input type="radio" name="rating" value="3" {{ old('rating') == '3' ? 'checked' : '' }} style="display: none;">
                            <i class="bx bx-meh" style="font-size: 28px; color: #0284C7;"></i>
                            <span style="font-size: 13px; font-weight: 700; color: #122822;">Cukup</span>
                            <span style="font-size: 11px; color: #F59E0B; font-weight: 700;">3 Bintang</span>
                        </label>

                        <label class="rating-choice-card" style="cursor: pointer; border: 2px solid #D6E8E2; border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.2s; background: #F8FAF9; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                            <input type="radio" name="rating" value="2" {{ old('rating') == '2' ? 'checked' : '' }} style="display: none;">
                            <i class="bx bx-sad" style="font-size: 28px; color: #EA580C;"></i>
                            <span style="font-size: 13px; font-weight: 700; color: #122822;">Kurang Puas</span>
                            <span style="font-size: 11px; color: #F59E0B; font-weight: 700;">2 Bintang</span>
                        </label>

                        <label class="rating-choice-card" style="cursor: pointer; border: 2px solid #D6E8E2; border-radius: 16px; padding: 16px 12px; text-align: center; transition: all 0.2s; background: #F8FAF9; display: flex; flex-direction: column; align-items: center; gap: 6px;">
                            <input type="radio" name="rating" value="1" {{ old('rating') == '1' ? 'checked' : '' }} style="display: none;">
                            <i class="bx bx-angry" style="font-size: 28px; color: #DC2626;"></i>
                            <span style="font-size: 13px; font-weight: 700; color: #122822;">Tidak Puas</span>
                            <span style="font-size: 11px; color: #F59E0B; font-weight: 700;">1 Bintang</span>
                        </label>
                    </div>
                </div>

                {{-- Ulasan / Masukan --}}
                <div style="margin-bottom: 32px;">
                    <label style="display: block; font-size: 14px; font-weight: 700; color: #122822; margin-bottom: 8px;">
                        Ulasan, Kritik, atau Saran Perbaikan Pelayanan <span style="color: #E8672C;">*</span>
                    </label>
                    <textarea name="pesan" 
                              rows="4" 
                              placeholder="Ceritakan pengalaman Anda selama mendapatkan pelayanan medis di Puskesmas..." 
                              required 
                              style="width: 100%; padding: 14px 16px; border-radius: 12px; border: 1.5px solid #D6E8E2; font-family: inherit; font-size: 14px; box-sizing: border-box; outline: none; resize: vertical; transition: border-color 0.2s;"
                              onfocus="this.style.borderColor='#0A5C45'" onblur="this.style.borderColor='#D6E8E2'">{{ old('pesan') }}</textarea>
                </div>

                {{-- Submit Button --}}
                <div style="display: flex; justify-content: flex-end;">
                    <button type="submit" style="background: #0A5C45; color: #FFFFFF; font-family: inherit; font-size: 15px; font-weight: 700; padding: 14px 36px; border-radius: 9999px; border: none; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 16px rgba(10, 92, 69, 0.35); display: inline-flex; align-items: center; gap: 8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        <span>Kirim Penilaian Survei</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- Ulasan Terbaru Pasien --}}
        @if(isset($recentSurveys) && $recentSurveys->count() > 0)
        <div>
            <div style="text-align: center; margin-bottom: 32px;">
                <h3 style="font-size: 22px; font-weight: 800; color: #122822; margin: 0 0 8px 0;">
                    Ulasan Pasien Terkini
                </h3>
                <p style="font-size: 14px; color: #6E857E; margin: 0;">
                    Transparansi evaluasi dan masukan nyata dari masyarakat Puskesmas.
                </p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                @foreach($recentSurveys as $review)
                <div style="background: #FFFFFF; border-radius: 16px; padding: 24px; border: 1px solid #E2E8F0; box-shadow: 0 2px 10px rgba(0,0,0,0.03); display: flex; flex-direction: column; justify-content: space-between; gap: 16px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="{{ $review->avatar_url }}" alt="{{ $review->name }}" style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover;">
                                <div>
                                    <strong style="display: block; font-size: 14px; color: #122822;">{{ $review->name }}</strong>
                                    <small style="color: #6E857E; font-size: 12px;">{{ $review->poli_name }}</small>
                                </div>
                            </div>
                            <div class="d-flex text-warning" style="font-size: 14px;">
                                @for($i = 1; $i <= $review->rating; $i++)
                                    <i class="bx bxs-star"></i>
                                @endfor
                            </div>
                        </div>
                        <p style="font-size: 13.5px; color: #40564F; line-height: 1.55; margin: 0;">
                            "{{ $review->pesan }}"
                        </p>
                    </div>
                    <div style="border-top: 1px solid #F1F5F9; padding-top: 10px;">
                        <small style="color: #94A3B8; font-size: 11px;">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
