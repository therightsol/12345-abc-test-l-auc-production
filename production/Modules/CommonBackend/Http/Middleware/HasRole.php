<?php
/**
 * Created by PhpStorm.
 * User: SAA
 * Date: 4/13/2017
 * Time: 8:33 PM
 */

namespace Modules\CommonBackend\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HasRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        //$user = Auth::user();
        

        //@todo for development purpose - Delete Login line in production
        //$user = \Auth::loginUsingId(101);
        $user = Auth::user();

        //dd($user);
        //return gettype($user->isAdmin());
        if ($user && $user->hasRole($role)){
            return $next($request);
        }else if ($user){

            dd('not-authorized');
        }

        return redirect( url('/login') );

    }
}