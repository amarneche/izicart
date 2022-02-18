<?php

namespace App\Http\Requests\Tenant;

use App\Models\Wilaya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWilayaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('wilaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:wilayas,id',
        ];
    }
}
