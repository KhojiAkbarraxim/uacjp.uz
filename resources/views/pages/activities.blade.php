@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.activities.hero_eyebrow')"
                :title="ui('pages.activities.hero_title')"
                :description="ui('pages.activities.hero_description')"
                align="center"
            />
        </div>
    </section>

    @foreach ($activityGroups as $category => $activities)
        <section class="section-shell {{ $loop->odd ? 'bg-white/45' : '' }}">
            <div class="container-shell space-y-8">
                <div class="max-w-3xl">
                    <x-i18n :text="$activities->first()['category']" tag="h2" class="text-3xl sm:text-4xl" />
                    <x-i18n
                        :text="$loop->first ? ui('pages.activities.first_group_description') : ui('pages.activities.other_group_description')"
                        tag="p"
                        class="mt-3 text-base leading-8 text-muted"
                    />
                </div>

                <div class="grid gap-6 lg:grid-cols-2 xl:grid-cols-3">
                    @foreach ($activities as $activity)
                        <x-activity-card :activity="$activity" />
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <x-cta
        :title="ui('pages.activities.cta_title')"
        :description="ui('pages.activities.cta_description')"
        :primary-label="ui('pages.activities.cta_primary')"
        primary-href="{{ route('contact') }}"
        :secondary-label="ui('pages.activities.cta_secondary')"
        secondary-href="{{ route('join') }}"
    />
@endsection
