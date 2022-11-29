<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Order;
use App\Model\ShoppingCart;


class OrderController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = auth()->user();
        $this->Middleware('JWT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = DB::table('orders')->get();
        return reponse()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|numeric',
            'payment_id' => 'required|numeric',
            'discount' => 'nullable|max:255|numeric',
            'tax' => 'required|numeric',
            'product_quantity' => 'required|numeric',
            'total_payment' => 'required|numeric',
        ]);
        $user_id = $this->user->id;
        $order = new Order();
        $order->user_id = $user_id;
        $order->customer_id = $request->customer_id;
        $order->payment_id = $request->payment_id;
        $order->discount = $request->discount;
        $order->tax = $request->tax;
        $order->product_quantity = $request->product_quantity;
        $order->total_payment = $request->total_payment;
        $order->month = date('F');
        $order->year = date('Y');
        $order->date = date('Y/m/d');
        $order->save();

        $shoppingcarts = $this->user->shoppingCart;
        if($order->id && $shoppingcarts)
        {
            $products = $shoppingcarts->map->only(['product_id','quantity','total_payment']);
            $order->products()->attach($products);
            $this->user->shoppingCart()->delete();
        }
        // return response()->json(["order"=>$order,"products"=>$products]);
        return response()->json("Order Compeleted");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
