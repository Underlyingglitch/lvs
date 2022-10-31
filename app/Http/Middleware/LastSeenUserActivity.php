<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LastSeenUserActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            //Last Seen
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        return $next($request);
    }
}
