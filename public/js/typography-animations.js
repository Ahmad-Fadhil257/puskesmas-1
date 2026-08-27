/**
 * ============================================================================
 * TYPOGRAPHY AOS ENGINE - PUSKESMAS CARELINK (EXTENDED 2.2s DURATION)
 * ============================================================================
 * Menginisialisasi Animate On Scroll dengan durasi 2200ms & kurva deselerasi sutra.
 */

(function () {
    'use strict';

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    function startAos() {
        if (typeof AOS === 'undefined') {
            setTimeout(startAos, 50);
            return;
        }

        AOS.init({
            duration: 2200,                            // 2.2 detik: Lebih tenang, lambat & anggun
            easing: 'cubic-bezier(0.08, 0.95, 0.15, 1)', // Easing super smooth
            once: false,                               // Animasi berulang saat di-scroll bolak-balik
            mirror: true,                              // Re-trigger animasi keluar & masuk
            offset: 90,                                // Titik pandang ideal
            delay: 0,
            anchorPlacement: 'top-bottom',
            disable: prefersReducedMotion
        });

        // Trigger reflow untuk render awal
        setTimeout(() => {
            AOS.refreshHard();
        }, 120);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startAos);
    } else {
        startAos();
    }

    window.addEventListener('load', () => {
        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
    });

    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (typeof AOS !== 'undefined') {
                AOS.refresh();
            }
        }, 200);
    }, { passive: true });

})();
