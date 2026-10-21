(() => {
    const overlay = document.querySelector('[data-boot-overlay]');
    const content = document.querySelector('[data-site-content]');

    if (!overlay || !content) {
        return;
    }

    const STORAGE_KEY = 'uacBootOverlayPlayed';
    const FULL_MIN_DELAY_MS = 350;
    const REPEAT_MIN_DELAY_MS = 150;
    const HARD_TIMEOUT_MS = 2000;

    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const alreadyPlayed = sessionStorage.getItem(STORAGE_KEY) === '1';
    const minDelayMs = alreadyPlayed ? REPEAT_MIN_DELAY_MS : FULL_MIN_DELAY_MS;

    if (prefersReducedMotion) {
        overlay.classList.add('is-static');
    }

    const wait = (ms) => new Promise((resolve) => setTimeout(resolve, ms));

    const fontsReady = document.fonts && document.fonts.ready
        ? document.fonts.ready
        : Promise.resolve();

    const dismiss = () => {
        sessionStorage.setItem(STORAGE_KEY, '1');

        if (prefersReducedMotion) {
            overlay.style.display = 'none';
            overlay.setAttribute('aria-hidden', 'true');
            content.style.transition = 'none';
            content.classList.add('is-visible');
            return;
        }

        overlay.classList.add('is-dismissing');
        overlay.setAttribute('aria-hidden', 'true');
        content.classList.add('is-visible');

        const finish = () => {
            overlay.style.display = 'none';
        };

        overlay.addEventListener('transitionend', finish, { once: true });
        // Fallback in case transitionend never fires (e.g. element already
        // hidden by other means), so the overlay can't get stuck on top.
        setTimeout(finish, 400);
    };

    // Never let a stalled fonts.ready promise keep the overlay up forever.
    Promise.race([
        Promise.all([fontsReady, wait(minDelayMs)]),
        wait(HARD_TIMEOUT_MS),
    ]).then(dismiss);
})();
