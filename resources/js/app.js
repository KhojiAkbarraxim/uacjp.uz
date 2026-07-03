const ready = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
};

(() => {
    const loader = document.querySelector('[data-page-loader]');
    if (!loader) {
        return;
    }

    const hideLoader = () => {
        loader.classList.remove('is-active');
        loader.classList.add('is-done');
    };

    const showLoader = () => {
        loader.classList.remove('is-done');
        // Force reflow so the transition restarts from scale-x-0 every time.
        void loader.offsetWidth;
        loader.classList.add('is-active');
    };

    const isModifiedClick = (event) =>
        event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey;

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');
        if (!link || isModifiedClick(event)) {
            return;
        }

        const url = new URL(link.href, window.location.href);
        const isSamePageAnchor = url.pathname === window.location.pathname && url.hash;
        const isExternal = url.origin !== window.location.origin;
        const opensNewTab = link.target && link.target !== '_self';
        const isSpecialScheme = /^(mailto|tel|javascript):/i.test(link.getAttribute('href') || '');

        if (isSamePageAnchor || isExternal || opensNewTab || isSpecialScheme || link.hasAttribute('download')) {
            return;
        }

        showLoader();
    });

    document.addEventListener('submit', (event) => {
        if (event.target instanceof HTMLFormElement && !event.defaultPrevented) {
            showLoader();
        }
    });

    window.addEventListener('pageshow', hideLoader);
})();

ready(() => {
    const mobileButton = document.querySelector('[data-mobile-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    const mobileOverlay = document.querySelector('[data-mobile-overlay]');
    const closeMenu = document.querySelector('[data-mobile-menu-close]');

    const toggleMenu = (open) => {
        if (!mobileMenu || !mobileOverlay || !mobileButton) {
            return;
        }

        mobileMenu.classList.toggle('translate-x-full', !open);
        mobileOverlay.classList.toggle('hidden', !open);
        mobileButton.setAttribute('aria-expanded', String(open));
        document.body.classList.toggle('overflow-hidden', open);
    };

    mobileButton?.addEventListener('click', () => {
        toggleMenu(mobileMenu?.classList.contains('translate-x-full'));
    });

    closeMenu?.addEventListener('click', () => toggleMenu(false));
    mobileOverlay?.addEventListener('click', () => toggleMenu(false));

    const filterButtons = document.querySelectorAll('[data-filter-button]');
    const memberCards = document.querySelectorAll('[data-member-card]');
    const currentFilters = { region: 'all', field: 'all' };

    const applyFilters = () => {
        memberCards.forEach((card) => {
            const regionMatch = currentFilters.region === 'all' || card.dataset.region === currentFilters.region;
            const fieldMatch = currentFilters.field === 'all' || card.dataset.field === currentFilters.field;

            card.classList.toggle('hidden', !(regionMatch && fieldMatch));
        });
    };

    filterButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const group = button.dataset.filterGroup;
            const value = button.dataset.filterValue;

            currentFilters[group] = value;

            filterButtons
                .forEach((candidate) => {
                    if (candidate.dataset.filterGroup === group) {
                        candidate.classList.toggle('is-active', candidate === button);
                    }
                });

            applyFilters();
        });
    });

    const faqButtons = document.querySelectorAll('[data-faq-button]');

    faqButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const expanded = button.getAttribute('aria-expanded') === 'true';
            const answer = document.getElementById(button.getAttribute('aria-controls'));
            const indicator = button.querySelector('[data-faq-indicator]');

            button.setAttribute('aria-expanded', String(!expanded));
            answer?.classList.toggle('hidden', expanded);
            if (indicator) {
                indicator.textContent = expanded ? '+' : '−';
            }
        });
    });

    // Generic click-to-open dropdown behaviour (nav "About" submenu, language switcher).
    const dropdowns = document.querySelectorAll('[data-dropdown]');

    const closeDropdown = (dropdown) => {
        const trigger = dropdown.querySelector('[data-dropdown-trigger]');
        const panel = dropdown.querySelector('[data-dropdown-panel]');
        panel?.classList.add('hidden');
        trigger?.setAttribute('aria-expanded', 'false');
        dropdown.classList.remove('is-open');
    };

    const openDropdown = (dropdown) => {
        dropdowns.forEach((candidate) => {
            if (candidate !== dropdown) {
                closeDropdown(candidate);
            }
        });

        const trigger = dropdown.querySelector('[data-dropdown-trigger]');
        const panel = dropdown.querySelector('[data-dropdown-panel]');
        panel?.classList.remove('hidden');
        trigger?.setAttribute('aria-expanded', 'true');
        dropdown.classList.add('is-open');
    };

    dropdowns.forEach((dropdown) => {
        const trigger = dropdown.querySelector('[data-dropdown-trigger]');

        trigger?.addEventListener('click', (event) => {
            event.stopPropagation();
            dropdown.classList.contains('is-open') ? closeDropdown(dropdown) : openDropdown(dropdown);
        });

        dropdown.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && dropdown.classList.contains('is-open')) {
                closeDropdown(dropdown);
                trigger?.focus();
            }
        });
    });

    document.addEventListener('click', (event) => {
        dropdowns.forEach((dropdown) => {
            if (!dropdown.contains(event.target)) {
                closeDropdown(dropdown);
            }
        });
    });

    const langButtons = document.querySelectorAll('[data-lang-button]');
    const langDropdowns = document.querySelectorAll('[data-lang-dropdown]');

    const setLanguage = (lang, persist) => {
        document.documentElement.lang = lang;

        const datasetKey = 'i18n' + lang.charAt(0).toUpperCase() + lang.slice(1);

        document.querySelectorAll('[data-i18n-en]').forEach((el) => {
            const value = el.dataset[datasetKey];
            if (value === undefined) {
                return;
            }

            const target = el.dataset.i18nTarget;
            if (target === 'text' || !target) {
                el.textContent = value;
            } else if (target === 'value') {
                el.value = value;
            } else {
                el.setAttribute(target, value);
            }
        });

        langButtons.forEach((btn) => {
            btn.classList.toggle('hidden', btn.dataset.langButton === lang);
        });

        langDropdowns.forEach((dropdown) => {
            const currentLabel = dropdown.querySelector('[data-lang-current]');
            if (currentLabel) {
                currentLabel.textContent = lang.toUpperCase();
            }
            closeDropdown(dropdown);
        });

        if (persist) {
            document.cookie = `locale=${lang}; path=/; max-age=31536000; samesite=Lax`;
        }
    };

    langButtons.forEach((button) => {
        button.addEventListener('click', () => setLanguage(button.dataset.langButton, true));
    });
});
