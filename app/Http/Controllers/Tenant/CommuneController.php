<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyCommuneRequest;
use App\Http\Requests\Tenant\StoreCommuneRequest;
use App\Http\Requests\Tenant\UpdateCommuneRequest;
use App\Models\Commune;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommuneController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commune_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $communes = Commune::with(['wilayas'])->get();

        return view('tenant.communes.index', compact('communes'));
    }

    public function create()
    {
        abort_if(Gate::denies('commune_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id');

        return view('tenant.communes.create', compact('wilayas'));
    }

    public function store(StoreCommuneRequest $request)
    {
        $commune = Commune::create($request->all());
        $commune->wilayas()->sync($request->input('wilayas', []));

        return redirect()->route('tenant.communes.index');
    }

    public function edit(Commune $commune)
    {
        abort_if(Gate::denies('commune_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilayas = Wilaya::pluck('wilaya', 'id');

        $commune->load('wilayas');

        return view('tenant.communes.edit', compact('commune', 'wilayas'));
    }

    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        $commune->update($request->all());
        $commune->wilayas()->sync($request->input('wilayas', []));

        return redirect()->route('tenant.communes.index');
    }

    public function show(Commune $commune)
    {
        abort_if(Gate::denies('commune_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commune->load('wilayas');

        return view('tenant.communes.show', compact('commune'));
    }

    public function destroy(Commune $commune)
    {
        abort_if(Gate::denies('commune_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commune->delete();

        return back();
    }

    public function massDestroy(MassDestroyCommuneRequest $request)
    {
        Commune::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
