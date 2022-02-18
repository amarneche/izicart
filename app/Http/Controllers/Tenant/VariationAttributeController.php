<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyVariationAttributeRequest;
use App\Http\Requests\Tenant\StoreVariationAttributeRequest;
use App\Http\Requests\Tenant\UpdateVariationAttributeRequest;
use App\Models\VariationAttribute;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VariationAttributeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('variation_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variationAttributes = VariationAttribute::with(['media'])->get();

        return view('tenant.variationAttributes.index', compact('variationAttributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('variation_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.variationAttributes.create');
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

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $variationAttribute->id]);
        }

        return redirect()->route('tenant.variation-attributes.index');
    }

    public function edit(VariationAttribute $variationAttribute)
    {
        abort_if(Gate::denies('variation_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.variationAttributes.edit', compact('variationAttribute'));
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

        return redirect()->route('tenant.variation-attributes.index');
    }

    public function show(VariationAttribute $variationAttribute)
    {
        abort_if(Gate::denies('variation_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.variationAttributes.show', compact('variationAttribute'));
    }

    public function destroy(VariationAttribute $variationAttribute)
    {
        abort_if(Gate::denies('variation_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $variationAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyVariationAttributeRequest $request)
    {
        VariationAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('variation_attribute_create') && Gate::denies('variation_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new VariationAttribute();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
