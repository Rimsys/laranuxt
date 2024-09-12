<?php

namespace Database\Factories\Resume;

use App\Models\Resume\Candidate;
use App\Models\Resume\Language;
use App\Models\Resume\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'candidate_id' => (Candidate::factory()->create())->id,
            'language_id' => (Language::factory()->create())->id,
            'presentation' => $this->faker->realText(500),
            'role' => $this->faker->jobTitle(),
        ];
    }
}
