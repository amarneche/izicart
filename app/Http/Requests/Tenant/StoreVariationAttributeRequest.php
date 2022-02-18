<?php

namespace App\Http\Requests\Tenant;

use App\Models\VariationAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVariationAttributeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('variation_attribute_create');
    }

    public function rules()
    {
        return [
            'value' => [
                'string',
                'required',
            ],
            'image' => [
                'required',
            ],
            'gallery' => [
                'array',
            ],
        ];
    }
}
