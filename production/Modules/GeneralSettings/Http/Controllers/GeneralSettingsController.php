<?php

namespace Modules\GeneralSettings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GeneralSettings\Entities\GeneralSetting;

class GeneralSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {

        $settings = GeneralSetting::all();
        if (!empty($settings)) $settings = $settings->pluck('value', 'key');
        $featured_img = isset($settings['picture']) ? $settings['picture'] : null;
        return view('generalsettings::index', compact('settings', 'featured_img'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function save(Request $request)
    {

        GeneralSetting::truncate();

        $arr = [];
        foreach ($request->except('_token') as $key => $value) {
            $arr[] = ['key' => $key, 'value' => $value];
        }
        $isSuccess = GeneralSetting::insert($arr);

        return ($isSuccess) ?
            back()->with('alert-success', 'Settings Saved Successfully')
            : back()->with('alert-danger', 'Error: please try again.');
    }

}
