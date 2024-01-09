@extends('index')
@section('content')
<div class="container p-5">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<strong class="card-title text-dark">Invoices</strong>
							<a href="{{url('/create' , $new_invoice_no )}}" class="btn btn-warning">Create Invoice</a>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th>Inv#</th>
										<th>Customer</th>
										<th>Bill</th>
										<th>Sub Total</th>
										<th>Total</th>
										<th>Issue Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($invoices) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">No invoices...</h6></td>
									</tr>
									@else
									@foreach($invoices as $invoice)
									<tr>
										<td>{{$invoice->invoice_number}}</td>
										<td>{{$invoice->customer_name}}</td>
										<td>{{$invoice->bill_type}}</td>
										<td>{{$invoice->sub_total}}</td>
										<td>{{$invoice->total}}</td>
										<td>{{$invoice->created_at}}</td>
										<td class="action">
											<a href="{{url('/invoice/view')}}" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#staticBackdrop9{{$invoice->id}}">View</a>
											<a href="{{url('/invoice/edit' , $invoice->id)}}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$invoice->id}}">Edit</a>
											<a href="{{url('/invoice/delete' , $invoice->id)}}" class="btn btn-danger">Delete</a>
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
	<!-- create user Modal start -->
	{{-- <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create invoice</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/invoice/create')}}">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="number" class="form-control">
						</div>
						<div class="form-group">
							<label>Salary</label>
							<input type="number" name="salary" class="form-control">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">submit</button>
					</div>
				</form>
			</div>
		</div>
	</div> --}}
	<!--create user Modal end -->

	<!-- Invoice View Model Start  -->
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
<!-- 						<div class="span4 d-flex " style="gap: 8px; margin-right: -100px;">
							
							<address style="text-align:right;margin-top: 0px ;">
								<strong style="font-size: 32px;">جیو برتن سٹور
								</strong><br>

								<p style="font-size:24px;">اندرون گلی  ،ظہور پلازہ <br>
								نوری گیٹ سرگودھا </p>
							<p>فون نمبر: 6051935-0300</p>
							</address>
						<img src="{{asset('/geo-news-logo.png')}}" class="img-rounded logo" width="80" height="90">
					</div> -->
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
									<td class="pull-right"><strong>تاریخ</strong></td>
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
								<th>مصنوعات</th>
								<th>قیمت</th>
								<th>مقدار</th>
								<th>کل</th>
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
<!-- Invoice View Model End  -->

<!-- Modal -->
{{-- 	@foreach($invoices as $invoice)
<div class="modal fade" id="staticBackdrop1{{$invoice->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel1">Edit invoice</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/invoice/edit' , $invoice->id)}}">
					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{$invoice->name}}">
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="number" class="form-control" value="{{$invoice->number}}">
					</div>
					<div class="form-group">
						<label>Salary</label>
						<input type="number" name="salary" class="form-control" value="{{$invoice->salary}}">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<input type="submit" class="btn btn-primary" value="Update">
				</div>
			</form>

		</div>
	</div>
</div>
@endforeach --}}
</div>
@endsection