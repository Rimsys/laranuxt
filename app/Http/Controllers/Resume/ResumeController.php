<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\ResumeRequest;
use App\Services\ResumeServiceInterface;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * ResumeController constructor.
     * @param  Request  $request
     * @param  ResumeServiceInterface  $resumeService
     */
    public function __construct(
        Request $request,
        protected ResumeServiceInterface $resumeService,
    ) {
        parent::__construct($request);
    }

    /**
     * @param  ResumeRequest  $request
     * @return mixed
     */
    public function index(ResumeRequest $request)
    {
        $this->addResponseOptions($request);
        return $this->render($this->resumeService->getResumeByUsername($request->get('username')));
    }
}
