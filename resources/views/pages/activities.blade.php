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

    {{-- ═══════════════════════════════════════════════════
         YILLIK TADBIRLAR KALENDARI
    ═══════════════════════════════════════════════════ --}}
    <section class="section-shell pt-0">
        <div class="container-shell space-y-8">
            <x-section-title
                :eyebrow="ui('pages.activities.calendar_eyebrow')"
                :title="ui('pages.activities.calendar_title')"
            />

            @php
                $locale   = app()->getLocale();
                $events   = config('uac.events');
                $now      = \Carbon\Carbon::now();
            @endphp

            <div class="space-y-3">
                @foreach ($events as $event)
                    @php
                        $date       = \Carbon\Carbon::parse($event['date']);
                        $isPast     = $date->isPast();
                        $isUpcoming = !$isPast;
                        $title      = is_array($event['title'])    ? ($event['title'][$locale]    ?? $event['title']['en'])    : $event['title'];
                        $location   = is_array($event['location']) ? ($event['location'][$locale] ?? $event['location']['en']) : $event['location'];
                        $type       = is_array($event['type'])     ? ($event['type'][$locale]     ?? $event['type']['en'])     : $event['type'];
                    @endphp
                    <div class="flex items-center gap-5 rounded-2xl border p-5 transition duration-300
                        {{ $isPast
                            ? 'border-line/60 bg-white/40 opacity-60'
                            : 'border-secondary/20 bg-secondary-soft hover:-translate-y-0.5 hover:shadow-paper' }}">
                        {{-- Date block --}}
                        <div class="flex w-16 shrink-0 flex-col items-center justify-center rounded-xl
                            {{ $isPast ? 'bg-slate-100 text-slate-400' : 'bg-primary text-white' }}
                            py-3 text-center">
                            <span class="text-xs font-semibold uppercase tracking-widest">{{ $date->format('M') }}</span>
                            <span class="text-2xl font-bold leading-none">{{ $date->format('d') }}</span>
                            <span class="text-xs opacity-70">{{ $date->format('Y') }}</span>
                        </div>

                        {{-- Content --}}
                        <div class="min-w-0 flex-1">
                            <div class="mb-1 flex flex-wrap items-center gap-2">
                                <span class="{{ $isPast ? 'chip' : 'eyebrow' }}">{{ $type }}</span>
                                @if ($isUpcoming)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-secondary/10 px-2 py-0.5 text-xs font-semibold text-secondary">
                                        <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-secondary"></span>
                                        <x-i18n :text="ui('pages.activities.upcoming_label')" />
                                    </span>
                                @endif
                            </div>
                            <p class="font-semibold text-primary truncate">{{ $title }}</p>
                            <p class="mt-0.5 flex items-center gap-1.5 text-sm text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="h-3.5 w-3.5 shrink-0"><path fill-rule="evenodd" d="m7.539 14.841.003.003.002.002a.755.755 0 0 0 .912 0l.002-.002.003-.003.012-.009a5.57 5.57 0 0 0 .19-.153 15.588 15.588 0 0 0 2.046-2.082c1.101-1.362 2.291-3.342 2.291-5.597A5 5 0 0 0 3 7c0 2.255 1.19 4.235 2.292 5.597a15.591 15.591 0 0 0 2.046 2.082 8.916 8.916 0 0 0 .189.153l.012.01ZM8 8.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3Z" clip-rule="evenodd" /></svg>
                                {{ $location }}
                            </p>
                        </div>

                        {{-- Countdown / Done badge --}}
                        <div class="shrink-0 text-right hidden sm:block">
                            @if ($isPast)
                                <span class="chip">
                                    <x-i18n :text="ui('pages.activities.past_label')" />
                                </span>
                            @else
                                <p class="text-xs text-muted"><x-i18n :text="ui('pages.activities.days_away_prefix')" /></p>
                                <p class="text-xl font-bold text-secondary">{{ $now->diffInDays($date) }}</p>
                                <p class="text-xs text-muted"><x-i18n :text="ui('pages.activities.days_label')" /></p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         FAOLIYAT TOIFALARI BO'YICHA GURUHLAR
    ═══════════════════════════════════════════════════ --}}
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

