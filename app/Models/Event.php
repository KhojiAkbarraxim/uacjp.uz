<?php

namespace App\Models;

use App\Models\Concerns\HasLocaleFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory, HasLocaleFields;

    protected $fillable = [
        'title_en', 'title_uz', 'title_ja',
        'date', 'location_en', 'location_uz', 'location_ja',
        'type_en', 'type_uz', 'type_ja',
        'is_past', 'image',
    ];

    protected $casts = [
        'date' => 'date',
        'is_past' => 'boolean',
    ];

    public function scopeUpcoming($query)
    {
        return $query->where('is_past', false)->orderBy('date');
    }

    public function scopePast($query)
    {
        return $query->where('is_past', true)->orderByDesc('date');
    }

    public function toFrontendArray(): array
    {
        return [
            'title' => $this->localeField('title'),
            'date' => optional($this->date)?->toDateString(),
            'location' => $this->localeField('location'),
            'type' => $this->localeField('type'),
            'is_past' => $this->is_past,
            'image' => $this->image,
        ];
    }
}
