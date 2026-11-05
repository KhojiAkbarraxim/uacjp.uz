<?php

namespace App\Models;

use App\Models\Concerns\HasLocaleFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory, HasLocaleFields;

    protected $fillable = [
        'slug', 'name_en', 'name_uz', 'name_ja',
        'short_name_en', 'short_name_uz', 'short_name_ja',
        'status_en', 'status_uz', 'status_ja',
        'members_count_en', 'members_count_uz', 'members_count_ja',
        'summary_en', 'summary_uz', 'summary_ja',
        'excerpt_en', 'excerpt_uz', 'excerpt_ja',
        'about_en', 'about_uz', 'about_ja',
        'image', 'hero_image',
        'email', 'phone',
        'city_en', 'city_uz', 'city_ja',
        'locations_en', 'locations_uz', 'locations_ja',
        'universities', 'activities', 'gallery', 'plans',
        'sort_order',
    ];

    protected $casts = [
        'universities' => 'array',
        'activities' => 'array',
        'gallery' => 'array',
        'plans' => 'array',
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

    public function toFrontendArray(): array
    {
        return [
            'slug' => $this->slug,
            'name' => $this->localeField('name'),
            'short_name' => $this->localeField('short_name'),
            'status' => $this->localeField('status'),
            'members_count' => $this->localeField('members_count'),
            'locations' => $this->localeField('locations'),
            'summary' => $this->localeField('summary'),
            'excerpt' => $this->localeField('excerpt'),
            'about' => $this->localeField('about'),
            'image' => $this->image,
            'hero_image' => $this->hero_image,
            'universities' => $this->universities ?? [],
            'activities' => $this->activities ?? [],
            'secretaries' => $this->secretaries
                ->map(fn (RegionSecretary $secretary) => $secretary->toFrontendArray())
                ->all(),
            'contact' => [
                'email' => $this->email,
                'phone' => $this->phone,
                'city' => $this->localeField('city'),
            ],
            'gallery' => $this->gallery ?? [],
            'plans' => $this->plans ?? [],
        ];
    }
}
