<?php

namespace Modules\CommonBackend\Providers;

use Modules\CommonBackend\Http\Middleware\LoginCheckMiddleWare as LoginCheckMiddleware;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class CommonBackendServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    public static $dashboardName = 'backend';

    public static function getdashboardName()
    {
        return self::$dashboardName;
    }


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();

        $router->middleware('admin_login_check', LoginCheckMiddleware::class);
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('admin_login_check', LoginCheckMiddleware::class);



    }

    public function registerMiddleware(Router $router)
    {
        /* custom */
        //$router->middleware('admin_login_check', \Modules\CommonBackend\Http\Middleware\LoginCheckMiddleWare::class);

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('commonbackend.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'commonbackend'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/commonbackend');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/commonbackend';
        }, \Config::get('view.paths')), [$sourcePath]), 'commonbackend');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/commonbackend');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'commonbackend');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'commonbackend');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
