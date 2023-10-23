@extends('index')
@section('content')
<div class="container bg-danger p-5">
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
										<th>account_id</th>
										<th>Name</th>
										<th>Number</th>
										<th>Type</th>
										<th>Amount</th>
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
										<td class="name">{{$transaction->account_id}}</td>
										<td class="number">{{$transaction->name}}</td>
										<td class="balance">{{$transaction->number}}</td>
										<td class="balance">{{$transaction->type}}</td>
										<td class="balance">{{$transaction->amount}}</td>
										<td class="balance">{{$transaction->detail}}</td>

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
						</div> <!-- /.table-stats -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection