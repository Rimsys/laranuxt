<?php

namespace Tests\Feature;

use App\Models\Resume\Resume;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    /**
     * Getting the resume main information
     *
     * @return void
     */
    public function testGetResume()
    {
        $resume = Resume::factory()->create();

        $response = $this->getJson(route('profile.index', ['username' => $resume->candidate->username]));

        $response->assertStatus(200);
    }
}
