<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffUpdateRequest extends FormRequest
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
        return [
            'name'              => ['string'],
            'image'             => ['image'],
            'DOB'               => ['string'],
            'work_start'        => ['string'],
            'job_title_id'      => ['exists:job_titles,id'],
            'specialization_id' => ['exists:specializations,id'],
            'phone'             => ['numeric'],
            'address'           => ['string'],
            'email'             => ['string' , 'unique:staff,email'],
            'note'              => ['string'],
            'salary'            => ['numeric'],
            'experiance'        => ['string'],
            'collage'           => ['string'],
             'work_time_start'  => ['string'],
             'work_time_end'    => ['string'],
        ];
    }
}
