@props(['news'])

@php $newsUrl = ! empty($news['slug']) ? route('news.show', $news['slug']) : null; @endphp

<article class="academic-card group flex h-full flex-col overflow-hidden">
    @if (! empty($news['thumbnail']))
        <div class="h-48 overflow-hidden">
            <img
                src="{{ asset($news['thumbnail']) }}"
                alt=""
                loading="lazy"
                decoding="async"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
            >
        </div>
    @endif

    <div class="flex flex-1 flex-col p-6">
        <div class="mb-3 flex flex-wrap items-center gap-2">
            <x-i18n :text="$news['type']" tag="span" class="eyebrow" />
            <x-i18n :text="$news['date']" tag="span" class="chip" />
        </div>

        @if ($newsUrl)
            <a href="{{ $newsUrl }}" class="hover:underline"><x-i18n :text="$news['title']" tag="h3" class="text-xl" /></a>
        @else
            <x-i18n :text="$news['title']" tag="h3" class="text-xl" />
        @endif

        <x-i18n :text="$news['summary']" tag="p" class="mt-3 line-clamp-3 flex-1 text-sm leading-7 text-muted" />

        @if ($newsUrl)
            <x-i18n :text="ui('pages.news.read_more')" tag="a" href="{{ $newsUrl }}" class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-secondary hover:text-primary" />
        @endif
    </div>
</article>
