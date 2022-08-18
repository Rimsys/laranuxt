<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'job_title' => 'Full Stack Developer',
            'github_profile' => 'https://github.com/amitleuva1987',
            'linkedin_profile' => 'https://linkedin.com/profile',
            'location' => 'Ahmedabad, India',
            'mobile_no' => '+91 9033049648',
            'description' => 'Full stack developer with over 10 years of web development experience, both technically focused and
            customer oriented. I believe in sustained improvement and finding better ways in doing things every
            day. I am looking for a career that is both challenging and reward .
            ',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
