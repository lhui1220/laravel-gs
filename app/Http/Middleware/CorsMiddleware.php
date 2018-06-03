<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CorsMiddleware
{
    const ALLOWED_HOSTS = ['php.dev'];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //处理跨域请求
        $origin = $request->header('Origin');
        $host = parse_url($origin,PHP_URL_HOST);
        if (!$host || !in_array($host,static::ALLOWED_HOSTS)) {
            return response('CORS denied.',403); //拒绝访问
        }

        $response =  $next($request);

        $response->header('Access-Control-Allow-Origin',$origin);
        $response->header('Access-Control-Allow-Headers','content-type');

        return $response;
    }
}
