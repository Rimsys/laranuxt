<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Models\Education;
use Illuminate\Http\JsonResponse;

class EducationController extends Controller
{
    /**
     * Returning a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $this->has_err = false;
        $this->data['educations'] = Education::where('user_id', request()->user()->id)->get();
        return $this->sendResponse();
    }

    /**
     * Store the specified resource in storage.
     *
     * @param StoreEducationRequest $request
     * @return JsonResponse
     */
    public function store(StoreEducationRequest $request): JsonResponse
    {
        $education = Education::create(array_merge($request->validated(), ['user_id' => $request->user()->id]));

        if ($education) {
            $this->has_err = false;
            $this->data['education'] = $education;
        } else {
            $this->message = 'Education could not be saved, please trg again';
        }

        return $this->sendResponse();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateEducationRequest $request
     * @param Education $education
     * @return JsonResponse
     */
    public function update(UpdateEducationRequest $request, Education $education): JsonResponse
    {
        $this->has_err = !$education->update($request->validated());

        if ($this->has_err) {
            $this->message = 'Education could not be updated, please trg again';
        } else {
            $this->data['education'] = $education;
        }

        return $this->sendResponse();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Education $education
     * @return JsonResponse
     */
    public function destroy(Education $education): JsonResponse
    {
        abort_unless(request()->user()->id === $education->user_id, 403, 'You are not authorized to perform this action');

        $id = $education->id;

        if ($education->delete()) {
            $this->data['id'] = $id;
            $this->has_err = false;
        } else {
            $this->message = 'Education could not be deleted, please trg again';
        }

        return $this->sendResponse();
    }

}
