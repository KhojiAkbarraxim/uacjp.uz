@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.partners.hero_eyebrow')"
                :title="ui('pages.partners.hero_title')"
                :description="ui('pages.partners.hero_description')"
                align="center"
            />
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-10">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.partners.sponsors_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.partners.sponsors_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($partners['sponsors'] as $partner)
                    <x-partner-card :partner="$partner" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell space-y-10">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.partners.networks_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.partners.networks_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($partners['networks'] as $partner)
                    <x-partner-card :partner="$partner" />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta
        :title="ui('pages.partners.cta_title')"
        :description="ui('pages.partners.cta_description')"
        :primary-label="ui('pages.partners.cta_primary')"
        primary-href="{{ route('contact') }}"
        :secondary-label="ui('pages.partners.cta_secondary')"
        secondary-href="{{ route('members.index') }}"
    />
@endsection
