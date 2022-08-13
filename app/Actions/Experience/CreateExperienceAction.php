<?php

namespace App\Actions\Experience;

use App\Models\Experience;

class CreateExperienceAction
{
    public function execute($request)
    {
        $input = [
            'company_name' => $request->company_name,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_current_position' => $request->is_current_position,
            'responsibilities' => [$request->responsibilities],
        ];

        $response = Experience::create($input);

        return $response;
    }
}
