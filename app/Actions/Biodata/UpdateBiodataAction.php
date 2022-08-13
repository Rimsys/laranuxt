<?php

namespace App\Actions\Biodata;

use App\Models\Biodata as BiodataModel;

class UpdateBiodataAction
{
    public function execute($request, $id)
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
        ];

        if ($request->interests) {
            $data = explode(',', $request->interests);
            $input['interests'] = $data;
        }

        $response = BiodataModel::find($id)->update($input);

        return $response;
    }
}
