<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSettingRequest extends FormRequest
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
                    'tupe' => 'required|min:2|max:255',

                ];
                break;

            case 'DELETE':
                return [
                    'id' => ['exists:admin_tupes,id'],
                    'ids' => ['array'],
                    'ids.*' => ['exists:admin_tupes,id'],
                ];
                break;

            case 'PUT':
                return [
                    'id' => ['exists:admin_tupes,id'],
                    'tupe'=>['string','min:2','max:255'],
                ];
            }
    }
}
