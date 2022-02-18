<?php

namespace App\Http\Requests\Tenant;

use App\Models\SizeAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSizeAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('size_attribute_edit');
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
