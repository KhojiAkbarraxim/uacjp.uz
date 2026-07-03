@php
    $navByRoute = collect($navigation)->keyBy('route');

    $primaryLinks = collect(['home', 'activities', 'regions.index'])
        ->map(fn ($route) => $navByRoute->get($route))
        ->filter()
        ->values();

    $aboutItem = $navByRoute->get('about');
    $aboutChildren = collect(['members.index', 'partners'])
        ->map(fn ($route) => $navByRoute->get($route))
        ->filter()
        ->values();

    $contactItem = $navByRoute->get('contact');
    $isAboutGroupActive = request()->routeIs(['about', 'members.*', 'partners']);
@endphp

<header class="fixed inset-x-0 top-0 z-50 border-b border-white/70 bg-white/80 backdrop-blur">
    <div class="container-shell flex h-20 items-center justify-between gap-6">
        <a href="{{ route('home') }}" class="flex items-center">
            <img
                src="{{ asset('images/uac-japan-logo.webp') }}"
                width="320"
                height="320"
                alt="UAC Japan logo"
                class="h-24 w-auto origin-left scale-x-[1.3] sm:h-28"
                fetchpriority="high"
                decoding="async"
            >
        </a>

        <nav class="hidden items-center gap-1 lg:flex" aria-label="Primary">
            @foreach ($primaryLinks as $item)
                <x-i18n
                    :text="$item['label']"
                    tag="a"
                    href="{{ route($item['route']) }}"
                    class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"
                />
            @endforeach

            @if ($aboutItem)
                <div class="relative" data-dropdown>
                    <button
                        type="button"
                        class="nav-link inline-flex items-center gap-1 {{ $isAboutGroupActive ? 'nav-link-active' : '' }}"
                        data-dropdown-trigger
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <x-i18n :text="$aboutItem['label']" tag="span" />
                        <svg class="h-3.5 w-3.5" data-dropdown-chevron viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="dropdown-panel left-0 hidden" data-dropdown-panel role="menu">
                        <a href="{{ route($aboutItem['route']) }}" role="menuitem" class="dropdown-item {{ request()->routeIs($aboutItem['route']) ? 'is-active' : '' }}">
                            <x-i18n :text="$aboutItem['label']" />
                        </a>
                        @foreach ($aboutChildren as $child)
                            <a href="{{ route($child['route']) }}" role="menuitem" class="dropdown-item {{ request()->routeIs($child['route']) ? 'is-active' : '' }}">
                                <x-i18n :text="$child['label']" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($contactItem)
                <x-i18n
                    :text="$contactItem['label']"
                    tag="a"
                    href="{{ route($contactItem['route']) }}"
                    class="nav-link {{ request()->routeIs($contactItem['route']) ? 'nav-link-active' : '' }}"
                />
            @endif
        </nav>

        <div class="hidden items-center gap-3 lg:flex">
            <div class="relative" data-dropdown data-lang-dropdown>
                <button
                    type="button"
                    class="lang-trigger inline-flex items-center gap-1.5 rounded-full border border-line bg-white px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.08em] text-primary transition hover:border-primary/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                    data-dropdown-trigger
                    aria-haspopup="true"
                    aria-expanded="false"
                    aria-label="{{ ui('lang_switcher.label')[app()->getLocale()] }}"
                >
                    <span data-lang-current>{{ strtoupper(app()->getLocale()) }}</span>
                    <svg class="h-3 w-3" data-dropdown-chevron viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="dropdown-panel right-0 left-0 min-w-0 hidden" data-dropdown-panel role="menu">
                    @foreach (config('i18n.locales') as $code => $label)
                        <button
                            type="button"
                            class="dropdown-item w-full text-left {{ app()->getLocale() === $code ? 'hidden' : '' }}"
                            data-lang-button="{{ $code }}"
                            role="menuitem"
                        >{{ strtoupper($code) }}</button>
                    @endforeach
                </div>
            </div>
            <x-i18n :text="ui('common.join_uac')" tag="a" href="{{ route('join') }}" class="btn-primary" />
        </div>

        <button
            type="button"
            class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-line bg-white text-primary lg:hidden"
            aria-label="Open menu"
            aria-expanded="false"
            data-mobile-menu-button
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round"/>
            </svg>
        </button>
    </div>
</header>

{{-- Rendered outside <header> on purpose: that element uses backdrop-blur, which
     establishes a new containing block for fixed-position descendants. Nesting
     these fixed panels inside it collapses their height to the header's own
     (~80px) box instead of the viewport. --}}
