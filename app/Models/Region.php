<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'name_en', 'name_uz', 'name_ja',
        'short_name_en', 'short_name_uz', 'short_name_ja',
        'status', 'members_count',
        'summary_en', 'summary_uz', 'summary_ja',
        'excerpt_en', 'excerpt_uz', 'excerpt_ja',
        'image', 'hero_image',
        'email', 'phone',
        'city_en', 'city_uz', 'city_ja',
        'locations', 'universities', 'activities',
    ];

    protected $casts = [
        'locations' => 'array',
        'universities' => 'array',
        'activities' => 'array',
    ];

    public function secretaries(): HasMany
    {
        return $this->hasMany(RegionSecretary::class);
    }

    public function name(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->name_uz ?? $this->name_en,
            'ja' => $this->name_ja ?? $this->name_en,
            default => $this->name_en,
        };
    }

    public function shortName(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->short_name_uz ?? $this->short_name_en,
            'ja' => $this->short_name_ja ?? $this->short_name_en,
            default => $this->short_name_en,
        };
    }

    public function summary(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->summary_uz ?? $this->summary_en,
            'ja' => $this->summary_ja ?? $this->summary_en,
            default => $this->summary_en,
        };
    }

    public function excerpt(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->excerpt_uz ?? $this->excerpt_en,
            'ja' => $this->excerpt_ja ?? $this->excerpt_en,
            default => $this->excerpt_en,
        };
    }

    public function city(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->city_uz ?? $this->city_en,
            'ja' => $this->city_ja ?? $this->city_en,
            default => $this->city_en,
        };
    }
}
