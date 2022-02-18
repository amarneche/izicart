<?php

namespace App\Http\Requests\Tenant;

use App\Models\Commune;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCommuneRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('commune_create');
    }

    public function rules()
    {
        return [
            'commune' => [
                'string',
                'required',
            ],
            'commune_ar' => [
                'string',
                'nullable',
            ],
            'wilayas.*' => [
                'integer',
            ],
            'wilayas' => [
                'required',
                'array',
            ],
            'is_available' => [
                'required',
            ],
        ];
    }
}
