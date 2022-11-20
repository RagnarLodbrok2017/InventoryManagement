<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
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
        $validate = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'description' => 'nullable|max:255'
        ]);
        Category::create($request->all());
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
            'name'=> 'required|unique:categories,name,'.$id,
            'description'=> 'nullable|max:255'
        ]);
        $category = Category::find($id);
        if($validated && $category)
        {
            $category->update($request->all());
            // $category = Category::update([
            //     'name' => $request->name,
            //     'description' => $request->description,
            // ]);
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if($category){
            $category->delete();
        }
    }

    // get Products of category by id
    public function getProducts($id)
    {
        $products = Category::find($id)->product;
        return response()->json($products);
    }
}
