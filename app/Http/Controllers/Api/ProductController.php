<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category:id,name')->with('supplier:id,name')->get();
        return response()->json($products);
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
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products',
            'code'=> 'required|unique:products|max:255',
            'root'=> 'required|unique:products|max:255',
            'quantity'=> 'required|numeric',
            'buying_price'=> 'nullable|numeric',
            'selling_price'=>'required|numeric',
            'buying_date'=>'nullable|date',
            'photo'=>'nullable',
            'supplier_id'=>'required|numeric|exists:suppliers,id',
            'category_id'=>'required|numeric|exists:categories,id',
        ]);
        $product = new Product;
        if($validated && $request->photo == null)
        {
            $product = Product::create($request->all());
        }
        else{
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0 , $position);
            $ext = explode('/', $sub)[1];
            $upload_path ="backend/product/";
            $name = time().'.'. $ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product->photo = $image_url;
            $product->name = $request->name;
            $product->code = $request->code;
            $product->root = $request->root;
            $product->quantity = $request->quantity;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->save();
        }
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
        $validated = $request->validate([
            'name' => 'required|max:255|unique:products,name,'.$id,
            'code'=> 'required|max:255|unique:products,code,'.$id,
            'root'=> 'required|max:255|unique:products,root,'.$id,
            'quantity'=> 'required|numeric',
            'buying_price'=> 'nullable|numeric',
            'selling_price'=>'required|numeric',
            'buying_date'=>'nullable|date',
            'photo'=>'nullable',
            'supplier_id'=>'required|numeric|exists:suppliers,id',
            'category_id'=>'required|numeric|exists:categories,id',
        ]);
        $product = Product::find($id);
        if($request->photo && $request->photo != $product->photo)
        {
            if($product->photo != NULL)
            {
                unlink($product->photo);
            }
            $position = strpos($request->photo,';');
            $sub = substr($request->photo, 0 , $position);
            $ext = explode('/', $sub)[1];
            $upload_path ="backend/product/";
            $name = time().'.'. $ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $image_url = $upload_path.$name;
            $img->save($image_url);
            $product->photo = $image_url;
            $product->name = $request->name;
            $product->code = $request->code;
            $product->root = $request->root;
            $product->quantity = $request->quantity;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->buying_date = $request->buying_date;
            $product->supplier_id = $request->supplier_id;
            $product->category_id = $request->category_id;
            $product->update();
        }
        else{
            $product->update($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if($product && $product->photo)
        {
            unlink($product->photo);
        }
        $product->delete();
    }
}
