<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Account;
use App\Models\Invoice;
use App\Models\InvoiceProducts;

class SaleController extends Controller
{
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
		$invoices = Invoice::all();
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
			$invoice = Invoice::create([
				"invoice_number" => $new_invoice_no,
				"customer_name" => $request->customerName,
				"customer_number" => $request->customerNumber,
				"bill_type" => $request->billType,
				"sub_total" => $request->sub_total,
				"total" => $request->total_amount
			]);
			$products = $request->input('products', []);
			$quantities = $request->input('quantities', []);
			for ($product=0; $product < count($products); $product++) {
				if ($products[$product] != '') {
					$invoice->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
				}
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
// 		$accounts = Account::all();
// 		$products = Product::all();
// 		$invoices = Invoice::all();

// 		$var = Invoice::count();
// 		if ($var === 0) {
// 			$new_invoice_no = 1;
// 		}else{
// 			$previous_invoice = Invoice::latest('invoice_number')->first();
// 			$previous_invoice_no = $previous_invoice->invoice_number;
// 			$new_invoice_no = $previous_invoice_no + 1;
// 		}

// 		$invoice = new Invoice;
// 		$invoice_product = new InvoiceProducts;

// 		$data = [
// 			'invoice_number' => $new_invoice_no,
// 			'customer_name' => $request->account_name,
// 			'customer_number' => $request->account_name,
// 			'bill_type' => $request->bill_type,
// 			'sub_total' => "",
// 			'total' => "", 
// 		];

// 		$p_data = [
// 			'invoice_id' => $new_invoice_no,
// 			'product_name' => $request->product_name,
// 			'product_price' => $request->product_price,
// 			'product_qty' => $request->quantity,
// 			'product_total' => $request->product_price * $request->quantity
// 		];	
// 		$invoice->create($data);		
// 		$invoice_product->create($p_data);
// 		$inv_prd = InvoiceProducts::where('invoice_id' , $new_invoice_no)->get();

// 		return view('create_invoice' , compact('new_invoice_no' , 'accounts' , 'products' , 'inv_prd' ));

	// }
	
	public function save_invoice(Request $request){

		try {
			$invoice = $request->input('invoice');
			$customerName = $request->input('customer_name');
			$customerNumber = $request->input('customer_number');
			$billType = $request->input('bill_type');
			$subTotal = $request->input('sub_total');
			$total = $request->input('total');

			Invoice::create([
				'invoice_number' => $invoice,
				'customer_name' => $customerName,
				'customer_number' => $customerNumber,
				'bill_type' => $billType,
				'sub_total'=> $subTotal,
				'total'=> $total,
			]);

			return response()->json(['message' => 'Invoice saved successfully']);
		} catch (\Exception $e) {
			\Log::error($e);
			return response()->json(['message' => 'An error occurred while saving the invoice'], 500);
		}
    // return response()->json(['message' => 'Products saved successfully']);
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
