<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreSizeAttributeRequest;
use App\Http\Requests\Tenant\UpdateSizeAttributeRequest;
use App\Http\Resources\Tenant\SizeAttributeResource;
use App\Models\SizeAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SizeAttributeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('size_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SizeAttributeResource(SizeAttribute::all());
    }

    public function store(StoreSizeAttributeRequest $request)
    {
        $sizeAttribute = SizeAttribute::create($request->all());

        if ($request->input('image', false)) {
            $sizeAttribute->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        return (new SizeAttributeResource($sizeAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(SizeAttribute $sizeAttribute)
    {
        abort_if(Gate::denies('size_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SizeAttributeResource($sizeAttribute);
    }

    public function update(UpdateSizeAttributeRequest $request, SizeAttribute $sizeAttribute)
    {
        $sizeAttribute->update($request->all());

        if ($request->input('image', false)) {
            if (!$sizeAttribute->image || $request->input('image') !== $sizeAttribute->image->file_name) {
                if ($sizeAttribute->image) {
                    $sizeAttribute->image->delete();
                }
                $sizeAttribute->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($sizeAttribute->image) {
            $sizeAttribute->image->delete();
        }

        return (new SizeAttributeResource($sizeAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(SizeAttribute $sizeAttribute)
    {
        abort_if(Gate::denies('size_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sizeAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
