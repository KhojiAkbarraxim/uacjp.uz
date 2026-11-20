@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.members_index.hero_eyebrow')"
                :title="ui('pages.members_index.hero_title')"
                :description="ui('pages.members_index.hero_description')"
            />
        </div>
    </section>

    <section class="section-shell pt-0">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_index.executive_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_index.executive_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($executives as $member)
                    <x-member-card :member="$member" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_index.ambassadors_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_index.ambassadors_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($ambassadors as $member)
                    <x-member-card :member="$member" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_index.staff_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_index.staff_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($staff as $member)
                    <x-member-card :member="$member" />
                @endforeach
            </div>
        </div>
    </section>

    <x-cta
        :title="ui('pages.members_index.cta_title')"
        :description="ui('pages.members_index.cta_description')"
        :primary-label="ui('common.join_uac')"
        primary-href="{{ route('join') }}"
        :secondary-label="ui('pages.members_index.cta_secondary')"
        secondary-href="{{ route('contact') }}"
    />
@endsection
