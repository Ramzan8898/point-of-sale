@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				
				<div class="col-12">

					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> {{__('messages.create_account')}}</button>
							<strong class="card-title text-dark h4">{{__('messages.accounts')}}</strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="h4 fw-bold">{{__('messages.action')}}</th>
										<th class="h4 fw-bold">{{__('messages.balance')}}</th>
										<th class="h4 fw-bold">{{__('messages.phone_number')}}</th>
										<th class="h4 fw-bold">{{__('messages.name')}}</th>
										<th class="serial">#</th>
									</tr>
								</thead>
								<tbody>
									@if(count($accounts) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">{{__('messages.no_accounts')}} ...</h6></td>
									</tr>
									@else
									@foreach($accounts as $account)
									<tr>
										<td class="action" style="width: 450px;">
											<a href="{{url('/accounts/edit' , $account->id)}}" class=" btn-orange" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$account->id}}">{{__('messages.edit')}}</a>
											<a href="#" class="btn-yellow" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$account->id}}">{{__('messages.add_transaction')}} </a>
											<a href="{{url('/transactions' , $account->id)}}" class="btn-red">{{__('messages.transactions')}}</a>
											<a href="{{url('/accounts/delete' , $account->id)}}" class="btn-blue">{{__('messages.delete')}}</a>
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
					<h1 class="modal-title fs-5" id="staticBackdropLabel">{{__('messages.create_account')}}</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/create')}}">
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
							<label>{{__('messages.balance')}}</label>
							<input type="number" name="balance" class="form-control">
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.close')}}</button>
						<button type="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
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
					<h5 class="modal-title" id="staticBackdropLabel2">{{__('messages.edit')}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/edit' , $account->id)}}">
						@csrf
						<div class="form-group">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control" value="{{$account->name}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control" value="{{$account->number}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.balance')}}</label>
							<input type="number" name="balance" class="form-control" value="{{$account->balance}}">
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
	@endforeach
	<!-- Edit Account Modal End-->


	<!--Add Balance Modal start -->
	@foreach($accounts as $account)
	<div class="modal fade" id="staticBackdrop1{{$account->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel1">{{__('messages.add_transaction')}}</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="{{url('/transaction/add_transaction' , $account->id)}}" method="POST">
						@csrf
						<div class="form-group">
							<label>{{__('messages.amount_type')}} </label>
							<select name="type" class="form-control">
								<option>{{__('messages.credit')}}</option>
								<option>{{__('messages.debit')}}</option>
							</select>
						</div>
						<div class="form-group">
							<label>{{__('messages.amount')}}</label>
							<input type="number" name="amount" class="form-control">
						</div>
						<div class="form-group">
							<label>{{__('messages.detail')}}</label>
							<textarea name="detail" class="form-control"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
						<button type="submit" class="btn btn-success">{{__('messages.submit')}}</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	@endforeach
	<!--Add Balance Modal End -->
</div>
@endsection