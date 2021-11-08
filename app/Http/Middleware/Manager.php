<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Manager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role == 2) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
        return response()->json('Not Authorized', 401);
    }
}
