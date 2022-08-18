<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'job_title' => $this->job_title,
            'github_profile' => $this->github_profile,
            'linkedin_profile' => $this->linkedin_profile,
            'location' => $this->location,
            'description' => $this->description,
            'verified' => $this->hasVerifiedEmail(),
            'created_at' => $this->created_at,
        ];
    }
}
