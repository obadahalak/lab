<?php

namespace App\Http\Controllers\LabAccount\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\specializationRequest;
use App\Models\Job_title;
use App\Models\Specialization;
use Illuminate\Http\Request;

class specializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spec = Specialization::orderBy('id', 'desc')->get();
        return response()->json($spec);
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
    public function store(specializationRequest $request)
    {
        $spec = Specialization::create($request->validated());

        return response()->json($spec);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spec = Specialization::where('id' , $id)->first();

        return response()->json($spec);
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
        $spec = Specialization::where('id' , $id)->first();
        $input['name'] = $request->name ?? $spec->name;

        $data =  $spec->update($input);

        return response()->json($spec);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spec = Specialization::where('id' , $id)->first();

            $spec->delete();

            return response()->json('deleted' , 200);


    }
}
