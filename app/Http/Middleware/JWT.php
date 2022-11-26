<?php

namespace App\Http\Middleware;
use JWTAuth;
use Closure;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Http\Controllers\Api\AuthController;

class JWT
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
        try{
            $user = JWTAuth::parseToken()->authenticate();
            return $next($request);

        }
        catch (\Exception $e) {
            if($e instanceof TokenExpiredException)
            {
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json([
                    'success' => false,
                    'token' => $newToken,
                    'status' => 'expired'
                ], 403);
            }
            else if($e instanceof TokenBlacklistedException)
            {
                $newToken = JWTAuth::parseToken()->refresh();
                return response()->json([
                    'success' => false,
                    'token' => $newToken,
                    'status' => 'blacklist'
                ], 401);
            }
            else if($e instanceof TokenInvalidException)
            {
                return response()->json([
                    'success' => false,
                    'token' => 'null',
                    'status' => 'Invalid'
                ], 400);
            }
        }
    }
}
