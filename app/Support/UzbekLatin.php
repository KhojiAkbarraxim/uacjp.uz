<?php

namespace App\Support;

/**
 * Converts Uzbek text from the old Latin alphabet (oʻ, gʻ, sh, ch) to the
 * new one (ö, ğ, ş, ç). Idempotent: text already in the new alphabet is
 * returned unchanged. URLs and email addresses are left untouched.
 */
class UzbekLatin
{
    // Any apostrophe-like mark used after o/g in the old alphabet. The
    // modifier letter apostrophe (ʼ) is the tutuq belgisi and is kept.
    private const MARK = "[ʻ‘'’`]";

    public static function toNew(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        return preg_replace_callback(
            '~(?:https?://|www\.)\S+|\S+@\S+|[^\s@]+~u',
            fn (array $m) => str_contains($m[0], '@') || preg_match('~^(?:https?://|www\.)~i', $m[0])
                ? $m[0]
                : self::word($m[0]),
            $text,
        );
    }

    private static function word(string $word): string
    {
        $word = preg_replace(['~O'.self::MARK.'~u', '~o'.self::MARK.'~u', '~G'.self::MARK.'~u', '~g'.self::MARK.'~u'], ['Ö', 'ö', 'Ğ', 'ğ'], $word);

        return strtr($word, ['SH' => 'Ş', 'Sh' => 'Ş', 'sh' => 'ş', 'CH' => 'Ç', 'Ch' => 'Ç', 'ch' => 'ç']);
    }
}
