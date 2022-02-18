<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreColorAttributeRequest;
use App\Http\Requests\Tenant\UpdateColorAttributeRequest;
use App\Http\Resources\Tenant\ColorAttributeResource;
use App\Models\ColorAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColorAttributeApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('color_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorAttributeResource(ColorAttribute::all());
    }

    public function store(StoreColorAttributeRequest $request)
    {
        $colorAttribute = ColorAttribute::create($request->all());

        return (new ColorAttributeResource($colorAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ColorAttribute $colorAttribute)
    {
        abort_if(Gate::denies('color_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ColorAttributeResource($colorAttribute);
    }

    public function update(UpdateColorAttributeRequest $request, ColorAttribute $colorAttribute)
    {
        $colorAttribute->update($request->all());

        return (new ColorAttributeResource($colorAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ColorAttribute $colorAttribute)
    {
        abort_if(Gate::denies('color_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colorAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
