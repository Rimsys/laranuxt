<?php

namespace Tests\Feature;

use Tests\TestCase;

class SkillTest extends TestCase
{
    /**
     * Getting all skills
     *
     * @return void
     */
    public function testGetAllSkills()
    {
        $response = $this->getJson(route('skills.index'));
        $response->assertStatus(200);
    }
}
