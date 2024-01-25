@extends('index')
@section('content')
<style>
    .table-container {
        height: 300px; /* Set the height for the table body */
        overflow-y: auto; /* Enable vertical scrolling for the table body */
    }

    .fixed-header-table thead {
        position: sticky;
        top: 0;
        background-color: #f8f9fa; /* Set the background color for the fixed header */
    }
</style>
<div class="container p-4" style="width:-webkit-fill-available;background-color: #dfdfdf;">
	<div class="content">
		<h3>Overview</h3>
	</div>
</div>

<!-- Modal -->
@foreach($invoices as $invoice)
<div class="modal fade modal-xl" id="staticBackdrop9{{$invoice->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="staticBackdropLabel">Invoice</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body ">
				<div class="container">
					<div class="row1" style="display:flex; justify-content: flex-end;">
						<div class="row">
							<div class="span4 d-flex " style="gap: 8px; margin-right: -100px;">

								<address style="text-align:right;margin-top: 0px ;">
									<strong style="font-size: 32px;">جیو برتن سٹور
									</strong><br>

									<p style="font-size:24px;">اندرون گلی  ،ظہور پلازہ <br>
									نوری گیٹ سرگودھا </p>
									<p>فون نمبر: 6051935-0300</p>
								</address>
								<img src="{{asset('/geo-news-logo.png')}}" class="img-rounded logo" width="80" height="90">
							</div>
							<div class="span4 well">
								<table class="invoice-head">
									<tbody>
										<tr>
											<td>{{$invoice->customer_name}}</td>
											<td class="pull-right"><strong>کسٹمر </strong></td>
										</tr>
										<tr>
											<td>{{$invoice->invoice_number}}</td>
											<td class="pull-right"><strong>انوايس #</strong></td>
										</tr>
										<tr>
											<td>{{$invoice->created_at}}</td>
											<td class="pull-right"><strong>Date</strong></td>
										</tr>

									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="row mt-3">
						<div class="span8 well invoice-body">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Product</th>
										<th>price</th>
										<th>Quantity</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{$invoice->products}}</td>
										<td>{{$invoice->products}}</td>
										<td>{{$invoice->products}}</td>
										<td>{{$invoice->products}}</td>
									</tr>
									<tr><td colspan="4"></td></tr>
									<tr>
										<td colspan="2">&nbsp;</td>
										<td><strong>Sub Total</strong></td>
										<td><strong>{{$invoice->sub_total}}</strong></td>
									</tr>
									<tr>
										<td colspan="2">&nbsp;</td>
										<td><strong>Total</strong></td>
										<td><strong>{{$invoice->total}}</strong></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="row">
						<div class="span8 well invoice-thank">
							<h5 style="text-align:center;">Thank You!</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endforeach

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
@endsection