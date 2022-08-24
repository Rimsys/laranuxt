<?php

namespace Database\Seeders;

use App\Models\Resume\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::query()->delete();

        $skills = [
            ['name' => 'php'],
            ['name' => 'laravel'],
            ['name' => 'vue'],
            ['name' => 'tailwind'],
            ['name' => 'css3'],
            ['name' => 'html5'],
            ['name' => 'redis'],
            ['name' => 'docker'],
            ['name' => 'inertia'],
            ['name' => 'api'],
            ['name' => 'phpunit'],
            ['name' => 'aws'],
            ['name' => 'linux'],
            ['name' => 'json'],
            ['name' => 'mysql'],
            ['name' => 'sql'],
            ['name' => 'javascript'],
            ['name' => 'react'],
            ['name' => 'angularjs'],
            ['name' => 'bootstrap'],
            ['name' => 'jquery'],
            ['name' => 'git'],
            ['name' => 'zend'],
            ['name' => 'java'],
        ];

        DB::table('skills')->insert($skills);

    }
}
