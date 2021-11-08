<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Customer
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
        if (auth()->user()->role == 3) {
            return $next($request);
        }

        if (! $request->expectsJson()) {
            return route('login');
        }
        return response()->json('Not Authorized', 401);
    }
}
