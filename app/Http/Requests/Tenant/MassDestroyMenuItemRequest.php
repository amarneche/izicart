<?php

namespace App\Http\Requests\Tenant;

use App\Models\MenuItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMenuItemRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('menu_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:menu_items,id',
        ];
    }
}
