<?php

namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class SwitchLang extends BaseMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $locale = session()->get('locale');
            if (!$locale) {
                session()->put('locale', 'ko');
            }
            app()->setLocale($locale);
        } catch (Exception $e) {
        }
        return $next($request);
    }


}
