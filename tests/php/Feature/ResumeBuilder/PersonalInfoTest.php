<?php

namespace Tests\Feature\ResumeBuilder;

use App\Models\Country;
use App\Models\User;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonalInfoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;


    public function test_user_can_update_personal_info()
    {
        $user = User::query()->inRandomOrder()->first();

        // Logging In
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password', // Default password is 'password'
        ]);

        $faker = Factory::create();

        $this->withHeaders([
            'Authorization' => 'Bearer ' . $response['data']['token'],
            'Accept' => 'application/json'

        ])->putJson(route('users.update', ['user' => $user->id]), [
            'name' => $user->name,
            'phone_number' => '+923508452594',
            'country_id' => Country::query()->inRandomOrder()->first()->id,
            'city' => $faker->city(),
            'professional_summary' => $faker->sentences(),
        ])
            ->assertStatus(200);
    }

}
