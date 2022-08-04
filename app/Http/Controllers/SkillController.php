<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\Skill;
use Illuminate\Http\JsonResponse;

class SkillController extends Controller
{

    /**
     * Returning a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->has_err = false;
        $this->data['skills'] = Skill::where('user_id', request()->user()->id)->get();
        return $this->sendResponse();
    }

    /**
     * Store the specified resource in storage.
     *
     * @param StoreSkillRequest $request
     * @return JsonResponse
     */
    public function store(StoreSkillRequest $request): JsonResponse
    {
        $skill = Skill::create(array_merge($request->validated(), ['user_id' => $request->user()->id]));

        if ($skill) {
            $this->has_err = false;
            $this->data['skill'] = $skill;
        } else {
            $this->message = 'Skill could not be saved, please trg again';
        }

        return $this->sendResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSkillRequest $request
     * @param Skill $skill
     * @return JsonResponse
     */
    public function update(UpdateSkillRequest $request, Skill $skill): JsonResponse
    {
        $this->has_err = !$skill->update($request->validated());

        if ($this->has_err) {
            $this->message = 'Skill could not be updated, please trg again';
        } else {
            $this->data['skill'] = $skill;
        }

        return $this->sendResponse();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Skill $skill
     * @return JsonResponse
     */
    public function destroy(Skill $skill): JsonResponse
    {
        abort_unless(request()->user()->id === $skill->user_id, 403, 'You are not authorized to perform this action');

        $id = $skill->id;

        if ($skill->delete()) {
            $this->data['id'] = $id;
            $this->has_err = false;
        } else {
            $this->message = 'Skill could not be deleted, please trg again';
        }

        return $this->sendResponse();
    }

}
