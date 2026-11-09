@extends('layouts.app')

@section('content')
    <section class="section-shell">
        <div class="container-shell">
            <x-section-title
                :eyebrow="ui('pages.about.hero_eyebrow')"
                :title="ui('pages.about.hero_title')"
                :description="ui('pages.about.hero_description')"
            />
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell">
            <article class="academic-card p-8 sm:p-12">
                <span class="eyebrow">Uzbek Academic Club</span>
                <x-i18n :text="$about['intro']['title']" tag="h2" class="mt-4 max-w-4xl text-3xl leading-tight sm:text-4xl" />
                <div class="mt-6 max-w-4xl space-y-5 text-base leading-8 text-muted sm:text-lg sm:leading-9">
                    @foreach ($about['intro']['lead'] as $paragraph)
                        <x-i18n :text="$paragraph" tag="p" />
                    @endforeach
                </div>

                <div class="mt-10 grid gap-6 lg:grid-cols-3">
                    @foreach ($about['intro']['sections'] as $section)
                        <div class="rounded-2xl border border-line p-6">
                            <x-i18n :text="$section['heading']" tag="h3" class="text-xl" />
                            <div class="mt-4 space-y-4 text-base leading-8 text-muted">
                                @foreach ($section['paragraphs'] as $paragraph)
                                    <x-i18n :text="$paragraph" tag="p" />
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10 flex flex-col gap-5 rounded-2xl border-l-4 border-secondary bg-white/60 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <x-i18n :text="$about['intro']['closing']" tag="p" class="max-w-3xl text-lg leading-8 text-primary" />
                    <x-i18n :text="ui('common.join_uac')" tag="a" href="{{ route('join') }}" class="btn-primary shrink-0" />
                </div>
            </article>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-6 lg:grid-cols-2">
            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.about.who_we_are')" tag="h2" class="text-3xl" />
                <x-i18n :text="$site['description']" tag="p" class="mt-4 text-base leading-8 text-muted" />
            </div>
            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.about.history_heading')" tag="h2" class="text-3xl" />
                <x-i18n :text="$about['history']" tag="p" class="mt-4 text-base leading-8 text-muted" />
            </div>
        </div>
    </section>

    <section class="section-shell bg-white/45">
        <div class="container-shell grid gap-6 lg:grid-cols-2">
            <div class="academic-card border-l-4 border-secondary p-8">
                <x-i18n :text="ui('pages.about.mission_vision_heading')" tag="h2" class="text-3xl" />
                <div class="mt-5 space-y-4 text-base leading-8 text-muted">
                    <x-i18n :text="config('uac.mission.body')" tag="p" />
                    <x-i18n :text="config('uac.vision.body')" tag="p" />
                </div>
            </div>
            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.about.values_heading')" tag="h2" class="text-3xl" />
                <ul class="mt-5 space-y-3 text-base leading-8 text-muted">
                    @foreach ($about['values'] as $value)
                        <li class="flex gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-accent"></span>
                            <x-i18n :text="$value" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell grid gap-6 lg:grid-cols-[0.9fr,1.1fr]">
            <div class="academic-card p-8">
                <x-i18n :text="ui('pages.about.structure_heading')" tag="h2" class="text-3xl" />
                <ul class="mt-5 space-y-4 text-base leading-8 text-muted">
                    @foreach ($about['structure'] as $item)
                        <li class="flex gap-3">
                            <span class="mt-2 h-2 w-2 rounded-full bg-secondary"></span>
                            <x-i18n :text="$item" />
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="surface-panel p-8">
                <x-i18n :text="ui('pages.about.president_message_eyebrow')" tag="span" class="eyebrow" />
                <x-i18n :text="$about['president_message']" tag="p" class="mt-5 text-lg leading-9 text-primary" />
                <div class="mt-8 rounded-2xl border border-dashed border-line px-5 py-4 text-sm text-muted">
                    <x-i18n :text="ui('pages.about.charter_placeholder')" />
                </div>
            </div>
        </div>
    </section>
@endsection
