<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'bio',
        'education_work_history',
        'skills',
        'interests',
    ];

    protected $casts = [
        'education_work_history' => 'array',
        'skills' => 'array',
        'interests' => 'array',
    ];
}
