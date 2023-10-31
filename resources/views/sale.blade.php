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
<div class=" p-5 row " style="margin-right: 0px;">
	<div class="col-5">
		<h3 class="text-center">Create Invoice</h3>
		<form method="POST" action="">
			@csrf
			<div class="form-group">
				<label>account Name</label>
				<select class="form-control" name="account_name" id="account_name" onchange="selectaccount(event)">
					<option selected >Cash Sale</option>
					@foreach($accounts as $account)
					<option value="{{$account->number}}" data-balance="{{$account->balance}}">{{$account->name}}</option>
					@endforeach
				</select>
				<input type="number" name="account_number" id="account_number" style="display:none;">
				{{-- 					<input type="number" name="account_balance" id="account_balance" > --}}
			</div>
{{-- 				<div class="form-group">
					<label>Bill Type</label>
					<select class="form-control" name="bill_type" id="bill_type" onchange="selectType(event)">
						<option value="Cash" selected>Cash</option>
						<option value="Credit">Credit</option>
					</select>
				</div> --}}
				<div class="form-group">
					<label>Product</label>
					<select class="form-control" name="product_name" id="product_select" onchange="displayPrice(event)" required>
						<option value="" selected disabled>Choose a product</option>
						@foreach($products as $product)
						<option value="{{$product->product_price}}">{{$product->product_name}}</option>
						@endforeach
					</select>
				</div>
				<span id="product_message" style="color: red;"></span>

				<div class="form-group">
					<label>Price</label>
					<input type="text" id="product_price" class="form-control" name="product_price" required>
				</div>
				<div class="form-group">
					<label>Quantity</label>
					<input type="number" id="product_quantity" name="quantity" class="form-control" required>	
				</div>
				<p><span id="product_qty" style="color: red;"></span></p>

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
					</tbody>
				</table>
				<div  class="text-end">SubTotal: <span class="text-end" id="sub_total"></span></div>
				<div class="text-end">GST: <span class="text-end" id="gst"></span></div>
				<div class="text-end">Total: <span class="text-end" id="total"></span></div>
				<div >Balance: <span id="data_balance"></span></div>		

			</div>

			<button onclick="printContent('printable_data')">Print</button>

		</div>

	</div>

	<script src="public/js/jquery.js"></script>

	<script>

		function selectaccount(e){

		// account Select 
		var account_number = document.getElementById('account_number');	
		    // Get the selected option element
  // Get the selected option element
  var selectedOption = event.target.options[event.target.selectedIndex];

    // Get the data-balance attribute value
    var dataBalance = selectedOption.getAttribute('data-balance');
    console.log(dataBalance);
    document.getElementById('data_balance').innerHTML = dataBalance;

}

function selectType(e) {
	var type = document.getElementById("bill_type").value = e.target.value;

}

function displayPrice(e){
	var pricePlace = document.getElementById("product_price").value = e.target.value;	
	const selectElement = document.getElementById('product_select');
	const selectedOption = selectElement.options[selectElement.selectedIndex];
	selectedProductHTML = selectedOption.innerHTML;

}

let totalProductTotal = 0;
var billTotal = 0;

function saleBtn(){

		//Validation

		let message; 

		var product = document.getElementById("product_select").value;
		var productPrice = document.getElementById("product_price").value;
		var productQuantity = document.getElementById("product_quantity").value;

		if (product == "") {
			document.getElementById("product_message").innerHTML = "Select Product!";

		} 
		if (product != "") {
			document.getElementById("product_message").innerHTML = "";
		}

		if(productQuantity == "" || productQuantity < 1 ){
			// console.log("check Product Quantity");
			document.getElementById("product_qty").innerHTML = "check Product Quantity";
			return false;
		} else {
			document.getElementById("product_qty").style.display = "none";
		}

		
		let rowIndex = 0;
		
		// account Selection 
		var account = document.getElementById('account_name').value;
		
		// product Selection
		const selectElement = document.getElementById('product_select');
		const selectedOption = selectElement.options[selectElement.selectedIndex];
		selectedProduct = selectedOption.innerHTML;
		
		// Product Price
		var productPrice = document.getElementById("product_price").value;
		
		var productQuantity =document.getElementById("product_quantity").value;
		
		var productTotal = productPrice * productQuantity;
		totalProductTotal += productTotal;
		
		// Bill Total
		billTotal = totalProductTotal + 1;
		document.getElementById('sub_total').innerHTML = totalProductTotal;
		document.getElementById('gst').innerHTML = 1 ;
		document.getElementById('total').innerHTML = billTotal;
		
		const newRow = $("<tr class='remove'>");
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

		const removeBtn = $("<td id='icon-cell'>").html("<i id='remove_row' class='fas fa-trash-alt fa-lg' style='color:#d11f1f;cursor:pointer;'></i>");
		newRow.append(removeBtn);
		rowIndex++;
	}

	$(document).ready(function() {
		$(document).on('click', '#remove_row', function() {
			$(this).closest('.remove').remove();
		});
	});

</script>


<script>
	var uniqueIdentifier = parseInt(localStorage.getItem('uniqueIdentifier')) || 1;

	function printContent(el){
		
		// Get the current timestamp
		var today = new Date();
		var year = today.getFullYear();
		var month = today.getMonth() + 1; // Months are zero-based, so add 1
		var day = today.getDate();
		
		var issue_date = day + "-" + month + "-" + year;
		
		// console.log(issue_date);
		var prefix = "INV-";
		
		var invoiceNumber = prefix + day + month + year + "-" + uniqueIdentifier;
		var selectedaccount = $('#account_name option:selected').text();
		var account_number = $('#account_name option:selected').val();
		
		var selectedType = $('#bill_type option:selected').text();
		var restorepage = $('body').html();
		var printcontent = $('#' + el).clone();

		//bill printing date
		printcontent.find('#issue_date').text("Issue Date: " + issue_date);
		printcontent.find('#invoice').text("invoice#: " + invoiceNumber);

		// hiding icon on print view 
		printcontent.find('#icon-cell').css("display" , "none");
		
		printcontent.find('#account_name_in_print').text('Customer Name: ' + selectedaccount);
		
		printcontent.find('#account_phone_in_print').text('Customer Number: ' + account_number);
		$('body').empty().html(printcontent);
		
		window.print();
		$('body').html(restorepage);
		uniqueIdentifier++;
		localStorage.setItem('uniqueIdentifier', uniqueIdentifier.toString());
	}

</script>
@endsection