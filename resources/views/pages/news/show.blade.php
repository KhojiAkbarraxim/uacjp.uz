@extends('layouts.app')

@section('content')
    <article class="section-shell">
        <div class="container-shell space-y-8">
            <div class="mx-auto max-w-3xl space-y-8">
                <x-i18n :text="ui('pages.news.back')" tag="a" href="{{ route('home') }}" class="text-sm font-semibold text-secondary hover:text-primary" />

                <header class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <x-i18n :text="$news['type']" tag="span" class="eyebrow" />
                        <x-i18n :text="$news['date']" tag="span" class="chip" />
                    </div>
                    <x-i18n :text="$news['title']" tag="h1" class="text-4xl sm:text-5xl" />
                </header>
            </div>

            @if (! empty($news['thumbnail']))
                <img src="{{ asset($news['thumbnail']) }}" alt="" class="max-h-[32rem] w-full rounded-[var(--radius-card)] border border-line object-cover shadow-paper">
            @endif

            <div class="mx-auto max-w-3xl">
                <x-i18n :text="array_filter(i18n_dict($news['body'] ?? [])) ? $news['body'] : $news['summary']" tag="div" class="whitespace-pre-line text-lg leading-8 text-ink" />
            </div>

            @if (! empty($news['images']))
                <div class="space-y-5">
                    <x-i18n :text="ui('pages.news.gallery_heading')" tag="h2" class="text-2xl" />
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                        @foreach ($news['images'] as $image)
                            <a href="{{ asset($image) }}" target="_blank" rel="noopener noreferrer" class="group block overflow-hidden rounded-[var(--radius-card)] border border-line">
                                <img src="{{ asset($image) }}" alt="" loading="lazy" class="aspect-square w-full object-cover transition duration-300 group-hover:scale-105">
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </article>
@endsection
