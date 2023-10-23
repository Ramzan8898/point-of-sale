@extends('index')
@section('content')
<style type="text/css">
	
	@media print {
		#logo {
			display: block;
		}
	}
	@media screen {
		#logo{
			display: none;
		}
	}
</style>
<div class=" p-5 row">
	<div class="col-5">
	<h3 class="text-center">Create Invoice</h3>
	<form method="POST" action="">
		@csrf
		<div class="form-group">
			<label>Customer Name</label>
			<select class="form-control" name="account_name" id="customer_name" onchange="selectCustomer(event)">
				<option selected >Cash Sale</option>
				@foreach($accounts as $account)
				<option value="{{$account->id}}">{{$account->name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Bill Type</label>
			<select class="form-control" name="bill_type" id="bill_type" onchange="selectType(event)">
				<option value="Cash" selected>Cash</option>
				<option value="Credit">Credit</option>
			</select>
		</div>
		<div class="form-group">
			<label>Product</label>
			<select class="form-control" name="product_name" id="product_select" onchange="displayPrice(event)" required>
				<option value="" selected disabled>Choose a product</option>
				@foreach($products as $product)
				<option value="{{$product->product_price}}">{{$product->product_name}}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Price</label>
			<input type="text" id="product_price" class="form-control" name="product_price" required>
		</div>
		<div class="form-group">
			<label>Quantity</label>
			<input type="number" id="product_quantity" name="quantity" class="form-control" required>	
		</div>
		<input type="button" onclick="saleBtn()" name="sale_btn" value="Add" class="btn btn-success sale_btn">
	</form>

	</div>

<div class="col-6 offset-1">

	<div id="printable_data">
		<div id="logo">
			<div style="display: flex;">
				<div>
					<img src="{{url('/public/geo-news-logo.png')}}" style="height: 70px; width: 60px;">
				</div>			
				<div style="display: flex;flex-direction: column; margin-left: 10px;">
					<span class="shop-name " style="font-family: fantasy ; letter-spacing: 1.8px">Geo Bartan Store</span>
					<span>Noori Gate Sargodha</span>
				</div>

			</div>			
		</div>
		<div class="text-end">invoice#:<span id="invoice"></span></div>

		<div id="customer_name_in_print" class="text-end"></div>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Product Total</th>
				</tr>
			</thead>
			<tbody id="products_table">
			</tbody>
		</table>
		<div  class="text-end">SubTotal:<span class="text-end" id="sub_total"></span></div>
		
	</div>

		<button onclick="printContent('printable_data')">Print</button>	
</div>

</div>

<script>

	function selectCustomer(e){

		// Customer Select 
		var customer = document.getElementById('customer_name').value = e.target.value;
		// console.log(customer);
	}

	function selectType(e) {
		var type = document.getElementById("bill_type").value = e.target.value;
		// console.log(type);
	}
	function displayPrice(e){
		var pricePlace = document.getElementById("product_price").value = e.target.value;
		// console.log(pricePlace);

		const selectElement = document.getElementById('product_select');
		const selectedOption = selectElement.options[selectElement.selectedIndex];
		selectedProductHTML = selectedOption.innerHTML;
    	// console.log(selectedProductHTML);
    }

    let totalProductTotal = 0;
    function saleBtn(){

    	let rowIndex = 0;

		// Customer Selection 
		var customer = document.getElementById('customer_name').value;

		// product Selection
		const selectElement = document.getElementById('product_select');
		const selectedOption = selectElement.options[selectElement.selectedIndex];
		selectedProduct = selectedOption.innerHTML;

    	// Product Price
    	var productPrice = document.getElementById("product_price").value;

    	var productQuantity =document.getElementById("product_quantity").value;

    	var productTotal = productPrice * productQuantity;
    	totalProductTotal += productTotal;
    	document.getElementById('sub_total').innerHTML = totalProductTotal;

    	const newRow = $("<tr>");
    	$("#products_table").append(newRow);

    	const product_name = $("<td>").html(selectedProduct);
    	newRow.append(product_name);

    	const product_price = $("<td>").html(productPrice);
    	newRow.append(product_price);

    	const product_quantity = $("<td>").html(productQuantity);
    	newRow.append(product_quantity);

    	const product_total = $("<td>").html(productTotal);
    	const productTotalValue = productTotal.innerText;
    	newRow.append(product_total);
    	rowIndex++;
    }

</script>

<script>
		var uniqueIdentifier = 0001;

	function printContent(el){
        
        // Get the current timestamp
        var today = new Date();
		var year = today.getFullYear();
    	var month = today.getMonth() + 1; // Months are zero-based, so add 1
    	var day = today.getDate();

        
        // Create a prefix for your invoice number (e.g., 'INV-')
        var prefix = "INV-";
        
        // Combine the prefix, timestamp, and unique identifier to create the invoice number
        var invoiceNumber = prefix + day + month + year + "-" + uniqueIdentifier;
        
        // Set the generated invoice number in the input field
        // $("#invoice").val(invoiceNumber);

		var selectedCustomer = $('#customer_name option:selected').text();
		var selectedType = $('#bill_type option:selected').text();
		var restorepage = $('body').html();
		var printcontent = $('#' + el).clone();
		printcontent.find('#invoice').text(invoiceNumber);

		printcontent.find('#customer_name_in_print').text('Customer Name: ' + selectedCustomer);
		$('body').empty().html(printcontent);
		window.print();
		$('body').html(restorepage);
}
uniqueIdentifier++;

</script>
@endsection