<?php
Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\CarModels\Http\Controllers'
    ],
    function()
    {
        Route::Resource('car-models', 'CarModelsController', ['names' => Helper::ResourceNames('carModel')]);
    });