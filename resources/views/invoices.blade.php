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