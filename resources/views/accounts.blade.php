@extends('index')
@section('content')
<div class="container p-4">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> {{__('messages.create_account')}}</button>
							<strong class="card-title text-dark">اکاؤنٹس</strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="h4 fw-bold">عمل</th>
										<th class="h4 fw-bold">بقیہ  </th>
										<th class="h4 fw-bold">فون نمبر  </th>
										<th class="h4 fw-bold">نام  </th>
										<th class="serial">#</th>
									</tr>
								</thead>
								<tbody>
									@if(count($accounts) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">کوئی اکاؤنٹس نہیں۔ ...</h6></td>
									</tr>
									@else
									@foreach($accounts as $account)
									<tr>
										<td class="action" style="width: 350px;">
											<a href="{{url('/accounts/edit' , $account->id)}}" class=" btn-orange" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$account->id}}">تبدیلی</a>
											<a href="#" class="btn-yellow" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$account->id}}">ٹرانزیکشن شامل کریں  </a>
											<a href="{{url('/transactions' , $account->id)}}" class="btn-red">ٹرانزیکشن  </a>
											<a href="{{url('/accounts/delete' , $account->id)}}" class="btn-blue">ختم</a>
										</td>
										<td class="balance">{{$account->balance}}</td>
										<td class="number">{{$account->number}}</td>
										<td class="name">{{$account->name}}</td>
										<td class="id">{{$account->id}}</td>

									</tr> 	
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

	<!-- create Account Modal start -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create Account</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/create')}}">
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
							<label>Balance</label>
							<input type="number" name="balance" class="form-control">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--create Account Modal end -->

	<!-- Edit Account Modal -->
	@foreach($accounts as $account)
	<div class="modal fade" id="staticBackdrop2{{$account->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel2">Edit account</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/edit' , $account->id)}}">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" value="{{$account->name}}">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="number" class="form-control" value="{{$account->number}}">
						</div>
						<div class="form-group">
							<label>Balance</label>
							<input type="number" name="balance" class="form-control" value="{{$account->balance}}">
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


	<!--Add Balance Modal start -->
	@foreach($accounts as $account)
	<div class="modal fade" id="staticBackdrop1{{$account->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel1">Add Transaction</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="{{url('/transaction/add_transaction' , $account->id)}}" method="POST">
						@csrf
						<div class="form-group">
							<label>Amount Type</label>
							<select name="type" class="form-control">
								<option>Credit</option>
								<option>Debit</option>
							</select>
						</div>
						<div class="form-group">
							<label>Amount</label>
							<input type="number" name="amount" class="form-control">
						</div>
						<div class="form-group">
							<label>Detail</label>
							<textarea name="detail" class="form-control"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-success">Submit</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	@endforeach
	<!--Add Balance Modal End -->
</div>
@endsection