<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->text('bio_en')->nullable()->after('affiliation_ja');
            $table->text('bio_uz')->nullable()->after('bio_en');
            $table->text('bio_ja')->nullable()->after('bio_uz');
        });
    }

    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn(['bio_en', 'bio_uz', 'bio_ja']);
        });
    }
};
