<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePaymentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string|min:1|max:32',
            'pan'=>'required|between:12,19',
            'exp_year'=>'required|numeric|between:2019,2050',
            'exp_month'=>'required|numeric|between:1,12',
            'cvc'=>'required|digits:3',
            'order'=>'required'
        ];
    }
}
