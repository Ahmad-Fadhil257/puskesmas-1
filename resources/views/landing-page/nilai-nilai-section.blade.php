{{-- Nilai-Nilai Kami Section --}}
<section class="values" id="nilai-nilai">
    <div class="values__container">
        <div class="values__card">
            
            {{-- Badge / Subtitle --}}
            <div class="values__badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
                <span>{{ $nilaiSection->badge_text ?? 'NILAI - NILAI KAMI' }}</span>
            </div>

            {{-- Title --}}
            <h2 class="values__title">
                {{ $nilaiSection->title ?? 'Berdedikasi pada Keunggulan dalam Layanan Kesehatan melalui Kemitraan Terpercaya' }}
            </h2>

            {{-- Partners / Logos Carousel --}}
            <div class="values__partners-clip">
                <div class="values__partners" id="valuesCarousel">
                    <div class="values__partner-item">
                        <img src="{{ $nilaiSection ? $nilaiSection->logo_1_url : asset('assets/nilai-nilai/logo-bpjs.png') }}" 
                             alt="{{ $nilaiSection->logo_1_name ?? 'BPJS Kesehatan' }}" 
                             class="values__partner-logo">
                    </div>
                    <div class="values__partner-item">
                        <img src="{{ $nilaiSection ? $nilaiSection->logo_2_url : asset('assets/nilai-nilai/logo-kemenkes.png') }}" 
                             alt="{{ $nilaiSection->logo_2_name ?? 'Kementerian Kesehatan Republik Indonesia' }}" 
                             class="values__partner-logo">
                    </div>
                    <div class="values__partner-item">
                        <img src="{{ $nilaiSection ? $nilaiSection->logo_3_url : asset('assets/nilai-nilai/logo-puskesmas.png') }}" 
                             alt="{{ $nilaiSection->logo_3_name ?? 'Mitra Kesehatan Puskesmas' }}" 
                             class="values__partner-logo">
                    </div>
                </div>
            </div>

            {{-- Dots Indicator --}}
            <div class="values__dots" id="valuesDots">
                <span class="values__dot values__dot--active"></span>
                <span class="values__dot"></span>
                <span class="values__dot"></span>
            </div>

        </div>
    </div>
</section>

<script>
(function() {
    var carousel = document.getElementById('valuesCarousel');
    var dots     = document.querySelectorAll('#valuesDots .values__dot');
    var current  = 0;
    if (!carousel || !dots.length) return;

    carousel.addEventListener('scroll', function() {
        var idx = Math.round(carousel.scrollLeft / carousel.offsetWidth);
        if (idx !== current) {
            current = idx;
            dots.forEach(function(d, i) {
                d.classList.toggle('values__dot--active', i === current);
            });
        }
    });
})();
</script>
