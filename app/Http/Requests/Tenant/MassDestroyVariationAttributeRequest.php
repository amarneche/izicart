<?php

namespace App\Http\Requests\Tenant;

use App\Models\VariationAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyVariationAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('variation_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:variation_attributes,id',
        ];
    }
}
