<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionSecretary extends Model
{
    use HasFactory;

    protected $fillable = [
        'region_id', 'name', 'role_en', 'role_uz', 'role_ja',
        'affiliation_en', 'affiliation_uz', 'affiliation_ja',
        'email', 'phone', 'telegram',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function role(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->role_uz ?? $this->role_en,
            'ja' => $this->role_ja ?? $this->role_en,
            default => $this->role_en,
        };
    }

    public function affiliation(): ?string
    {
        return match (app()->getLocale()) {
            'uz' => $this->affiliation_uz ?? $this->affiliation_en,
            'ja' => $this->affiliation_ja ?? $this->affiliation_en,
            default => $this->affiliation_en,
        };
    }
}
