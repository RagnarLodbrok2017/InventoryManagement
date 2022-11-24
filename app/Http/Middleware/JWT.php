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
            if (!JWTAuth::parseToken()->authenticate()) {
            return response()->json("", 401);
            }
            return $next($request);
        }
        catch (TokenExpiredException $e) {
                return response()->json([
                    'error' => 'token_expired',
                    'refresh' => false,
                ], 401);
        } catch (TokenInvalidException $e) {
            \Log::debug('token invalid');
            return response()->json([
                'error' => 'token_invalid',
            ], 401);
        } catch (TokenBlacklistedException $e) {
            \Log::debug('token blacklisted');
            return response()->json([
                'error' => 'token_blacklisted',
            ], 401);
        } catch (JWTException  $e) {
            return response()->json([], 400);
        }
        return $next($request);
    }
}
