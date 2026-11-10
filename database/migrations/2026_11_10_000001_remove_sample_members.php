<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Drops the placeholder profiles that `static:seed` created from the old
 * config/uac.php sample data. The real UAC officers replace them.
 */
return new class extends Migration
{
    private const SAMPLE_NAMES = [
        'Dilshod Abdullaev',
        'Aziza Murodova',
        'Bekzod Kholmatov',
        'Nilufar Ergasheva',
        'Madina Khusanova',
        'Shahzod Mamatqulov',
        'Gulrukh Mirzayeva',
        'Otabek Tursunov',
        'Saida Kadirova',
    ];

    public function up(): void
    {
        if (Schema::hasTable('members')) {
            DB::table('members')->whereIn('name', self::SAMPLE_NAMES)->delete();
        }
    }

    public function down(): void
    {
        // The sample profiles were never real content; nothing to restore.
    }
};
