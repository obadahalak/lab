<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Http\Requests\StaffUpdateRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class staffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::where('account_id' , auth('lab')->user()->id)->paginate(10);
        return response()->json($staff);
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
    public function store(StaffRequest $request)
    {
        $input = $request->validated();

        $input['account_id'] = auth('lab')->user()->id;
        if ($request->image)
        {
            $input['image'] = $request->image->store($request->name . '_staff' , 'public');

        }
        $staff = Staff::create($input);

        return response()->json($staff);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $staff = Staff::where('id' , $id)->first();

        return response()->json($staff);
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
    public function update(StaffUpdateRequest $request, $id)
    {
        $staff = Staff::where('id' , $id)->first();
        $input['name']              = $request->name              ?? $staff->name;
        $input['phone']             = $request->phone             ?? $staff->phone;
        $input['address']           = $request->address           ?? $staff->address;
        $input['email']             = $request->email             ?? $staff->email ;
        $input['DOB']               = $request->DOB               ?? $staff->DOB ;
        $input['work_start']        = $request->work_start        ?? $staff->work_start ;
        $input['experiance']        = $request->experiance        ?? $staff->experiance ;
        $input['note']              = $request->note              ?? $staff->note ;
        $input['collage']           = $request->collage           ?? $staff->collage ;
        $input['salary']            = $request->salary            ?? $staff->salary ;
        $input['work_time_start']   = $request->work_time_start   ?? $staff->work_time_start ;
        $input['work_time_end']     = $request->work_time_end     ?? $staff->work_time_end ;
        $input['specialization_id'] = $request->specialization_id ?? $staff->specialization_id ;
        $input['job_title_id']      = $request->job_title_id      ?? $staff->job_title_id ;


        $data =  $staff->update($input);

        return response()->json($staff , 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staff::where('id' , $id)->first();

        $staff->delete();

        return response()->json('deleted');
    }
}
