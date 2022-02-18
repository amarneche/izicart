<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroySizeAttributeRequest;
use App\Http\Requests\Tenant\StoreSizeAttributeRequest;
use App\Http\Requests\Tenant\UpdateSizeAttributeRequest;
use App\Models\SizeAttribute;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SizeAttributeController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('size_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sizeAttributes = SizeAttribute::with(['media'])->get();

        return view('tenant.sizeAttributes.index', compact('sizeAttributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('size_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.sizeAttributes.create');
    }

    public function store(StoreSizeAttributeRequest $request)
    {
        $sizeAttribute = SizeAttribute::create($request->all());

        if ($request->input('image', false)) {
            $sizeAttribute->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $sizeAttribute->id]);
        }

        return redirect()->route('tenant.size-attributes.index');
    }

    public function edit(SizeAttribute $sizeAttribute)
    {
        abort_if(Gate::denies('size_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.sizeAttributes.edit', compact('sizeAttribute'));
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

        return redirect()->route('tenant.size-attributes.index');
    }

    public function show(SizeAttribute $sizeAttribute)
    {
        abort_if(Gate::denies('size_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.sizeAttributes.show', compact('sizeAttribute'));
    }

    public function destroy(SizeAttribute $sizeAttribute)
    {
        abort_if(Gate::denies('size_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sizeAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroySizeAttributeRequest $request)
    {
        SizeAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('size_attribute_create') && Gate::denies('size_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SizeAttribute();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
