<?php

namespace App\Services;

use App\Models\Resume\Resume;
use Illuminate\Database\Eloquent\Collection;

interface SkillServiceInterface
{
    /**
     * @param  Resume  $resume
     * @return Collection
     */
    public function getSkillByResume(Resume $resume): Collection;

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @param  int  $years
     * @return int
     */
    public function updateSkillByResume(Resume $resume, string $name, int $years): int;

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @return int
     */
    public function deleteSkillByResume(Resume $resume, string $name): int;

    /**
     * @return Collection
     */
    public function getAllSkills(): Collection;

    /**
     * @param  Resume  $resume
     * @param  string  $name
     * @param  int  $years
     * @return mixed
     */
    public function attachSkillToResume(Resume $resume, string $name, int $years): mixed;

}