<div class="fixed inset-0 z-40 hidden bg-primary/30 backdrop-blur-sm lg:hidden" data-mobile-overlay></div>

<div class="fixed right-0 top-0 z-50 flex h-full w-full max-w-sm translate-x-full flex-col border-l border-white/70 bg-white p-6 shadow-2xl transition-transform duration-300 lg:hidden" data-mobile-menu>
        <div class="mb-8 flex items-center justify-between">
            <div class="space-y-2">
                <img
                    src="{{ asset('images/uac-japan-logo.webp') }}"
                    width="320"
                    height="320"
                    alt="UAC Japan logo"
                    class="h-24 w-auto origin-left scale-x-[1.3]"
                    loading="lazy"
                    decoding="async"
                >
                <x-i18n :text="ui('nav.menu')" tag="div" class="text-xs uppercase tracking-[0.22em] text-muted" />
            </div>
            <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-line text-primary" aria-label="Close menu" data-mobile-menu-close>
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                    <path d="M6 6l12 12M18 6L6 18" stroke-linecap="round"/>
                </svg>
            </button>
        </div>

        <nav class="flex flex-1 flex-col gap-2" aria-label="Mobile primary">
            @foreach ($primaryLinks as $item)
                <x-i18n
                    :text="$item['label']"
                    tag="a"
                    href="{{ route($item['route']) }}"
                    class="rounded-2xl px-4 py-3 text-base font-medium {{ request()->routeIs($item['route']) ? 'bg-secondary-soft text-secondary' : 'text-primary hover:bg-slate-50' }}"
                />
            @endforeach

            @if ($aboutItem)
                <div data-dropdown>
                    <button
                        type="button"
                        class="flex w-full items-center justify-between rounded-2xl px-4 py-3 text-base font-medium {{ $isAboutGroupActive ? 'bg-secondary-soft text-secondary' : 'text-primary hover:bg-slate-50' }}"
                        data-dropdown-trigger
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <x-i18n :text="$aboutItem['label']" tag="span" />
                        <svg class="h-4 w-4" data-dropdown-chevron viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                    <div class="dropdown-panel dropdown-panel--inline hidden" data-dropdown-panel role="menu">
                        <a href="{{ route($aboutItem['route']) }}" role="menuitem" class="dropdown-item {{ request()->routeIs($aboutItem['route']) ? 'is-active' : '' }}">
                            <x-i18n :text="$aboutItem['label']" />
                        </a>
                        @foreach ($aboutChildren as $child)
                            <a href="{{ route($child['route']) }}" role="menuitem" class="dropdown-item {{ request()->routeIs($child['route']) ? 'is-active' : '' }}">
                                <x-i18n :text="$child['label']" />
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($contactItem)
                <x-i18n
                    :text="$contactItem['label']"
                    tag="a"
                    href="{{ route($contactItem['route']) }}"
                    class="rounded-2xl px-4 py-3 text-base font-medium {{ request()->routeIs($contactItem['route']) ? 'bg-secondary-soft text-secondary' : 'text-primary hover:bg-slate-50' }}"
                />
            @endif
        </nav>

        <div class="relative mt-6 flex justify-center self-center" data-dropdown data-lang-dropdown>
            <button
                type="button"
                class="lang-trigger inline-flex items-center gap-1.5 rounded-full border border-line bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.08em] text-primary transition hover:border-primary/30 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary/30"
                data-dropdown-trigger
                aria-haspopup="true"
                aria-expanded="false"
                aria-label="{{ ui('lang_switcher.label')[app()->getLocale()] }}"
            >
                <span data-lang-current>{{ strtoupper(app()->getLocale()) }}</span>
                <svg class="h-3 w-3" data-dropdown-chevron viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
            <div class="dropdown-panel left-0 right-0 min-w-0 hidden" data-dropdown-panel role="menu">
                @foreach (config('i18n.locales') as $code => $label)
                    <button
                        type="button"
                        class="dropdown-item w-full px-4 text-left {{ app()->getLocale() === $code ? 'hidden' : '' }}"
                        data-lang-button="{{ $code }}"
                        role="menuitem"
                    >{{ strtoupper($code) }}</button>
                @endforeach
            </div>
        </div>

        <x-i18n :text="ui('common.join_uac')" tag="a" href="{{ route('join') }}" class="btn-primary mt-4 w-full" />
    </div>
