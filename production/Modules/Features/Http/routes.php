<?php

Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\Features\Http\Controllers'
    ],
    function()
    {
        Route::Resource('car-features', 'FeaturesController', ['names' => Helper::ResourceNames('features')]);
    });