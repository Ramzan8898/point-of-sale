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
		$accounts = Account::all();
		$products = Product::all();
		$invoices = Invoice::all();

		$var = Invoice::count();
		if ($var === 0) {
			$new_invoice_no = 1;
		}else{
			$previous_invoice = Invoice::latest('invoice_number')->first();
			$previous_invoice_no = $previous_invoice->invoice_number;
			$new_invoice_no = $previous_invoice_no + 1;
		}

		$invoice = new Invoice;
		$data = [
			'invoice_number' => $new_invoice_no,
			'customer_name' => $request->account_name,
			'customer_number' => $request->account_number,
			'bill_type' => $request->bill_type,
			'issued_date' => "",
			'sub_total' => "",
			'total' => "", 
		];
		$invoice->create($data);
		$inv_prd = InvoiceProducts::where('invoice_id' , $new_invoice_no)->get();

		return view('create_invoice' , compact('new_invoice_no' , 'accounts' , 'products' , 'inv_prd' ));

	}
	
	public function save_invoice(Request $request){

		try {
			$invoice = $request->input('invoice');
			$customerName = $request->input('customer_name');
			$customerNumber = $request->input('customer_number');
			$billType = $request->input('bill_type');
			$issuedDate = $request->input('issued_date');
			$subTotal = $request->input('sub_total');
			$total = $request->input('total');

			Invoice::create([
				'invoice_number' => $invoice,
				'customer_name' => $customerName,
				'customer_number' => $customerNumber,
				'bill_type' => $billType,
				'issued_date' => $issuedDate,
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

	public function save_invoice_products($id , Request $request){
		$accounts = Account::all();
		$products = Product::all();
		$invoices = Invoice::all();

		$new_invoice_no = $request->id;

		$invoice_product = new InvoiceProducts;
		$data = [
			'invoice_id' => $new_invoice_no,
			'product_name' => $request->product_name,
			'product_price' => $request->product_price,
			'product_qty' => $request->quantity,
			'product_total' => $request->product_price * $request->quantity
		];			
		$invoice_product->create($data);
		$inv_prd = InvoiceProducts::where('invoice_id' , $new_invoice_no)->get();
		return view('create_invoice' , compact('products' , 'accounts' , 'new_invoice_no' ,'inv_prd'));
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
