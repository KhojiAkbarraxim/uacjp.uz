@props([
    'member',
    'compact' => false,
])

@php
    $initials = collect(explode(' ', $member['name']))
        ->take(2)
        ->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');

    // Affiliations arrive later from the client, so an officer may have none yet.
    $affiliation = array_filter($member['affiliation'] ?? []);

    $hasBio = (bool) array_filter($member['bio'] ?? []);
@endphp

<article
    class="academic-card h-full p-6"
    data-member-card
    data-region="{{ $member['region_slug'] ?? '' }}"
    data-field="{{ $member['field_slug'] ?? '' }}"
>
    <div class="flex {{ $compact ? 'items-center' : 'items-start' }} gap-4">
        @if (! empty($member['photo']))
            <img
                src="{{ asset($member['photo']) }}"
                alt="{{ $member['name'] }}"
                loading="lazy"
                decoding="async"
                class="h-16 w-16 shrink-0 rounded-2xl object-cover"
            >
        @else
            <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-2xl bg-primary text-lg font-semibold tracking-[0.16em] text-white">
                {{ $initials }}
            </div>
        @endif

        <div class="space-y-2">
            <div>
                <h3 class="text-xl">{{ $member['name'] }}</h3>
                <x-i18n :text="$member['role']" tag="p" class="text-sm font-medium text-secondary" />
            </div>

            @if ($affiliation)
                <x-i18n :text="$member['affiliation']" tag="p" class="text-sm leading-7 text-muted" />
            @endif

            @if (! empty(array_filter($member['field'] ?? [])) || ! empty(array_filter($member['region'] ?? [])))
                <div class="flex flex-wrap gap-2">
                    @if (! empty(array_filter($member['field'] ?? [])))
                        <x-i18n :text="$member['field']" tag="span" class="chip" />
                    @endif
                    @if (! empty(array_filter($member['region'] ?? [])))
                        <x-i18n :text="$member['region']" tag="span" class="chip" />
                    @endif
                </div>
            @endif

            @if (! empty($member['contact']))
                <p class="text-sm text-primary">{{ $member['contact'] }}</p>
            @endif

            @if ($hasBio)
                {{-- Collapsed by default: a full biography would otherwise make one
                     card far taller than its neighbours in the grid. The text keeps
                     its blank lines via whitespace-pre-line, so the language
                     switcher can swap it as a single string. --}}
                <details class="group pt-1">
                    <summary class="cursor-pointer list-none text-sm font-semibold text-secondary hover:text-primary">
                        <x-i18n :text="ui('pages.members_index.bio_toggle')" />
                        <span class="inline-block transition-transform group-open:rotate-180" aria-hidden="true">&#9662;</span>
                    </summary>
                    <x-i18n :text="$member['bio']" tag="p" class="mt-3 whitespace-pre-line text-sm leading-7 text-muted" />
                </details>
            @endif
        </div>
    </div>
</article>
