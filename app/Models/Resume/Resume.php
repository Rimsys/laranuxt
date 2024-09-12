<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function interests()
    {
        return $this->hasMany(Interest::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'resume_skill')
            ->withPivot('years', 'order')
            ->orderBy('order');
    }

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

}
