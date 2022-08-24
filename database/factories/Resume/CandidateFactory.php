<?php

namespace Database\Factories\Resume;

use App\Models\Resume\Candidate;
use App\Models\Resume\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Candidate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'username' => $this->faker->unique()->name(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'country_id' => Country::first()->id,
        ];
    }
}
