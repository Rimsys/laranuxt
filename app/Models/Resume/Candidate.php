<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_language');
    }

    public function links()
    {
        return $this->belongsToMany(Link::class, 'candidate_link');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
