<?php

namespace Tests\Feature;

use App\Models\Resume\Resume;
use App\Models\Resume\Skill;
use Tests\TestCase;

class ResumeSkillTest extends TestCase
{
    /**
     * Test getting resume skills
     */
    public function testGetSkills()
    {
        $skill = Skill::factory()->create();
        $resume = Resume::factory()->create();
        $resume->skills()->attach($skill->id, ['years' => 3, 'order' => 1]);

        $response = $this->getJson(route('resume.skill.index', $resume->id));

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $skill->name,
            'order' => 1,
            'years' => 3,
        ]);
    }

    /**
     * Test attaching resume skills
     */
    public function testAttachSkill()
    {
        $skill = Skill::factory()->create();
        $resume = Resume::factory()->create();

        /* no skills */
        $this->assertCount(0, $resume->skills);

        /* attaching */
        $response = $this->postJson(route('resume.skill.store', $resume->id), [
            'name' => $skill->name,
            'years' => 5,
        ]);

        $response->assertStatus(200);

        /* skill saved */
        $this->assertCount(1, $resume->refresh()->skills);
    }

    /**
     * Test updating resume skills
     */
    public function testUpdateSkill()
    {
        $skill = Skill::factory()->create();
        $resume = Resume::factory()->create();

        $resume->skills()->attach($skill->id, ['years' => 3, 'order' => 1]);

        $newYears = 5;
        /* attaching */
        $response = $this->putJson(route('resume.skill.update', $resume->id), [
            'name' => $skill->name,
            'years' => $newYears,
        ]);

        $response->assertStatus(200);

        /* skill updated */
        $skill = $resume->refresh()->skills()->where('name', $skill->name)->first();
        $this->assertEquals($newYears, $skill->pivot->years);
    }

    /**
     * Test deleting resume skills
     */
    public function testDeleteSkill()
    {
        $skill = Skill::factory()->create();
        $resume = Resume::factory()->create();

        $resume->skills()->attach($skill->id, ['years' => 3, 'order' => 1]);

        /* there is skill */
        $this->assertCount(1, $resume->skills);

        /* attaching */
        $response = $this->deleteJson(route('resume.skill.destroy', $resume->id), [
            'name' => $skill->name,
        ]);

        $response->assertStatus(200);

        /* no skills */
        $this->assertCount(0, $resume->refresh()->skills);
    }
}
