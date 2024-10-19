@extends('index')
@section('content')

<style type="text/css">
	@media print {
		#logo {
			display: block;
		}

		#remove_row {
			display: none;
		}

		nav {
			display: none;
		}
	}

	@media screen {
		nav {
			display: none;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0px;
		}
	}

	@media screen {
		#logo {
			display: none;
		}

		#remove_row {
			display: block;
		}
	}
</style>

<div class="container-fluid main-bg" style="height: 100vh;">
	<div class="container">
		<a href="{{url('/invoices')}}" class="back" style="width:fit-content;margin-left: 20px;position: fixed;"><i class="fas fa-arrow-left"></i></a>
		<form action="{{url('/edit_invoice' , $invoice->invoice_number)}}" method="POST">
			@csrf
			<div class="row clearfix">
				<input type="hidden" name="customerId" class="form-control customerId" readonly>
				<div class="col-md-3">
					<div class="form-group">
						<label>{{__('messages.bill_type')}}</label>
						<select id="bill_type_list" name="billType" type="text" list="bill_type_list" class="form-control billType">
							<option value="Debit" {{ $invoice->bill_type == 'Debit' ? 'selected' : '' }}>{{__('messages.debit')}}</option>
							<option value="Credit" {{ $invoice->bill_type == 'Credit' ? 'selected' : '' }}>{{__('messages.credit')}}</option>
						</select>
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label>{{__('messages.previous_balance')}}</label>
						<input name="account_balance" id="customer_balance" type="number" class="form-control" required readonly value="{{$invoice->account->balance}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>{{__('messages.customer_number')}}</label>
						<input type="text" name="customerNumber" class="form-control customerNumber" readonly value="{{$invoice->customer_number}}">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>{{__('messages.customer_name')}}</label>
						<select id="customer_list" name="customerName" class="form-control customerName">
							@foreach($accounts as $account)
							<option
								value="{{$account->name}}"
								data-number="{{$account->number}}"
								data-id="{{$account->id}}"
								data-balance="{{$account->balance}}"
								{{ $account->name == $invoice->customer_name ? 'selected' : '' }}>
								{{$account->name}}
							</option>
							@endforeach
						</select>

					</div>
				</div>
				<div class="col-md-12 mt-5">
					<table class="table " id="tab_logic">
						<thead>
							<tr>
								<th></th>
								<th class="text-center h4 fw-bold"> {{__('messages.total')}} </th>
								<th class="text-center h4 fw-bold"> {{__('messages.quantity')}} </th>
								<th class="text-center h4 fw-bold"> {{__('messages.price')}} </th>
								<th class="text-center h4 fw-bold"> {{__('messages.product')}} </th>
								<th class="text-center h4 fw-bold"> # </th>
							</tr>
						</thead>
						<tbody id="productTable" class="table-group-divider">

							@foreach ($invoice_products as $index => $inv_prd)
							<tr id="addr{{$index}}">
								<td>
									<a href="{{url('/delete_invoice_product', ['invoiceId' => $invoice->invoice_number, 'productId' => $inv_prd->id])}}" class="delete-row"><i class="fas fa-trash-alt"></i></a>
								</td>
								<td>
									<input type="hidden" name="product_id[]" value="{{$inv_prd->id}}">
									<input type="number" name='total[]' class="form-control total" readonly value="{{$inv_prd->product_total}}" />
								</td>
								<td>
									<input type="number" name='qty[]' class="form-control qty" step="0.00" min="0" required value="{{$inv_prd->product_qty}}" />
								</td>
								<td>
									<input type="number" name='price[]' class="form-control price productPrice" step="0" min="0" value="{{$inv_prd->product_price}}" />
								</td>
								<td>

									<select id="products_list" name="product[]" class="form-control productSelect">
										@foreach($products as $product)
										<option value="{{ $product->product_name }}"
											{{ $product->product_name == $inv_prd->product_name ? 'selected' : '' }}
											data-price="{{ $product->product_price }}">
											{{ $product->product_name }}
										</option>
										@endforeach
									</select>
								</td>
								<td>{{$index + 1}}</td>
							</tr>
							@endforeach

						</tbody>
					</table>
				</div>
			</div>

			<div class="row clearfix">
				<div class="col-md-12">
					<div id="add_row" class="btn btn-yellow pull-left p-2 rounded fs-5">{{__('messages.add_row')}}</div>
				</div>
			</div>

			<div class="row clearfix" style="margin-top:20px">
				<div class="pull-right col-md-4">
					<table class="table table-bordered table-hover" id="tab_logic_total">
						<tbody>
							<tr>
								<th class="text-center">{{__('messages.sub_total')}}</th>
								<td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly value="{{$invoice->sub_total}}" /></td>
							</tr>
							<tr>
								<th class="text-center">{{__('messages.tax')}}</th>
								<td class="text-center">
									<div class="input-group mb-2 mb-sm-0">
										<input type="number" class="form-control" id="tax" placeholder="0">
									</div>
								</td>
							</tr>
							<tr>
								<th class="text-center">{{__('messages.tax_amount')}}</th>
								<td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly /></td>
							</tr>
							<tr>
								<th class="text-center">{{__('messages.total')}}</th>
								<td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly value="{{$invoice->total}}" /></td>
							</tr>
						</tbody>
					</table>
					<input type="submit" class="button-30" value="update">
		</form>
	</div>
