<?php

namespace App\Actions\Skill;

use App\Models\Skill;

class CreateSkillAction
{
    public function execute($request)
    {
        $response = Skill::create($request->all());

        return $response;
    }
}
