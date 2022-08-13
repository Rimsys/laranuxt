<?php

namespace App\Http\Controllers;

use App\Actions\Skill\CreateSkillAction;
use App\Http\Requests\SkillRequest;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        $response = Skill::get();

        return $this->okResponse("skills gotten successfully", $response);
    }

    public function create(SkillRequest $request)
    {
        try {
            $response = (new CreateSkillAction())->execute($request);

            return $this->okResponse("skill created successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("skill to create experience", $e->getMessage());
        }
    }

    public function update(SkillRequest $request, $id)
    {
        try {
            $response = Skill::find($id)->update($request->all());

            return $this->okResponse("skill updated successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("unable to update skill", $e->getMessage());
        }
    }
}
