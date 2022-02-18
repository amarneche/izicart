<?php

namespace App\Http\Requests\Tenant;

use App\Models\Product;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            'featured_image' => [
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'nullable',
            ],
            'price' => [
                'required',
            ],
            'stock_quantity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'gallery' => [
                'array',
            ],
            'short_description' => [
                'string',
                'max:250',
                'nullable',
            ],
            'colors.*' => [
                'integer',
            ],
            'colors' => [
                'array',
            ],
            'sizes.*' => [
                'integer',
            ],
            'sizes' => [
                'array',
            ],
            'variations.*' => [
                'integer',
            ],
            'variations' => [
                'array',
            ],
            'status' => [
                'required',
            ],
            'categories.*' => [
                'integer',
            ],
            'categories' => [
                'array',
            ],
            'coupons.*' => [
                'integer',
            ],
            'coupons' => [
                'array',
            ],
        ];
    }
}
