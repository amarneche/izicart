<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyColorAttributeRequest;
use App\Http\Requests\Tenant\StoreColorAttributeRequest;
use App\Http\Requests\Tenant\UpdateColorAttributeRequest;
use App\Models\ColorAttribute;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ColorAttributeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('color_attribute_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colorAttributes = ColorAttribute::all();

        return view('tenant.colorAttributes.index', compact('colorAttributes'));
    }

    public function create()
    {
        abort_if(Gate::denies('color_attribute_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.colorAttributes.create');
    }

    public function store(StoreColorAttributeRequest $request)
    {
        $colorAttribute = ColorAttribute::create($request->all());

        return redirect()->route('tenant.color-attributes.index');
    }

    public function edit(ColorAttribute $colorAttribute)
    {
        abort_if(Gate::denies('color_attribute_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.colorAttributes.edit', compact('colorAttribute'));
    }

    public function update(UpdateColorAttributeRequest $request, ColorAttribute $colorAttribute)
    {
        $colorAttribute->update($request->all());

        return redirect()->route('tenant.color-attributes.index');
    }

    public function show(ColorAttribute $colorAttribute)
    {
        abort_if(Gate::denies('color_attribute_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.colorAttributes.show', compact('colorAttribute'));
    }

    public function destroy(ColorAttribute $colorAttribute)
    {
        abort_if(Gate::denies('color_attribute_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $colorAttribute->delete();

        return back();
    }

    public function massDestroy(MassDestroyColorAttributeRequest $request)
    {
        ColorAttribute::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
