<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctortRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => ['required', 'unique:doctors,email'],
            'password' => 'required|min:6',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'ratio' => 'required|min:1|max:100',
            'src'=>'required|image|max:5000'

        ];
    }
}
