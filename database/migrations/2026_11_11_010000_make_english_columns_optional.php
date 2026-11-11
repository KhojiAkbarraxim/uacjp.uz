<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Content is authored in Uzbek now; English and Japanese are translated from it
 * afterwards. Six columns were declared NOT NULL back when English was the
 * source, so a record could not be saved before it had been translated.
 *
 * Only these six are affected - every other locale column was already nullable.
 * The *_uz twins are deliberately NOT made NOT NULL: rows written while English
 * was the source legitimately have an empty Uzbek value, and the public fallback
 * chain relies on that NULL. Uzbek is required by validation, not by the schema.
 */
return new class extends Migration
{
    private const COLUMNS = [
        'regions' => ['name_en', 'short_name_en'],
        'events' => ['title_en', 'location_en', 'type_en'],
        'news' => ['title_en'],
    ];

    public function up(): void
    {
        $this->setNullable(true);
    }

    public function down(): void
    {
        // Going back requires every row to have an English value; rows authored
        // in Uzbek only would violate the constraint, so backfill them first.
        foreach (self::COLUMNS as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach ($columns as $column) {
                $uz = str_replace('_en', '_uz', $column);
                \Illuminate\Support\Facades\DB::table($table)
                    ->whereNull($column)
                    ->update([$column => \Illuminate\Support\Facades\DB::raw("COALESCE({$uz}, '')")]);
            }
        }

        $this->setNullable(false);
    }

    private function setNullable(bool $nullable): void
    {
        foreach (self::COLUMNS as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($columns, $nullable) {
                foreach ($columns as $column) {
                    $blueprint->string($column)->nullable($nullable)->change();
                }
            });
        }
    }
};
