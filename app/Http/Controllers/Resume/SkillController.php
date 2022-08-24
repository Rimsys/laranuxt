<?php

namespace App\Http\Controllers\Resume;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resume\DestroyResumeSkillRequest;
use App\Http\Requests\Resume\StoreResumeSkillRequest;
use App\Models\Resume\Resume;
use App\Services\SkillServiceInterface;
use Illuminate\Http\Request;

class SkillController extends Controller
{

    /**
     * SkillController constructor.
     * @param  SkillServiceInterface  $skillService
     * @param  Request  $request
     */
    public function __construct(
        protected SkillServiceInterface $skillService,
        Request $request
    ) {
        parent::__construct($request);
    }

    /**
     * @param  Resume  $resume
     * @return mixed
     */
    public function index(Resume $resume)
    {
        $skills = $this->skillService->getSkillByResume($resume);
        return $this->render($skills);
    }

    /**
     * @param  StoreResumeSkillRequest  $request
     * @param  Resume  $resume
     */
    public function update(StoreResumeSkillRequest $request, Resume $resume)
    {
        $this->addResponseOptions($request);
        $this->skillService->updateSkillByResume($resume, $request->get('name'), $request->get('years'));
    }

    /**
     * @param  DestroyResumeSkillRequest  $request
     * @param  Resume  $resume
     */
    public function destroy(DestroyResumeSkillRequest $request, Resume $resume)
    {
        $this->addResponseOptions($request);
        $this->skillService->deleteSkillByResume($resume, $request->get('name'));
    }

    /**
     * @param  StoreResumeSkillRequest  $request
     * @param  Resume  $resume
     */
    public function store(StoreResumeSkillRequest $request, Resume $resume)
    {
        $this->addResponseOptions($request);
        $this->skillService->attachSkillToResume($resume, $request->get('name'), $request->get('years'));
    }
}
