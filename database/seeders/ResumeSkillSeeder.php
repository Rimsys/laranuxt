<?php

namespace Database\Seeders;

use App\Models\Resume\Resume;
use App\Models\Resume\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('resume_skill')->delete();

        $i = 1;
        $resumeId = Resume::first()->id;
        $skills = [
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'php')->first()->id,
                'years' => 10,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'laravel')->first()->id,
                'years' => 4,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'zend')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'phpunit')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'mysql')->first()->id,
                'years' => 9,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'sql')->first()->id,
                'years' => 9,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'javascript')->first()->id,
                'years' => 8,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'vue')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'html5')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'css3')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'git')->first()->id,
                'years' => 5,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'api')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'json')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'bootstrap')->first()->id,
                'years' => 4,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'tailwind')->first()->id,
                'years' => 1,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'jquery')->first()->id,
                'years' => 4,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'inertia')->first()->id,
                'years' => 1,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'redis')->first()->id,
                'years' => 2,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'docker')->first()->id,
                'years' => 2,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'angularjs')->first()->id,
                'years' => 2,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'react')->first()->id,
                'years' => 1,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'linux')->first()->id,
                'years' => 3,
                'order' => $i++,
            ],
            [
                'resume_id' => $resumeId,
                'skill_id' => Skill::where('name', 'aws')->first()->id,
                'years' => 2,
                'order' => $i++,
            ],
        ];

        DB::table('resume_skill')->insert($skills);
    }
}
