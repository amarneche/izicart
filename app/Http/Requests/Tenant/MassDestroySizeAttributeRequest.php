<?php

namespace App\Http\Requests\Tenant;

use App\Models\SizeAttribute;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySizeAttributeRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('size_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:size_attributes,id',
        ];
    }
}
