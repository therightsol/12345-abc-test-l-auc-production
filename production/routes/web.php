<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index')->name('homepage');
/*Route::group(['middleware' => ['web']], function () {
    Route::match(['get', 'post'], 'auction', 'Auction\AuctionController@index')->name('auction.index');
    Route::get('view-auction/{id}', 'Auction\AuctionController@show')->name('auction.show');
});
Route::Resource('inspection', 'InspectionController', ['names' => Helper::ResourceNames('inspection')]);
Route::get('help-page', function () {
    $page = \Modules\Media\Entities\Post::whereSlug('help-page')->whereHas('post_status', function ($query) {
        $query->where('status_title', 'published');
    })->firstOrFail();
    return view('pages', compact('page'));
});
Route::get('rules-page', function () {
    $page = \Modules\Media\Entities\Post::whereSlug('rules-page')->whereHas('post_status', function ($query) {
        $query->where('status_title', 'published');
    })->firstOrFail();
    return view('pages', compact('page'));
});


Route::group(
    ['middleware' => ['has_role:bidder']],
    function () {
        Route::post('add_bid', 'Auction\AuctionController@addBid');
    });*/

/*Route::get('/login/{params?}', 'Auth@index')->name('frontend-login');
Route::get('/logout', 'Auth@logout')->name('frontend-logout');
Route::post('/register', 'Auth@do_register')->name('frontend-do_register');
Route::post('/login', 'Auth@do_login')->name('frontend-do_login');
Route::get('/reset', 'Auth@show_reset_form')->name('frontend-reset');
Route::post('/reset', 'Auth@do_reset')->name('frontend-do_reset');

//Route::post('reset-password', "LoginController@do_reset")->name('reset-password');

Route::get('password/reset/{token}', 'Auth@showResetForm')->name('frontend-password-reset-with-token');
Route::post('password/reset', 'Auth@postReset')->name('frontend-reset-post');*/
