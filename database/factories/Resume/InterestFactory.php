<?php

namespace Database\Factories\Resume;

use App\Models\Resume\Interest;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->domainName(),
        ];
    }
}
