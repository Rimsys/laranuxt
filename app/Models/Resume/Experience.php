<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'experience_skill');
    }
}
