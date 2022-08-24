<?php

namespace App\Services;

interface ResumeServiceInterface
{
    /**
     * @param  string  $username
     * @return array|null
     */
    public function getResumeByUsername(string $username): ?array;
}
