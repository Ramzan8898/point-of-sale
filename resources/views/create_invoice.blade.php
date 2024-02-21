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

<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
<!------ Include the above in your HEAD tag ---------->

<div class="container">
	<form action="{{url('/create' , $new_invoice_no)}}" method="POST">
		@csrf
		<div class="row clearfix">
			<div class="col-md-3">
				<div class="form-group">
					<label>{{__('messages.bill_type')}}</label>
					<input name="billType" type="text" list="bill_type_list" class="form-control billType" required>
					<datalist id="bill_type_list">
						<option value="Cash">{{__('messages.cash')}}</option>
						<option value="Credit">{{__('messages.credit')}}</option>
					</datalist>
				</div>
			</div>

			<div class="col-md-3">
				<div class="form-group">
					<label>{{__('messages.previous_balance')}}</label>
					<input name="account_balance" id="customer_balance" type="number" class="form-control" required readonly>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>{{__('messages.customer_number')}}</label>
					<input type="number" name="customerNumber" class="form-control customerNumber" readonly>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label>{{__('messages.customer_name')}}</label>
					<input name="customerName" type="text" list="customer_list" class="form-control customerName" required>
					<datalist id="customer_list">
						@foreach($accounts as $account)
						<option value="{{$account->name}}" data-number="{{$account->number}}" data-balance="{{$account->balance}}">{{$account->name}}</option>
						@endforeach
					</datalist>
				</div>
			</div>


			<div class="col-md-12 mt-5">
				
				<table class="table table-bordered table-hover" id="tab_logic">
					<thead>
						<tr>
							<th class="text-center h4 fw-bold"> {{__('messages.total')}} </th>
							<th class="text-center h4 fw-bold"> {{__('messages.quantity')}} </th>
							<th class="text-center h4 fw-bold"> {{__('messages.price')}} </th>
							<th class="text-center h4 fw-bold"> {{__('messages.product')}} </th>
							<th class="text-center h4 fw-bold"> # </th>
						</tr>
					</thead>
					<tbody id="productTable">
						<tr id='addr0'>
							<td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly/></td>
							<td><input type="number" name='qty[]' placeholder="{{__('messages.quantity')}}" class="form-control qty" step="0.00" min="0" required/></td>
							<td><input type="number" name='price[]' placeholder="{{__('messages.price')}}" class="form-control price productPrice" step="0" min="0"/></td>
							<td>
								<input name="product[]" type="text" list="products_list" class="form-control productSelect" placeholder="{{__('messages.select_product')}}" required>
								<datalist id="products_list">
									@foreach($products as $product)
									<option value="{{$product->product_name}}" data-price={{$product->product_price}} >{{$product->product_name}}</option>
									@endforeach
								</datalist>
							</td>
							<td>1</td>


						</tr>
						<tr id='addr1'></tr>
					</tbody>
				</table>
			</div>
		</div>

		<div class="row clearfix">
			<div class="col-md-12">
				<div id="add_row" class="btn btn-yellow pull-left">{{__('messages.add_row')}}</div>
				<div id='delete_row' class="pull-right btn btn-orange text-white">{{__('messages.delete_row')}}</div>
			</div>
		</div>

		<div class="row clearfix" style="margin-top:20px">
			<div class="pull-right col-md-4">
				<table class="table table-bordered table-hover" id="tab_logic_total">
					<tbody>
						<tr>
							<th class="text-center">{{__('messages.sub_total')}}</th>
							<td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly/></td>
						</tr>
						<tr>
							<th class="text-center">{{__('messages.tax')}}</th>
							<td class="text-center"><div class="input-group mb-2 mb-sm-0">
								<input type="number" class="form-control" id="tax" placeholder="0">
								<div class="input-group-addon">%</div>
							</div></td>
						</tr>
						<tr>
							<th class="text-center">{{__('messages.tax_amount')}}</th>
							<td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly/></td>
						</tr>
						<tr>
							<th class="text-center">{{__('messages.total')}}</th>
							<td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly/></td>
						</tr>
					</tbody>
				</table>
				<input type="submit" class="btn btn-danger" value="save">
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

		$("#add_row").click(function(){
        // Get a reference to the first row of the table
			var referenceRow = $("#tab_logic tbody tr:first");

        // Clone the reference row
			var newRow = referenceRow.clone();

        // Clear input values in the new row
			newRow.find('input, select').val('');

        // Set a new ID for the new row
			var newIndex = $("#tab_logic tbody tr").length;
			newRow.attr("id", 'addr' + newIndex);

        // Update the row number in the first cell
			newRow.find('td:first-child').html(newIndex);

        // Append the new row to the table
			$("#tab_logic tbody").append(newRow);
		});

    // Delete a row
		$("#delete_row").click(function(){
			if($("#tab_logic tbody tr").length > 1){
				$("#tab_logic tbody tr:last").remove();
				calc();
			}
		});

		$('#tab_logic tbody').on('keyup change',function(){
			calc();
		});
		$('#tax').on('keyup change',function(){
			calc_total();
		});


	});

	function calc()
	{
		$('#tab_logic tbody tr').each(function(i, element) {
			var html = $(this).html();
			if(html!='')
			{
				var qty = $(this).find('.qty').val();
				var price = $(this).find('.price').val();
				$(this).find('.total').val(qty*price);

				calc_total();
			}
		});
	}

	function calc_total()
	{
		total=0;
		$('.total').each(function() {
			total += parseInt($(this).val());
		});
		$('#sub_total').val(total.toFixed(2));
		tax_sum=total/100*$('#tax').val();
		$('#tax_amount').val(tax_sum.toFixed(2));
		$('#total_amount').val((tax_sum+total).toFixed(2));
	}

	// $(document).on('change', '.productSelect', function () {
	// 	var selectedOption = $(this).find(':selected');
	// 	var selectedPrice = selectedOption.data('price');
	// 	var row = $(this).closest('tr');
	// 	row.find('.productPrice').val(selectedPrice)
	// 	calc();
	// });

	$(document).ready(function() {
    // When the product input changes within the productTable
		$('#productTable').on('input', '.productSelect', function() {
      // Get the selected option
			var selectedOption = $('#products_list option[value="' + $(this).val() + '"]');

      // If an option is selected, update the price field
			if (selectedOption.length > 0) {
				var productPrice = selectedOption.data('price');
				$(this).closest('tr').find('.productPrice').val(productPrice);
			} else {
        // If no option is selected, clear the price field
				$(this).closest('tr').find('.productPrice').val('');
			}
		});
	});

	$(document).ready(function() {
    // When the customer name input changes
		$('.customerName').on('input', function() {
      // Get the selected option
			var selectedOption = $('#customer_list option[value="' + $(this).val() + '"]');

      // If an option is selected, update the customer number field
			if (selectedOption.length > 0) {
				var customerNumber = selectedOption.data('number');
				$('.customerNumber').val(customerNumber);
				var customerBalance = selectedOption.data('balance');
				$('#customer_balance').val(customerBalance);
			} else {
        // If no option is selected, clear the customer number field
				$('.customerNumber').val('');
				$('.customer_balance').val('');
			}
		});
	});
</script>

<!-- <script>

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

</script> -->

@endsection