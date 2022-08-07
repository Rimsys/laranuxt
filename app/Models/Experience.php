<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiencies';

    protected $guarded = [];

    protected $casts = [
        'responsibilities' => 'array',
    ];

    public $timestamps = false;
}
