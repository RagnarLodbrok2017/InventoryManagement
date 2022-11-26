<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Image;

class SupplierController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return response()->json($suppliers);
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
            'name'=> 'required|min:3|max:255',
            'email'=> 'required|email|unique:suppliers|max:255',
            'phone'=> 'required|min:3|max:255|unique:suppliers',
            'address'=> 'nullable|min:3|max:255',
            'shopname'=>'nullable|min:3|max:255',
            'photo'=>'nullable',
        ]);
        $supplier = new Supplier;
        if($validated && $request->photo == null)
        {

            $supplier = Supplier::create($request->all());
        }else{
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $Image_url = $upload_path.$name;
            $img->save($Image_url);
            $supplier->photo = $Image_url;

            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->phone = $request->phone;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->save();
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
            'name'=> 'required|min:3|max:255',
            'email'=> 'required|max:255|email|unique:suppliers,email,'.$request->get('id'),
            'phone'=> 'required|min:3|max:255|unique:suppliers,phone,'.$request->get('id'),
            'address'=> 'nullable|min:3|max:255',
            'shopname'=>'nullable|min:3|max:255',
            'photo'=>'nullable',
        ]);
        $supplier = Supplier::find($id);
        if($request->photo != $supplier->photo)
        {
            if($supplier->photo != NULL)
            {
                unlink($supplier->photo);
            }
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/supplier/';
            $Image_url = $upload_path.$name;
            $img->save($Image_url);
            $supplier->photo = $Image_url;
            $supplier->name = $request->name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->shopname = $request->shopname;
            $supplier->phone = $request->phone;
            $supplier->save();
        }
        else{
            $supplier->update($request->all());
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
        $supplier = Supplier::find($id);
        if($supplier && $supplier->photo)
        {
            unlink($supplier->photo);
        }
        $supplier->delete();
    }
}
