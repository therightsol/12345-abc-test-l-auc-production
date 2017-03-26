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
		'namespace' => 'Modules\Media\Http\Controllers'
	],
	function(  ) use ($dashboardName, $prefixedResourceNames)
	{



    // Media
    Route::get('media/{paginate?}/{page?}', 'MediaController@index')->name('media');
    Route::get('add-media', 'MediaController@add')->name('add-media');
    Route::post('destroy-media', 'MediaController@destroy')->name('destroy-media');
    //Route::get('all-media/{dir?}', 'MediaController@all_media')->name('all-media');
    Route::post('store-media', 'MediaController@store')->name('store-media');
    //Route::get('ajax-media/{offset?}/{quantity?}', 'MediaController@ajax_media')->name('ajax_media');
    Route::delete('media-destroy/{filename}', 'MediaController@destroy')->name('media-delete');
    Route::post('media-destroy', 'MediaController@bulk_delete')->name('media-bulk-delete');


});


