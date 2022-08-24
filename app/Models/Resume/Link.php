<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_language');
    }
}
