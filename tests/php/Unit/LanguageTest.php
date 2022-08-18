<?php

namespace Tests\Php\Unit;

use App\Models\Language;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_language_data()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );
        $response = $this->get('/languages');
        $response->assertStatus(200);
    }

    public function test_can_create_a_language()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $this->assertDatabaseCount('languages', 0);
        $data = [
            'user_id' => $user->id,
            'language_name' => 'English',
        ];
        $this->assertDatabaseMissing('languages', $data);
        $response = $this->post('/languages', $data);
        $this->assertDatabaseCount('languages', 1);
        $this->assertDatabaseHas('languages', $data);
        $response->assertStatus(200);
    }

    public function test_validation_works_while_adding_a_language()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'language_name' => '',
        ];
        $response = $this->post('/languages', $data);
        $response->assertStatus(400);
    }

    public function test_validation_works_while_editing_a_language()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'language_name' => 'English',
        ];

        $language = Language::create($data);
        $new_data = [
            'language_name' => '',
        ];

        $response = $this->put('/languages/' . $language->id, $new_data);
        $response->assertStatus(400);
    }

    public function test_can_update_a_language()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'language_name' => 'English',
        ];
        $this->assertDatabaseCount('languages', 0);
        $language = Language::create($data);
        $this->assertDatabaseCount('languages', 1);
        $new_data = [
            'user_id' => $user->id,
            'language_name' => 'Hindi',
        ];

        $response = $this->put('/languages/' . $language->id, $new_data);
        $this->assertDatabaseHas('languages', $new_data);
        $response->assertStatus(200);
    }

    public function test_can_not_delete_a_non_existed_language()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->delete('languages/2');
        $response->assertStatus(404);
    }

    public function test_can_delete_a_language()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'language_name' => 'English',
        ];
        $this->assertDatabaseCount('languages', 0);
        $language = Language::create($data);
        $this->assertDatabaseCount('languages', 1);
        $response = $this->delete('languages/' . $language->id);
        $response->assertStatus(200);
    }
}
