<?php

namespace App\Http\Controllers\Admin;

use App\Models\Analyz;
use App\Models\Section;
use App\Models\TestUnit;
use App\Models\adminTupe;
use App\Models\TestMethod;
use Illuminate\Support\Arr;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use App\Rules\testMethodRule;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SectionRequest;
use App\Http\Resources\SectionResource;
use App\Http\Resources\AdminTupeResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\AdminSettingRequest;
use App\Http\Resources\SectionsWithTypesResource;
use App\Http\Resources\SectionsWithTypes2Resource;

class AdminSectionAnalizController extends Controller
{

    public function sections()
    {
        $onceTrue=SectionsWithTypes2Resource::collection(Section::where('role', Section::ADMIN)->select('id', 'name')->latest()->get());

        $onceFalse= SectionsWithTypesResource::collection(Analyz::AdminSection()->latest()->get());
        $all=[...$onceFalse, ...$onceTrue];

        return response()->json($all);
    }

    public function getAnalys(Request $request){
        return  SectionResource::collection(Analyz::AdminAnalys($request->section_id)->latest()->get());
    }

    public function createSections(SectionRequest $request)
    {


        $return = [];



        if ($request->once) {

            $validator = Validator::make($request->all(), [


                'hsitopology' => [Rule::requiredIf(fn () => !$request->culture_report && !$request->mane_report), 'array'],
                'hsitopology.*.text' => ['required'],


                'culture_report' => [Rule::requiredIf(fn () => !$request->hsitopology && !$request->mane_report), 'array'],
                'culture_report.*.text' => ['required'],

                'mane_report' => [Rule::requiredIf(fn () => !$request->culture_report && !$request->hsitopology), 'array'],
                'mane_report.*.normal_range' => 'required',
                'mane_report.*.gender' => 'required',
                'mane_report.*.h' => 'required',
                'mane_report.*.l' => 'required',


                'test_unit_id' => ['required', function ($attribute, $value, $fail) {
                    if (!TestUnit::whereNull('account_id')->find($value)) {
                        $fail('The ' . $attribute . ' is invalid.');
                    }
                }],
                'test_method_id' => ['required', function ($attribute, $value, $fail) {
                    if (!TestMethod::whereNull('account_id')->find($value)) {
                        $fail('The ' . $attribute . ' is invalid.');
                    }
                }],
                'tupe_id' => ['required', 'exists:admin_tupes,id'],
            ]);

            if (!$validator->fails()) {
                $analyz = Analyz::create([
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
                // return response()->json(['message' => 'section analyz created'], 201);
            } else {

                return response()->json(['error' => $validator->errors()->all()], 422);
            }
            return response()->json(['message' => $return]);
        } else {
            Section::create([
                'name' => $request->name,
                'role' => Section::ADMIN,
            ]);

            $return['Section'] = ' Section-Created';
            return $return;
        }
    }


    public function analyzForSection(SectionRequest $request)
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
        return response()->json(['message' => 'add analys successfully '], 201);
    }


    public function updateSection(SectionRequest $request)
    {
        Section::find($request->section_id)->update([
            'name' => $request->name,
        ]);
        return response()->json(['message' => 'section updated']);
    }
    public function deleteSection(Request $request)
    {
        Section::findOrFail($request->section_id)->delete();
        return response()->json(['message' => 'section deleted']);
    }
}
