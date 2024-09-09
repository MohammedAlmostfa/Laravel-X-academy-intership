<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkMiddleware
{

    public function handle($request, Closure $next, ...$roles)
    {// check role an auth
        if (auth()->user() && in_array(auth()->user()->role, $roles)) {
            return $next($request);
        } else {

            return Response()->json([

            "message" =>'غير مصرح لك بهذه العملية'

            ]);

        }
    }

}
