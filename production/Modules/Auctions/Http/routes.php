<?php
Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\Auctions\Http\Controllers'
    ],
    function()
    {
        Route::Resource('auctions', 'AuctionsController', ['names' => Helper::ResourceNames('auctions')]);
        Route::post('getAuctionForm', 'AuctionsController@getAuctionForm')->name('getAuctionForm');
        Route::get('searchCar', 'AuctionsController@searchCar')->name('searchCar');
    });