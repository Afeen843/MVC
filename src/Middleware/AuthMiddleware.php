<?php

namespace App\Middleware;

class AuthMiddleware
{
    public function handle($request, \Closure $next)
    {
        if(!isset($_SESSION['user_id'])) {
            throw new \Exception('Forbidden');
        }
        return $next($request);
    }
}