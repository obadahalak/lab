<?php

namespace App\Http\Controllers;

use App\Models\Analyz;
use App\Models\Section;
use App\Models\TestUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Http\Requests\SectionLabRequest;
use Illuminate\Support\Facades\Validator;

class AnalyzController extends Controller
{
    public function sections()
    {
        return SectionResource::collection(auth('lab')->user()->with('Section')->paginate(10));
    }

    public function store(SectionLabRequest $request)
    {
        $return = [];

        if ($request->once) {


            $analyz = auth('lab')->user()->analyz()->create([
                'test_code' => $request->test_code,
                'test_print_name' => $request->test_print_name,
                'price_for_patient' => $request->price_for_patient,
                'price_for_lap' => $request->price_for_lap,
                'price_for_company' => $request->price_for_company,
                'test_method_id' => $request->test_method_id,
                'test_unit_id' => $request->test_unit_id,
                'admin_tupe_id' => $request->tupe_id,
                'class_report' => $request->hsitopology != null  ? ['hsitopology' => $request->hsitopology]  : ($request->mane_report != null ? ['mane_report' => $request->mane_report] : ['culture_report' => $request->culture_report]),
                'once' => true,
            ]);

            $return['Analytic'] = 'Analytic-Created';
            if ($request->antibiotic) {
                foreach ($request->subject as $subject) {

                    $analyz->antibiotic()->create([
                        'subject' => $subject,
                    ]);
                }
                $return['antibiotic'] = 'antibiotic-Created';
            }

            return response()->json(['message' => $return]);
        } else {
            Section::create([
                'name' => $request->name,
                'role' => Section::ACCOUNT,
            ]);

            $return['Section'] = ' Section-Created';
            return $return;
        }
    }


    public function analyzForSection(SectionLabRequest $request)
    {

        $section = Section::find($request->section_id);
        $section->analyz()->create([
            'test_code' => $request->test_code,
            'test_print_name' => $request->test_print_name,
            'price_for_patient' => $request->price_for_patient,
            'price_for_lap' => $request->price_for_lap,
            'price_for_company' => $request->price_for_company,
            'test_method_id' => $request->test_method_id,
            'test_unit_id' => $request->test_unit_id,
            'admin_tupe_id' => $request->tupe_id,
            'class_report' => $request->hsitopology != null  ? ['hsitopology' => $request->hsitopology]  : ($request->mane_report != null ? ['mane_report' => $request->mane_report] : ['culture_report' => $request->culture_report]),
            'once' => true,
        ]);
        return response()->json(['message' => 'add analys successfully _ '], 201);
    }
}
