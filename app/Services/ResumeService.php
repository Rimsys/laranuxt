<?php

namespace App\Services;

use App\Models\Resume\Candidate;

class ResumeService implements ResumeServiceInterface
{
    /**
     * @param  string  $username
     * @return array|null
     */
    public function getResumeByUsername(string $username): ?array
    {
        $candidate = Candidate::where('username', $username)->first();
        $resume = $candidate->resumes()->first()->loadMissing('skills');

        return [
            'resume_id' => $resume->id,
            'full_name' => $candidate->full_name,
            'email' => $candidate->email,
            'phone' => $candidate->phone,
            'role' => $resume->role,
            'about' => nl2br($resume->presentation),
        ];
    }
}
