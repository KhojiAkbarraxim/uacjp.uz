<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    protected $fillable = ['path', 'sort_order'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
