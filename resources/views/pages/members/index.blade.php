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
            <div class="surface-panel p-6 sm:p-8">
                <div class="grid gap-6 lg:grid-cols-2">
                    <div>
                        <x-i18n :text="ui('pages.members_index.filter_region_label')" tag="p" class="text-sm font-semibold uppercase tracking-[0.22em] text-muted" />
                        <div class="mt-4 flex flex-wrap gap-3">
                            <x-i18n :text="ui('pages.members_index.filter_all_regions')" tag="button" type="button" class="filter-button is-active" data-filter-button data-filter-group="region" data-filter-value="all" />
                            @foreach ($regions as $region)
                                <x-i18n :text="$region['label']" tag="button" type="button" class="filter-button" data-filter-button data-filter-group="region" data-filter-value="{{ $region['slug'] }}" />
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <x-i18n :text="ui('pages.members_index.filter_field_label')" tag="p" class="text-sm font-semibold uppercase tracking-[0.22em] text-muted" />
                        <div class="mt-4 flex flex-wrap gap-3">
                            <x-i18n :text="ui('pages.members_index.filter_all_fields')" tag="button" type="button" class="filter-button is-active" data-filter-button data-filter-group="field" data-filter-value="all" />
                            @foreach ($fields as $field)
                                <x-i18n :text="$field['label']" tag="button" type="button" class="filter-button" data-filter-button data-filter-group="field" data-filter-value="{{ $field['slug'] }}" />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <x-i18n :text="ui('pages.members_index.featured_heading')" tag="h2" class="text-3xl" />
                <div class="grid gap-6 lg:grid-cols-2">
                    @foreach ($featuredMembers as $member)
                        <x-member-card :member="$member" />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_index.directory_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_index.directory_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($members as $member)
                    @if ($member['type'] !== 'Alumni')
                        <x-member-card :member="$member" />
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell space-y-8">
            <div class="max-w-3xl">
                <x-i18n :text="ui('pages.members_index.alumni_heading')" tag="h2" class="text-3xl sm:text-4xl" />
                <x-i18n :text="ui('pages.members_index.alumni_description')" tag="p" class="mt-3 text-base leading-8 text-muted" />
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($alumniMembers as $member)
                    <x-member-card :member="$member" compact />
                @endforeach
            </div>
        </div>
    </section>
@endsection
