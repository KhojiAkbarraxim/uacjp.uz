<?php

namespace App\Models;

use App\Models\Concerns\HasLocaleFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegionSecretary extends Model
{
    use HasFactory, HasLocaleFields;

    protected $fillable = [
        'region_id', 'name', 'role_en', 'role_uz', 'role_ja',
        'affiliation_en', 'affiliation_uz', 'affiliation_ja',
        'email', 'phone', 'telegram',
    ];

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function toFrontendArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->localeField('role'),
            'affiliation' => $this->localeField('affiliation'),
            'email' => $this->email,
            'phone' => $this->phone,
            'telegram' => $this->telegram,
        ];
    }
}
