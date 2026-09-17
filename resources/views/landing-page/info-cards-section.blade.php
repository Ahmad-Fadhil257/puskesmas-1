{{-- Info Cards Section — antara Hero dan About (Dinamis dari Database) --}}
<section class="info-cards" id="info-cards">
    <div class="info-cards__inner">

        @if(isset($infoCards) && $infoCards->count() > 0)
            @foreach($infoCards as $card)
                <div class="info-card {{ $card->is_featured ? 'info-card--featured' : '' }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="info-card__icon">
                        @if($card->icon == 'doctor')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                <circle cx="12" cy="7" r="4"/>
                                <path d="M12 11v4M10 13h4"/>
                            </svg>
                        @elseif($card->icon == 'emergency')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M12 2l2.09 6.26L20 10l-5.91 1.74L12 18l-2.09-6.26L4 10l5.91-1.74L12 2z"/>
                                <path d="M12 6v2M12 14v2M8 10H6M18 10h-2"/>
                            </svg>
                        @elseif($card->icon == 'clock')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M12 6v6l4 2"/>
                            </svg>
                        @elseif($card->icon == 'shield')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        @elseif($card->icon == 'heart')
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                            </svg>
                        @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/>
                                <path d="M9 12l2 2 4-4"/>
                            </svg>
                        @endif
                    </div>
                    <div class="info-card__body">
                        <h3 class="info-card__title">{{ $card->title }}</h3>
                        <p class="info-card__desc">{{ $card->description }}</p>
                    </div>
                </div>
            @endforeach
        @else
            {{-- Fallback Default Jika Database Kosong --}}
            <div class="info-card" data-aos="fade-up">
                <div class="info-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                        <path d="M12 11v4M10 13h4"/>
                    </svg>
                </div>
                <div class="info-card__body">
                    <h3 class="info-card__title">Dokter Ahli</h3>
                    <p class="info-card__desc">Berkonsultasi dengan dokter berpengalaman.</p>
                </div>
            </div>

            <div class="info-card info-card--featured" data-aos="fade-up">
                <div class="info-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 2l2.09 6.26L20 10l-5.91 1.74L12 18l-2.09-6.26L4 10l5.91-1.74L12 2z"/>
                        <path d="M12 6v2M12 14v2M8 10H6M18 10h-2"/>
                    </svg>
                </div>
                <div class="info-card__body">
                    <h3 class="info-card__title">Pelayanan Gawat Darurat</h3>
                    <p class="info-card__desc">Layanan gawat darurat 24/7 siap membantu Anda.</p>
                </div>
            </div>

            <div class="info-card" data-aos="fade-up">
                <div class="info-card__icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 6v6l4 2"/>
                    </svg>
                </div>
                <div class="info-card__body">
                    <h3 class="info-card__title">24/7 Siap Melayani</h3>
                    <p class="info-card__desc">Kami siap melayani Anda kapan saja dan dimana saja.</p>
                </div>
            </div>
        @endif

    </div>
</section>
