<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use App\Model\Salary;
use DB;

class SalaryController extends Controller
{
    public function Paid(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' =>'required|numeric',
            'type'=>'nullable|string|max:255',
            'month'=>'required|string|max:255',
        ]);
        $checkMonthExist = DB::table('salaries')->where('employee_id',$id)->where('month', $request->month)->first();
        $employee = Employee::find($id);
        if ($checkMonthExist)
        {
            return response()->json("Salary Already Paid");
        }
        else{
            $employee = Employee::find($id);
            if($employee)
            {
                $salary = new Salary();
                $salary->amount = $request->amount;
                $salary->date = date('Y/m/d');
                $salary->type = $request->type;
                $salary->month = $request->month;
                $salary->year = date('Y');
                $salary->employee_id = $request->id;
                $salary->save();
            }
            else{
                return response()->json("Employee doesn't exist");
            }
            
        }
    }
}
