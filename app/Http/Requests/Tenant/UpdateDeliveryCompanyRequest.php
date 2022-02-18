<?php

namespace App\Http\Requests\Tenant;

use App\Models\DeliveryCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDeliveryCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('delivery_company_edit');
    }

    public function rules()
    {
        return [
            'company_name' => [
                'string',
                'required',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'adresse' => [
                'string',
                'nullable',
            ],
            'ship_to_wilayas.*' => [
                'integer',
            ],
            'ship_to_wilayas' => [
                'array',
            ],
        ];
    }
}
