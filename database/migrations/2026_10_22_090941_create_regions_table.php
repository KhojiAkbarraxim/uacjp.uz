<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name_en');
            $table->string('name_uz')->nullable();
            $table->string('name_ja')->nullable();
            $table->string('short_name_en');
            $table->string('short_name_uz')->nullable();
            $table->string('short_name_ja')->nullable();
            $table->string('status_en')->nullable();
            $table->string('status_uz')->nullable();
            $table->string('status_ja')->nullable();
            $table->string('members_count_en')->nullable();
            $table->string('members_count_uz')->nullable();
            $table->string('members_count_ja')->nullable();
            $table->text('summary_en')->nullable();
            $table->text('summary_uz')->nullable();
            $table->text('summary_ja')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->text('excerpt_uz')->nullable();
            $table->text('excerpt_ja')->nullable();
            $table->text('about_en')->nullable();
            $table->text('about_uz')->nullable();
            $table->text('about_ja')->nullable();
            $table->string('image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city_en')->nullable();
            $table->string('city_uz')->nullable();
            $table->string('city_ja')->nullable();
            $table->string('locations_en')->nullable();
            $table->string('locations_uz')->nullable();
            $table->string('locations_ja')->nullable();
            $table->json('universities')->nullable();
            $table->json('activities')->nullable();
            $table->json('gallery')->nullable();
            $table->json('plans')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
