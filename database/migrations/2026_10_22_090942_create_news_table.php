<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->string('title_uz')->nullable();
            $table->string('title_ja')->nullable();
            $table->string('type_en')->nullable();
            $table->string('type_uz')->nullable();
            $table->string('type_ja')->nullable();
            $table->date('date');
            $table->text('summary_en')->nullable();
            $table->text('summary_uz')->nullable();
            $table->text('summary_ja')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
