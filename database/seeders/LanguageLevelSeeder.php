<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('language_levels')->delete();

        $levels = [
            [ "name" => "basic" ],
            [ "name" => "intermediate" ],
            [ "name" => "advanced" ],
            [ "name" => "fluent" ],
            [ "name" => "native" ],
        ];

        DB::table('language_levels')->insert($levels);
    }
}
