@extends('index')
@section('content')
<div class="container p-4">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<strong class="card-title text-dark">Transactions</strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>Name</th>
										<th>Number</th>
										<th>Type</th>
										<th>Amount</th>
										<th>Detail</th>
										<th>Action</th>
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
										<td class="number">{{$transaction->name}}</td>
										<td class="balance">{{$transaction->number}}</td>
										<td class="balance">{{$transaction->type}}</td>
										<td class="balance">{{$transaction->amount}}</td>
										<td class="balance">{{$transaction->detail}}</td>
										<td class="action">
											<a href="{{url('/transactions/edit' , $transaction->id)}}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$transaction->id}}">Edit</a>
											<a href="{{url('/transaction/delete' , $transaction->id)}}" class="btn btn-danger">Delete</a>
											<!-- <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$transaction->id}}">Add Balance</a>
												<a href="{{url('/transactions' , $transaction->id)}}" class="btn btn-danger">Transactions</a> -->
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