<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup','AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::apiResource('/dashboard/employee', 'Api\EmployeeController');
Route::apiResource('/dashboard/supplier', 'Api\SupplierController');
Route::apiResource('/dashboard/category', 'Api\CategoryController');
Route::apiResource('/dashboard/product', 'Api\ProductController');
Route::apiResource('/dashboard/expense', 'Api\ExpenseController');
// Salary Routes
Route::Post('/dashboard/salary/paid/{id}', 'Api\salaryController@Paid');
Route::Get('/dashboard/salary', 'Api\salaryController@index');
Route::Get('/dashboard/salary/view/{month}', 'Api\salaryController@viewSalary');
Route::Put('/dashboard/salary/view/{id}', 'Api\SalaryController@updateSalary');
Route::Delete('/dashboard/salary/view/{id}', 'Api\salaryController@deleteSalary');
// Route::middleware(['auth'])->group(function () {
//     Route::get('home', 'AuthController@home');
//     });
