<?php

namespace Modules\CommonBackend\Helpers;
use Modules\GeneralSettings\Entities\GeneralSetting;
use \Route;

/**
 * Class Currency
 *
 * @package \App\Helpers
 */
class Helper
{

    public static $symbol;

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public static function isActiveRoute($route, $output = "active")
    {
        if (Route::currentRouteName() == $route) return $output;
    }

    /*
    |--------------------------------------------------------------------------
    | Detect Active Routes
    |--------------------------------------------------------------------------
    |
    | Compare given routes with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    public static function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route)
        {
            if (Route::currentRouteName() == $route) return $output;
        }

    }



    public static function ResourceNames($prefix)
    {
        return [
            'index'   => $prefix . '.index',
            'create'  => $prefix . '.create',
            'store'   => $prefix . '.store',
            'show'    => $prefix . '.show',
            'edit'    => $prefix . '.edit',
            'update'  => $prefix . '.update',
            'destroy' => $prefix . '.destroy'
        ];
    }


    public static function dashboardName()
    {
        return \Modules\CommonBackend\Providers\CommonBackendServiceProvider::getdashboardName();

    }


    public static function limit($request)
    {
        return  ($request->has('limit')) ? $request->input('limit') : 10;

    }



    public static function isActiveResource($resource, $output = "active"){
        $currentRoute = self::getResourceName();
        if ($currentRoute == $resource) return $output;
    }

    public static function route($name)
    {
        switch ($name) {
            case "index":
                return self::getResourceName().'.index';
                break;
            case "create":
                return self::getResourceName().'.create';
                break;
            case "edit":
                return self::getResourceName().'.edit';
                break;
            case "store":
                return self::getResourceName().'.store';
                break;
            case "update":
                return self::getResourceName().'.update';
                break;
            case "destroy":
                return self::getResourceName().'.destroy';
                break;
            default:
                return '/';
        }

    }

    public static function getResourceName(){
        return preg_replace('/\W\w+\s*(\W*)$/', '$1', Route::currentRouteName());
    }


    public static function currencySymbol()
    {
        if(!self::$symbol){
            $symbol = GeneralSetting::currencySymbol();
            if(count($symbol)){
                self::$symbol = $symbol[0];
            }
        }

        return self::$symbol;
    }

}