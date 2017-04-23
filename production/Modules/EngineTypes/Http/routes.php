<?php
Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\EngineTypes\Http\Controllers'
    ],
    function()
    {
        Route::Resource('car-types', 'EngineTypesController', ['names' => Helper::ResourceNames('engineTypes')]);
    });