<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
                return [
                    'name' => 'required|min:3|max:15',
                    'age' => 'required|integer|min:1|max:100',
                    'email' => 'required|email|unique:patients,email',
                    'address' => 'required|max:255',
                    'phone_number' => 'required',
                    'gender_id' => ['required', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->Genders->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],
                    'date_of_visit' => 'required|date|date_format:Y-m-d',
                    'receive_of_date' => 'required|date|date_format:Y-m-d',




                    'list_analys.*.send_method_id' => ['required', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->sendMethod->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],




                    'list_analys.*.price_doctor' => 'required_with:list_analys.*.doctor_id',
                    'list_analys.*.ratio_price' => 'required_with:list_analys.*.doctor_id',
                    'list_analys.*.doctor_id' => [
                        'exclude_without:list_analys.*.company_id',
                        'exclude_without:list_analys.*.lab_id',
                        function ($attribute, $value, $fail) {
                            if (!auth('lab')->user()->doctors->find($value)) {
                                $fail('The ' . $attribute . ' is invalid.');
                            }
                        }
                    ],

                    'list_analys.*.price_company' => ['required_with:list_analys.*.company_id'],

                    'list_analys.*.company_id' => [
                        'exclude_without:list_analys.*.doctor_id',
                        'exclude_without:list_analys.*.lab_id', function ($attribute, $value, $fail) {
                            if (!auth('lab')->user()->companies->find($value)) {
                                $fail('The ' . $attribute . ' is invalid.');
                            }
                        }
                    ],

                    'list_analys.*.price_lab' => 'required_with:list_analys.*.lab_id',
                    'list_analys.*.lab_id' => ['exclude_without:list_analys.*.doctor_id', 'exclude_without:list_analys.*.comapny_id', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->labs->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],


                    'list_analys.*.section_id' => ['required', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->Section->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],

                    'list_analys.*.analyz_id' => ['nullable', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->analyz->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],

                    'list_analys.*.emergency' => 'required|boolean',
                    'lislist_analys.*._analys.notes' => 'required',


                    'list_analys.*.price_analysis' => 'required',
                    'list_analys.*.paid_up' => 'required',
                    'list_analys.*.duo' => 'required',
                    'list_analys.*.discount' => 'nullable',

                    'list_analys.*.payment_method_id' => ['required', function ($attribute, $value, $fail) {
                        if (!auth('lab')->user()->paymentMethod->find($value)) {
                            $fail('The ' . $attribute . ' is invalid.');
                        }
                    }],

                ];
                break;
        }
    }
}
