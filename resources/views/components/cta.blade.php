@props([
    'title',
    'description',
    'primaryLabel',
    'primaryHref',
    'secondaryLabel' => null,
    'secondaryHref' => null,
])

<section {{ $attributes->class(['section-shell']) }}>
    <div class="container-shell">
        <div class="surface-panel pattern-grid relative overflow-hidden px-8 py-10 sm:px-12 sm:py-14">
            <div class="absolute -right-12 top-0 h-36 w-36 rounded-full bg-secondary/10 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 h-36 w-36 rounded-full bg-primary/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
                <div class="max-w-3xl space-y-4">
                    <x-i18n :text="ui('common.get_involved')" tag="span" class="eyebrow" />
                    <x-i18n :text="$title" tag="h2" class="text-3xl sm:text-4xl" />
                    <x-i18n :text="$description" tag="p" class="text-base leading-8 text-muted sm:text-lg" />
                </div>

                <div class="flex flex-col gap-3 sm:flex-row">
                    <x-i18n :text="$primaryLabel" tag="a" href="{{ $primaryHref }}" class="btn-primary" />
                    @if ($secondaryLabel && $secondaryHref)
                        <x-i18n :text="$secondaryLabel" tag="a" href="{{ $secondaryHref }}" class="btn-secondary" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
