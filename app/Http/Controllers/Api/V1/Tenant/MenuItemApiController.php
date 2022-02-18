<?php

namespace App\Http\Controllers\Api\V1\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\StoreMenuItemRequest;
use App\Http\Requests\Tenant\UpdateMenuItemRequest;
use App\Http\Resources\Tenant\MenuItemResource;
use App\Models\MenuItem;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MenuItemApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('menu_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MenuItemResource(MenuItem::with(['menu', 'page'])->get());
    }

    public function store(StoreMenuItemRequest $request)
    {
        $menuItem = MenuItem::create($request->all());

        if ($request->input('icon', false)) {
            $menuItem->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        return (new MenuItemResource($menuItem))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MenuItemResource($menuItem->load(['menu', 'page']));
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $menuItem->update($request->all());

        if ($request->input('icon', false)) {
            if (!$menuItem->icon || $request->input('icon') !== $menuItem->icon->file_name) {
                if ($menuItem->icon) {
                    $menuItem->icon->delete();
                }
                $menuItem->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
            }
        } elseif ($menuItem->icon) {
            $menuItem->icon->delete();
        }

        return (new MenuItemResource($menuItem))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuItem->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
