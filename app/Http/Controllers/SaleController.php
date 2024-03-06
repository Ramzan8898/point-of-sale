<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\InvoiceProducts;

class SaleController extends Controller{
	public function index(){
		$var = Invoice::count();
		if ($var === 0) {
			$new_invoice_no = 1;
		}else{
			$previous_invoice = Invoice::latest('invoice_number')->first();
			$previous_invoice_no = $previous_invoice->invoice_number;
			$new_invoice_no = $previous_invoice_no + 1;
		}
		$accounts = Account::all();
		$products = Product::all();
		$invoices = Invoice::orderBy('created_at' , 'DESC')->get();
		
		return view('invoices' , compact('products' , 'accounts' , 'new_invoice_no' , 'invoices'));
	}

	public function create_invoice($id , Request $request){
		if ($request->isMethod("POST")) {
			$var = Invoice::count();
			if ($var === 0) {
				$new_invoice_no = 1;
			}else{
				$previous_invoice = Invoice::latest('invoice_number')->first();
				$previous_invoice_no = $previous_invoice->invoice_number;
				$new_invoice_no = $previous_invoice_no + 1;
			}
			if ($request->billType === "Credit") {
				$prev_amount =$request->account_balance;
				$new_amount = $request->total_amount;
				$prev_amount += $new_amount;
				$account = Account::where("name" , $request->customerName)->first();
				$account->update([
					"balance" => $prev_amount
				]);
			}
			$invoice = Invoice::create([
				"invoice_number" => $new_invoice_no,
				"customer_name" => $request->customerName,
				"customer_number" => $request->customerNumber,
				"bill_type" => $request->billType,
				"sub_total" => $request->sub_total,
				"total" => $request->total_amount
			]);
			$products = $request->input('product', []);
			$prices = $request->input('price' , []);
			$quantities = $request->input('qty', []);

			for ($i = 0; $i < count($products); $i++) {
				InvoiceProducts::create([
					"invoice_id" => $new_invoice_no,
					"product_name" => $products[$i],
					"product_price" => $prices[$i],
					"product_qty" => $quantities[$i],
					"product_total" => $prices[$i] * $quantities[$i]
				]);
			}

			return redirect()->route('view-inv' , $id);
		}

		$var = Invoice::count();
		if ($var === 0) {
			$new_invoice_no = 1;
		}else{
			$previous_invoice = Invoice::latest('invoice_number')->first();
			$previous_invoice_no = $previous_invoice->invoice_number;
			$new_invoice_no = $previous_invoice_no + 1;
		}
		$accounts = Account::all();
		$products = Product::all();
		return view('create_invoice' , compact('accounts' , 'products' , 'new_invoice_no'));

	}

	public function view_invoice($id){
		$invoice = Invoice::where("invoice_number" , $id)->first();
		$inv_prod = InvoiceProducts::where("invoice_id" , $id)->get();
		return view('view_invoice' , compact('inv_prod' , 'invoice'));
	}
	public function delete_invoice($id) {
		$invoice = Invoice::where('invoice_number' , $id)->first();
		$invoice->delete();
		return redirect(url('/invoices'));
	}

}
