<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoinApplication extends Model
{
    protected $fillable = [
        'name',
        'email',
        'membership_type',
        'region',
        'affiliation',
        'message',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
