<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SkillTest extends TestCase
{
    /**
     * Test that the endpoint returns a 200 response.
     *
     * @return void
     */
    public function test_skill_data_endpoint_returns_a_successful_response()
    {
        $response = $this->get('/skill');

        $response->assertStatus(200);
    }
}
