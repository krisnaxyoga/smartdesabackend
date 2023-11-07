<?php

namespace App\Http\Middleware;

use Closure;

class CekDesaHeader
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
        if ($request->header("DesaId") == null) {
            return response()->json([
                'error' => true,
                'message' => 'Unauthorized Header',
                'data' => []
            ],401);
        }

        return $next($request);
    }
}