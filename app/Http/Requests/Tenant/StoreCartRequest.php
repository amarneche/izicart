<?php

namespace App\Http\Requests\Tenant;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_create');
    }

    public function rules()
    {
        return [
            'cart_number' => [
                'string',
                'required',
                'unique:carts',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
