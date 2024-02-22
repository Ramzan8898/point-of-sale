@extends('index')
@section('content')
<div class="container p-4">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-end h3">
							<strong class="card-title text-dark ">{{__('messages.transactions')}}</strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="h4 fw-bold">{{__('messages.action')}}</th>
										<th class="h4 fw-bold">{{__('messages.detail')}}</th>
										<th class="h4 fw-bold">{{__('messages.amount')}}</th>
										<th class="h4 fw-bold">{{__('messages.bill_type')}}</th>
										<th class="h4 fw-bold">{{__('messages.phone_number')}}</th>
										<th class="h4 fw-bold">{{__('messages.name')}}</th>
										<th class="serial">#</th>
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
										<td class="action" style="width:300px;">
											<a href="{{url('/transactions/edit' , $transaction->id)}}" class="btn btn-blue" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$transaction->id}}">{{__('messages.edit')}}</a>
											<a href="{{url('/transaction/delete', $transaction->id)}}" class="btn btn-red">{{__('messages.delete')}}</a>
											<!-- <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$transaction->id}}">Add Balance</a>
												<a href="{{url('/transactions' , $transaction->id)}}" class="btn btn-danger">Transactions</a> --> 
											</td>
											<td class="balance" style="width:300px;">{{$transaction->detail}}</td>
											<td class="balance">{{$transaction->amount}}</td>
											<td class="balance">{{$transaction->type}}</td>
											<td class="balance">{{$transaction->number}}</td>
											<td class="number">{{$transaction->name}}</td>
											<td class="id">{{$transaction->id}}</td>
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

	<!-- Edit Account Modal -->
	@foreach($transactions as $transaction)
	<div class="modal fade" id="staticBackdrop2{{$transaction->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel2">Edit Transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/transaction/update' , $transaction->id)}}">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" value="{{$transaction->name}}" readonly>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="number" class="form-control" value="{{$transaction->number}}" readonly>
						</div>
						<div class="form-group">
							<label>Amount Type</label>
							<input type="text" name="type" class="form-control" value="{{$transaction->type}}">
						</div>
						<div class="form-group">
							<label>Amount</label>
							<input type="number" name="amount" class="form-control" value="{{$transaction->amount}}">
						</div>
						<div class="form-group">
							<label>Detail</label>
							<textarea name="detail" class="form-control" >{{$transaction->detail}}</textarea>
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
	@endforeach
	<!-- Edit Account Modal End-->
	@endsection