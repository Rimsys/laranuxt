<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title', 'currently_working_here', 'start_date', 'end_date',
        'company_name', 'country_id', 'city', 'description', 'user_id'
    ];

    public static array $validation_rules = [
        'job_title' => 'required|max:255',
        'currently_working_here' => 'bail|sometimes|nullable|in:0,1',
        'start_date' => 'bail|required|date|before_or_equal:today',
        'end_date' => 'bail|nullable|sometimes|date|after_or_equal:start_date',
        'company_name' => 'required|max:255',
        'country_id' => 'required|exists:countries,id',
        'city' => 'required|max:50',
        'description' => 'bail|nullable|sometimes',
    ];

    protected $hidden = ['user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
