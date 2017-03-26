<?php

$dashboardName = \Modules\CommonBackend\Providers\CommonBackendServiceProvider::getdashboardName();

$prefixedResourceNames = function ($prefix) {
    return [
        'index'   => $prefix . '.index',
        'create'  => $prefix . '.create',
        'store'   => $prefix . '.store',
        'show'    => $prefix . '.show',
        'edit'    => $prefix . '.edit',
        'update'  => $prefix . '.update',
        'destroy' => $prefix . '.destroy'
    ];
};

Route::group(
    [
        'middleware' => ['web', 'admin_login_check'],
        'prefix' => 'backend',
        'as'    =>  'admin.',
        'namespace' => 'Modules\Users\Http\Controllers'
    ],
    function(  ) use ($dashboardName, $prefixedResourceNames)
    {

        Route::Resource('users', 'UsersController', ['names' => $prefixedResourceNames('users')]);

//        Route::get('/', 'UsersController@index');
        //Route::get('/login', 'UsersController@login')->name($dashboardName . '-login');
    });


// For Base Controllers

