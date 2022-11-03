<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
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
            'name' =>'required|max:255|min:3',
            'email' => 'required|unique:employees|max:255|min:3|email',
            'address'=> 'nullable|string|max:255',
            'salary' => 'numeric|min:2',
            'joining_date'=> 'date_format:Y-m-d',
            'nid'=> 'nullable|sometimes',
            'phone'=> 'required|unique:employees|min:5|max:13',
            'photo'=>'nullable',
        ]);
        $employee = new Employee;
        if($validated && $request->photo == null)
        {
           $employee = Employee::create($request->all());
        }
        elseif($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];
            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $Image_url = $upload_path.$name;
            $img->save($Image_url);
            $employee->photo = $Image_url;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->address = $request->address;
            $employee->salary = $request->salary;
            $employee->joining_date = $request->joining_date;
            $employee->nid = $request->nid;
            $employee->phone = $request->phone;
            $employee->save();

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
        $employee =Employee::find($id);
        // var_dump($employee);
        // $employee = DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;
        $employee->delete();
        if($photo)
        {
            unlink($photo);
        }
    }
}
