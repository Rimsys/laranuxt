<?php

namespace Database\Factories;

use App\Models\Experience;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'company_name' => 'Microsoft',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(6)->toDateString(),
            'responsibilities' => 'Make coding. Attending Meetings'
        ];
    }
}
