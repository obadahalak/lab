<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Models\Analyz;
use App\Models\Doctor;
use App\Models\Lab;
use App\Models\Patient;
use Illuminate\Http\Request;

class reportingController extends Controller
{
  public function AnalysisCountFilter(Request $request)
  {



  }
  public function AnalysisCount()
  {
     $patient_count = Patient::where('account_id' , auth()->user()->id)->count();
     $analysis_count = Analyz::where('account_id' , auth()->user()->id)->count();
     $labs_count = Lab::where('account_id' , auth()->user()->id)->count();
     $doctors_count = Doctor::where('account_id' , auth()->user()->id)->count();


     $response = [
        'num_of_patient'    =>$patient_count,
        'analysis_count'    =>$analysis_count,
        'labs_count'        =>$labs_count,
        'doctors_count'     =>$doctors_count,
     ];
     return response()->json($response);
  }
}
