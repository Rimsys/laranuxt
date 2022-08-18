<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::where('user_id', Auth::id())->get();
        return $this->render($educations);
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
            ->option('degree_name', 'required|string|max:50')
            ->option('university_name', 'required|string|max:20')
            ->option('from_date', 'required|date|before:today')
            ->option('to_date', 'required|date|after:from_date')
            ->verify();

        $education = Education::create([
            'user_id' => Auth::id(),
            'degree_name' => $request->degree_name,
            'university_name' => $request->university_name,
            'from_date' => $request->from_date,
            'to_date' => $request->to_date
        ]);

        return $this->render($education);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Education $education)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Education $education)
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
    public function update(Request $request, Education $education)
    {
        $this
            ->option('degree_name', 'required|string|max:50')
            ->option('university_name', 'required|string|max:20')
            ->option('from_date', 'required|date|before:today')
            ->option('to_date', 'required|date|after:from_date')
            ->verify();

        $education->degree_name = $request->degree_name;
        $education->university_name = $request->university_name;
        $education->from_date = $request->from_date;
        $education->to_date = $request->to_date;
        $education->save();

        return $this->render($education);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Education $education)
    {
        $education->delete();

        return $this->render($education);
    }
}
