<?php

namespace Database\Seeders;

use App\Models\Resume\Candidate;
use App\Models\Resume\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateLinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('candidate_link')->delete();
        $candidateId = Candidate::first()->id;

        $links = [
            [
                'candidate_id' => $candidateId,
                'link_id' => Link::where('name', 'website')->first()->id,
                'url' => 'http://robsonsousa.com',
            ],
            [
                'candidate_id' => $candidateId,
                'link_id' => Link::where('name', 'github')->first()->id,
                'url' => 'https://github.com/robsoncasousa',
            ],
            [
                'candidate_id' => $candidateId,
                'link_id' => Link::where('name', 'linkedin')->first()->id,
                'url' => 'https://www.linkedin.com/in/robsoncasousa',
            ],
            [
                'candidate_id' => $candidateId,
                'link_id' => Link::where('name', 'stack overflow')->first()->id,
                'url' => 'https://stackoverflow.com/users/11117535/robson-sousa',
            ],
            [
                'candidate_id' => $candidateId,
                'link_id' => Link::where('name', 'gitlab')->first()->id,
                'url' => 'https://gitlab.com/robsoncsousa',
            ],
        ];

        DB::table('candidate_link')->insert($links);
    }
}
