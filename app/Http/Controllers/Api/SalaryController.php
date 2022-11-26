<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use App\Model\Salary;
use DB;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }
    public function index()
    {
        $salaries = Salary::groupBy('month')
        ->selectRaw('sum(amount) as total_salary')
        ->selectRaw('month')
        ->get();
        return response()->json($salaries);
    }
    public function Paid(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' =>'required|numeric',
            'type'=>'nullable|string|max:255',
            'month'=>'required|string|max:255',
        ]);
        $checkMonthExist = DB::table('salaries')
        ->where('employee_id',$id)
        ->where('month', $request->month)->first();
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
    public function viewSalary($month)
    {
        $salaries = DB::table('salaries')
        ->join('employees', 'salaries.employee_id','employees.id')
        ->select('employees.name', 'salaries.*')
        ->where('salaries.month',$month)
        ->get();
        return response()->json($salaries);

    }
    public function updateSalary(Request $request, $id)
    {
        $validated = $request->validate([
            'amount' =>'required|numeric',
            'type'=>'nullable|string|max:255',
            'month'=>'required|string|max:255',
        ]);
        $salary = Salary::find($id);
            if($salary)
            {
                $salary->amount = $request->amount;
                $salary->type = $request->type;
                $salary->save();
            }
            else{
                return response()->json("Salary doesn't exist");
            }
        }

        public function deleteSalary($id)
        {
            $salary = Salary::find($id);
            if($salary)
            {
                $salary->delete();
                return response()->json("Salary deleted successfully");
            }

        }
}
