<?php

namespace App\Http\Requests\Tenant;

use App\Models\Order;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('order_create');
    }

    public function rules()
    {
        return [
            'order_number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'unique:orders,order_number',
            ],
            'ship_to_wilaya_id' => [
                'required',
                'integer',
            ],
            'shipt_to_commune_id' => [
                'required',
                'integer',
            ],
            'shipping_cost' => [
                'required',
            ],
            'total' => [
                'string',
                'nullable',
            ],
            'status' => [
                'required',
            ],
        ];
    }
}
