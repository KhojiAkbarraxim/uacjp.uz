@props([
    'member',
    'compact' => false,
])

@php
    $initials = collect(explode(' ', $member['name']))
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');
@endphp

<article
    class="academic-card h-full p-6"
    data-member-card
    data-region="{{ $member['region_slug'] ?? '' }}"
    data-field="{{ $member['field_slug'] ?? '' }}"
>
    <div class="flex {{ $compact ? 'items-center' : 'items-start' }} gap-4">
        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-primary text-lg font-semibold tracking-[0.16em] text-white">
            {{ $initials }}
        </div>

        <div class="space-y-2">
            <div>
                <h3 class="text-xl">{{ $member['name'] }}</h3>
                <x-i18n :text="$member['role']" tag="p" class="text-sm font-medium text-secondary" />
            </div>

            <x-i18n :text="$member['affiliation']" tag="p" class="text-sm leading-7 text-muted" />

            <div class="flex flex-wrap gap-2">
                @isset($member['field'])
                    <x-i18n :text="$member['field']" tag="span" class="chip" />
                @endisset
                @isset($member['region'])
                    <x-i18n :text="$member['region']" tag="span" class="chip" />
                @endisset
            </div>

            @if (! empty($member['contact']))
                <p class="text-sm text-primary">{{ $member['contact'] }}</p>
            @endif
        </div>
    </div>
</article>
