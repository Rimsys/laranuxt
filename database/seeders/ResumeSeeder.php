<?php

namespace Database\Seeders;

use App\Models\Resume\Candidate;
use App\Models\Resume\Language;
use App\Models\Resume\Resume;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resume::query()->delete();

        $resume = [
            'candidate_id' => Candidate::first()->id,
            'language_id' => Language::where('code', 'en')->first()->id,
            'role' => 'Senior Full Stack Developer',
            'presentation' => trim("
As a developer, I've been programming in PHP since 2010, with Laravel and modern frontend frameworks since 2018, as well as many other technologies.

As a professional, I'm a very responsible, quick learner, hard worker, and results-driven person. I'm a leader, calm, and a team player with strong critical thinking.

Concerning soft skills, I have played the Lead Developer role twice and I have already run a small business, so I have familiarity with sales, marketing, finances, and customer success, and I know the stakeholder's and customers' needs.

I'd like to be part of the Rimsys team, learning with you, and sharing knowledge. Build a meaningful, modern, and innovative system. And make new friends :)
            "),
        ];

        DB::table('resumes')->insert($resume);
    }
}
