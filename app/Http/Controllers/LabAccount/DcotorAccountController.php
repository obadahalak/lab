<?php

namespace App\Http\Controllers\LabAccount;

use App\Models\Doctor;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Trait\UploadImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountRequest;
use App\Http\Requests\DoctortRequest;
use App\Http\Resources\DoctorResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LabAccountRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LabProfileResource;
use Illuminate\Validation\ValidationException;

class DcotorAccountController extends Controller
{


    public function storeDoctor(DoctortRequest $request)
    {

        $doctor = auth('lab')->user()->doctors()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address,
            'ratio' => $request->ratio,
        ]);

        $path = $request->src->store('doctorImages', 'public');

        $doctor->DoctorImage()->create([
            'src' => 'public/' . $path,
        ]);

        return response()->json(['message' => 'doctor account created successfully']);
    }

    public function Docotors()
    {
        return  DoctorResource::collection(auth('lab')->user()->doctors);
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return  DoctorResource::collection(auth('lab')->user()->doctors->find($id));

        // return response()->json($doctors , 200);
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
        $doctor = Doctor::where('id', $id)->first();
        $input['name'] = $request->name ?? $doctor->name;
        $input['phone'] = $request->phone ?? $doctor->phone;
        $input['address'] = $request->address ?? $doctor->address;
        $input['email'] = $request->email ?? $doctor->email;
        $input['password'] = $request->password ?? $doctor->password;
        $input['gender'] = $request->gender ?? $doctor->gender;
        $input['ratio'] = $request->ratio ?? $doctor->ratio;

        $data =  $doctor->update($input);

        return response()->json($doctor, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        $doctor->delete();

        return response()->json('deleted', 200);
    }
}
