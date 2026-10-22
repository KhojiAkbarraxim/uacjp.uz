<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('region_secretaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('region_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('role_en')->nullable();
            $table->string('role_uz')->nullable();
            $table->string('role_ja')->nullable();
            $table->string('affiliation_en')->nullable();
            $table->string('affiliation_uz')->nullable();
            $table->string('affiliation_ja')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('telegram')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('region_secretaries');
    }
};
