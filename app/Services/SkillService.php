<?php

namespace App\Services;

use App\Models\Resume\Resume;
use App\Models\Resume\Skill;
use Illuminate\Database\Eloquent\Collection;

class SkillService implements SkillServiceInterface
{
    /**
     * @param  Resume  $resume
     * @return Collection
     */
    public function getSkillByResume(Resume $resume): Collection
    {
        return $resume->skills()
            ->select('name', 'years', 'order')
            ->get()
            ->makeHidden('pivot');
    }

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @param  int  $years
     * @return int
     */
    public function updateSkillByResume(Resume $resume, string $name, int $years): int
    {
        return $resume->skills()
            ->where('name', $name)
            ->update(['years' => $years]);
    }

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @return int
     */
    public function deleteSkillByResume(Resume $resume, string $name): int
    {
        $skill = Skill::where('name', $name)->first();
        return $resume->skills()->detach($skill->id);
    }

    /**
     * @return Collection
     */
    public function getAllSkills(): Collection
    {
        return Skill::select('id', 'name')->get();
    }

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @param  int  $years
     * @return mixed
     */
    public function attachSkillToResume(Resume $resume, string $name, int $years): mixed
    {
        $skill = Skill::where('name', $name)->first();
        return $resume->skills()->attach($skill->id, ['years' => $years, 'order' => Skill::count() + 1]);
    }
}
