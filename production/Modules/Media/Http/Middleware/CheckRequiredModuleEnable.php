<?php

namespace Modules\Media\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Nwidart\Modules\Facades\Module;

class CheckRequiredModuleEnable
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
        $enable_module = Module::enabled();

        return array_key_exists('Media', $enable_module) ? $next($request) : dd('Please enable post module first.');

    }
}
