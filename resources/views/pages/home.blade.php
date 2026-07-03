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
