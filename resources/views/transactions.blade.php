@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="content">
		<div class="d-flex justify-content-end ">
			<strong class="card-title text-dark h1">{{__('messages.transactions')}}</strong>
		</div>
		<table class="table table-striped table-light table-hover">
			<thead>
				<tr>
					<th class="h4 fw-bold">{{__('messages.action')}}</th>
					<th class="h4 fw-bold">{{__('messages.detail')}}</th>
					<th class="h4 fw-bold">{{__('messages.amount')}}</th>
					<th class="h4 fw-bold">{{__('messages.bill_type')}}</th>
					<th class="h4 fw-bold">{{__('messages.phone_number')}}</th>
					<th class="h4 fw-bold">{{__('messages.balance')}}</th>
					<th class="h4 fw-bold">{{__('messages.name')}}</th>
					<th class="serial">#</th>
				</tr>
			</thead>
			<tbody>
				@if(count($transactions) === 0)
				<tr>
					<td colspan="7">
						<h3 class="p-3 text-center " style="opacity: 0.5">...{{__("messages.no_transaction")}}</h3>
					</td>
				</tr>
				@else
				@foreach($transactions as $transaction)
				<tr>
					<td class="action">
						<a href="{{url('/transaction/delete', $transaction->id)}}"><i class="far fa-trash-alt icon"></i></a>
						<a href="{{url('/transactions/edit' , $transaction->id)}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{$transaction->id}}"><i class="far fa-edit icon"></i></a>
					</td>
					<td style="max-width:350px;width:300px;overflow-wrap:break-word;">{{$transaction->detail}}</td>
					<td>{{$transaction->amount}}</td>
					<td>{{$transaction->type}}</td>
					<td class="number">{{$transaction->number}}</td>
					<td class="name fs-5">{{$account->balance}}</td>
					<td class="name">{{$transaction->name}}</td>
					<td>{{$transaction->id}}</td>
				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>

<!-- Edit Transaction Modal -->
@foreach($transactions as $transaction)
<div class="modal fade" id="staticBackdrop2{{$transaction->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel2" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="background-color: #3f2259;color:beige;">
			<div class="modal-header">
				<button type="button" class="btn-close bg-light m-0" data-bs-dismiss="modal" aria-label="Close"></button>
				<h1 class="modal-title fs-3" id="staticBackdropLabel2">{{__("messages.edit_transaction")}}</h1>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/transaction/update' , $transaction->id)}}">
					@csrf
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label>{{__("messages.name")}}</label>
						<input type="text" name="name" class="form-control fs-4" value="{{$transaction->name}}" readonly>
					</div>
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label>{{__("messages.phone_number")}}</label>
						<input type="text" name="number" class="form-control fs-5" value="{{$transaction->number}}" readonly>
					</div>
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label>{{__("messages.amount_type")}}</label>
						<!-- <input type="text" name="type" class="form-control " value="{{$transaction->type}}"> -->
						<select id="bill_type_list" name="type" type="text" list="bill_type_list" class="form-control billType fs-5">
							<option value="Debit" {{ $transaction->type == 'Debit' || $transaction->type == 'ڈیبٹ'  ? 'selected' : '' }}>{{__('messages.debit')}}</option>
							<option value="Credit" {{ $transaction->type == 'Credit' || $transaction->type == 'کریڈت' ? 'selected' : '' }}>{{__('messages.credit')}}</option>
						</select>
					</div>
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label>{{__("messages.amount")}}</label>
						<input type="number" name="amount" class="form-control fs-5" value="{{$transaction->amount}}">
					</div>
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label>{{__("messages.detail")}}</label>
						<textarea name="detail" class="form-control fs-5">{{$transaction->detail}}</textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-light btn-sm fs-5" data-bs-dismiss="modal">{{__("messages.cancel")}}</button>
				<input type="submit" class="btn btn-light fs-5 btn-sm" value="{{__('messages.update')}}">
			</div>
			</form>

		</div>
	</div>
</div>
@endforeach
@endsection