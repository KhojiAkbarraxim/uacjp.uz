<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_uz')->nullable();
            $table->string('title_ja')->nullable();
            $table->date('date');
            $table->string('location_en');
            $table->string('location_uz')->nullable();
            $table->string('location_ja')->nullable();
            $table->string('type_en');
            $table->string('type_uz')->nullable();
            $table->string('type_ja')->nullable();
            $table->boolean('is_past')->default(false);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->index(['is_past', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
