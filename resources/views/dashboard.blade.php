@extends('index')
@section('content')
<div class="p-4" style="width:-webkit-fill-available;">
	<div class="content">
		<h1>Overview</h1>
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<strong class="card-title text-dark">{{__('messages.transactions')}}</strong>
						</div>
						<div class="table-stats order-table ov-h transactions">
							<table class="table">
								<thead>
									<tr>
										<th class="serial">#</th>
										{{-- <th>account_id</th> --}}
										<th>{{trans('message.Name')}}</th>
										{{-- <th>Number</th> --}}
										<th>{{trans('message.Type')}}</th>
										<th>Amount</th>
										<th>Date</th>
										<th>Detail</th>
									</tr>
								</thead>
								<tbody>
									@if(count($transactions) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">No Transactions...</h6></td>
									</tr>
									@else
									@foreach($transactions as $transaction)
									<tr>
										<td class="id">{{$transaction->id}}</td>
										{{-- <td class="name">{{$transaction->account_id}}</td> --}}
										<td class="number">{{$transaction->name}}</td>
										{{-- <td class="balance">{{$transaction->number}}</td> --}}
										<td class="type">{{$transaction->type}}</td>
										<td class="amount">{{$transaction->amount}}</td>
										<td class="date">{{$transaction->created_at->format('Y-m-d')}}</td>
										<td class="detail" width="300px">{{$transaction->detail}}</td>

{{-- 										<td class="action">
											<a href="{{url('/transactions/edit' , $transaction->id)}}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$transaction->id}}">Edit</a>
											<a href="{{url('/transactions/delete' , $transaction->id)}}" class="btn btn-danger">Delete</a>
											<a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$transaction->id}}">Add Balance</a>
											<a href="{{url('/transactions' , $transaction->id)}}" class="btn btn-danger">Transactions</a>
										</td>
									--}}									</tr> 	
								</tbody>
								@endforeach
								@endif
							</table>

							{{-- @dd($transactions); --}}
							{{-- <p class="transactions bg-success">{{$transactions}}</p> --}}
						</div> <!-- /.table-stats -->
					</div>
				</div>

				<div class="col-6">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<strong class="card-title text-dark">{{__('messages.invoices')}}</strong>
						</div>
						<div class="table-stats order-table ov-h invoices">
							<table class="table">
								<thead>
									<tr>
										<th>Invoice#</th>
										<th>Customer</th>
										<th>Bill</th>
										<th>Products</th>
										<th>Total</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
									@if(count($invoices) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">No Invoices...</h6></td>
									</tr>
									@else
									@foreach($invoices as $invoice)
									{{-- @dd($invoice) --}}
									<tr>
										<td class="id">{{$invoice->invoice_number}}</td>
										<td class="number">{{$invoice->customer_name}}</td>
										<td class="type">{{$invoice->bill_type}}</td>
										<td class="amount">{{$invoice->products}}</td>
										<td class="detail">{{$invoice->total}}</td>
										<td class="action d-flex justify-content-evenly">
											<a href="{{url('/invoice/view')}}" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop9{{$invoice->id}}">View</a>
											<a href="{{url('/invoice/edit' , $invoice->id)}}" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$invoice->id}}">Edit</a>
											<a href="{{url('/invoice/delete' , $invoice->id)}}" class="btn btn-danger ">Delete</a>
										</td>
									</tr>
									@endforeach
									@endif 	
								</tbody>
							</table>
						</div> <!-- /.table-stats -->
					</div>
				</div>
			</div>
		</div>
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
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="span4 d-flex " style="gap: 8px;">
							<img src="{{asset('/geo-news-logo.png')}}" class="img-rounded logo" width="80" height="90">
							<address>
								<strong>Webivorous Web services Pvt. Ltd.</strong><br>

								35, Lajpat Nagar<br>
								Gurugram, Haryana-122001 (India)
							</address>
						</div>
						<div class="span4 well">
							<table class="invoice-head">
								<tbody>
									<tr>
										<td class="pull-right"><strong>Customer </strong></td>
										<td>{{$invoice->customer_name}}</td>
									</tr>
									<tr>
										<td class="pull-right"><strong>Invoice #</strong></td>
										<td>{{$invoice->invoice_number}}</td>
									</tr>
									<tr>
										<td class="pull-right"><strong>Date</strong></td>
										<td>{{$invoice->issued_date}}</td>
									</tr>

								</tbody>
							</table>
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