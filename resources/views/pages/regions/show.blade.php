@extends('layouts.app')

@section('content')
    <section class="section-shell pt-0">
        <div class="container-shell">
            <div class="relative overflow-hidden rounded-[1.75rem]">
                <img
                    src="{{ asset($region['hero_image']) }}"
                    width="512"
                    height="512"
                    alt="{{ $region['name']['en'] }} hero image"
                    class="h-[26rem] w-full object-cover sm:h-[32rem]"
                    fetchpriority="high"
                    decoding="async"
                >
                <div class="absolute inset-0 bg-gradient-to-t from-primary via-primary/50 to-transparent"></div>
                <div class="absolute inset-x-0 bottom-0 p-8 text-white sm:p-12">
                    <x-i18n :text="$region['status']" tag="span" class="eyebrow border-white/20 bg-white/10 text-white" />
                    <x-i18n :text="$region['name']" tag="h1" class="mt-5 text-4xl text-white sm:text-5xl" />
                    <x-i18n :text="$region['summary']" tag="p" class="mt-4 max-w-2xl text-lg leading-8 text-white/80" />
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-6 lg:grid-cols-[1.1fr,0.9fr]">
            <div class="academic-card border-l-4 border-secondary p-8">
                <x-i18n :text="ui('pages.regions_show.about_chapter_heading')" tag="h2" class="text-3xl" />
                <x-i18n :text="$region['about']" tag="p" class="mt-4 text-base leading-8 text-muted" />
            </div>

            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.regions_show.regional_contact_heading')" tag="h2" class="text-3xl" />
                <div class="mt-5 space-y-3 text-base leading-8 text-muted">
                    <p><x-i18n :text="ui('common.coverage')" tag="span" class="font-semibold text-primary" /> <x-i18n :text="$region['locations']" /></p>
                    <p><x-i18n :text="ui('common.email_label')" tag="span" class="font-semibold text-primary" /> {{ $region['contact']['email'] }}</p>
                    <p><x-i18n :text="ui('common.phone_label')" tag="span" class="font-semibold text-primary" /> {{ $region['contact']['phone'] }}</p>
                    <p><x-i18n :text="ui('common.city_base_label')" tag="span" class="font-semibold text-primary" /> <x-i18n :text="$region['contact']['city']" /></p>
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell grid gap-10 lg:grid-cols-[0.8fr,1.2fr]">
            <x-section-title
                :eyebrow="ui('pages.regions_show.universities_eyebrow')"
                :title="ui('pages.regions_show.universities_title')"
                :description="ui('pages.regions_show.universities_description')"
            />

            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($region['universities'] as $university)
                    <div class="academic-card flex items-center gap-4 p-5">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-primary/10 text-primary">U</div>
                        <div>
                            <x-i18n :text="$university" tag="h3" class="text-xl" />
                            <x-i18n :text="ui('common.university_representation')" tag="p" class="text-sm text-muted" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-10 lg:grid-cols-[1.05fr,0.95fr]">
            <div class="space-y-6">
                <x-section-title
                    :eyebrow="ui('pages.regions_show.local_activities_eyebrow')"
                    :title="ui('pages.regions_show.local_activities_title')"
                    :description="ui('pages.regions_show.local_activities_description')"
                />

                <div class="space-y-5">
                    @foreach ($region['activities'] as $activity)
                        <article class="academic-card p-6">
                            <div class="mb-3 flex flex-wrap items-center gap-2">
                                <x-i18n :text="$activity['date']" tag="span" class="eyebrow" />
                            </div>
                            <x-i18n :text="$activity['title']" tag="h3" class="text-2xl" />
                            <x-i18n :text="$activity['description']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="space-y-6">
                <x-section-title
                    :eyebrow="ui('pages.regions_show.leadership_eyebrow')"
                    :title="ui('pages.regions_show.leadership_title')"
                    :description="ui('pages.regions_show.leadership_description')"
                />

                <div class="space-y-5">
                    @foreach ($region['secretaries'] as $leader)
                        <x-member-card :member="$leader" compact />
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell grid gap-10 lg:grid-cols-[1.05fr,0.95fr]">
            <div class="space-y-6">
                <x-section-title
                    :eyebrow="ui('pages.regions_show.gallery_eyebrow')"
                    :title="ui('pages.regions_show.gallery_title')"
                    :description="ui('pages.regions_show.gallery_description')"
                />

                <div class="grid gap-4 sm:grid-cols-3">
                    @foreach ($region['gallery'] as $item)
                        <div class="academic-card overflow-hidden">
                            <div class="flex h-56 items-end bg-gradient-to-br {{ $item['tone'] }} p-5">
                                <x-i18n :text="$item['title']" tag="p" class="text-lg font-medium text-white" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.regions_show.plans_heading')" tag="h2" class="text-3xl" />
                <ul class="mt-5 space-y-4 text-base leading-8 text-muted">
                    @foreach ($region['plans'] as $plan)
                        <li class="flex gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-accent"></span>
                            <x-i18n :text="$plan" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
@endsection
