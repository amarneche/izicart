<?php

namespace App\Http\Requests\Tenant;

use App\Models\CartItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCartItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('cart_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:cart_items,id',
        ];
    }
}
