<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Slug
{
    /**
     * A URL-safe slug derived from Uzbek text, unique within $table.$column.
     *
     * Str::slug folds the new Uzbek alphabet down to ASCII - o to o, g to g,
     * s to s, c to c - so titles that differ only by those letters collapse
     * onto the same slug. regions.slug and news.slug are unique, so the
     * generated value gets -2, -3 and so on until it is free. A slug the admin
     * typed is never renumbered: it is validated and rejected instead, so they
     * see the clash rather than silently getting a different address.
     */
    public static function unique(string $table, ?string $source, ?int $ignoreId = null, string $column = 'slug'): string
    {
        $base = Str::slug((string) $source);

        if ($base === '') {
            return '';
        }

        $slug = $base;

        for ($suffix = 2; self::taken($table, $column, $slug, $ignoreId); $suffix++) {
            $slug = "{$base}-{$suffix}";
        }

        return $slug;
    }

    private static function taken(string $table, string $column, string $slug, ?int $ignoreId): bool
    {
        return DB::table($table)
            ->where($column, $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists();
    }
}
