<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
                    'name' => 'required|max:20',
                    'email' => 'required|unique:accounts,email',
                    'password' => 'required|min:6',
                    'lab_name' => 'required|unique:accounts,lab_name',
                    'address'=>'required',
                    'phone' => 'required',
                    'src' => 'required|image|max:5000',

                ];
                break;

            // case 'PUT':
            //     return [
            //         'old_password' => '',
            //         'new_password' => ['min:6', 'confirmed'],
            //         'lab_name' => [
            //             'string',
            //             'max:255',
            //             Rule::unique('accounts', 'lab_name')->ignore(auth('lab')->user()->id)
            //         ],
            //         'phone' => '',
            //         'image' => ['image', 'max:5000'],

            //     ];
               // break;
        }
    }


    // public function validated($key = null, $default = null)
    // {
    //     $getPath=request('image')->store('public');
    //     // return array_merge(parent::validated() , ['image'=>$getPath]);
    //     return $thi
    // }
}
