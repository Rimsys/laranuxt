<?php

namespace Tests\Php\Unit;

use App\Models\Hobby;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HobbyTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_hobby_data()
    {
        $response = $this->get('/hobbies');
        $response->assertStatus(200);
    }

    public function test_can_create_a_hobby()
    {
        $this->assertDatabaseCount('hobbies', 0);
        $data = [
            'hobby_name' => 'Travelling',
        ];
        $this->assertDatabaseMissing('hobbies', $data);
        $response = $this->post('/hobbies', $data);
        $this->assertDatabaseCount('hobbies', 1);
        $this->assertDatabaseHas('hobbies', $data);
        $response->assertStatus(200);
    }

    public function test_validation_works_while_adding_a_hobby()
    {
        $data = [
            'hobby_name' => '',
        ];
        $response = $this->post('/hobbies', $data);
        $response->assertStatus(400);
    }

    public function test_validation_works_while_editing_a_hobby()
    {
        $data = [
            'hobby_name' => 'Travelling',
        ];

        $hobby = Hobby::create($data);
        $new_data = [
            'name' => '',
        ];

        $response = $this->put('/hobbies/' . $hobby->id, $new_data);
        $response->assertStatus(400);
    }

    public function test_can_update_a_hobby()
    {
        $data = [
            'hobby_name' => 'Travelling',
        ];
        $this->assertDatabaseCount('hobbies', 0);
        $hobby = Hobby::create($data);
        $this->assertDatabaseCount('hobbies', 1);
        $new_data = [
            'hobby_name' => 'Coding',
        ];

        $response = $this->put('/hobbies/' . $hobby->id, $new_data);
        $this->assertDatabaseHas('hobbies', $new_data);
        $response->assertStatus(200);
    }

    public function test_can_not_delete_a_non_existed_hobby()
    {
        $response = $this->delete('hobbies/2');
        $response->assertStatus(404);
    }

    public function test_can_delete_a_hobby()
    {
        $data = [
            'hobby_name' => 'Travelling',
        ];
        $this->assertDatabaseCount('hobbies', 0);
        $hobby = Hobby::create($data);
        $this->assertDatabaseCount('hobbies', 1);
        $response = $this->delete('hobbies/' . $hobby->id);
        $response->assertStatus(200);
    }
}
