<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\Invoice;

class SaleController extends Controller
{
	public function index(){
		$accounts = Account::all();
		$products = Product::all();
		return view('sale' , compact('products' , 'accounts'));
	}
	
	
}
