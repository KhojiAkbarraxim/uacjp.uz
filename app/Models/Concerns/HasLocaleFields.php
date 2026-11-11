<?php

namespace App\Models\Concerns;

use App\Support\Locales;

trait HasLocaleFields
{
    /**
     * The raw {en, uz, ja} triplet, missing languages included.
     *
     * No fallback happens here on purpose: the public side runs the values
     * through i18n_dict(), which fills every language and emits all three as
     * data-i18n-* attributes for the client-side switcher. Filling them here
     * too would hide from that layer which languages a record actually has.
     */
    public function localeField(string $base): array
    {
        return [
            'en' => $this->{$base.'_en'},
            'uz' => $this->{$base.'_uz'},
            'ja' => $this->{$base.'_ja'},
        ];
    }

    /**
     * One value to identify this record by in the admin panel.
     *
     * The authored language first, then the public fallback chain, so records
     * written before Uzbek became the source language still show a name
     * instead of an empty table cell.
     */
    public function authored(string $base): ?string
    {
        foreach ([Locales::SOURCE, ...Locales::FALLBACK] as $locale) {
            if (filled($this->{$base.'_'.$locale})) {
                return $this->{$base.'_'.$locale};
            }
        }

        return null;
    }
}
