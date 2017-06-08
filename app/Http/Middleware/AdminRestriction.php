<?php

namespace App\Http\Middleware;

use Closure;

class AdminRestriction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(in_array('super-admin', auth()->user()->rolesConnectionData()->pluck('id')->toArray())) {

            return $next($request);
        }
            abort(403,'No access');

    }
}
