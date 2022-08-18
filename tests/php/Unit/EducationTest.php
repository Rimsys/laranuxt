<?php

namespace Tests\Php\Unit;

use App\Models\Education;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Passport\Passport;
use Tests\TestCase;

class EducationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_retrive_all_education_data()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['create-servers']
        );
        $response = $this->get('/educations');
        $response->assertStatus(200);
    }

    public function test_can_create_an_education()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $this->assertDatabaseCount('education', 0);
        $data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => 'Ganpath University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];
        $this->assertDatabaseMissing('education', $data);
        $response = $this->post('/educations', $data);
        $this->assertDatabaseCount('education', 1);
        $this->assertDatabaseHas('education', $data);
        $response->assertStatus(200);
    }

    public function test_validation_works_while_adding_education()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );

        $data = [
            'user_id' => $user->id,
            'degree_name' => '',
            'university_name' => 'Ganpath University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];
        $response = $this->post('/educations', $data);
        $response->assertStatus(400);
    }

    public function test_validation_works_while_editing_an_education()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => 'AES',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];

        $education = Education::create($data);
        $new_data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => '',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];

        $response = $this->put('/educations/' . $education->id, $new_data);
        $response->assertStatus(400);
    }

    public function test_can_update_an_education()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => 'Ganpath University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];
        $this->assertDatabaseCount('education', 0);
        $education = Education::create($data);
        $this->assertDatabaseCount('education', 1);
        $new_data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => 'AES University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];

        $response = $this->put('/educations/' . $education->id, $new_data);
        $this->assertDatabaseHas('education', $new_data);
        $response->assertStatus(200);
    }

    public function test_can_not_delete_a_non_existed_education()
    {
        Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $response = $this->delete('educations/2');
        $response->assertStatus(404);
    }

    public function test_can_delete_an_education()
    {
        $user = Passport::actingAs(
            User::factory()->create(),
            ['*']
        );
        $data = [
            'user_id' => $user->id,
            'degree_name' => 'BCA',
            'university_name' => 'Ganpath University',
            'from_date' => Carbon::today()->subYear(8)->subMonth(6)->toDateString(),
            'to_date' => Carbon::today()->subYear(4)->subMonth(5)->toDateString(),
        ];
        $this->assertDatabaseCount('education', 0);
        $education = Education::create($data);
        $this->assertDatabaseCount('education', 1);
        $response = $this->delete('educations/' . $education->id);
        $this->assertDatabaseCount('education', 0);
        $response->assertStatus(200);
    }
}
