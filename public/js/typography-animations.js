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
            duration: 2200,
            easing: 'cubic-bezier(0.08, 0.95, 0.15, 1)',
            once: false,
            mirror: true,
            offset: 90,
            delay: 0,
            anchorPlacement: 'top-bottom',
            disable: prefersReducedMotion
        });

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
