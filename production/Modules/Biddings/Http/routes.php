<?php

Route::group(['middleware' => 'web', 'prefix' => 'biddings', 'namespace' => 'Modules\Biddings\Http\Controllers'], function()
{
    Route::get('/', 'BiddingsController@index');
});
Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\Biddings\Http\Controllers'
    ],
    function()
    {
        Route::Resource('biddings', 'BiddingsController', ['names' => Helper::ResourceNames('biddings')]);
        Route::get('searchAuction', 'BiddingsController@searchAuction')->name('searchAuction');
        Route::get('searchUser', 'BiddingsController@searchUser')->name('searchUser');
    });