<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class MapJwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
             if (!$user) {
                 return response()->json([
                     'msg' => 'انتهت صلاحية الجلسة',
                     'data' => null,
                     'status' => 401
                 ]);
             }
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'msg' => 'الرمز غير صالح',
                    'data' => null,
                    'status' => 407
                ]);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'msg' => 'انتهت صلاحية الجلسة',
                    'data' => null,
                    'status' => 408
                ]);
            } else {
                return response()->json([
                    'msg' => 'الرمز غير موجود',
                    'data' => null,
                    'status' => 401
                ]);
            }
        }
        return $next($request);
    }
}
