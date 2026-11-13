@props(['milestone'])

<article class="academic-card overflow-hidden">
    @if (! empty($milestone['thumbnail']))
        <img
            src="{{ asset($milestone['thumbnail']) }}"
            alt=""
            loading="lazy"
            decoding="async"
            class="h-48 w-full object-cover"
        >
    @endif
    <div class="p-6">
        <div class="mb-3 flex flex-wrap items-center gap-2">
            <x-i18n :text="$milestone['date']" tag="span" class="eyebrow" />
            <x-i18n :text="$milestone['type']" tag="span" class="chip" />
        </div>
        <x-i18n :text="$milestone['title']" tag="h3" class="text-xl leading-snug" />
        <x-i18n :text="$milestone['summary']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
        @if (! empty($milestone['slug']))
            <x-i18n
                :text="ui('pages.news.read_more')"
                tag="a"
                href="{{ route('news.show', $milestone['slug']) }}"
                class="mt-4 inline-block text-sm font-semibold text-secondary hover:text-primary"
            />
        @endif
    </div>
</article>
