<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaysRequest extends FormRequest
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
            'bills_id'                  => ['required'],
            // 'Amount_$_before_payment'   => ['numeric'],
            // 'Amount_ID_before_payment'  => ['numeric'],
            // 'Amount_$_after_payment'    => ['numeric'],
            // 'Amount_ID_after_payment'   => ['numeric'],
            'Amount_ID'    => ['numeric'],
            'Amount_dolar'   => ['numeric'],
        ];
    }
}
