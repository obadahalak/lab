<?php

namespace App\Http\Controllers\LabAccount\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobTitleRequest;
use App\Models\Job_title;
use Illuminate\Http\Request;

class jobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job_title::orderBy('id', 'desc')->get();
        return response()->json($jobs);
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
    public function store(JobTitleRequest $request)
    {
        $jobs = Job_title::create($request->validated());

        return response()->json($jobs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobs = Job_title::where('id' , $id)->first();

        return response()->json($jobs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request, $id)
    {
        $jobs = Job_title::where('id' , $id)->first();
        $input['name'] = $request->name ?? $jobs->name;

        $data =  $jobs->update($input);

        return response()->json($jobs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobs = Job_title::where('id' , $id)->first();

        $jobs->delete();

        return response()->json('deleted' , 200);
    }
}
