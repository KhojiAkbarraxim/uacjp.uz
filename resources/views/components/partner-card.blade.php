@props(['partner'])

<article class="academic-card h-full p-6">
    <div class="space-y-4">
        <x-i18n :text="$partner['type']" tag="span" class="eyebrow" />
        <div>
            <h3 class="text-2xl">{{ $partner['name'] }}</h3>
            <x-i18n :text="$partner['description']" tag="p" class="mt-3 text-sm leading-7 text-muted" />
        </div>
    </div>
</article>
