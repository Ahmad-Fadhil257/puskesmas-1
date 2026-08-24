{{-- About / Tentang Kami Section --}}
<section class="about" id="tentang">
    <div class="about__inner">

        {{-- Left Column: Staggered Photos --}}
        <div class="about__images">
            <div class="about__img-wrap about__img-wrap--main">
                <img src="{{ isset($about) ? $about->image_main_url : asset('assets/about/about-1.jpg') }}"
                     alt="{{ $about->title ?? 'Tim medis profesional Puskesmas CareLink' }}"
                     class="about__img"
                     loading="lazy">
            </div>
            <div class="about__img-wrap about__img-wrap--accent">
                <img src="{{ isset($about) ? $about->image_accent_url : asset('assets/about/about-2.jpg') }}"
                     alt="{{ $about->title ?? 'Tenaga kesehatan berstandar tinggi Puskesmas CareLink' }}"
                     class="about__img"
                     loading="lazy">
            </div>
        </div>

        {{-- Right Column: Text Content --}}
        <div class="about__content">

            {{-- Badge --}}
            <div class="about__badge">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
                <span>{{ $about->badge_label ?? 'Tentang Kami' }}</span>
            </div>

            {{-- Heading H2 --}}
            <h2 class="about__title">
                {!! nl2br(e($about->title ?? 'Puskesmas CareLink  Menciptakan Pelayanan Aman, Kesehatan Adalah Prioritas Kami')) !!}
            </h2>

            {{-- Description --}}
            <p class="about__desc">
                {!! nl2br(e($about->description ?? 'Puskesmas CareLink menyediakan layanan kesehatan berkualitas tinggi dengan dokter berpengalaman, layanan gawat darurat, dan dukungan sepanjang waktu. Mitra tepercaya Anda untuk hidup yang lebih sehat.')) !!}
            </p>

            {{-- Visi & Misi Cards --}}
            <div class="about__cards">

                {{-- Visi --}}
                <div class="about__card">
                    <div class="about__card-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="3"/>
                            <path d="M2 12C2 12 5 5 12 5s10 7 10 7-3 7-10 7S2 12 2 12z"/>
                        </svg>
                    </div>
                    <h3 class="about__card-title">{{ $about->visi_title ?? 'Visi Kami' }}</h3>
                    <p class="about__card-text">
                        {!! nl2br(e($about->visi_text ?? 'Menjadi pemimpin tepercaya dalam layanan kesehatan yang berkualitas, mudah diakses, dan penuh kepedulian.')) !!}
                    </p>
                </div>

                {{-- Misi --}}
                <div class="about__card">
                    <div class="about__card-icon">
                        <svg viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V3s-1 1-4 1-5-2-8-2-4 1-4 1z"/>
                            <line x1="4" y1="22" x2="4" y2="15"/>
                        </svg>
                    </div>
                    <h3 class="about__card-title">{{ $about->misi_title ?? 'Misi Kami' }}</h3>
                    <p class="about__card-text">
                        {!! nl2br(e($about->misi_text ?? 'CareLink menghadirkan layanan ahli yang berfokus pada pasien, didukung oleh teknologi canggih dan layanan 24/7, serta berorientasi pada kesehatan dan kesejahteraan.')) !!}
                    </p>
                </div>

            </div>{{-- /.about__cards --}}
        </div>{{-- /.about__content --}}

    </div>{{-- /.about__inner --}}
</section>
