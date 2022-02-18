<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreCommuneRequest;
use App\Http\Requests\Tenant\UpdateCommuneRequest;
use App\Http\Resources\Tenant\CommuneResource;
use App\Models\Commune;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CommuneApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('commune_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommuneResource(Commune::with(['wilayas'])->get());
    }

    public function store(StoreCommuneRequest $request)
    {
        $commune = Commune::create($request->all());
        $commune->wilayas()->sync($request->input('wilayas', []));

        return (new CommuneResource($commune))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Commune $commune)
    {
        abort_if(Gate::denies('commune_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CommuneResource($commune->load(['wilayas']));
    }

    public function update(UpdateCommuneRequest $request, Commune $commune)
    {
        $commune->update($request->all());
        $commune->wilayas()->sync($request->input('wilayas', []));

        return (new CommuneResource($commune))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Commune $commune)
    {
        abort_if(Gate::denies('commune_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $commune->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
