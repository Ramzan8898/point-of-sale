@extends('index')
@section('content')
<style type="text/css">

	@media print {
		#logo {
			display: block;
		}
		#remove_row{
			display: none;
		}
	}
	@media screen {
		#logo{
			display: none;
		}
		#remove_row{
			display: block;
		}
	}
</style>

<div class="container p-4 row " style="margin-right: 0px;">
	<div class="col-5">
		<h3 class="text-center">Create Invoice</h3>
		<form method="POST" action="{{url('/create' , $new_invoice_no)}}">
			@csrf
			<div class="form-group">
				<label>account Name</label>
				<select class="form-control" name="account_name" id="account_name" onchange="selectaccount(event)">
					<option selected >Cash Sale</option>
					@foreach($accounts as $account)
					<option value="{{$account->name}}" data-number="{{$account->number}}" data-balance="{{$account->balance}}">{{$account->name}}</option>
					@endforeach
				</select>
				<input type="number" name="account_number" id="data_number" style="display:none;">
				{{-- <input type="number" name="account_balance" id="account_balance" > --}}
			</div>
			<div class="form-group">
				<label>Bill Type</label>
				<select class="form-control" name="bill_type" id="bill_type" onchange="selectType(event)">
					<option value="Cash" selected>Cash</option>
					<option value="Credit">Credit</option>
				</select>
			</div>
			<input type="submit" name="" value="save">
		</form>

		<form method="POST" action="{{url('/save_invoice_products', $new_invoice_no)}}">
			@csrf
			<div class="form-group">
				<label>Product</label>
				<select class="form-control" name="product_name" id="product_select" onchange="displayPrice(event)" required>
					<option value="choose" selected disabled>Choose a product</option>
					@foreach($products as $product)
					<option value="{{$product->product_name}}" data-product_price="{{$product->product_price}}">{{$product->product_name}}</option>
					@endforeach
				</select>
			</div>
			<span id="product_message" style="color: red;"></span>

			<div class="form-group">
				<label>Price</label>
				<input type="number" id="product_price" class="form-control" name="product_price" required>
			</div>
			<div class="form-group">
				<label>Quantity</label>
				<input type="number" id="product_quantity" name="quantity" class="form-control" required>	
			</div>
			<p><span id="product_qty" style="color: red;"></span></p>
			<input type="submit" name="sale_btn" class="btn btn-success sale_btn" value="Add" >
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
						<span>+92 314 6051935</span>
					</div>

				</div>			
			</div>
			<div class="d-flex justify-content-between mt-4 mb-3">
				<div class="left">
					<div id="account_name_in_print"></div>
					<div id="account_phone_in_print"></div>
				</div>
				<div class="right">
					<div class="text-end"> <span id="invoice"></span></div>
					<div class="text-end" style="margin-right: 30px;"> <span id="issue_date"></span></div>
				</div>
			</div>

			{{-- Printable Data --}}
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
					@foreach($inv_prd as $prd)
					<tr class="remove">
						<td>{{$prd->product_name}}</td>
						<td>{{$prd->product_price}}</td>
						<td>{{$prd->product_qty}}</td>	
						<td>{{$prd->product_total}}</td>
						<td><a href="{{url('/delete_invoice_product' , $prd->invoice_id)}}"><i class='fas fa-trash-alt fa-lg' style='color:#d11f1f;cursor:pointer;'></i></a></td>
					</tr>
					@endforeach

				</tbody>
			</table>
			<div  class="text-end">SubTotal: <span class="text-end" id="sub_total">{{$inv_prd->sum('product_total')}}</span></div>
			<div class="text-end">GST: <span class="text-end" id="gst">5</span></div>
			<div class="text-end">Total: <span class="text-end" id="total"></span></div>
			<div >Balance: <span id="data_balance"></span></div>		

		</div>

		<button id="print_btn" onclick="printContent('printable_data')">Print</button>
		<a href="{{url('/create' , $new_invoice_no)}}" class="btn btn-success">Save</a>

	</div>

</div>

<script>
	var gst = $('#gst').html();
	var st = $('#sub_total').html();
	var total = parseInt(st) + parseInt(gst);
	var t = $('#total').html(total);
	function selectaccount(e){
		var account_number = document.getElementById('account_number');	
		var selectedOption = event.target.options[event.target.selectedIndex];
		var dataNumber = selectedOption.getAttribute('data-number');
		document.getElementById('data_number').innerHTML = dataNumber;
		
		var dataBalance = selectedOption.getAttribute('data-balance');
		document.getElementById('data_balance').innerHTML = dataBalance;
	}

	function selectType(e) {
		var type = document.getElementById("bill_type").value = e.target.value;
	}

	function displayPrice(e){
		const selectElement = document.getElementById('product_select');
		const selectedOption = selectElement.options[selectElement.selectedIndex];
		var pricePlace = document.getElementById("product_price").value = selectedOption.getAttribute('data-product_price');	
		selectedProductHTML = selectedOption.innerHTML;
	}

	let totalProductTotal = 0;
	var billTotal = 0;

	// removing row with delete icon from table
	$(document).ready(function() {
		$(document).on('click', '#remove_row', function() {
			$(this).closest('.remove').remove();
		});
	});

	//Printing content  
	var uniqueIdentifier = parseInt(localStorage.getItem('uniqueIdentifier')) || 1;

	function printContent(el){
		// Get the current timestamp
		var today = new Date();
		var year = today.getFullYear();
		var month = today.getMonth() + 1; // Months are zero-based, so add 1
		var day = today.getDate();
		
		// printing issue date
		var issue_date = day + "-" + month + "-" + year;
		
		// var prefix = "INV-";

		var invoiceNumber = uniqueIdentifier;
		var customer = $('#account_name option:selected').text();
		var customer_number = $('#account_name option:selected').val();
		var billType = $('#bill_type option:selected').text(); 
		var restorepage = $('body').html();
		var printcontent = $('#' + el).clone();

		var sub_total = $('#sub_total').html();
		var total = $('#total').html();

		//bill printing date
		printcontent.find('#issue_date').text("Issue Date: " + issue_date);
		printcontent.find('#invoice').text("invoice#: " + invoiceNumber);

		// hiding icon on print view 
		printcontent.find('#icon-cell').css("display" , "none");
		
		var divContent = $('#products_table').text();

		printcontent.find('#account_name_in_print').text('Customer Name: ' + customer);
		
		printcontent.find('#account_phone_in_print').text('Customer Number: ' + customer_number);
		$('body').empty().html(printcontent);
		window.print();
		$('body').html(restorepage);
		$.ajax({
			type: 'post',
			url: '{{url("/save-invoice")}}',
			data: { 
				"_token" : "{{ csrf_token()}}",
				invoice:invoiceNumber,
				customer_name:customer,
				customer_number:customer_number,
				bill_type:billType,
				issued_date:issue_date,
				sub_total:sub_total,
				total:total
			},
			success: function(response) {
				alert(response.message);
			},
			error: function(err) {
				console.error(err);
			}
		});
		uniqueIdentifier++;

		localStorage.setItem('uniqueIdentifier', uniqueIdentifier.toString());
	}
</script>
@endsection