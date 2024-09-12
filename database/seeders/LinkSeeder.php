<?php

namespace Database\Seeders;

use App\Models\Resume\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Link::query()->delete();

        $links = [
            ['name' => 'website'],
            ['name' => 'github'],
            ['name' => 'gitlab'],
            ['name' => 'linkedin'],
            ['name' => 'stack overflow'],
            ['name' => 'facebook'],
            ['name' => 'twitter'],
        ];

        DB::table('links')->insert($links);
    }
}
