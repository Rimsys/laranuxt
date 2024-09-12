<?php

namespace App\Models\Resume;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LanguageLevel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'language_levels';

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'candidate_language');
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'candidate_language');
    }
}
