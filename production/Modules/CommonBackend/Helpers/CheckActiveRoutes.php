<?php

    /*
    |--------------------------------------------------------------------------
    | Detect Active Route
    |--------------------------------------------------------------------------
    |
    | Compare given route with current route and return output if they match.
    | Very useful for navigation, marking if the link is active.
    |
    */
    function isActiveRoute($route, $output = "active")
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
    function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route)
        {
            if (Route::currentRouteName() == $route) return $output;
        }

    }

    function isActiveResource($resource, $output = "active"){
        $currentRoute = getResourceName();
        if ($currentRoute == $resource) return $output;
    }

    function getCreateRouteName(){
        return getResourceName().'.create';
    }

    function getStoreRouteName(){
        return getResourceName().'.store';
    }
    function getUpdateRouteName(){
        return getResourceName().'.update';
    }

    function getDestroyRouteName(){
        return getResourceName().'.destroy';
    }

    function getResourceName(){
        return preg_replace('/\W\w+\s*(\W*)$/', '$1', Route::currentRouteName());
    }

