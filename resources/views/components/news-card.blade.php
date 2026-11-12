@props(['news'])

@php $newsUrl = ! empty($news['slug']) ? route('news.show', $news['slug']) : null; @endphp

<article class="academic-card overflow-hidden sm:flex">
    @if (! empty($news['thumbnail']))
        <img src="{{ asset($news['thumbnail']) }}" alt="" loading="lazy" class="h-48 w-full object-cover sm:h-auto sm:w-56 sm:shrink-0">
    @endif
    <div class="p-6">
        <div class="mb-4 flex flex-wrap items-center gap-2">
            <x-i18n :text="$news['type']" tag="span" class="eyebrow" />
            <x-i18n :text="$news['date']" tag="span" class="chip" />
        </div>
        @if ($newsUrl)
            <a href="{{ $newsUrl }}" class="hover:underline"><x-i18n :text="$news['title']" tag="h3" class="text-2xl" /></a>
        @else
            <x-i18n :text="$news['title']" tag="h3" class="text-2xl" />
        @endif
        <x-i18n :text="$news['summary']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
        @if ($newsUrl)
            <x-i18n :text="ui('pages.news.read_more')" tag="a" href="{{ $newsUrl }}" class="mt-4 inline-block text-sm font-semibold text-secondary hover:text-primary" />
        @endif
    </div>
</article>
