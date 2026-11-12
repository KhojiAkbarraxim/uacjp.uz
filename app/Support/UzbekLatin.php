<?php

namespace App\Support;

/**
 * Converts Uzbek text between the old Latin alphabet (oʻ, gʻ, sh, ch) and the
 * new one (ö, ğ, ş, ç). toNew() is idempotent: text already in the new
 * alphabet is returned unchanged. URLs and email addresses are left untouched.
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

    /**
     * The reverse, for services that only know the old alphabet. Lossless,
     * since every new letter has exactly one old spelling.
     */
    public static function toOld(?string $text): ?string
    {
        if ($text === null || $text === '') {
            return $text;
        }

        return preg_replace_callback('~\p{L}+~u', function (array $m) {
            $caps = mb_strtoupper($m[0]) === $m[0] && mb_strlen($m[0]) > 1;

            return strtr($m[0], [
                'ö' => 'oʻ', 'Ö' => 'Oʻ', 'ğ' => 'gʻ', 'Ğ' => 'Gʻ',
                'ş' => 'sh', 'Ş' => $caps ? 'SH' : 'Sh', 'ç' => 'ch', 'Ç' => $caps ? 'CH' : 'Ch',
            ]);
        }, $text);
    }

    /**
     * toNew() plus the ASCII apostrophe fix for the tutuq belgisi. The full
     * pipeline from typed or Azure-returned Uzbek to what the site displays.
     */
    public static function toDisplay(?string $text): ?string
    {
        $text = self::toNew($text);

        return $text === null ? null : preg_replace("~(?<=\\p{L})['’](?=\\p{L})~u", 'ʼ', $text);
    }

    private static function word(string $word): string
    {
        $word = preg_replace(['~O'.self::MARK.'~u', '~o'.self::MARK.'~u', '~G'.self::MARK.'~u', '~g'.self::MARK.'~u'], ['Ö', 'ö', 'Ğ', 'ğ'], $word);

        return strtr($word, ['SH' => 'Ş', 'Sh' => 'Ş', 'sh' => 'ş', 'CH' => 'Ç', 'Ch' => 'Ç', 'ch' => 'ç']);
    }
}
