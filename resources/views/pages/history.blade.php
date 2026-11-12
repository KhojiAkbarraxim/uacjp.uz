@extends('layouts.app')

@section('content')
    <section class="section-shell pb-0">
        <div class="container-shell">
            <x-i18n :text="ui('pages.history.back')" tag="a" href="{{ route('about') }}" class="text-sm font-semibold text-secondary hover:text-primary" />

            <div class="mt-6">
                <x-section-title
                    :eyebrow="ui('pages.about.history_section_eyebrow')"
                    :title="ui('pages.about.history_section_title')"
                    :description="ui('pages.about.history_section_description')"
                    align="center"
                />
            </div>

            <div class="mx-auto mt-10 grid max-w-md grid-cols-2 gap-4">
                <div class="academic-card px-5 py-4 text-center">
                    <p class="text-3xl font-semibold text-primary">{{ $meetingCount }}</p>
                    <x-i18n :text="ui('pages.history.stats_meetings')" tag="p" class="mt-1 text-sm uppercase tracking-[0.2em] text-muted" />
                </div>
                <div class="academic-card px-5 py-4 text-center">
                    <p class="text-3xl font-semibold text-primary">{{ $yearCount }}</p>
                    <x-i18n :text="ui('pages.history.stats_years')" tag="p" class="mt-1 text-sm uppercase tracking-[0.2em] text-muted" />
                </div>
            </div>
        </div>
    </section>

    <section class="section-shell">
        <div class="container-shell">
            @if ($milestonesByYear->isEmpty())
                <x-i18n :text="ui('pages.about.history_empty')" tag="p" class="academic-card p-6 text-center text-muted" />
            @else
                <div class="relative">
                    {{-- The journey spine: one continuous gradient line running behind
                         every year and meeting, navy to green to gold - the same
                         colors the rest of the site is built from. Desktop only;
                         there is nothing to weave between in a single mobile column. --}}
                    <div class="pointer-events-none absolute inset-y-0 left-1/2 hidden w-px -translate-x-1/2 bg-gradient-to-b from-primary via-secondary to-accent lg:block" aria-hidden="true"></div>

                    <ol class="space-y-16">
                        @foreach ($milestonesByYear as $year => $yearMilestones)
                            <li>
                                <div class="relative z-10 mb-10 flex justify-center">
                                    <span class="rounded-full border-4 border-background bg-primary px-8 py-3 font-display text-2xl text-white shadow-paper sm:text-3xl">
                                        {{ $year }}
                                    </span>
                                </div>

                                <ol class="space-y-10 lg:space-y-14">
                                    @foreach ($yearMilestones as $i => $milestone)
                                        @php $onRight = $i % 2 === 1; @endphp
                                        <li class="relative lg:grid lg:grid-cols-[1fr_2.5rem_1fr] lg:items-start" data-history-item>
                                            {{-- Center node: part of the grid on desktop, irrelevant on
                                                 the single-column mobile layout below. --}}
                                            <span class="absolute left-1/2 top-6 hidden h-3.5 w-3.5 -translate-x-1/2 rounded-full border-2 border-background bg-secondary shadow-paper lg:static lg:col-start-2 lg:mx-auto lg:block lg:translate-x-0" aria-hidden="true"></span>

                                            {{-- Desktop: the card sits on whichever side this entry
                                                 alternates to; the other side stays empty but present,
                                                 so the grid keeps 3 columns for every row. --}}
                                            <div class="hidden lg:col-start-1 lg:row-start-1 lg:block lg:pr-6">
                                                @unless ($onRight)
                                                    <x-history-card :milestone="$milestone" />
                                                @endunless
                                            </div>
                                            <div class="hidden lg:col-start-3 lg:row-start-1 lg:block lg:pl-6">
                                                @if ($onRight)
                                                    <x-history-card :milestone="$milestone" />
                                                @endif
                                            </div>

                                            {{-- Mobile: a single stacked column, no sides to alternate between. --}}
                                            <div class="lg:hidden">
                                                <x-history-card :milestone="$milestone" />
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </li>
                        @endforeach
                    </ol>
                </div>
            @endif
        </div>
    </section>
@endsection
