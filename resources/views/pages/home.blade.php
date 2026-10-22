@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <div class="grid gap-10 lg:grid-cols-[1.15fr,0.85fr] lg:items-center">
                <div class="space-y-8">
                    <span class="eyebrow"><x-i18n :text="ui('common.established')" /> {{ $site['founded'] }}</span>

                    <div class="space-y-5">
                        <x-i18n :text="ui('pages.home.hero_heading')" tag="h1" class="max-w-4xl text-4xl leading-tight sm:text-5xl lg:text-6xl" />
                        <p class="max-w-2xl text-lg leading-8 text-muted">
                            <x-i18n :text="$site['tagline']" /> <x-i18n :text="ui('pages.home.hero_body')" />
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row">
                        <x-i18n :text="ui('common.join_uac')" tag="a" href="{{ route('join') }}" class="btn-primary" />
                        <x-i18n :text="ui('common.become_partner')" tag="a" href="{{ route('partners') }}" class="btn-secondary" />
                    </div>

                    <div class="grid gap-4 sm:grid-cols-3">
                        @foreach ($heroStats as $stat)
                            <div class="academic-card px-5 py-4">
                                <p class="text-3xl font-semibold text-primary">{{ $stat['value'] }}</p>
                                <x-i18n :text="$stat['label']" tag="p" class="mt-1 text-sm uppercase tracking-[0.2em] text-muted" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="surface-panel overflow-hidden p-3">
                    <div class="relative h-[26rem] overflow-hidden rounded-[1.35rem]">
                        <img
                            src="{{ asset('images/home-hero.webp') }}"
                            width="512"
                            height="512"
                            alt="Modern university campus in Japan"
                            class="h-full w-full object-cover"
                            fetchpriority="high"
                            decoding="async"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-primary/10 to-transparent"></div>
                        <div class="absolute inset-x-0 bottom-0 p-8 text-white">
                            <x-i18n :text="ui('pages.home.hero_image_eyebrow')" tag="p" class="text-sm uppercase tracking-[0.22em] text-white/70" />
                            <x-i18n :text="ui('pages.home.hero_image_caption')" tag="p" class="mt-3 max-w-md text-xl font-medium leading-8" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         "UAC NIMA?" — Tezkor tushuntirish bo'limi
    ═══════════════════════════════════════════════════ --}}
    <section class="section-shell pt-0">
        <div class="container-shell">
            <div class="relative overflow-hidden rounded-[1.5rem] border border-primary/10 bg-primary pattern-grid p-8 sm:p-12">
                {{-- Radial glow --}}
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_top_left,rgba(27,109,36,0.18),transparent_60%)]"></div>

                <div class="relative space-y-10">
                    <div class="max-w-2xl">
                        <x-i18n :text="ui('pages.home.what_is_uac_eyebrow')" tag="span" class="eyebrow border-white/20 bg-white/10 text-white/90" />
                        <x-i18n :text="ui('pages.home.what_is_uac_title')" tag="h2" class="mt-4 text-3xl text-white sm:text-4xl" />
                        <x-i18n :text="ui('pages.home.what_is_uac_body')" tag="p" class="mt-4 text-base leading-8 text-white/70" />
                    </div>

                    <div class="grid gap-5 sm:grid-cols-3">
                        {{-- Pillar 1: Community --}}
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition duration-300 hover:bg-white/10">
                            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-secondary/20 text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"><path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" /></svg>
                            </div>
                            <x-i18n :text="ui('pages.home.pillar_community_title')" tag="h3" class="text-lg text-white" />
                            <x-i18n :text="ui('pages.home.pillar_community_body')" tag="p" class="mt-2 text-sm leading-7 text-white/60" />
                        </div>

                        {{-- Pillar 2: Research --}}
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition duration-300 hover:bg-white/10">
                            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-accent/20 text-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"><path d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" /></svg>
                            </div>
                            <x-i18n :text="ui('pages.home.pillar_research_title')" tag="h3" class="text-lg text-white" />
                            <x-i18n :text="ui('pages.home.pillar_research_body')" tag="p" class="mt-2 text-sm leading-7 text-white/60" />
                        </div>

                        {{-- Pillar 3: Japan --}}
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-6 backdrop-blur-sm transition duration-300 hover:bg-white/10">
                            <div class="mb-4 flex h-11 w-11 items-center justify-center rounded-2xl bg-white/15 text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6"><path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM6.262 6.072a8.25 8.25 0 1 0 10.562-.766 4.5 4.5 0 0 1-1.318 1.357L14.25 7.5l.165.33a.809.809 0 0 1-1.086 1.085l-.604-.302a1.125 1.125 0 0 0-1.298.21l-.132.131c-.439.44-.439 1.152 0 1.591l.296.296c.256.257.622.374.98.314l1.17-.195c.323-.054.654.036.905.245l1.33 1.108c.32.267.46.694.358 1.1a8.7 8.7 0 0 1-2.288 4.04l-.723.724a1.125 1.125 0 0 1-1.298.21l-.153-.076a1.125 1.125 0 0 1-.622-1.006v-1.089c0-.298-.119-.585-.33-.796l-1.347-1.347a1.125 1.125 0 0 1-.21-1.298L9.75 12l-1.64-1.64a6 6 0 0 1-1.676-3.257l-.172-1.03Z" clip-rule="evenodd" /></svg>
                            </div>
                            <x-i18n :text="ui('pages.home.pillar_japan_title')" tag="h3" class="text-lg text-white" />
                            <x-i18n :text="ui('pages.home.pillar_japan_body')" tag="p" class="mt-2 text-sm leading-7 text-white/60" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-8">
            <x-section-title
                :eyebrow="ui('pages.home.events_eyebrow')"
                :title="ui('pages.home.events_title')"
                :description="ui('pages.home.events_description')"
            />
            <div class="grid gap-4 md:grid-cols-2">
                @foreach (config('uac.events') as $event)
                    <div class="academic-card p-6">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="chip">{{ $event['date'] }}</span>
                            <span class="eyebrow">{{ is_array($event['type']) ? ($event['type'][app()->getLocale()] ?? $event['type']['en']) : $event['type'] }}</span>
                        </div>
                        <h3 class="text-xl">{{ is_array($event['title']) ? ($event['title'][app()->getLocale()] ?? $event['title']['en']) : $event['title'] }}</h3>
                        <p class="mt-2 text-sm text-muted">{{ is_array($event['location']) ? ($event['location'][app()->getLocale()] ?? $event['location']['en']) : $event['location'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell space-y-8">
            <x-section-title
                :eyebrow="ui('pages.home.gallery_eyebrow')"
                :title="ui('pages.home.gallery_title')"
                align="center"
            />
            <div class="relative overflow-hidden rounded-[1.35rem] bg-primary" data-event-slider>
                @php $galleryImages = config('uac.event_gallery'); @endphp
                @foreach ($galleryImages as $img)
                    <img
                        src="{{ asset($img) }}"
                        alt="UAC event photo"
                        class="absolute inset-0 h-full w-full object-cover transition-opacity duration-700"
                        data-slide
                        style="opacity: {{ $loop->first ? '1' : '0' }}; position: {{ $loop->first ? 'relative' : 'absolute' }}; height: 22rem;"
                    >
                @endforeach
                {{-- Height spacer --}}
                <div class="h-[22rem] w-full"></div>
                {{-- Gradient overlay --}}
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-primary/60 via-transparent to-transparent"></div>
                {{-- Dot indicators --}}
                <div class="absolute inset-x-0 bottom-5 flex justify-center gap-2" data-slider-dots>
                    @foreach ($galleryImages as $i => $img)
                        <button
                            data-dot="{{ $i }}"
                            class="h-2 w-2 rounded-full transition-all duration-300 {{ $loop->first ? 'bg-white w-6' : 'bg-white/40' }}"
                            aria-label="Slide {{ $loop->iteration }}"
                        ></button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <script>
        (function () {
            const slider = document.querySelector('[data-event-slider]');
            if (!slider) return;
            const slides = slider.querySelectorAll('[data-slide]');
            const dots   = slider.querySelectorAll('[data-dot]');
            if (slides.length < 2) return;
            let current = 0;

            function goTo(next) {
                slides[current].style.opacity = '0';
                slides[current].style.position = 'absolute';
                dots[current].style.width = '';
                dots[current].style.backgroundColor = '';

                current = next;
                slides[current].style.opacity = '1';
                slides[current].style.position = 'relative';
                dots[current].style.width = '1.5rem';
                dots[current].style.backgroundColor = 'white';
            }

            dots.forEach((dot, idx) => dot.addEventListener('click', () => goTo(idx)));
            setInterval(() => goTo((current + 1) % slides.length), 4000);
        })();
    </script>



    <section class="section-shell pt-0">
        <div class="container-shell">
            <div class="grid gap-6 lg:grid-cols-2">
                <div class="academic-card border-l-4 border-secondary p-8">
                    <x-i18n :text="$mission['title']" tag="h2" class="text-3xl" />
                    <x-i18n :text="$mission['body']" tag="p" class="mt-4 text-base leading-8 text-muted" />
                </div>
                <div class="academic-card border-l-4 border-accent p-8">
                    <x-i18n :text="$vision['title']" tag="h2" class="text-3xl" />
                    <x-i18n :text="$vision['body']" tag="p" class="mt-4 text-base leading-8 text-muted" />
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-10">
            <x-section-title
                :eyebrow="ui('pages.home.regions_eyebrow')"
                :title="ui('pages.home.regions_title')"
                :description="ui('pages.home.regions_description')"
            />

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
                @foreach ($regions as $region)
                    <x-region-card :region="$region" :show-image="false" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-10 lg:grid-cols-[0.8fr,1.2fr]">
            <x-section-title
                :eyebrow="ui('pages.home.news_eyebrow')"
                :title="ui('pages.home.news_title')"
                :description="ui('pages.home.news_description')"
            />

            <div class="space-y-5">
                @foreach ($latestNews as $news)
                    <article class="academic-card p-6">
                        <div class="mb-4 flex flex-wrap items-center gap-2">
                            <x-i18n :text="$news['type']" tag="span" class="eyebrow" />
                            <x-i18n :text="$news['date']" tag="span" class="chip" />
                        </div>
                        <x-i18n :text="$news['title']" tag="h3" class="text-2xl" />
                        <x-i18n :text="$news['summary']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-10">
            <x-section-title
                :eyebrow="ui('pages.home.partners_eyebrow')"
                :title="ui('pages.home.partners_title')"
                :description="ui('pages.home.partners_description')"
                align="center"
            />

            <div class="grid gap-6 md:grid-cols-3">
                @foreach ($partners as $partner)
                    <div class="academic-card flex min-h-40 items-center justify-center p-6 text-center">
                        <div>
                            <x-i18n :text="$partner['type']" tag="p" class="text-xs uppercase tracking-[0.22em] text-muted" />
                            <h3 class="mt-3 text-2xl">{{ $partner['name'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-cta
        :title="ui('pages.home.cta_title')"
        :description="ui('pages.home.cta_description')"
        :primary-label="ui('common.join_uac')"
        primary-href="{{ route('join') }}"
        :secondary-label="ui('common.become_partner')"
        secondary-href="{{ route('partners') }}"
    />
@endsection
