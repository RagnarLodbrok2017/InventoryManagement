<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','signup']]);
    }


    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
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

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users|min:10|max:255',
            'name' => 'required|min:2|max:255',
            'password' => 'required|confirmed|min:6|max:255',
        ]);
        User::create([
            'name' => $request['name'],
            'email' =>$request['email'],
            'password' =>Hash::make( $request['password'] ),
        ]);
            // $user['name'] = $request['name'];
            // $user['email'] = $request['email'];
            // $user['password'] = Hash::make( $request['password'] );
            // DB::table('users')->insert($user);
            // // response()->json(['message' => 'Register Successful']);
             return $this->login($request);


    }

}
