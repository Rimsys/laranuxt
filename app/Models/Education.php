<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = ['school', 'currently_attending', 'start_date',
        'end_date', 'degree', 'field_of_study', 'user_id'];

    public static array $validation_rules = [
        'school' => 'required|max:255',
        'currently_attending' => 'bail|sometimes|nullable|in:0,1',
        'start_date' => 'bail|required|date|before_or_equal:today',
        'end_date' => 'bail|nullable|sometimes|date|after_or_equal:start_date',
        'degree' => 'required|max:255',
        'field_of_study' => 'required|max:255',
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
