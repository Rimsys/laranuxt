<?php

namespace App\Http\Controllers;

use App\Actions\Biodata\CreateBiodataAction;
use App\Actions\Biodata\UpdateBiodataAction;
use App\Http\Requests\BiodataRequest;
use Illuminate\Http\Request;
use App\Models\Biodata;

class BiodataController extends Controller
{
    public function index()
    {
        $response = Biodata::first();

        return $this->okResponse("biodata gotten successfully", $response);
    }

    public function create(BiodataRequest $request)
    {
        try {
            $response = (new CreateBiodataAction())->execute($request);

            return $this->okResponse("Biodata created successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("unable to create biodata", $e->getMessage());
        }
    }

    public function update(BiodataRequest $request, $id)
    {
        try {
            $response = (new UpdateBiodataAction())->execute($request, $id);

            return $this->okResponse("Biodata updated successfully", $response);
        } catch (\Exception $e) {
            return $this->errorResponse("unable to update biodata", $e->getMessage());
        }
    }
}
