<?php

namespace Tests\Php\Unit;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Tests\TestCase;

class SkillTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_skill_data()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        
        // Passport::actingAsClient(
        //     Client::factory()->create(),
        //     ['*']
        // );
        $response = $this->get('/skills');
     //   $response = $this->get('/test_jwt');
     //   dd($response);
        $response->assertStatus(200);
    }

    public function test_can_create_a_skill()
    {
        $this->assertDatabaseCount('skills', 0);
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'name' => 'Laravel',
        ];
        $this->assertDatabaseMissing('skills', $data);
        $response = $this->post('/skills', $data);
        $this->assertDatabaseCount('skills', 1);
        $this->assertDatabaseHas('skills', $data);
        $response->assertStatus(200);
    }

    public function test_validation_works_while_adding_a_skill()
    {
        $data = [
            'name' => '',
        ];
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->post('/skills', $data);
        $response->assertStatus(400);
    }

    public function test_validation_works_while_editing_a_skill()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'user_id' => $user->id,
            'name' => 'Laravel',
        ];

        $skill = Skill::create($data);
        $new_data = [
            'user_id' => $user->id,
            'name' => '',
        ];
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->put('/skills/' . $skill->id, $new_data);
        $response->assertStatus(400);
    }

    public function test_can_update_a_skill()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'name' => 'Laravel',
        ];
        $this->assertDatabaseCount('skills', 0);
        $skill = Skill::create($data);
        $this->assertDatabaseCount('skills', 1);
        $new_data = [
            'user_id' => $user->id,
            'name' => 'Nuxt',
        ];

        $response = $this->put('/skills/' . $skill->id, $new_data);
        $this->assertDatabaseHas('skills', $new_data);
        $response->assertStatus(200);
    }

    public function test_can_not_delete_a_non_existed_skill()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->delete('skills/2');
        $response->assertStatus(404);
    }

    public function test_can_delete_a_skill()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'name' => 'Laravel',
        ];
        $this->assertDatabaseCount('skills', 0);
        $skill = Skill::create($data);
        $this->assertDatabaseCount('skills', 1);
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->delete('skills/' . $skill->id);
        $response->assertStatus(200);
    }
}
