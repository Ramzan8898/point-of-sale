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

// Transaction
Route::get('/transactions' , [App\Http\Controllers\TransactionController::class , 'transactions']);
Route::get('/transactions/{id}' , [App\Http\Controllers\TransactionController::class , 'index'])->name('user_transactions');
Route::post('/transaction/add_transaction/{id}' , [App\Http\Controllers\TransactionController::class , 'add_transaction']);
Route::post('/transaction/update/{id}' , [App\Http\Controllers\TransactionController::class , 'update_transaction']);
Route::get('/transaction/delete/{id}' , [App\Http\Controllers\TransactionController::class , 'delete']);

// Sale
Route::get('/invoices' , [App\Http\Controllers\SaleController::class , 'index'])->name('invoices');
Route::post('/save-invoice/{id}' , [App\Http\Controllers\SaleController::class , 'save_invoice'])->middleware('web');

// Product
Route::get('/add_new_product' , [App\Http\Controllers\ProductController::class , 'index']);
Route::post('/add_new_product/create' , [App\Http\Controllers\ProductController::class , 'create']);
Route::post('/add_new_product/edit/{id}' , [App\Http\Controllers\ProductController::class , 'edit']);
Route::get('/add_new_product/{id}' , [App\Http\Controllers\ProductController::class , 'delete']);

// Invoices
Route::get('/create/{id}' , [App\Http\Controllers\SaleController::class , 'create_invoice']);
Route::post('/create/{id}' , [App\Http\Controllers\SaleController::class , 'create_invoice']);
Route::get('/edit_invoice/{id}' , [App\Http\Controllers\SaleController::class , 'edit_invoice'])->name("edit_invoice");

Route::post('/edit_invoice/{id}' , [App\Http\Controllers\SaleController::class , 'update_invoice'])->name("update_invoice");

Route::get('/view/{id}' , [App\Http\Controllers\SaleController::class , 'view_invoice'])->name("view-inv");

Route::get('/invoice/delete/{id}' , [App\Http\Controllers\SaleController::class , 'delete_invoice']);

//Log Out
Route::get('/delete_invoice_product/{id}' , [App\Http\Controllers\SaleController::class , 'delete_invoice_product']);

Route::group(['middleware' => ['auth']], function() {
   /**
   * Logout Route
   */
   Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout.perform');
});