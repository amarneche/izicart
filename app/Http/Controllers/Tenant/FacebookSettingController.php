<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\MassDestroyFacebookSettingRequest;
use App\Http\Requests\Tenant\StoreFacebookSettingRequest;
use App\Http\Requests\Tenant\UpdateFacebookSettingRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FacebookSettingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('facebook_setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.facebookSettings.index');
    }

    public function create()
    {
        abort_if(Gate::denies('facebook_setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.facebookSettings.create');
    }

    public function store(StoreFacebookSettingRequest $request)
    {
        $facebookSetting = FacebookSetting::create($request->all());

        return redirect()->route('tenant.facebook-settings.index');
    }

    public function edit(FacebookSetting $facebookSetting)
    {
        abort_if(Gate::denies('facebook_setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.facebookSettings.edit', compact('facebookSetting'));
    }

    public function update(UpdateFacebookSettingRequest $request, FacebookSetting $facebookSetting)
    {
        $facebookSetting->update($request->all());

        return redirect()->route('tenant.facebook-settings.index');
    }

    public function show(FacebookSetting $facebookSetting)
    {
        abort_if(Gate::denies('facebook_setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('tenant.facebookSettings.show', compact('facebookSetting'));
    }

    public function destroy(FacebookSetting $facebookSetting)
    {
        abort_if(Gate::denies('facebook_setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $facebookSetting->delete();

        return back();
    }

    public function massDestroy(MassDestroyFacebookSettingRequest $request)
    {
        FacebookSetting::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
