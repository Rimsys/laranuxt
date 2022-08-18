<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::where('user_id', Auth::id())->get();
        return $this->render($experiences);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this
            ->option('company_name', 'required|string|max:50')
            ->option('job_title', 'required|string|max:20')
            ->option('from_date', 'required|date|before:today')
            ->option('to_date', 'required|date|after:from_date')
            ->option('responsibilities', 'required')
            ->verify();

        $experience = Experience::create([
            'user_id' => Auth::id(),
            'company_name' => $request->company_name,
            'job_title' => $request->job_title,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'responsibilities' => $request->responsibilities
        ]);

        return $this->render($experience);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Experience $experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Experience $experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Experience $experience)
    {
        $this
            ->option('company_name', 'required|string|max:50')
            ->option('job_title', 'required|string|max:20')
            ->option('from_date', 'required|date|before:today')
            ->option('to_date', 'required|date|after:from_date')
            ->option('responsibilities', 'required')
            ->verify();

        $experience->company_name = $request->company_name;
        $experience->job_title = $request->job_title;
        $experience->from_date = $request->from_date;
        $experience->to_date = $request->to_date;
        $experience->responsibilities = $request->responsibilities;

        $experience->save();
        return $this->render($experience);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Experience $experience)
    {
        $experience->delete();
        return $this->render($experience);
    }
}
