<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('home');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard','HomeController@index')->name('home');
    Route::get('/managers','ManagerController@index')->name('managers');
    Route::get('/customers','CustomerController@index')->name('customers');
    Route::get('/complaints','ComplainController@index')->name('complaints');
    Route::get('/Branches','BranchController@index')->name('branches');

});


Auth::routes();
