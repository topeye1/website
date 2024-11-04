<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
//use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            //$request_all = $request->all();
            $url = $request->getPathInfo();
            $contains = Str::of($url)->contains('user.');
            $guard = 'admin';
            if ($contains) {
                $guard = 'user';
            }
            $user = auth($guard)->authenticate();

        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['msg' => 'err','cont' => 'Token is Invalid']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['msg' => 'err', 'cont' => 'Token is Expired']);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                return response()->json(['msg' => 'err', 'cont' => 'Token is Blacklisted']);
            } else {
                return response()->json(['msg' => 'err', 'cont' => 'Authorization Token not found']);
            }
        }
        return $next($request);
    }


}
