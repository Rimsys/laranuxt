<?php

namespace Database\Factories;

use App\Models\Education;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $educations = ['BCA','MCA','BSC','MSC','BE','ME'];
        return [
            'degree_name' => $educations[rand(0,5)],
            'university_name' => 'North Gujarat University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(6)->toDateString(),
        ];
    }
}
