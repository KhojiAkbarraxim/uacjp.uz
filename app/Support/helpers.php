<?php

use App\Support\Locales;

if (! function_exists('i18n_dict')) {
    /**
     * Normalise a value into a full {en, uz, ja} set, filling any language the
     * record does not have yet.
     *
     * Content is authored in Uzbek and translated afterwards, so a record can
     * legitimately be saved with English and Japanese still empty. Each missing
     * language falls back through Locales::FALLBACK - English first, because a
     * Japanese reader is better served English than Uzbek, then Uzbek, which is
     * the one language always present. An empty string counts as missing: the
     * old `??` chain only caught null, so a blank column rendered as a blank
     * heading.
     */
    function i18n_dict(array|string|null $value): array
    {
        if (! is_array($value)) {
            $text = (string) ($value ?? '');

            return ['en' => $text, 'uz' => $text, 'ja' => $text];
        }

        $pick = function (string $locale) use ($value): string {
            foreach ([$locale, ...Locales::FALLBACK] as $candidate) {
                if (filled($value[$candidate] ?? null)) {
                    return (string) $value[$candidate];
                }
            }

            // Nothing in the known languages: take whatever the value does hold
            // rather than render an empty element.
            foreach ($value as $fallback) {
                if (filled($fallback)) {
                    return (string) $fallback;
                }
            }

            return '';
        };

        return ['en' => $pick('en'), 'uz' => $pick('uz'), 'ja' => $pick('ja')];
    }
}

if (! function_exists('i18n_text')) {
    function i18n_text(array|string|null $value, ?string $locale = null): string
    {
        $dict = i18n_dict($value);

        return $dict[$locale ?? app()->getLocale()] ?? $dict[Locales::SOURCE];
    }
}

if (! function_exists('ui')) {
    function ui(string $key): array
    {
        return i18n_dict(config("ui.{$key}"));
    }
}
