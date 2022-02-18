<?php

namespace App\Http\Requests\Tenant;

use App\Models\Commune;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCommuneRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('commune_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:communes,id',
        ];
    }
}