</div>


<script>

	$(document).ready(function() {
		function calc() {
			var total = 0;
			// Loop through each row in the product table to calculate totals
			$('#productTable tr').each(function(i, element) {
				var qty = $(this).find('.qty').val();
				var price = $(this).find('.price').val();
				var rowTotal = qty * price;
				$(this).find('.total').val(rowTotal.toFixed(2)); // Update the row total
				total += parseFloat(rowTotal);
			});

			// Update the subtotal, tax, and overall total
			$('#sub_total').val(total.toFixed(2));
			var taxRate = $('#tax').val() || 0;
			var taxAmount = total / 100 * taxRate;
			$('#tax_amount').val(taxAmount.toFixed(2));
			$('#total_amount').val((total + taxAmount).toFixed(2));
		}

		// Function to update row ids after adding or removing rows
		function updateRowIds() {
			$('#productTable tr').each(function(index, element) {
				$(this).attr('id', 'addr' + index);
				$(this).find('td:last-child').html(index + 1);
			});
		}

		// Add a new row when clicking "Add Row" button
		$('#add_row').click(function() {
			var referenceRow = $("#productTable tr:first");
			var newRow = referenceRow.clone();

			newRow.find('input').val(''); // Clear input fields in the new row
			newRow.find('input[type=hidden]').remove(); // Remove hidden product_id input for new rows

			var newIndex = $("#productTable tr").length;
			newRow.attr("id", 'addr' + newIndex);
			newRow.find('td:last-child').html(newIndex + 1);

			$("#productTable").append(newRow);
			updateRowIds();
		});

		// Remove a row when clicking the delete button
		$('#productTable').on('click', '.delete-row', function(e) {
			e.preventDefault();
			$(this).closest('tr').remove();
			updateRowIds();
			calc(); // Recalculate totals after row removal
		});

		// Recalculate totals when quantity or price is changed
		$('#productTable').on('keyup change', '.qty, .price', function() {
			calc();
		});

		// Recalculate totals when tax is changed
		$('#tax').on('keyup change', function() {
			calc();
		});

		// Update price and total when a product is selected
		$('#productTable').on('input', '.productSelect', function() {
			var selectedOption = $(this).find('option:selected'); // Get the selected option
			if (selectedOption.length > 0) {
				var productPrice = selectedOption.data('price'); // Get the price from data-price attribute
				$(this).closest('tr').find('.productPrice').val(productPrice); // Update the price field

				// Update the total for the row after updating the price
				var qty = $(this).closest('tr').find('.qty').val();
				var rowTotal = qty * productPrice;
				$(this).closest('tr').find('.total').val(rowTotal.toFixed(2));

				calc(); // Recalculate the entire invoice totals
			} else {
				$(this).closest('tr').find('.productPrice').val('');
				$(this).closest('tr').find('.total').val('0.00');
				calc(); // Recalculate to reflect any changes
			}
		});

		// When the customer is selected, update customer-related fields
		$('.customerName').on('input', function() {
			var selectedOption = $('#customer_list option[value="' + $(this).val() + '"]');
			if (selectedOption.length > 0) {
				var customerId = selectedOption.data('id');
				$('.customerId').val(customerId);
				var customerNumber = selectedOption.data('number');
				$('.customerNumber').val(customerNumber);
				var customerBalance = selectedOption.data('balance');
				$('#customer_balance').val(customerBalance);
			} else {
				$('.customerNumber').val('');
				$('#customer_balance').val('');
			}
		});
	});
</script>

@endsection