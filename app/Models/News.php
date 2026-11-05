<?php

namespace App\Models;

use App\Models\Concerns\HasLocaleFields;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory, HasLocaleFields;

    protected $fillable = [
        'slug', 'title_en', 'title_uz', 'title_ja',
        'type_en', 'type_uz', 'type_ja',
        'date', 'summary_en', 'summary_uz', 'summary_ja',
        'body_en', 'body_uz', 'body_ja', 'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function title(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->title_uz ?? $this->title_en,
            'ja' => $this->title_ja ?? $this->title_en,
            default => $this->title_en,
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

    public function type(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->type_uz ?? $this->type_en,
            'ja' => $this->type_ja ?? $this->type_en,
            default => $this->type_en,
        };
    }

    public function dateDict(): array
    {
        $date = Carbon::parse($this->date);

        return [
            'en' => $date->copy()->locale('en')->translatedFormat('F j, Y'),
            'uz' => $date->copy()->locale('uz_Latn')->translatedFormat('Y-\\y\\i\\l j-F'),
            'ja' => $date->copy()->locale('ja')->translatedFormat('Y年n月j日'),
        ];
    }

    public function toFrontendArray(): array
    {
        return [
            'slug' => $this->slug,
            'title' => $this->localeField('title'),
            'type' => $this->localeField('type'),
            'date' => $this->dateDict(),
            'summary' => $this->localeField('summary'),
            'body' => $this->localeField('body'),
            'image' => $this->image,
        ];
    }
}
