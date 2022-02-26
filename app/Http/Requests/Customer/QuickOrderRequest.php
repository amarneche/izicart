<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class QuickOrderRequest extends FormRequest
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
            
            'first_name'=>['nullable'],
            'last_name'=>['nullable'],
            'email'=>['nullable'],
            'phone'=>['nullable'],
            'wilaya_id'=>['nullable','exists:wilayas'],
            'commune_id'=>['nullable','exists:communes'],
            'quantity'=>['nullable','integer'],
        ];
    }
}
