@props([
    'eyebrow' => null,
    'title',
    'description' => null,
    'align' => 'left',
])

@php
    $alignment = $align === 'center' ? 'mx-auto max-w-3xl text-center' : 'max-w-3xl';
@endphp

<div {{ $attributes->class([$alignment, 'space-y-4']) }}>
    @if ($eyebrow)
        <x-i18n :text="$eyebrow" tag="span" class="eyebrow" />
    @endif

    <div class="space-y-3">
        <x-i18n :text="$title" tag="h2" class="text-3xl leading-tight sm:text-4xl" />

        @if ($description)
            <x-i18n :text="$description" tag="p" class="text-base leading-8 text-muted sm:text-lg" />
        @endif
    </div>
</div>
