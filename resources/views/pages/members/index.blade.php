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

                {{-- The Kansai ambassador has not been appointed yet; the client
                     will send the name. Shown as an open seat rather than hidden. --}}
                <article class="academic-card flex h-full items-center gap-4 border-dashed p-6">
                    <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl border border-dashed border-line text-muted">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                            <circle cx="12" cy="8" r="3.5"/>
                            <path d="M5 19.5c0-3.3 3.1-5.5 7-5.5s7 2.2 7 5.5" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <div>
                        <x-i18n :text="ui('pages.members_index.kansai_vacant_role')" tag="h3" class="text-xl" />
                        <x-i18n :text="ui('pages.members_index.kansai_vacant_note')" tag="p" class="mt-1 text-sm font-medium text-muted" />
                    </div>
                </article>
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
