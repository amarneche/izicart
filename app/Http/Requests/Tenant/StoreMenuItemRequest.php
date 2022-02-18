<?php

namespace App\Http\Requests\Tenant;

use App\Models\MenuItem;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('menu_item_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'menu_id' => [
                'required',
                'integer',
            ],
            'link' => [
                'string',
                'required',
            ],
            'css_class' => [
                'string',
                'nullable',
            ],
        ];
    }
}
