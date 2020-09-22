<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use JWTAuth;
use Exception;
use Firebase\JWT\JWT;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    public $attributes;
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $token = JWTAuth::getToken();
            $credentials = JWTAuth::getPayload($token)->toArray();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status' => 'Token is Invalid']);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response(['status' => 'Token is Expired'], 401);
            }else{
                return response([
                    'status' => 'error',
                    'message' => 'Authorization Token not found'
                ], 401);
            }
        }
        $request->attributes->add(['uid' => $credentials['sub']]);
        $request->auth = $user;
        return $next($request);
    }
}