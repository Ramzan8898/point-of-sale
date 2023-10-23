<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
class TransactionController extends Controller
{
    public function index($id) {
    	$transactions = Transaction::where('account_id' , $id)->get();
    	return view('transactions' , compact('transactions'));
    }
}
