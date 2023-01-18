<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DoctortRequest;
use App\Http\Resources\DoctorResource;
use Illuminate\Validation\ValidationException;

class AuthDoctroController extends Controller
{

    public function doctorAuth(Request $request)
    {

        $doctor = Doctor::where('email', $request->email)->first();



        if (!$doctor || ! Hash::check($request->password, $doctor->password)) {
            throw ValidationException::withMessages([
                'email' => ['email or password is incorrect'],
            ]);
        } else {
            $token = $doctor->createToken($request->email);
            return response()->json(['token' => $token->accessToken]);
        }
    }

    public function doctorProfile(){
      return new  DoctorResource (auth('doctor')->user());
    }
}
