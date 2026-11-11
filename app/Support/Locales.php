<?php

namespace App\Support;

/**
 * Which language the site is written in, and what to show when a translation
 * is missing. Single source of truth: the admin forms, the validation rules and
 * the public fallback all read these constants rather than naming a locale.
 */
class Locales
{
    /**
     * The language content is authored in. English and Japanese are produced
     * from it by the translate button, so only this one can be required.
     */
    public const SOURCE = 'uz';

    /** Admin form order - the authored language first. */
    public const ORDER = ['uz', 'en', 'ja'];

    /**
     * Where to look when the requested locale is empty, in order.
     *
     * English comes before Uzbek on purpose: a Japanese visitor reading a
     * record that has not been translated yet is better served English than
     * Uzbek. Uzbek is the last resort because it is the one always present.
     */
    public const FALLBACK = ['en', 'uz'];
}
