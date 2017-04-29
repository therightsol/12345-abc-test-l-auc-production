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
        'middleware' => ['web'],
        'prefix' => $dashboardName,
        'namespace' => 'Modules\CommonBackend\Http\Controllers'
    ],
    function () use ($dashboardName, $prefixedResourceNames)
{
    //Route::Resource('commonbackend', 'CommonBackendController', ['names' => $prefixedResourceNames('commonbackend')]);
    Route::get('/', 'CommonBackendController@index')->name('backend');
    Route::get('/login', 'CommonBackendController@login')->name('dashboard-login');
    Route::post('/login', 'CommonBackendController@do_login')->name('do-login');
    Route::get('/reset-password', 'CommonBackendController@login')->name('reset-password');
    Route::get('/logout', 'CommonBackendController@logout')->name('logout');

});
Route::group(
    [
        'middleware' => ['web','auth'],
        'prefix' => 'account',
        'as'    =>  'user.',
        'namespace' => 'Modules\Biddings\Http\Controllers'
    ],
    function(  )
    {

        Route::get('/', function(){
            return view('commonbackend::index');
        })->name('account');
    });
