<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\InvoiceProducts;

class SaleController extends Controller{
	public function index($id){
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
		$invoice_view = Invoice::where("invoice_number" , $id)->get();
		
		return view('invoices' , compact('products' , 'accounts' , 'new_invoice_no' , 'invoices' , 'invoice_view'));
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

			return redirect()->route('invoices');
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

	public function view_invoice($id , Request $request){

	}

	public function delete_invoice_product($id){

		$accounts = Account::all();
		$products = Product::all();
		$new_invoice_no = $id;
		$inv_prd = InvoiceProducts::where('invoice_id' , $new_invoice_no)->get();

		InvoiceProducts::destroy($new_invoice_no);
		return view('create_invoice' , compact('products' , 'accounts' , 'new_invoice_no' , 'inv_prd'));
	}
}
