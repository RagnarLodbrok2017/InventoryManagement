<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Expense;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Expense::all();
        return response()->json($expenses);
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
            'details'=>'required|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'nullable|date'
        ]);
        // date_default_timezone_set("Africa/cairo");
        $expense = new Expense();
        $expense->details = $request->details;
        $expense->amount = $request->amount;
        $expense->expense_date = date('Y/m/d');
        $expense->save();
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
            'details'=>'required|max:255',
            'amount' => 'required|numeric',
            'expense_date' => 'nullable|date'
        ]);
        $expense = Expense::find($id);
        if($expense)
        {
            $expense->update($request->all());
        }
        else{

            return response()->json(['errors' => "Expense didn't exist!"], 422);
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
        $expense = Expense::where('id', $id)->first();
        if ($expense){
            $expense->delete();
        }
    }
}
