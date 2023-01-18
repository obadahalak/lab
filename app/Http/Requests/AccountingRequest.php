<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountingRequest extends FormRequest
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
        switch ($this->method())
        {
            case 'POST':

                        return [

                          //  'account_id'   => ['required' , 'exists:accounts,id'],
                            'day'         => ['required' , 'string' , 'max:10'],
                            'date'      => ['required' , 'date_format:Y-m-d'],
                            'payment_amount' => ['required' , 'numeric'],
                            'note'    => ['required' , 'string'],
                            'status'  => ['required' , 'boolean']
                        ];
                break;
            case 'PUT' :

                return [

                    //  'account_id'   => ['required' , 'exists:accounts,id'],
                      'day'         => ['string' , 'max:10'],
                      'date'      => ['date_format:Y-m-d'],
                      'Payment_amount' => ['numeric'],
                      'Note'    => ['string'],
                      'status'  => ['boolean']
                  ];
                break;
        }

    }
}
