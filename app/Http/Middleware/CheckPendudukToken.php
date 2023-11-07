<?php

namespace App\Http\Middleware;

use Closure;
use App\Penduduk;

class CheckPendudukToken
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
        $token = $request->bearerToken();
        $check = Penduduk::where('token',$token)->first();
        if($check)
            return $next($request);
        else
            return response()->json([
                'error' => true,
                'message' => 'Invalid Credentials',
                'data' => []
            ],401);
    }
}
