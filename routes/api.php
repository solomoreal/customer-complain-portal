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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    Route::get('/managers','ManagerController@index')->name('managers');
    Route::get('/customers','CustomerController@index')->name('customers');
    Route::get('/complaints','ComplainController@index')->name('complaints');
    Route::get('/Branches','BranchController@index')->name('branches');
});


Route::resource('manager',ManagerController::class);
Route::resource('customer', CustomerController::class);
Route::resource('branch', BranchController::class);
Route::resource('complaint', ComplainController::class);
