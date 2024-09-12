<?php

namespace Database\Seeders;

use App\Models\Resume\Candidate;
use App\Models\Resume\Country;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Candidate::query()->delete();
        Candidate::create([
            'first_name' => 'Robson',
            'last_name' => 'Sousa',
            'username' => 'robson',
            'email' => 'robsoncasousa@gmail.com',
            'phone' => '+5586998221553',
            'country_id' => Country::where('code', 'BR')->first()?->id ?? 32,
            'first_name' => 'Robson',
        ]);
    }
}
