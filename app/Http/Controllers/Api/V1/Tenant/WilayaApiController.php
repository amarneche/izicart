<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\StoreWilayaRequest;
use App\Http\Requests\Tenant\UpdateWilayaRequest;
use App\Http\Resources\Tenant\WilayaResource;
use App\Models\Wilaya;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WilayaApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('wilaya_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WilayaResource(Wilaya::with(['payment_methods'])->get());
    }

    public function store(StoreWilayaRequest $request)
    {
        $wilaya = Wilaya::create($request->all());
        $wilaya->payment_methods()->sync($request->input('payment_methods', []));

        return (new WilayaResource($wilaya))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Wilaya $wilaya)
    {
        abort_if(Gate::denies('wilaya_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new WilayaResource($wilaya->load(['payment_methods']));
    }

    public function update(UpdateWilayaRequest $request, Wilaya $wilaya)
    {
        $wilaya->update($request->all());
        $wilaya->payment_methods()->sync($request->input('payment_methods', []));

        return (new WilayaResource($wilaya))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Wilaya $wilaya)
    {
        abort_if(Gate::denies('wilaya_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $wilaya->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
