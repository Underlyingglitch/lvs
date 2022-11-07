<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DebugMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // TODO - Implement new authentication system
        if (auth()->user() && in_array(auth()->id(), [1])) {
            \Debugbar::enable();
        } else {
            \Debugbar::disable();
        }

        return $next($request);
    }
}
