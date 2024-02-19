@extends('index')
@section('content')
<div class="container p-5">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<a href="{{url('/create' , $new_invoice_no )}}" class="btn-yellow ">{{__('messages.create_invoice')}}</a>
							<strong class="h3 card-title text-dark">{{__('messages.invoices')}}</strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="h4 fw-bold">{{__('messages.action')}}</th>
										<th class="h4 fw-bold">{{__('messages.total')}}</th>
										<th class="h4 fw-bold">{{__('messages.sub_total')}}</th>
										<th class="h4 fw-bold">{{__('messages.issue_date')}}</th>
										<th class="h4 fw-bold">{{__('messages.bill')}}</th>
										<th class="h4 fw-bold">{{__('messages.customer')}}</th>
										<th class="h4 fw-bold">Inv#</th>
									</tr>
								</thead>
								<tbody>
									@if(count($invoices) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">{{__('messages.no_invoices')}}...</h6></td>
									</tr>
									@else
									@foreach($invoices as $invoice)
									<tr>
										<td class="action">
											<a href="{{url('/view' , $invoice->invoice_number)}}" class="btn-blue ">{{__('messages.view')}}</a>
											<a href="{{url('/invoice/edit' , $invoice->id)}}" class="mr-3 btn-orange" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$invoice->invoice_number}}">{{__('messages.edit')}}</a>
											<a href="{{url('/invoice/delete' , $invoice->invoice_number)}}" class="btn-red" >{{__('messages.delete')}}</a>

										</td>
										<td>{{$invoice->total}}</td>
										<td>{{$invoice->sub_total}}</td>
										<td>{{$invoice->created_at}}</td>
										<td>{{$invoice->bill_type}}</td>
										<td>{{$invoice->customer_name}}</td>
										<td>{{$invoice->invoice_number}}</td>
										
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
					<h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('messages.create_invoice')}}</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/invoice/create')}}">
						@csrf
						<div class="form-group">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control">
						</div>
						<div class="form-group">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control">
						</div>
						<div class="form-group">
							<label>{{__('messages.salary')}}</label>
							<input type="number" name="salary" class="form-control">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
						<button type="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
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
					<h5 class="modal-title" id="staticBackdropLabel1">{{__('messages.edit_invoice')}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/invoice/edit' , $invoice->id)}}">
						@csrf
						<div class="form-group">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control" value="{{$invoice->name}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control" value="{{$invoice->number}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.salary')}}</label>
							<input type="number" name="salary" class="form-control" value="{{$invoice->salary}}">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
						<input type="submit" class="btn btn-primary" value="{{__('messages.update')}}">
					</div>
				</form>

			</div>
		</div>
	</div>
	@endforeach --}}
</div>
@endsection