<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'value_en', 'value_uz', 'value_ja', 'meta'];

    protected $casts = ['meta' => 'array'];

    public static function get(string $key, string $locale = null): ?string
    {
        $locale = $locale ?? app()->getLocale();
        $setting = self::where('key', $key)->first();
        if (! $setting) {
            return null;
        }
        return match ($locale) {
            'uz' => $setting->value_uz ?? $setting->value_en,
            'ja' => $setting->value_ja ?? $setting->value_en,
            default => $setting->value_en,
        };
    }

    public static function set(string $key, string $value, string $locale = 'en'): void
    {
        $column = match ($locale) {
            'uz' => 'value_uz',
            'ja' => 'value_ja',
            default => 'value_en',
        };
        self::updateOrCreate(
            ['key' => $key],
            [$column => $value]
        );
    }
}
