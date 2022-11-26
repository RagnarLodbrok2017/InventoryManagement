<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Customer;
use Image;

class CustomerController extends Controller
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
        $customers = Customer::all();

        return response()->json($customers);
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
            'name' =>'required|max:255|min:3|unique:customers',
            'email' => 'required|unique:customers|max:255|min:3|email',
            'address'=> 'nullable|string|max:255',
            'phone'=> 'required|unique:customers|min:5|max:13',
            'photo'=>'nullable',
        ]);
        $customer = new Customer;
        if($validated && $request->photo == null)
        {
           $customer = Customer::create($request->all());
        }
        elseif($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/customer/';
            $Image_url = $upload_path.$name;
            $img->save($Image_url);
            $customer->photo = $Image_url;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->address = $request->address;
            $customer->phone = $request->phone;
            $customer->save();
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
        $this->validate($request ,[
            'name' =>'required|max:255|min:3',
            'email' => 'required | max:255| min:3 | email |  unique:customers,email,'. $request->get('id'),
            'address'=> 'nullable|string|max:255',
            'phone'=> 'required|min:5|max:13| unique:customers,phone,'.$request->get('id'),
            'photo'=>'nullable',
        ]);
        $customer = Customer::find($id);
        if($request->photo != $customer->photo)
        {
            if($customer->photo != NULL)
            {
                unlink($customer->photo);
            }
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/customer/';
            $Image_url = $upload_path.$name;
            $img->save($Image_url);
            $customer->photo = $Image_url;
            $customer->name = $request->name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->save();
        }
        else{
            $customer->update($request->all());
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
        $customer =Customer::find($id);
        // var_dump($customer);
        // $customer = DB::table('customers')->where('id', $id)->first();
        $photo = $customer->photo;
        $customer->delete();
        if($photo)
        {
            unlink($photo);
        }
    }
}
