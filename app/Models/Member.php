<?php

namespace App\Models;

use App\Models\Concerns\HasLocaleFields;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory, HasLocaleFields;

    protected $fillable = [
        'name',
        'role_en', 'role_uz', 'role_ja',
        'affiliation_en', 'affiliation_uz', 'affiliation_ja',
        'field_en', 'field_uz', 'field_ja', 'field_slug',
        'region_en', 'region_uz', 'region_ja', 'region_slug',
        'type', 'sort_order',
    ];

    public function toFrontendArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->localeField('role'),
            'affiliation' => $this->localeField('affiliation'),
            'field' => $this->localeField('field'),
            'field_slug' => $this->field_slug,
            'region' => $this->localeField('region'),
            'region_slug' => $this->region_slug,
            'type' => $this->type,
        ];
    }
}
