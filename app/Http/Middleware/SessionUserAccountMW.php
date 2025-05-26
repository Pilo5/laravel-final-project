<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class SessionUserAccountMW
{
    public function handle($request, Closure $next)
    {
        if (!Session::has('loggedUser')) {
            return redirect('/login');
        }

        return $next($request);
    }
}
