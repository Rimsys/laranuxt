<?php

namespace App\Actions\Experience;

use App\Models\Experience;

class UpdateExperienceAction
{
    public function execute($request, $id)
    {
        $input = [
            'company_name' => $request->company_name,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_current_position' => $request->is_current_position,
        ];

        if ($request->responsibilities) {
            $data = explode(',', $request->responsibilities);
            $input['responsibilities'] = $data;
        }

        $response = Experience::find($id)->update($input);

        return $response;
    }
}
