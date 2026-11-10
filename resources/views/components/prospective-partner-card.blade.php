@props(['partner', 'badge' => null])

<article class="academic-card flex h-full flex-col gap-5 p-6">
    <div class="flex h-28 items-center justify-center rounded-[1rem] border border-line/60 bg-white px-5 py-4">
        <x-i18n
            :text="$partner['name']"
            tag="img"
            target="alt"
            src="{{ asset($partner['logo']) }}"
            loading="lazy"
            decoding="async"
            class="max-h-full max-w-full w-auto object-contain"
        />
    </div>

    <div class="flex flex-wrap items-center gap-2">
        <x-i18n :text="$partner['type']" tag="span" class="text-xs font-semibold uppercase tracking-[0.18em] text-muted" />

        @if ($badge)
            <x-i18n :text="$badge" tag="span" class="chip" />
        @endif
    </div>

    <div>
        <x-i18n :text="$partner['name']" tag="h3" class="text-xl leading-snug" />
        <x-i18n :text="$partner['description']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
    </div>
</article>
