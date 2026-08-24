<section class="layanan-section" id="layanan-kami">
    <div class="layanan-container">

        {{-- ---- HEADER ---- --}}
        <div class="layanan-header">

            <div class="layanan-label">
                {{-- Ikon gedung/rumah --}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z"/>
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z"/>
                </svg>
                LAYANAN KAMI
            </div>

            <h2 class="layanan-title">Solusi Layanan Kesehatan Komprehensif</h2>

            <p class="layanan-subtitle">
                Di CareLink, kami menawarkan beragam layanan medis yang disesuaikan dengan kebutuhan Anda,<br>
                mulai dari pemeriksaan rutin hingga perawatan khusus.
            </p>

        </div>
        {{-- END HEADER --}}

        {{-- ---- CARDS GRID (Dinamis dari Database) ---- --}}
        <div class="layanan-grid">

            @forelse($layanans as $item)
                @if($item->variant === 'emergency')
                    {{-- Emergency Card (Merah) --}}
                    <div class="layanan-card layanan-card--emergency">
                        <h3 class="layanan-card-title">{{ $item->title }}</h3>
                        <p class="layanan-card-desc">{{ $item->description }}</p>
                        @if($item->btn_text)
                            <a href="{{ $item->btn_link ?? '#kontak' }}" class="layanan-emergency-btn">
                                {{ $item->btn_text }} <i class="bx bx-right-arrow-alt" style="font-size: 1.2em;"></i>
                            </a>
                        @endif
                    </div>
                @elseif($item->variant === 'featured')
                    {{-- Featured Card (Hijau Gelap) --}}
                    <div class="layanan-card layanan-card--featured">
                        <div class="layanan-card-icon">
                            {!! $item->icon_html !!}
                        </div>
                        <h3 class="layanan-card-title">{{ $item->title }}</h3>
                        <p class="layanan-card-desc">{{ $item->description }}</p>
                        @if($item->btn_text)
                            <a href="{{ $item->btn_link ?? '#' }}" class="layanan-emergency-btn mt-3">
                                {{ $item->btn_text }} <i class="bx bx-right-arrow-alt" style="font-size: 1.2em;"></i>
                            </a>
                        @endif
                    </div>
                @else
                    {{-- Default Card (Standar) --}}
                    <div class="layanan-card">
                        <div class="layanan-card-icon">
                            {!! $item->icon_html !!}
                        </div>
                        <h3 class="layanan-card-title">{{ $item->title }}</h3>
                        <p class="layanan-card-desc">{{ $item->description }}</p>
                    </div>
                @endif
            @empty
                <p class="text-center text-muted" style="grid-column: 1/-1; padding: 40px 0;">
                    Belum ada layanan yang ditambahkan.
                </p>
            @endforelse

        </div>
        {{-- END GRID --}}

    </div>
</section>
