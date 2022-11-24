<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Model\ShoppingCart;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        // $this->user = JWTAuth::parseToken()->authenticate();

        $this->middleware('JWT');
        // $this->middleware('auth:api', ['except' => ['index']]);
        // $this->middleware('auth:api');
    }


    public function index()
    {
        $carts = ShoppingCart::all();
        return response()->json($carts);
    }



    public function storeByClick($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        // dd($product);
        $user = auth()->user();
        // $user = JWTAuth::user();

        // dd($user);
        if($product)
        {
            $cart = new ShoppingCart;
            $cart->user_id = $user->id;
            $cart->product_id = $product->id;
            $cart->product_price = $product->selling_price;
            $cart->product_name = $product->name;
            $cart->quantity = 1;
            $cart->total_price = ($product->selling_price * $cart->quantity);
            $cart->save();
        }
        else{
            return response()->json('error');
        }
    }

    public function delete($id)
    {
        $cart = ShoppingCart::find($id);
        if($cart)
        {
            $cart->delete();
        }
    }
}
