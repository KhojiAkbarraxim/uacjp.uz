<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en', 'title_uz', 'title_ja',
        'date', 'location_en', 'location_uz', 'location_ja',
        'type_en', 'type_uz', 'type_ja',
        'is_past', 'image',
    ];

    public function title(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->title_uz ?? $this->title_en,
            'ja' => $this->title_ja ?? $this->title_en,
            default => $this->title_en,
        };
    }

    public function location(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->location_uz ?? $this->location_en,
            'ja' => $this->location_ja ?? $this->location_en,
            default => $this->location_en,
        };
    }

    public function type(): string
    {
        return match (app()->getLocale()) {
            'uz' => $this->type_uz ?? $this->type_en,
            'ja' => $this->type_ja ?? $this->type_en,
            default => $this->type_en,
        };
    }

    public function scopeUpcoming($query)
    {
        return $query->where('is_past', false)->orderBy('date');
    }

    public function scopePast($query)
    {
        return $query->where('is_past', true)->orderByDesc('date');
    }
}
