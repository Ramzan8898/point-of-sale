<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SaleController;
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

Auth::routes();

Route::get('/get_records', [App\Http\Controllers\HomeController::class, 'getRecords'])->name('get_records');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

//Employee
Route::get('/employee' , [App\Http\Controllers\EmployeeController::class , 'index'])->name('employee');
Route::post('/employee/create' , [App\Http\Controllers\EmployeeController::class , 'create']);
Route::post('/employee/edit/{id}' , [App\Http\Controllers\EmployeeController::class , 'update']);
Route::get('/employee/delete/{id}' , [App\Http\Controllers\EmployeeController::class , 'delete']);

// Accounts
Route::get('/accounts' , [App\Http\Controllers\AccountsController::class , 'index'])->name('accounts');
Route::post('/accounts/create' , [App\Http\Controllers\AccountsController::class , 'create']);
Route::post('/accounts/edit/{id}' , [App\Http\Controllers\AccountsController::class , 'update']);
Route::get('/accounts/delete/{id}' , [App\Http\Controllers\AccountsController::class , 'delete']);
Route::post('/accounts/add_balance/{id}' , [App\Http\Controllers\AccountsController::class , 'add_balance']);

// Transaction
Route::get('/transactions/{id}' , [App\Http\Controllers\TransactionController::class , 'index']);
Route::post('/transactions/create/{id}' , [App\Http\Controllers\AccountsController::class , 'add_balance']);

// Sale
Route::get('/invoices' , [App\Http\Controllers\SaleController::class , 'index']);
Route::post('/save-invoice/{id}' , [App\Http\Controllers\SaleController::class , 'save_invoice'])->middleware('web');

// Product
Route::get('/add_new_product' , [App\Http\Controllers\ProductController::class , 'index']);
Route::post('/add_new_product/create' , [App\Http\Controllers\ProductController::class , 'create']);
Route::post('/add_new_product/edit/{id}' , [App\Http\Controllers\ProductController::class , 'edit']);
Route::get('/add_new_product/{id}' , [App\Http\Controllers\ProductController::class , 'delete']);


// Invoices
Route::get('/create/{id}' , [App\Http\Controllers\SaleController::class , 'create_invoice']);
Route::post('/create/{id}' , [App\Http\Controllers\SaleController::class , 'create_invoice']);
Route::get('/invoice/delete/{id}' , [App\Http\Controllers\HomeController::class , 'delete_invoice']);
//Log Out
Route::get('/delete_invoice_product/{id}' , [App\Http\Controllers\SaleController::class , 'delete_invoice_product']);

Route::group(['middleware' => ['auth']], function() {
   /**
   * Logout Route
   */
   Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout.perform');
});