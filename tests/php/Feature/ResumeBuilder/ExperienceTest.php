<?php

namespace Tests\Feature\ResumeBuilder;

use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;


    private function getToken()
    {
        $user = User::query()->inRandomOrder()->first();

        // Logging In
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password', // Default password is 'password'
        ]);

        return $response['data']['token'];
    }

    public function test_user_can_create_experience()
    {
        $faker = Factory::create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json'
        ])->postJson(route('experiences.store'), [
            'job_title' => $faker->jobTitle(),
            'start_date' => Carbon::now()->subYears(3)->format('Y-m-d'),
            'end_date' => Carbon::now()->subYears(1)->format('Y-m-d'),
            'company_name' => $faker->company(),
            'country_id' => Country::query()->inRandomOrder()->first()->id,
            'city' => $faker->city(),
        ])
            ->assertOk();
    }

    public function test_user_can_not_create_experience()
    {
        $faker = Factory::create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken(),
            'Accept' => 'application/json'

        ])->postJson(route('experiences.store'), [
            'job_title' => $faker->jobTitle(),
            'start_date' => Carbon::now()->subYears(3)->format('Y-m-d'),
            'end_date' => Carbon::now()->subYears(1)->format('Y-m-d'),
            // required fields were not provided
            'company_name' => null,
            'country_id' => null,
            'city' => null,
        ])
            ->assertStatus(422);

    }

}
