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
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
        // $this->user = JWTAuth::parseToken()->authenticate();

        $this->middleware('JWT');
        // $this->middleware('auth:api', ['except' => ['index']]);
        // $this->middleware('auth:api');
    }


    public function index()
    {
        $carts = ShoppingCart::where('user_id', $this->user->id)->get();
        if($carts){
            //to get the total product quantity
            $product_quantity = ShoppingCart::groupBy('user_id')
            ->where('user_id', $this->user->id)
            ->selectRaw('sum(quantity) as product_quantity')
            ->get();

            //sub_total
            $sub_total = ShoppingCart::groupBy('user_id')
            ->where('user_id', $this->user->id)
            ->selectRaw('sum(total_payment) as sub_total')
            ->get();
        }
        return response()->json(['carts'=>$carts, 'product_quantity'=>$product_quantity,'sub_total'=>$sub_total]);
    }



    public function storeByClick($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $user = auth()->user();

        if($product && $product->quantity > 0)
        {
            $existProd = ShoppingCart::where('product_id' , $product->id)->where('user_id', $this->user->id)->first();
            if(!$existProd)
            {
                // new product in shopping carts
                $cart = new ShoppingCart;
                $cart->user_id = $user->id;
                $cart->product_id = $product->id;
                $cart->product_price = $product->selling_price;
                $cart->product_name = $product->name;
                $cart->quantity = 1;
                $cart->total_payment = ($product->selling_price * $cart->quantity);
                $cart->save();
            }
            else{
                $existProd->quantity = $existProd->quantity + 1;
                $existProd->total_payment = ($existProd->product_price * $existProd->quantity);
                $existProd->save();
            }
            //Update quantity of the product
            $product = DB::table('products')->where('id', $id)->update(['quantity' => DB::raw('quantity -'. 1)]);

            return response()->json(['message' => "The Product Added to Shopping Cart"], 200);
        }
        else{
            return response()->json(['message' => "The product Sold out"], 201);
        }
    }

    public function delete($id)
    {
        $cart = ShoppingCart::find($id);
        if($cart)
        {
            $cart->delete();
            DB::table('products')->where('id', $cart->product_id)
            ->update(['quantity'=> DB::raw('quantity +'.$cart->quantity)]);
        }
    }
}
