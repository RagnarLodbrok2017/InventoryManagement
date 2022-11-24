<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class AuthController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api', ['except' => ['login','signup']]);
        $this->middleware('JWT', ['except' => ['login', 'signup','refreshToken']]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        $credentials = request(['email', 'password']);
        $myTTL = 1; //minutes
        JWTAuth::factory()->setTTL($myTTL);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Invalid Email or Password'], 401);
        }

        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();
        JWTAuth::invalidate(auth()->getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $myTTL = 1; //minutes
        JWTAuth::factory()->setTTL($myTTL);
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            // 'expires_in' => auth()->factory()->setTTL(1),
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'user_id' => auth()->user()->id,
        ]);
    }

    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|max:255',
            'name' => 'required|min:2|max:255',
            'password' => 'required|confirmed|min:6|max:255',
        ]);
        $user = array();
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['password']);
        DB::table('users')->insert($user);
        // // response()->json(['message' => 'Register Successful']);
        //return $this->login($request);
        //return response()->json(['error' => 'Registeration error'], 401);
        return $this->login($request);


    }

    public function getUser()
    {
        // $user = auth()->user();
        $user = Auth::User();
        // $user = JWTAuth::parseToken()->authenticate();
        // $user = Auth::guard('api')->user();
        // $user = JWTAuth::parseToken()->authenticate();
        return response()->json($user);
        // dd($token);
        // $user = auth()->user();
        // dd($user);
        // dd("done");
    //     if (! $user = JWTAuth::parseToken()->authenticate()) {
    //         return response()->json(['user_not_found'], 404);
    // }

        // return response()->json(auth()->user());
    }
    public function getAuthenticatedUser()
            {
                try {
                    if (! $user = JWTAuth::parseToken()->authenticate()) {
                        return response()->json(['user_not_found'], 404);
                    }
                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
                }

                return response()->json(compact('user'));
            }

            public function refreshToken(){
                if(auth()->user())
                {
                    dd(auth()->user());
                    $newtoken = auth()->refresh();
                    return $this->respondWithToken($newtoken);
                }
                else {
                    return response()->json([
                        "error" => "Not Auth"
                    ], 400);
                }
            }
    // public function refreshToken()
    // {
    //     $newtoken = auth()->refresh();
    //     return $this->respondWithToken($newtoken);
    //     try {
    //         if (!JWTAuth::parseToken()->authenticate()) {
    //             return response()->json("not authenticated", 401);
    //         }

    //         //refresh token
    //         $newtoken = auth()->refresh();
    //         $this->respondWithToken($newtoken); // or assign original token that hasn't expired yet.
    //         // dd("new token"+$newtoken);
    //         // return $this->authService->respondWithToken($newtoken);
    //     } catch (TokenExpiredException $e) {
    //         // Access token has expired
    //         try {
    //             $newtoken = auth()->refresh();
    //             $this->respondWithToken($newtoken);
    //             return $this->authService->respondWithToken($newtoken);
    //         } catch (TokenExpiredException $e) {
    //             // Refresh token has expired
    //             return response()->json([
    //                 "message" => $e->getMessage()
    //             ], 401);
    //         } catch (TokenBlacklistedException $e) {
    //             // Access token has be list to blacklist. You must re-log into the system.
    //             return response()->json([
    //                 "message" => $e->getMessage()
    //             ], 401);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([], 400);
    //     }
    // }

}
