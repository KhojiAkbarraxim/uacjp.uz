<?php

use App\Support\UzbekLatin;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Rewrites admin-managed Uzbek content from the old Latin alphabet (oʻ, gʻ, sh, ch)
 * to the new one (ö, ğ, ş, ç). Values that are just a copy of the English text
 * (the admin forms fall back to English when Uzbek is left empty) are skipped.
 */
return new class extends Migration
{
    /** table => [uz column => en column] */
    private const COLUMNS = [
        'regions' => [
            'name_uz' => 'name_en', 'short_name_uz' => 'short_name_en', 'status_uz' => 'status_en',
            'members_count_uz' => 'members_count_en', 'summary_uz' => 'summary_en', 'excerpt_uz' => 'excerpt_en',
            'about_uz' => 'about_en', 'city_uz' => 'city_en', 'locations_uz' => 'locations_en',
        ],
        'region_secretaries' => ['role_uz' => 'role_en', 'affiliation_uz' => 'affiliation_en'],
        'events' => ['title_uz' => 'title_en', 'location_uz' => 'location_en', 'type_uz' => 'type_en'],
        'news' => ['title_uz' => 'title_en', 'type_uz' => 'type_en', 'summary_uz' => 'summary_en', 'body_uz' => 'body_en'],
        'members' => ['role_uz' => 'role_en', 'affiliation_uz' => 'affiliation_en', 'field_uz' => 'field_en', 'region_uz' => 'region_en'],
        'site_settings' => ['value_uz' => 'value_en'],
    ];

    /** Region JSON columns holding nested {en, uz, ja} dictionaries. */
    private const REGION_JSON = ['universities', 'activities', 'gallery', 'plans'];

    public function up(): void
    {
        foreach (self::COLUMNS as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            foreach (DB::table($table)->get() as $row) {
                $changes = [];

                foreach ($columns as $uz => $en) {
                    if ($row->{$uz} !== null && $row->{$uz} !== $row->{$en}) {
                        $converted = UzbekLatin::toNew($row->{$uz});
                        if ($converted !== $row->{$uz}) {
                            $changes[$uz] = $converted;
                        }
                    }
                }

                if ($table === 'regions') {
                    foreach (self::REGION_JSON as $column) {
                        $value = json_decode($row->{$column} ?? 'null', true);
                        if (is_array($value)) {
                            $converted = $this->convertDicts($value);
                            if ($converted !== $value) {
                                $changes[$column] = json_encode($converted, JSON_UNESCAPED_UNICODE);
                            }
                        }
                    }
                }

                if ($changes) {
                    DB::table($table)->where('id', $row->id)->update($changes);
                }
            }
        }
    }

    public function down(): void
    {
        // Not reversible: the old alphabet cannot be reliably reconstructed.
    }

    private function convertDicts(array $value): array
    {
        if (isset($value['uz']) && is_string($value['uz']) && $value['uz'] !== ($value['en'] ?? null)) {
            $value['uz'] = UzbekLatin::toNew($value['uz']);
        }

        foreach ($value as $key => $item) {
            if (is_array($item)) {
                $value[$key] = $this->convertDicts($item);
            }
        }

        return $value;
    }
};
