<?php

namespace App\Http\Controllers;

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
     * @return mixed
     */
    public function index()
    {
        return $this->render($this->skillService->getAllSkills());
    }
}
