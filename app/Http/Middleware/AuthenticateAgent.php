<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateAgent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->guard('agent')->user() !== null) {
            return $next($request);
        }

        return response([
            'error' => true,
            'message' => 'Invalid credentials.'
        ], 401);
    }
}
