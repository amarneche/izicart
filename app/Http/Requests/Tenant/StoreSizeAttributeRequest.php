<?php

namespace App\Http\Requests\Tenant;

use App\Models\SizeAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSizeAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('size_attribute_create');
    }

    public function rules()
    {
        return [
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
