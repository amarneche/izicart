<?php

namespace App\Http\Requests\Tenant;

use App\Models\DeliveryCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDeliveryCompanyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('delivery_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:delivery_companies,id',
        ];
    }
}
