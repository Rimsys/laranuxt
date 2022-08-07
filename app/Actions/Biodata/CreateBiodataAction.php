<?php

namespace App\Actions\Biodata;

use App\Models\Biodata;

class CreateBiodataAction
{
    public function execute($request)
    {
        $input = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'headline' => $request->headline,
            'location' => $request->location,
            'professional_summary' => $request->professional_summary,
            'myvalues' => $request->myvalues,
            'github_url' => $request->github_url,
            'linkedin_url' => $request->linkedin_url,
            'interests' => [$request->interests],
        ];

        $response = Biodata::create($input);

        return $response;
    }
}
