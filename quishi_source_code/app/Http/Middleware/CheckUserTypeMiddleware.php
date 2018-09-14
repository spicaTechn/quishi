<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserTypeMiddleware
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
        if($request->user() && $request->user()->logged_in_type == 1)
        {
            return redirect('/admin');
        }
        return $next($request);
    }
}
