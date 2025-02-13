<?php

namespace App\Http\Middleware\Clinet;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user is authenticated and has the given role
        if (auth()->check() && (auth()->user()->role === $role)) {
            return $next($request); // Allow the request to proceed
        }
    }
}
