<?php

namespace App\Http\Middleware;

use Closure;

class UserRoleMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role !== 'user') {
            abort(403, 'Access denied. You are not authorized to access this resource.');
        }
        return $next($request);
    }
}