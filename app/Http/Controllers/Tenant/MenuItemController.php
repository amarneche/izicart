<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\Tenant\MassDestroyMenuItemRequest;
use App\Http\Requests\Tenant\StoreMenuItemRequest;
use App\Http\Requests\Tenant\UpdateMenuItemRequest;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MenuItemController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('menu_item_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuItems = MenuItem::with(['menu', 'page', 'media'])->get();

        return view('tenant.menuItems.index', compact('menuItems'));
    }

    public function create()
    {
        abort_if(Gate::denies('menu_item_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menus = Menu::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pages = Page::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('tenant.menuItems.create', compact('menus', 'pages'));
    }

    public function store(StoreMenuItemRequest $request)
    {
        $menuItem = MenuItem::create($request->all());

        if ($request->input('icon', false)) {
            $menuItem->addMedia(storage_path('tmp/uploads/' . basename($request->input('icon'))))->toMediaCollection('icon');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuItem->id]);
        }

        return redirect()->route('tenant.menu-items.index');
    }

    public function edit(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menus = Menu::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $pages = Page::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menuItem->load('menu', 'page');

        return view('tenant.menuItems.edit', compact('menuItem', 'menus', 'pages'));
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

        return redirect()->route('tenant.menu-items.index');
    }

    public function show(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuItem->load('menu', 'page');

        return view('tenant.menuItems.show', compact('menuItem'));
    }

    public function destroy(MenuItem $menuItem)
    {
        abort_if(Gate::denies('menu_item_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuItem->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuItemRequest $request)
    {
        MenuItem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('menu_item_create') && Gate::denies('menu_item_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MenuItem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
