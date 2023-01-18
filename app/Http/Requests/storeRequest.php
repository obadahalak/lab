<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeRequest extends FormRequest
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
            'product_name'           => ['required' , 'unique:stores,product_name'],
            'image'                  => ['nullable'],
            'description'            => ['required' , 'min:5' , 'max:255'],
            'company'                => ['required' ,  'min:5' , 'max:255'],
            'expire_date'            => ['required' , 'date_format:Y-m-d'],
            'out_date'               => ['date_format:Y-m-d' , 'nullable'],
            'model'                  => ['required' , 'min:5' , 'max:255'],
            'test_unit_id'      => ['required' , 'exists:test_units,id'],
            'quantity'               => ['required' , 'numeric'],
        ];
    }
}
