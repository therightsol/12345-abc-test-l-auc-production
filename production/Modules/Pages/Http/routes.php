<?php

Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\Pages\Http\Controllers'
    ],
    function()
    {
        Route::get('rules-page', 'PagesController@rules')->name('rulesPage');
        Route::post('rules-page', 'PagesController@storeRulesPage')->name('rulesPage.store');
        Route::get('help-page', 'PagesController@help')->name('helpPage');
        Route::post('help-page', 'PagesController@storeHelpPage')->name('helpPage.store');
    });