<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    public function index(){
    	$products = Product::orderBy('created_at' , 'DESC')->get();
    	return view('product' , compact('products'));
    }

    public function create(Request $request) {
    	$product = new Product;
    	$data = [
    		'product_name' => $request->product_name,
    		'product_price' => $request->product_price
    	];

    	$product->create($data);
    	return redirect(url('/add_new_product'));
    }

    public function edit($id , Request $request){
    	$product = Product::find($id);
    	$data = [
    		'product_name' => $request->product_name,
    		'product_price' => $request->product_price
    	];

    	$product->update($data);
    	return redirect(url('/add_new_product'));
    }

    public function delete($id) {
    	Product::destroy($id);
    	
    	return redirect(url('/add_new_product'));
    }
}
