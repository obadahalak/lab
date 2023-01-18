<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\LabRequest;
use App\Models\Lab;
use Illuminate\Http\Request;

class labsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labs = Lab::orderBy('id', 'desc')->get();
        return response()->json($labs);
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
    public function store(LabRequest $request)
    {
        $input = $request->validated();
        $input['user_id'] = auth()->user()->id;

        $lab = Lab::create($input);

        return response()->json($lab);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lab = Lab::where('id' , $id)->first();

        return response()->json($lab , 200);
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
        $lab = Lab::where('id' , $id)->first();
        $input['lab_name'] = $request->lab_name ?? $lab->lab_name;
        $input['phone'] = $request->phone ?? $lab->phone;
        $input['address'] = $request->address ?? $lab->address;

        $data =  $lab->update($input);

        return response()->json($lab , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = Lab::where('id' , $id)->first();

        $lab->delete();

        return response()->json('deleted' , 200);
    }
}
