<?php

namespace Tests\Php\Unit;

use App\Models\Experience;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class ExperienceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_experience_data()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->get('/experiences');
        $response->assertStatus(200);
    }

    public function test_can_create_an_experience()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $this->assertDatabaseCount('experiences', 0);
        $data = [
            'user_id' => $user->id,
            'company_name' => 'ABX Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
            'responsibilities' => 'make coding'
        ];
        $this->assertDatabaseMissing('experiences', $data);
        $response = $this->post('/experiences', $data);
        $this->assertDatabaseCount('experiences', 1);
        $this->assertDatabaseHas('experiences', $data);
        $response->assertStatus(200);
    }

    public function test_validation_works_while_adding_experience()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(12)->subMonth(5)->toDateString(),  // validation should fail and return 400 response because, to_date is older than from_date
            'responsibilities' => 'make coding'
        ];
        $response = $this->post('/experiences', $data);
        $response->assertStatus(400);
    }

    public function test_validation_works_while_editing_an_experience()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
            'responsibilities' => 'make coding'
        ];

        $experience = Experience::create($data);
        $new_data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(12)->subMonth(5)->toDateString(), // validation should fail and return 400 response because, to_date is older than from_date
            'responsibilities' => 'make coding'
        ];

        $response = $this->put('/experiences/' . $experience->id, $new_data);
        $response->assertStatus(400);
    }

    public function test_can_update_an_experience()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
            'responsibilities' => 'make coding'
        ];
        $this->assertDatabaseCount('experiences', 0);
        $experience = Experience::create($data);
        $this->assertDatabaseCount('experiences', 1);
        $new_data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
            'responsibilities' => 'make coding'
        ];

        $response = $this->put('/experiences/' . $experience->id, $new_data);
        $this->assertDatabaseHas('experiences', $new_data);
        $response->assertStatus(200);
    }

    public function test_can_not_delete_a_non_existed_experience()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->delete('experiences/2');
        $response->assertStatus(404);
    }

    public function test_can_delete_an_experience()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'company_name' => 'ABC Pvt Ltd',
            'job_title' => 'Full Stack Developer',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
            'responsibilities' => 'make coding'
        ];
        $this->assertDatabaseCount('experiences', 0);
        $experience = Experience::create($data);
        $this->assertDatabaseCount('experiences', 1);
        $response = $this->delete('experiences/' . $experience->id);
        $response->assertStatus(200);
    }
}
