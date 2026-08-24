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

        {{-- ---- DOCTORS GRID (Dinamis dari database) ---- --}}
        <div class="dokter-grid dokter-grid--{{ $dokters->count() <= 4 ? 'four' : 'many' }}">

            @forelse($dokters as $dokter)
            <div class="dokter-card">
                <div class="dokter-photo-wrap">
                    @if($dokter->photo)
                        <img src="{{ asset($dokter->photo) }}" alt="{{ $dokter->name }}" loading="lazy">
                    @else
                        {{-- Placeholder avatar jika tidak ada foto --}}
                        <div class="dokter-no-photo">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16" style="width:48px;height:48px;opacity:0.4;">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm-5 8s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <h3 class="dokter-name">{{ $dokter->name }}</h3>
                <p class="dokter-specialty">{{ $dokter->specialty }}</p>
            </div>
            @empty
            <p class="text-center" style="color: rgba(255,255,255,0.6); grid-column: 1/-1; padding: 40px 0;">
                Belum ada data dokter yang ditampilkan.
            </p>
            @endforelse

        </div>
        {{-- END GRID --}}

    </div>
</section>
