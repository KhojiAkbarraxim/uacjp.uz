@props([
    'region',
    'showImage' => true,
])

<article class="academic-card group overflow-hidden">
    @if ($showImage)
        <div class="relative h-56 overflow-hidden">
            <img
                src="{{ asset($region['image']) }}"
                width="512"
                height="512"
                alt="{{ $region['name']['en'] }} chapter overview"
                class="h-full w-full object-cover transition duration-500 group-hover:scale-105"
                loading="lazy"
                decoding="async"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-primary/85 via-primary/25 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 p-5 text-white">
                <x-i18n :text="$region['status']" tag="span" class="inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-semibold uppercase tracking-[0.18em] text-primary" />
                <x-i18n :text="$region['name']" tag="h3" class="mt-3 text-2xl text-white" />
            </div>
        </div>
    @endif

    <div class="space-y-5 p-6">
        @unless ($showImage)
            <div class="space-y-3">
                <x-i18n :text="$region['status']" tag="span" class="eyebrow" />
                <x-i18n :text="$region['name']" tag="h3" class="text-2xl" />
            </div>
        @endunless

        <x-i18n :text="$region['summary']" tag="p" class="text-sm leading-7 text-muted" />

        <div class="flex flex-wrap gap-2">
            <x-i18n :text="$region['locations']" tag="span" class="chip" />
            <x-i18n :text="$region['members_count']" tag="span" class="chip" />
        </div>

        <a href="{{ route('regions.show', $region['slug']) }}" class="inline-flex items-center gap-2 text-sm font-semibold text-secondary transition hover:text-primary">
            <x-i18n :text="ui('common.explore_chapter')" />
            <span aria-hidden="true">&rarr;</span>
        </a>
    </div>
</article>
