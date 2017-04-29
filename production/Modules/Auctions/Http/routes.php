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

Route::group(
    [
        'middleware' => ['web','has_role:auctioneer'],
        'prefix' => 'account',
        'as'    =>  'auctioneer.',
        'namespace' => 'Modules\Auctions\Http\Controllers'
    ],
    function(  )
    {

        Route::get('my-auctions', 'AuctioneerAuctionsController@index')->name('auctions');
        Route::get('auction-bids/{id}', 'AuctioneerAuctionsController@auctionBids')->name('auctionBids');
        Route::post('auction-winner/{id}', 'AuctioneerAuctionsController@winner')->name('auctionWinner');

    });
Route::group(
    [
        'middleware' => ['web','has_role:bidder'],
        'prefix' => 'account',
        'as'    =>  'bidder.',
        'namespace' => 'Modules\Auctions\Http\Controllers'
    ],
    function(  )
    {

        Route::get('won-auctions', 'BidderAuctionController@index')->name('wonAuctions');

    });