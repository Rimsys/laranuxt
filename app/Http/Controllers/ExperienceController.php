<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\WorkExperience;
use Illuminate\Http\JsonResponse;

class ExperienceController extends Controller
{
    /**
     * Returning a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->has_err = false;
        $this->data['experiences'] = WorkExperience::where('user_id', request()->user()->id)->get();
        return $this->sendResponse();
    }

    /**
     * Store the specified resource in storage.
     *
     * @param StoreExperienceRequest $request
     * @return JsonResponse
     */
    public function store(StoreExperienceRequest $request): JsonResponse
    {
        $work_experience = WorkExperience::create(array_merge($request->validated(), ['user_id' => $request->user()->id]));


        if ($work_experience) {
            $this->has_err = false;
            $this->data['experience'] = $work_experience;
        } else {
            $this->message = 'Experience could not be saved, please trg again';
        }

        return $this->sendResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateExperienceRequest $request
     * @param WorkExperience $experience
     * @return JsonResponse
     */
    public function update(UpdateExperienceRequest $request, WorkExperience $experience): JsonResponse
    {
        $this->has_err = !$experience->update($request->validated());

        if ($this->has_err) {
            $this->message = 'Experience could not be updated, please trg again';
        } else {
            $this->data['experience'] = $experience;
        }

        return $this->sendResponse();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param WorkExperience $experience
     * @return JsonResponse
     */
    public function destroy(WorkExperience $experience): JsonResponse
    {
        abort_unless(request()->user()->id === $experience->user_id, '403', 'You are not authorized to perform this action');

        $id = $experience->id;

        if ($experience->delete()) {
            $this->data['id'] = $id;
            $this->has_err = false;
        } else {
            $this->message = 'Experience could not be deleted, please trg again';
        }

        return $this->sendResponse();
    }

}
