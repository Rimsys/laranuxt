<?php

namespace App\Http\Controllers;

use App\Actions\Experience\CreateExperienceAction;
use App\Actions\Experience\UpdateExperienceAction;
use App\Http\Requests\ExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $response = Experience::get();

        return $this->okResponse("experience gotten successfully", $response);
    }

    public function store(ExperienceRequest $request)
    {
        try {
            $response = (new CreateExperienceAction())->execute($request);

            return $this->okResponse("experience created successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("unable to create experience", $e->getMessage());
        }
    }

    public function update(ExperienceRequest $request, $id)
    {
        try {
            $response = (new UpdateExperienceAction())->execute($request, $id);

            return $this->okResponse("experience updated successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("unable to update experience", $e->getMessage());
        }
    }
}
