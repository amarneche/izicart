<?php

namespace App\Http\Requests\Tenant;

use App\Models\Wilaya;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWilayaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('wilaya_edit');
    }

    public function rules()
    {
        return [
            'wilaya' => [
                'string',
                'required',
                'unique:wilayas,wilaya,' . request()->route('wilaya')->id,
            ],
            'wilaya_ar' => [
                'string',
                'nullable',
            ],
            'is_available' => [
                'required',
            ],
            'default_cost' => [
                'string',
                'nullable',
            ],
            'payment_methods.*' => [
                'integer',
            ],
            'payment_methods' => [
                'array',
            ],
        ];
    }
}
