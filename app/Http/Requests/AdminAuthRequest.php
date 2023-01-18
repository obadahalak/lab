<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdminAuthRequest extends FormRequest
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
        switch($this->method()){
            case 'GET':
                return [
                    'email'=>'required|exists:admins,email',
                    'password'=>'required',
                ];
            break;

            case 'PUT':
                return [
                    'email'=>[ 'required',Rule::unique('admins')->ignore(auth('admin')->user()->id)],
                    'name'=>'required|min:3|max:255',
                    'old_password'=>'nullable',
                    'new_password'=>['min:6','max:50','confirmed'],
                ];
            break;

        }

    }
}
