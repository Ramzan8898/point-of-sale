@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="content">
		<div class="mb-3 d-flex justify-content-end gap-4">
			<button class="button-30" data-bs-toggle="modal" data-bs-target="#staticBackdrop"> <i class="far fa-plus-square icon"></i></button>
			<strong class="card-title text-dark h1">{{__('messages.accounts')}}</strong>
		</div>
		<table class="table table-striped table-light table-hover">
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
					<td colspan="5">
						<h3 class="p-3 text-center " style="opacity: 0.5"> ...{{__('messages.no_accounts')}}</h3>
					</td>
				</tr>
				@else
				@foreach($accounts as $account)
				<tr>
					<td class="action" style="width: 400px;">

						<a href="#" class="btn-yellow" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$account->id}}">{{__('messages.add_transaction')}} </a>
						<a href="{{url('/transactions' , $account->id)}}" class="btn-red">{{__('messages.transactions')}}</a>
						<a href="{{url('/accounts/delete' , $account->id)}}"><i class="far fa-trash-alt icon"></i></a>
						<a href="{{url('/accounts/edit' , $account->id)}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$account->id}}"><i class="far fa-edit icon"></i></a>
					</td>
					<td class="balance">{{$account->balance}}</td>
					<td class="number">{{$account->number}}</td>
					<td class="name">{{$account->name}}</td>
					<td class="id">{{$account->id}}</td>

				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>

	<!-- create Account Modal start -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background-color: #3f2259;color:beige">
				<div class="modal-header">
					<button type="button" class="btn-close bg-light m-0" data-bs-dismiss="modal" aria-label="Close"></button>
					<h1 class="modal-title fs-3" id="staticBackdropLabel">{{__('messages.create_account')}}</h1>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/create')}}">
						@csrf
						<div class="form-group d-flex flex-column gap-2 mb-2">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control fs-4">
						</div>
						<div class="form-group d-flex flex-column gap-1 mb-2">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control fs-4">
						</div>
						<div class="form-group d-flex flex-column gap-1 mb-2">
							<label>{{__('messages.balance')}}</label>
							<input type="number" name="balance" class="form-control fs-4">
						</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-light fs-5 btn-sm" data-bs-dismiss="modal">{{__('messages.no')}}</button>
					<button type="submit" class="btn btn-light fs-5 btn-sm">{{__('messages.yes')}}</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!--create Account Modal end -->

	<!-- Edit Account Modal -->
	@foreach($accounts as $account)
	<div class="modal fade" id="staticBackdrop2{{$account->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background-color: #3f2259;color:beige;">
				<div class="modal-header">
					<button type="button" class="btn-close bg-light m-0" data-bs-dismiss="modal" aria-label="Close"></button>
					<h1 class="modal-title fs-3" id="staticBackdropLabel2">{{__('messages.edit')}}</h1>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/accounts/edit' , $account->id)}}">
						@csrf
						<div class="form-group">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control fs-4" value="{{$account->name}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control fs-4" value="{{$account->number}}">
						</div>
						<div class="form-group">
							<label>{{__('messages.balance')}}</label>
							<input type="number" name="balance" class="form-control fs-4" value="{{$account->balance}}">
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light fs-5 btn-sm" data-bs-dismiss="modal">{{__('messages.no')}}</button>
					<input type="submit" class="btn btn-sm btn-light fs-5" value="{{__('messages.update')}}">
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
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background-color: #3f2259;color:beige;">
				<div class="modal-header">
					<button type="button" class="m-0 bg-light btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					<h1 class="modal-title fs-3" id="staticBackdropLabel1">{{__('messages.add_transaction')}}</h1>
				</div>
				<div class="modal-body">
					<form action="{{url('/transaction/add_transaction' , $account->id)}}" method="POST">
						@csrf
						<div class="form-group d-flex flex-column gap-2 mb-2">
							<label>{{__('messages.amount_type')}} </label>
							<select name="type" class="form-control fs-4">
								<option selected>{{__('messages.debit')}}</option>
								<option>{{__('messages.credit')}}</option>
							</select>
						</div>
						<div class="form-group d-flex flex-column gap-2 mb-2">
							<label>{{__('messages.amount')}}</label>
							<input type="number" name="amount" class="form-control fs-4">
						</div>
						<div class="form-group d-flex flex-column gap-2 mb-2">
							<label>{{__('messages.detail')}}</label>
							<textarea name="detail" class="form-control fs-4"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-sm fs-5  btn-light" data-bs-dismiss="modal">{{__('messages.cancel')}}</button>
					<button type="submit" class="btn btn-sm fs-5  btn-light">{{__('messages.submit')}}</button>
				</div>

				</form>
			</div>
		</div>
	</div>
	@endforeach
	<!--Add Balance Modal End -->
</div>
@endsection