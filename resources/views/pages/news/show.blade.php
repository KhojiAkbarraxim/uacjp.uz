@extends('layouts.app')

@section('content')
    <article class="section-shell">
        <div class="container-shell max-w-3xl space-y-8">
            <x-i18n :text="ui('pages.news.back')" tag="a" href="{{ route('home') }}" class="text-sm font-semibold text-secondary hover:text-primary" />

            <header class="space-y-4">
                <div class="flex flex-wrap items-center gap-2">
                    <x-i18n :text="$news['type']" tag="span" class="eyebrow" />
                    <x-i18n :text="$news['date']" tag="span" class="chip" />
                </div>
                <x-i18n :text="$news['title']" tag="h1" class="text-4xl sm:text-5xl" />
            </header>

            @if (! empty($news['thumbnail']))
                <img src="{{ asset($news['thumbnail']) }}" alt="" class="w-full rounded-[var(--radius-card)] border border-line object-cover shadow-paper">
            @endif

            <x-i18n :text="array_filter(i18n_dict($news['body'] ?? [])) ? $news['body'] : $news['summary']" tag="div" class="whitespace-pre-line text-lg leading-8 text-ink" />

            @if (! empty($news['images']))
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                    @foreach ($news['images'] as $image)
                        <a href="{{ asset($image) }}" target="_blank" rel="noopener noreferrer" class="block overflow-hidden rounded-[var(--radius-card)] border border-line">
                            <img src="{{ asset($image) }}" alt="" loading="lazy" class="aspect-square w-full object-cover transition duration-300 hover:scale-105">
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </article>
@endsection
