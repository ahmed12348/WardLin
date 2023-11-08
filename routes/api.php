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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::post('login', 'AuthController@login')->name('login')->middleware('throttle:5,1');

// Companies
Route::apiResource('companies', 'CompanyController')->middleware('auth:api');

// Employees
Route::apiResource('employees', 'EmployeeController')->middleware('auth:api');

// Users
Route::apiResource('users', 'UserController')->middleware('auth:api');
