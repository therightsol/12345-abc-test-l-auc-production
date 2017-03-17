<?php

namespace Modules\CommonBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\CommonBackend\Providers\CommonBackendServiceProvider;

class LoginCheckMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //$user = Auth::user();

        //@todo for development purpose - Delete Login line in production
        //$user = \Auth::loginUsingId(101);
        $user = Auth::user();

        //dd($user);
        //return gettype($user->isAdmin());
        if ($user && $user->isAdmin()){
            return $next($request);
        }else if ($user){

            return redirect(route('not-authorized'));
        }

        return redirect( route( 'dashboard-login') );

    }
}
