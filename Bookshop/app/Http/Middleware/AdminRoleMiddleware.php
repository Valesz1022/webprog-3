<?php

namespace App\Http\Middleware;

use Closure;

class AdminRoleMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->role !== 'admin') {
            abort(403, 'Access denied. You are not authorized to access this resource.');
        }
        return $next($request);
    }
}
