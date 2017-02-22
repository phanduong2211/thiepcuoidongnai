<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Redirect;

class CheckLogin
{
    public function handle($request, Closure $next)
    {
        if(!Session::has("logininfo")){
            return Redirect::to("admin/login?redirect=".$request->path());
        }

        return $next($request);
    }
}
