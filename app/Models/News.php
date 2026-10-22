<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 'title_uz', 'title_ja',
        'type_en', 'type_uz', 'type_ja',
        'date', 'summary_en', 'summary_uz', 'summary_ja', 'image',
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

    public function scopeLatest($query)
    {
        return $query->orderByDesc('date');
    }
}
