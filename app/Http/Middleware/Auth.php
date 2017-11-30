<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
        $token = $request->header('token');

        if (!$token || $token != '123456') {
            return response()->json(['code'=>401,'message'=>'invalid token'],401);
        }

        return $next($request);
    }
}
