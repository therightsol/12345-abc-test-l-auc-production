<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Modules\GeneralSettings\Entities\GeneralSetting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \DB::listen(function($sql) {

            \Log::info($sql->sql);
        });
        \View::composer('*', function ($view) {
            $settings = GeneralSetting::pluck('value', 'key');
            $view->with(compact('settings'));
        });
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
