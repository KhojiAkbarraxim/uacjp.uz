<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * News and events move from one 'image' to a 'thumbnail' (shown in cards and
 * listings) plus an optional gallery of up to 7 images (news_images,
 * event_images - see the next two migrations). Existing image values become
 * the thumbnail, so cards keep rendering; nothing is added to the gallery
 * automatically, since there is no way to guess which extra photos belong
 * with a record that only ever had one.
 */
return new class extends Migration
{
    private const TABLES = ['news', 'events'];

    public function up(): void
    {
        foreach (self::TABLES as $table) {
            Schema::table($table, fn (Blueprint $blueprint) => $blueprint->string('thumbnail')->nullable()->after('image'));

            DB::table($table)->whereNotNull('image')->update(['thumbnail' => DB::raw('image')]);

            Schema::table($table, fn (Blueprint $blueprint) => $blueprint->dropColumn('image'));
        }
    }

    public function down(): void
    {
        foreach (self::TABLES as $table) {
            Schema::table($table, fn (Blueprint $blueprint) => $blueprint->string('image')->nullable()->after('thumbnail'));

            DB::table($table)->whereNotNull('thumbnail')->update(['image' => DB::raw('thumbnail')]);

            Schema::table($table, fn (Blueprint $blueprint) => $blueprint->dropColumn('thumbnail'));
        }
    }
};
