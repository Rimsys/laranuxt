<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('countries')->upsert([
            ['name' => 'Canada', 'created_at' => $today, 'updated_at' => $today],
            ['name' => 'United Kingdom', 'created_at' => $today, 'updated_at' => $today],
            ['name' => 'Pakistan', 'created_at' => $today, 'updated_at' => $today],
            ['name' => 'United States of America', 'created_at' => $today, 'updated_at' => $today],
            ['name' => 'Germany', 'created_at' => $today, 'updated_at' => $today],
        ], ['name']);
    }
}
