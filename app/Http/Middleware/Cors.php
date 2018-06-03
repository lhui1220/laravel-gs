<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2018/5/12
 * Time: 21:51
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cors
{

    protected $corsRequestType = '';

    const ALLOWED_ORIGINS = [
        'http://cors.geek.io'
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $origin = $request->header('Origin');

        if ($this->isSimpleCors($request)) {
            if (!in_array($origin,self::ALLOWED_ORIGINS)) {
                return response('Forbidden',403);
            }
            $response->header('Access-Control-Allow-Origin',$origin);
        } else if ($this->isPreflightedCors($request)) {
            if (!in_array($origin,self::ALLOWED_ORIGINS)) {
                return response('Forbidden',403);
            }
            $response->header('Access-Control-Allow-Origin',$origin);
            $response->header('Access-Control-Allow-Methods','POST, OPTION');
            $response->header('Access-Control-Allow-Headers','content-type');
            $response->header('Access-Control-Allow-Credentials', 'true');
        }
        return $response;
    }

    private function isSimpleCors(Request $request) {
        $method = strtoupper($request->getMethod());
        $contentType = $request->getContentType();
        $contentTypes = [
            'application/x-www-form-urlencoded',
            'multipart/form-data',
            'text/plain'
        ];
        if ($method == 'GET'
            || ($method == 'POST' && in_array($contentType,$contentTypes))) {
            return true;
        }
        return false;
    }

    private function isPreflightedCors(Request $request) {
        $method = strtoupper($request->getMethod());
        $contentType = $request->getContentType();
        $contentTypes = [
            'application/x-www-form-urlencoded',
            'multipart/form-data',
            'text/plain'
        ];
        if ($method == 'OPTIONS'
            || ($method == 'POST' && !in_array($contentType,$contentTypes))) {
            return true;
        };
        return false;
    }

}