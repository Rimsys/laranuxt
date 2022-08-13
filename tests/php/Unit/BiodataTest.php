<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BiodataTest extends TestCase
{
    /**
     * Test that the endpoint returns a 200 response.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/bioData');

        $response->assertStatus(200);
    }
}
