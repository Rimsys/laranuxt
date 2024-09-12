<?php

namespace Database\Seeders;

use App\Models\Resume\Candidate;
use App\Models\Resume\Language;
use App\Models\Resume\LanguageLevel;
use App\Models\Resume\Resume;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidate_language')->delete();

        $languages = [
            [
                'candidate_id' => Candidate::first()->id,
                'language_id' => Language::where('code', 'en')->first()->id,
                'language_level_id' => LanguageLevel::where('name', 'fluent')->first()->id,
            ],
            [
                'candidate_id' => Candidate::first()->id,
                'language_id' => Language::where('code', 'pt')->first()->id,
                'language_level_id' => LanguageLevel::where('name', 'native')->first()->id,
            ],
        ];

        DB::table('candidate_language')->insert($languages);
    }
}
