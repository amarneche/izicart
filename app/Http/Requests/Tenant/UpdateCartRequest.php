<?php

namespace App\Http\Requests\Tenant;

use App\Models\Cart;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCartRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_edit');
    }

    public function rules()
    {
        return [
            'cart_number' => [
                'string',
                'required',
                'unique:carts,cart_number,' . request()->route('cart')->id,
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
