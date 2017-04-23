<?php

Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
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
Route::group(
    [
        'middleware' => ['web','has_role:bidder'],
        'prefix' => 'account',
        'as'    =>  'bidder.',
        'namespace' => 'Modules\Biddings\Http\Controllers'
    ],
    function(  )
    {

        Route::get('all-bids', 'BidderBiddingController@index')->name('bidding');

//        Route::resource('inspection', 'AuctioneerInspectionRequestsController',['names' => Helper::ResourceNames('inspection')]);
//        Route::post('storeCar', 'AuctioneerInspectionRequestsController@storeCar')->name('storeCar');
    });