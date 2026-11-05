<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role_en')->nullable();
            $table->string('role_uz')->nullable();
            $table->string('role_ja')->nullable();
            $table->string('affiliation_en')->nullable();
            $table->string('affiliation_uz')->nullable();
            $table->string('affiliation_ja')->nullable();
            $table->string('field_en')->nullable();
            $table->string('field_uz')->nullable();
            $table->string('field_ja')->nullable();
            $table->string('field_slug')->nullable();
            $table->string('region_en')->nullable();
            $table->string('region_uz')->nullable();
            $table->string('region_ja')->nullable();
            $table->string('region_slug')->nullable();
            $table->string('type')->default('General');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['type', 'region_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
