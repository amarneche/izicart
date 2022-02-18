<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreVariationAttributeRequest;
use App\Http\Requests\Tenant\UpdateVariationAttributeRequest;
use App\Http\Resources\Tenant\VariationAttributeResource;
use App\Models\VariationAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VariationAttributeApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('variation_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VariationAttributeResource(VariationAttribute::all());
    }

    public function store(StoreVariationAttributeRequest $request)
    {
        $variationAttribute = VariationAttribute::create($request->all());

        if ($request->input('image', false)) {
            $variationAttribute->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        foreach ($request->input('gallery', []) as $file) {
            $variationAttribute->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
        }

        return (new VariationAttributeResource($variationAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(VariationAttribute $variationAttribute)
    {
        abort_if(Gate::denies('variation_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new VariationAttributeResource($variationAttribute);
    }

    public function update(UpdateVariationAttributeRequest $request, VariationAttribute $variationAttribute)
    {
        $variationAttribute->update($request->all());

        if ($request->input('image', false)) {
            if (!$variationAttribute->image || $request->input('image') !== $variationAttribute->image->file_name) {
                if ($variationAttribute->image) {
                    $variationAttribute->image->delete();
                }
                $variationAttribute->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($variationAttribute->image) {
            $variationAttribute->image->delete();
        }

        if (count($variationAttribute->gallery) > 0) {
            foreach ($variationAttribute->gallery as $media) {
                if (!in_array($media->file_name, $request->input('gallery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $variationAttribute->gallery->pluck('file_name')->toArray();
        foreach ($request->input('gallery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $variationAttribute->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('gallery');
            }
        }

        return (new VariationAttributeResource($variationAttribute))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(VariationAttribute $variationAttribute)
    {
        abort_if(Gate::denies('variation_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variationAttribute->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
