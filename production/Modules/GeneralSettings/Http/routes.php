<?php
    use Illuminate\Foundation\Auth\User;

    Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
            'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\GeneralSettings\Http\Controllers'
    ],
    function()
    {
        Route::get('settings', 'GeneralSettingsController@index')->name('settings.index');
        Route::post('settings-save', 'GeneralSettingsController@save')->name('settings.save');
    });
$userid = User::where('user_role', 'admin')->where('status', 'open')->limit(1)->get();
