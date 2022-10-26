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
        // $this->middleware('auth:api', ['except' => ['login','signup']]);
        $this->middleware('JWT', ['except' => ['login', 'signup']]);
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|max:255',
            'password' => 'required|min:5|max:255'
        ]);

        $credentials = request(['email', 'password']);

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
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
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
//        User::create([
//            'name' => $request['name'],
//            'email' =>$request['email'],
//            'password' =>Hash::make( $request['password'] ),
//        ]);
        $user = array();
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user['password'] = Hash::make($request['password']);
        DB::table('users')->insert($user);
        // // response()->json(['message' => 'Register Successful']);
        //return $this->login($request);
//        return response()->json(['error' => 'Registeration error'], 401);
        return $this->login($request);


    }

}
