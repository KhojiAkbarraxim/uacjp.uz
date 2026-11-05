<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('id');
            $table->text('body_en')->nullable()->after('summary_ja');
            $table->text('body_uz')->nullable()->after('body_en');
            $table->text('body_ja')->nullable()->after('body_uz');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn(['slug', 'body_en', 'body_uz', 'body_ja']);
        });
    }
};
