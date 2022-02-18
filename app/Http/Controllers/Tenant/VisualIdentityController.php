<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyVisualIdentityRequest;
use App\Http\Requests\Tenant\StoreVisualIdentityRequest;
use App\Http\Requests\Tenant\UpdateVisualIdentityRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VisualIdentityController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('visual_identity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.visualIdentities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('visual_identity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.visualIdentities.create');
    }

    public function store(StoreVisualIdentityRequest $request)
    {
        $visualIdentity = VisualIdentity::create($request->all());

        return redirect()->route('tenant.visual-identities.index');
    }

    public function edit(VisualIdentity $visualIdentity)
    {
        abort_if(Gate::denies('visual_identity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.visualIdentities.edit', compact('visualIdentity'));
    }

    public function update(UpdateVisualIdentityRequest $request, VisualIdentity $visualIdentity)
    {
        $visualIdentity->update($request->all());

        return redirect()->route('tenant.visual-identities.index');
    }

    public function show(VisualIdentity $visualIdentity)
    {
        abort_if(Gate::denies('visual_identity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.visualIdentities.show', compact('visualIdentity'));
    }

    public function destroy(VisualIdentity $visualIdentity)
    {
        abort_if(Gate::denies('visual_identity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visualIdentity->delete();

        return back();
    }

    public function massDestroy(MassDestroyVisualIdentityRequest $request)
    {
        VisualIdentity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
