<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resumes()
    {
        return $this->belongsTo(Resume::class, 'resume_skill');
    }

    public function experiences()
    {
        return $this->belongsToMany(Experience::class, 'experience_skill');
    }
}
