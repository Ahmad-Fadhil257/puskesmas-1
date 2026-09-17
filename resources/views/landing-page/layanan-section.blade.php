@if(isset($layanans) && $layanans->isNotEmpty())
<!-- Layanan Section -->
<section class="layanan-section" id="layanan">
    <div class="layanan-container">

        <!-- Section Header -->
        <div class="layanan-header" data-aos="fade-up">
            <div class="layanan-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                </svg>
                <span>PELAYANAN UNGGULAN</span>
            </div>
            <h2 class="layanan-title">
                Layanan {{ $appSetting->app_name ?? 'Puskesmas' }}
            </h2>
            <div class="layanan-title-line" aria-hidden="true"></div>
            <p class="layanan-subtitle">
                Kami menyediakan berbagai layanan kesehatan yang komprehensif dan mudah diakses
            </p>
        </div>

        <!-- Grid Layanan (Simple, Clean, Human-crafted) -->
        <div class="layanan-grid">
            @foreach($layanans as $index => $layanan)
                <a href="{{ route('layanan.detail', $layanan->slug) }}" class="layanan-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 60 }}">
                    <div class="layanan-card__icon">
                        {!! $layanan->icon_html !!}
                    </div>
                    <div class="layanan-card__body">
                        <h3 class="layanan-card__title">{{ $layanan->title }}</h3>
                        <p class="layanan-card__desc">
                            {{ \Illuminate\Support\Str::limit(strip_tags($layanan->description), 85) }}
                        </p>
                        <span class="layanan-card__link">
                            <span>Lihat detail</span>
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </span>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- CTA Button -->
        <div class="layanan-cta" data-aos="fade-up" data-aos-delay="150">
            <a href="{{ route('layanan.index') }}" class="layanan-cta__btn">
                <span>Lihat Semua Layanan</span>
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </a>
        </div>

    </div>
</section>
@endif
