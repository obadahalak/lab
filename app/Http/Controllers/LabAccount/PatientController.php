<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Models\Analyz;
use App\Models\Company;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Lab;
use App\Models\Patient;
use App\Models\PatieonAnalys;
use App\Models\PaymentMethod;
use App\Models\Section;
use App\Models\SendMethod;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    public function get_patient()
    {
        $patient = Patient::with('patieonAnalys')->where('account_id' , auth()->user()->id)->get();

        return response()->json($patient);

    }


    public function store(PatientRequest $request)
    {

        $result = [];
        $patient = auth('lab')->user()->patients()->create([
            'name' => $request->name,
            'age' => $request->age,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' =>  $request->phone_number,
            'gender_id' => $request->gender_id,
            'date_of_visit' => $request->date_of_visit,
            'receive_of_date' => $request->receive_of_date,
        ]);
        $result['patient'] = 'patient created';



        $patient->patieonAnalys()->createMany($request->list_analys);


        $result['patientAnalys'] = 'patieon Analys created';
        return response()->json($result, 201);
    }

    public function delete($id)
    {
        $pateint = Patient::find($id);
        $pateint->patieonAnalys->delete();

        return response()->json('deleted');
    }

    public function show($id)
    {
        $pateint_info = Patient::with('patieonAnalys')->where('id' , $id)->first();
        $gender = Gender::where('id' , $pateint_info->gender_id)->first()->value('name');

        $pateints = $pateint_info->patieonAnalys;
        foreach($pateints as $pateint)
        {
           if($pateint->doctor_id) {
            $doctor_id = $pateint->doctor_id;
               $doctor_name = Doctor::where('id' , $doctor_id)->first()->value('name');
               $doctor_price = $pateint->price_doctor;
               $doctor_ratio = $pateint->ratio_price;
               $send_method_name = SendMethod::where('id' , $pateint->send_method_id)->first()->value('name');
               $payment_method_name = PaymentMethod::where('id' , $pateint->payment_method_id)->first()->value('name');
               $section_name = Section::where('id' , $pateint->section_id)->first()->value('name');
               $analyis_name = Analyz::where('id' , $pateint->analyz_id)->first()->value('test_print_name');

               $response = [
                'message'       => 'get was sucsessful',
                'pateint_info'  => $pateint_info,
                'gender'  => $gender,
                'doctor_name' => $doctor_name,
                'doctor_price' => $doctor_price,
                'doctor_ratio' => $doctor_ratio,
                'send_method_name'  => $send_method_name,
                'payment_method_name' => $payment_method_name,
                'section_name' => $section_name,
                'analyis_name' => $analyis_name,

            ];

            return response()->json($response);


           }
           if($pateint->lab_id) {
            $lab_id = $pateint->lab_id;
               $lab_name = Lab::where('id' , $lab_id)->first()->value('lab_name');
               $lab_price = $pateint->price_lab;

               $send_method_name = SendMethod::where('id' , $pateint->send_method_id)->first()->value('name');
               $payment_method_name = PaymentMethod::where('id' , $pateint->payment_method_id)->first()->value('name');
               $section_name = Section::where('id' , $pateint->section_id)->first()->value('name');
               $analyis_name = Analyz::where('id' , $pateint->analyz_id)->first()->value('test_print_name');

               $response = [
                'message'       => 'get was sucsessful',
                'pateint_info'  => $pateint_info,
                'gender'  => $gender,
                'lab_name' => $lab_name,
                'lab_price' => $lab_price,
                'send_method_name'  => $send_method_name,
                'payment_method_name' => $payment_method_name,
                'section_name' => $section_name,
                'analyis_name' => $analyis_name,

            ];

            return response()->json($response);


           }
           if($pateint->company_id) {
            $company_id = $pateint->company_id;
               $company_name = Company::where('id' , $company_id)->first()->value('name');
               $company_price = $pateint->price_company;
               $send_method_name = SendMethod::where('id' , $pateint->send_method_id)->first()->value('name');
               $payment_method_name = PaymentMethod::where('id' , $pateint->payment_method_id)->first()->value('name');
               $section_name = Section::where('id' , $pateint->section_id)->first()->value('name');
               $analyis_name = Analyz::where('id' , $pateint->analyz_id)->first()->value('test_print_name');

               $response = [
                'message'       => 'get was sucsessful',
                'pateint_info'  => $pateint_info,
                'gender'  => $gender,
                'company_name' => $company_name,
                'company_price' => $company_price,
                'send_method_name'  => $send_method_name,
                'payment_method_name' => $payment_method_name,
                'section_name' => $section_name,
                'analyis_name' => $analyis_name,

            ];

            return response()->json($response);


           }

        }







    }


}
