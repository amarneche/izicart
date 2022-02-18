<?php

namespace App\Http\Requests\Tenant;

use App\Models\ColorAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateColorAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('color_attribute_edit');
    }

    public function rules()
    {
        return [
            'value' => [
                'string',
                'required',
            ],
            'hex_code' => [
                'string',
                'nullable',
            ],
        ];
    }
}
