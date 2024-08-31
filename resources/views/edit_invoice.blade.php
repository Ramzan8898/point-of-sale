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
		#logo {
			display: none;
		}

		#remove_row {
			display: block;
		}

		.invoice_view {
			display: none;
		}
	}
</style>

<div class="container">
	<a href="{{url('/invoices')}}" class="back" style="width:fit-content;margin-left: 20px;position: fixed;"><i class="fas fa-arrow-left"></i></a>
	<form action="{{url('/edit_invoice' , $invoice->invoice_number)}}" method="POST">
		@csrf
		<div class="row clearfix">
			<input type="hidden" name="customerId" class="form-control customerId" readonly>
			<div class="col-md-3">
				<div class="form-group">
					<label>{{__('messages.bill_type')}}</label>
					<input name="billType" type="text" list="bill_type_list" class="form-control billType" required value="{{$invoice->bill_type}}">
					<datalist id="bill_type_list">
						<option value="Cash">{{__('messages.cash')}}</option>
						<option value="Credit">{{__('messages.credit')}}</option>
					</datalist>
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
					<input name="customerName" type="text" list="customer_list" class="form-control customerName" required value="{{$invoice->customer_name}}">
					<datalist id="customer_list">
						@foreach($accounts as $account)
						<option value="{{$account->name}}" data-number="{{$account->number}}" data-id="{{$account->id}}" data-balance="{{$account->balance}}">{{$account->name}}</option>
						@endforeach
					</datalist>
				</div>
			</div>


			<div class="col-md-12 mt-5">

				<table class="table table-bordered table-hover" id="tab_logic">
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
					<tbody id="productTable">
						<!-- @foreach ($invoice_products as $index => $inv_prd)
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
								<input name="product[]" type="text" list="products_list" class="form-control productSelect" required value="{{$inv_prd->product_name}}">
								<datalist id="products_list">
									@foreach($products as $product)
									<option value="{{$product->product_name}}" data-price={{$product->product_price}}>{{$product->product_name}}</option>
									@endforeach
								</datalist>
							</td>
							<td>{{$index + 1}}</td>
						</tr>
						@endforeach -->
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
								<input name="product[]" type="text" list="products_list" class="form-control productSelect" required value="{{$inv_prd->product_name}}">
								<datalist id="products_list">
									@foreach($products as $product)
									<option value="{{$product->product_name}}" data-price={{$product->product_price}}>{{$product->product_name}}</option>
									@endforeach
								</datalist>
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
				<div id="add_row" class="btn btn-yellow pull-left">{{__('messages.add_row')}}</div>
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
				<input type="submit" class="btn btn-danger" value="update">
	</form>
</div>
</div>
</div>

<script>
	$(document).ready(function() {
		function calc() {
			var total = 0;
			$('#productTable tr').each(function(i, element) {
				var qty = $(this).find('.qty').val();
				var price = $(this).find('.price').val();
				var rowTotal = qty * price;
				$(this).find('.total').val(rowTotal);
				total += parseFloat(rowTotal);
			});

			$('#sub_total').val(total.toFixed(2));
			var taxRate = $('#tax').val() || 0;
			var taxAmount = total / 100 * taxRate;
			$('#tax_amount').val(taxAmount.toFixed(2));
			$('#total_amount').val((total + taxAmount).toFixed(2));
		}

		function updateRowIds() {
			$('#productTable tr').each(function(index, element) {
				$(this).attr('id', 'addr' + index);
				$(this).find('td:last-child').html(index + 1);
			});
		}

		$('#add_row').click(function() {
			var referenceRow = $("#productTable tr:first");
			var newRow = referenceRow.clone();

			newRow.find('input').val('');
			newRow.find('input[type=hidden]').remove(); // Remove hidden product_id input for new rows

			var newIndex = $("#productTable tr").length;
			newRow.attr("id", 'addr' + newIndex);
			newRow.find('td:last-child').html(newIndex + 1);

			$("#productTable").append(newRow);
			updateRowIds();
		});

		$('#productTable').on('click', '.delete-row', function(e) {
			e.preventDefault();
			$(this).closest('tr').remove();
			updateRowIds();
			calc();
		});

		$('#productTable').on('keyup change', '.qty, .price', function() {
			calc();
		});

		$('#tax').on('keyup change', function() {
			calc();
		});

		$('#productTable').on('input', '.productSelect', function() {
			var selectedOption = $('#products_list option[value="' + $(this).val() + '"]');
			if (selectedOption.length > 0) {
				var productPrice = selectedOption.data('price');
				$(this).closest('tr').find('.productPrice').val(productPrice);
			} else {
				$(this).closest('tr').find('.productPrice').val('');
			}
		});

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