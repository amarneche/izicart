<?php

namespace App\Http\Requests\Tenant;

use App\Models\CartItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('cart_item_edit');
    }

    public function rules()
    {
        return [
            'cart_id' => [
                'required',
                'integer',
            ],
            'product_id' => [
                'required',
                'integer',
            ],
            'quanitty' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'product_price' => [
                'required',
            ],
        ];
    }
}
