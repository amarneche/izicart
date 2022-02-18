<?php

namespace App\Http\Requests\Tenant;

use App\Models\ColorAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyColorAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('color_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:color_attributes,id',
        ];
    }
}
