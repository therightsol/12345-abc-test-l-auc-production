<?php

Route::group(['middleware' => 'web', 'prefix' => 'carmetas', 'namespace' => 'Modules\CarMetas\Http\Controllers'], function()
{
    Route::get('/', 'CarMetasController@index');
});
