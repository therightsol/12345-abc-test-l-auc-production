<?php
Route::group(
    [
//        'middleware' => ['web', 'admin_login_check'],
        'middleware' => ['web','has_role:admin,staff'],
        'prefix' => Helper::dashboardName(),
        'as'    =>  'admin.',
        'namespace' => 'Modules\CarCompanies\Http\Controllers'
    ],
    function()
    {

        Route::Resource('car-companies', 'CarCompaniesController', ['names' => Helper::ResourceNames('carCompany')]);

    });