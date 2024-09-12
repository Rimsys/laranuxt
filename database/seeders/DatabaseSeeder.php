<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(LanguageLevelSeeder::class);
        $this->call(LinkSeeder::class);
        $this->call(SkillSeeder::class);

        $this->call(CandidateSeeder::class);
        $this->call(CandidateLanguageSeeder::class);
        $this->call(CandidateLinkSeeder::class);

        $this->call(ResumeSeeder::class);
        $this->call(ResumeSkillSeeder::class);
    }
}
