<?php

namespace App\Http\Requests;

use App\Models\TestUnit;
use App\Models\TestMethod;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {


        switch ($this->method()) {
            case 'POST':

                if (request()->route()->getName() == 'analyzForSection') {

                    return [
                        'section_id' => 'required|exists:sections,id',
                        'test_code' => 'required|unique:analyzs,test_code',
                        'test_print_name' => 'required|min:2|max:255',
                        'price_for_patient' => 'required|min:1|numeric',
                        'price_for_lap' => 'required|min:1|numeric',
                        'price_for_company' => 'required|min:1|numeric',
                        'antibiotic' => 'boolean',
                        'subject' => 'required_if:antibiotic,1',

                        'hsitopology' => [Rule::requiredIf(fn () => !request()->culture_report && !request()->mane_report), 'array'],
                        'hsitopology.*.text' => ['required'],


                        'culture_report' => [Rule::requiredIf(fn () => !request()->hsitopology && !request()->mane_report), 'array'],
                        'culture_report.*.text' => ['required'],

                        'mane_report' => [Rule::requiredIf(fn () => !request()->culture_report && !request()->hsitopology), 'array'],
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
                        'tupe_id' => [Rule::requiredIf(fn () => request()->once==1), 'exists:admin_tupes,id'],

                    ];
                } else {


                    return [
                        'name' => 'required_if:once,0|min:2|max:255',
                        'test_code' => 'required_if:once,1|unique:analyzs,test_code',
                        'test_print_name' => 'required_if:once,1|min:2|max:255',
                        'price_for_patient' => 'required_if:once,1|min:1|numeric',
                        'price_for_lap' => 'required_if:once,1|min:1|numeric',
                        'price_for_company' => 'required_if:once,1|min:1|numeric',
                        // 'test_method_id'=>'required_if:once,1|exists:test_methods,id',
                        // 'test_unit_id'=>'required_if:once,1|exists:test_units,id',

                        'once' => 'boolean',
                        'antibiotic' => 'boolean',
                        'subject' => 'required_if:antibiotic,1',
                        'tupe_id' => [Rule::requiredIf(fn () => request()->once==1), 'exists:admin_tupes,id'],

                    ];
                }
                break;

            case 'PUT':
                return [
                    'name' => 'required|min:2|max:255',
                    'section_id' => 'required|exists:sections,id'
                ];
                break;
        }
    }
}
