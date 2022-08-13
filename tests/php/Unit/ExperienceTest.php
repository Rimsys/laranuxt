<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExperienceTest extends TestCase
{
    /**
     * Test that the endpoint returns a 200 response.
     *
     * @return void
     */
    public function test_experience_data_endpoint_returns_a_successful_response()
    {
        $response = $this->get('/experience');

        $response->assertStatus(200);
    }
}
