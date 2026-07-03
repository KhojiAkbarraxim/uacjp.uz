@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.members_secretary.hero_eyebrow')"
                :title="ui('pages.members_secretary.hero_title')"
                :description="ui('pages.members_secretary.hero_description')"
                align="center"
            />
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_secretary.national_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_secretary.national_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($leaders['national'] as $leader)
                    <x-member-card :member="$leader" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_secretary.regional_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_secretary.regional_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($leaders['regional'] as $leader)
                    <x-member-card :member="$leader" compact />
                @endforeach
            </div>
        </div>
    </section>
@endsection
