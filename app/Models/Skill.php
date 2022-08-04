<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'years_of_experience', 'user_id'];

    public static array $validation_rules = [
        'name' => 'required|max:255',
        'years_of_experience' => 'required|integer|between:1,10',
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
