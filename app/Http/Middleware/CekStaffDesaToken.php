<?php

namespace App\Http\Middleware;

use Closure;
use App\DesaPamong;

class CekStaffDesaToken
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
        
        $pamong = DesaPamong::where('token',$token)->first();
        if($pamong)
            return $next($request);
        else 
            return response()->json([
                'error' => true,
                'message' => 'Invalid Credentials',
                'data' => []
            ],401);
    }
}
