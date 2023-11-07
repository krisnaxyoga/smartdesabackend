<?php

namespace App\Http\Middleware;

use Closure;
use App\KepalaDusun;

class CheckKadusApiKey
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
        $api_key = $request->bearerToken();
        
        $kepalaDusun = KepalaDusun::where('api_key',$api_key)->first();
        if($kepalaDusun)
            return $next($request);
        else 
            return response()->json([
                'error' => true,
                'message' => 'Invalid Credentials',
                'data' => []
            ],401);
    }
}
