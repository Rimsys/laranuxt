<?php

namespace Database\Factories\Resume;

use App\Models\Resume\Experience;
use App\Models\Resume\Resume;
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
            'resume_id' => (Resume::factory()->create())->id,
            'company' => $this->faker->company(),
            'role' => $this->faker->jobTitle(),
            'date_start' => $this->faker->dateTimeThisDecade('2021-01-01'),
            'date_end' => $this->faker->dateTimeBetween('2021-01-02'),
            'description' => $this->faker->text(500),
        ];
    }
}
