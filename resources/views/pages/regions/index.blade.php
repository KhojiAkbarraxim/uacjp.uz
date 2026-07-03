@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <div class="surface-panel pattern-grid overflow-hidden px-8 py-12 sm:px-12 sm:py-16">
                <div class="max-w-3xl space-y-5">
                    <x-i18n :text="ui('pages.regions_index.hero_eyebrow')" tag="span" class="eyebrow" />
                    <x-i18n :text="ui('pages.regions_index.hero_title')" tag="h1" class="text-4xl sm:text-5xl" />
                    <x-i18n :text="ui('pages.regions_index.hero_description')" tag="p" class="text-lg leading-8 text-muted" />
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell pt-0">
        <div class="container-shell space-y-8">
            <x-section-title
                :eyebrow="ui('pages.regions_index.map_eyebrow')"
                :title="ui('pages.regions_index.map_title')"
                :description="ui('pages.regions_index.map_description')"
            />

            <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
                @foreach ($regions as $region)
                    <x-region-card :region="$region" />
                @endforeach
            </div>
        </div>
    </section>
@endsection
