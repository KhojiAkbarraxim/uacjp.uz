@props(['activity'])

<article class="academic-card h-full p-6">
    <div class="mb-5 flex flex-wrap items-center gap-2">
        <x-i18n :text="$activity['category']" tag="span" class="eyebrow" />
        <x-i18n :text="$activity['date']" tag="span" class="chip" />
    </div>

    <div class="space-y-4">
        <div>
            <x-i18n :text="$activity['title']" tag="h3" class="text-2xl" />
            <x-i18n :text="$activity['location']" tag="p" class="mt-2 text-sm font-medium uppercase tracking-[0.18em] text-muted" />
        </div>

        <x-i18n :text="$activity['description']" tag="p" class="text-sm leading-7 text-muted" />

        @if ($activity['speaker'])
            <p class="rounded-2xl bg-slate-50 px-4 py-3 text-sm text-primary">
                <x-i18n :text="ui('common.speaker_lead')" tag="span" class="font-semibold" />
                <x-i18n :text="$activity['speaker']" />
            </p>
        @endif
    </div>
</article>
