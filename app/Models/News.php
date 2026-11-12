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
        'body_en', 'body_uz', 'body_ja', 'thumbnail',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /** Carbon's uz_Latn month names are not dependable on every host. */
    private const UZBEK_MONTHS = [
        1 => 'yanvar', 'fevral', 'mart', 'aprel', 'may', 'iyun',
        'iyul', 'avgust', 'sentabr', 'oktabr', 'noyabr', 'dekabr',
    ];

    /** Up to 7 photos shown on the article page, in upload order. */
    public function images()
    {
        return $this->hasMany(NewsImage::class)->orderBy('sort_order');
    }

    public function dateDict(): array
    {
        $date = Carbon::parse($this->date);

        return [
            'en' => $date->copy()->locale('en')->translatedFormat('F j, Y'),
            'uz' => $date->year.'-yil '.$date->day.'-'.self::UZBEK_MONTHS[(int) $date->month],
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
            'thumbnail' => $this->thumbnail,
            'images' => $this->images->pluck('path')->all(),
        ];
    }
}
