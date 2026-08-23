{{-- ======================================================
     SECTION: DOKTER KAMI
     Background hijau gelap, 4 kartu dokter berjejer
     ====================================================== --}}

<style>
/* ===== Section Dokter Kami ===== */
.dokter-section {
    background-color: #1a5c3e;
    padding: 72px 48px 80px;
    font-family: 'Inter', ui-sans-serif, system-ui, sans-serif;
}

/* --- Container --- */
.dokter-container {
    max-width: 1080px;
    margin: 0 auto;
}

/* ===== HEADER ===== */
.dokter-header {
    text-align: center;
    margin-bottom: 52px;
}

.dokter-label {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    font-size: 11.5px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.75);
    margin-bottom: 16px;
}

.dokter-label svg {
    width: 14px;
    height: 14px;
    flex-shrink: 0;
    opacity: 0.85;
}

.dokter-title {
    font-size: 2.1rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 14px 0;
    line-height: 1.2;
    letter-spacing: -0.01em;
}

.dokter-subtitle {
    font-size: 0.93rem;
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.65;
    margin: 0;
}

/* ===== DOCTORS GRID ===== */
.dokter-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
}

/* ===== DOCTOR CARD ===== */
.dokter-card {
    display: flex;
    flex-direction: column;
}

/* --- Photo wrapper --- */
.dokter-photo-wrap {
    width: 100%;
    aspect-ratio: 4/5;
    border-radius: 14px;
    overflow: hidden;
    margin-bottom: 16px;
    background-color: rgba(255, 255, 255, 0.1);
    position: relative;
}

.dokter-photo-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: top center;
    display: block;
    transition: transform 0.35s ease;
}

.dokter-card:hover .dokter-photo-wrap img {
    transform: scale(1.04);
}

/* --- Text --- */
.dokter-name {
    font-size: 1rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 4px 0;
    line-height: 1.3;
}

.dokter-specialty {
    font-size: 0.865rem;
    color: rgba(255, 255, 255, 0.65);
    margin: 0;
    line-height: 1.5;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
    .dokter-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    .dokter-section {
        padding: 56px 24px 64px;
    }
}

@media (max-width: 520px) {
    .dokter-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    .dokter-title {
        font-size: 1.65rem;
    }
    .dokter-section {
        padding: 48px 16px 56px;
    }
}
</style>

<section class="dokter-section" id="dokter-kami">
    <div class="dokter-container">

        {{-- ---- HEADER ---- --}}
        <div class="dokter-header">

            <div class="dokter-label">
                {{-- Ikon dokter/orang --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.77C4.484 10.426 5.980 10 8 10c.145 0 .288.004.43.01a4.5 4.5 0 0 1 .288-.97C8.51 9.015 8.27 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                </svg>
                DOKTER KAMI
            </div>

            <h2 class="dokter-title">Kenali Dokter Spesialis Kami</h2>

            <p class="dokter-subtitle">
                Tim dokter spesialis kami berdedikasi untuk memberikan<br>
                layanan ahli di berbagai bidang medis.
            </p>

        </div>
        {{-- END HEADER --}}

        {{-- ---- DOCTORS GRID ---- --}}
        <div class="dokter-grid">

            {{-- Dokter 1 --}}
            <div class="dokter-card">
                <div class="dokter-photo-wrap">
                    <img src="{{ asset('images/dokter/dokter_john.png') }}" alt="Dr. John Smith">
                </div>
                <h3 class="dokter-name">Dr. John Smith</h3>
                <p class="dokter-specialty">Ahli jantung</p>
            </div>

            {{-- Dokter 2 --}}
            <div class="dokter-card">
                <div class="dokter-photo-wrap">
                    <img src="{{ asset('images/dokter/dokter_sarah.png') }}" alt="Dr. Sarah Johnson">
                </div>
                <h3 class="dokter-name">Dr. Sarah Johnson</h3>
                <p class="dokter-specialty">Dokter Bedah Ortopedi</p>
            </div>

            {{-- Dokter 3 --}}
            <div class="dokter-card">
                <div class="dokter-photo-wrap">
                    <img src="{{ asset('images/dokter/dokter_michael.png') }}" alt="Dr. Michael Lee">
                </div>
                <h3 class="dokter-name">Dr. Michael Lee</h3>
                <p class="dokter-specialty">Dokter spesialis anak</p>
            </div>

            {{-- Dokter 4 --}}
            <div class="dokter-card">
                <div class="dokter-photo-wrap">
                    <img src="{{ asset('images/dokter/dokter_emily.png') }}" alt="Dr. Emily Davis">
                </div>
                <h3 class="dokter-name">Dr. Emily Davis</h3>
                <p class="dokter-specialty">Ginekolog</p>
            </div>

        </div>
        {{-- END GRID --}}

    </div>
</section>
