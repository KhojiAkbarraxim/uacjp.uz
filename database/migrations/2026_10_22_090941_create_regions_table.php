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
            $table->string('status')->default('Active');
            $table->string('members_count')->nullable();
            $table->text('summary_en')->nullable();
            $table->text('summary_uz')->nullable();
            $table->text('summary_ja')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->text('excerpt_uz')->nullable();
            $table->text('excerpt_ja')->nullable();
            $table->string('image')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('city_en')->nullable();
            $table->string('city_uz')->nullable();
            $table->string('city_ja')->nullable();
            $table->json('locations')->nullable();
            $table->json('universities')->nullable();
            $table->json('activities')->nullable();
            $table->timestamps();
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
