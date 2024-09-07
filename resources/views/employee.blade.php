@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="content">
		<div class="mb-3 d-flex justify-content-end gap-4">
			<button class="button-30" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="far fa-plus-square icon"></i> </button>
			<strong class="card-title text-dark h1">{{__('messages.employees')}}</strong>
		</div>
		<table class="table table-light table-striped table-hover">
			<thead>
				<tr>
					<th class="h4 fw-bold">{{__('messages.action')}}</th>
					<th class="h4 fw-bold">{{__('messages.salary')}} </th>
					<th class="h4 fw-bold">{{__('messages.phone_number')}}</th>
					<th class="h4 fw-bold">{{__('messages.name')}}</th>
					<th class="serial ">#</th>
				</tr>
			</thead>
			<tbody>
				@if(count($employees) === 0)
				<tr>
					<td colspan="5">
						<h3 class="p-3 text-center " style="opacity: 0.5">...{{__('messages.no_employees')}}</h3>
					</td>
				</tr>
				@else
				@foreach($employees as $employee)
				<tr>
					<td class="action">
						<a href="{{url('/employee/delete' , $employee->id)}}"><i class="far fa-trash-alt icon"></i></a>
						<a href="{{url('/employee/edit' , $employee->id)}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$employee->id}}"><i class="far fa-edit icon"></i></a>
					</td>
					<td class="salary">{{$employee->salary}}</td>
					<td class="number">{{$employee->number}}</td>
					<td class="name">{{$employee->name}}</td>
					<td class="id">{{$employee->id}}</td>
				</tr>
				@endforeach
				@endif

			</tbody>
		</table>
	</div>
	<!-- create user Modal start -->
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background: #3f2259; color:beige">
				<div class="modal-header d-flex justify-content-between ">
					<button type="button" class="btn-close bg-light p-2 m-0" data-bs-dismiss="modal" aria-label="Close"></button>
					<h1 class="modal-title fs-3 text-right" id="staticBackdropLabel">{{__('messages.add_employee')}} </h1>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/create')}}">
						@csrf
						<div class="form-group d-flex flex-column gap-2 mb-2 ">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control fs-4" required>
						</div>
						<div class="form-group d-flex flex-column gap-2 mb-2">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control fs-4" required>
						</div>
						<div class="form-group d-flex flex-column gap-2">
							<label>{{__('messages.salary')}}</label>
							<input type="number" name="salary" class="form-control fs-4" required>
						</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-light fs-5 btn-sm" data-bs-dismiss="modal">{{__('messages.no')}} </button>
					<button type="submit" class="btn btn-light btn-sm fs-5">{{__('messages.yes')}}</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!--create user Modal end -->

	<!-- User Edit Modal -->
	@foreach($employees as $employee)
	<div class="modal fade" id="staticBackdrop1{{$employee->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content" style="background: #3f2259; color:beige;">
				<div class="modal-header">
					<button type="button" class="btn-close bg-light m-0" data-bs-dismiss="modal" aria-label="Close"></button>
					<h1 class="modal-title fs-3" id="staticBackdropLabel1">{{__('messages.edit')}}</h1>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/edit' , $employee->id)}}">
						@csrf
						<div class="form-group">
							<label>{{__('messages.name')}}</label>
							<input type="text" name="name" class="form-control fs-4" value="{{$employee->name}}" required>
						</div>
						<div class="form-group">
							<label>{{__('messages.phone_number')}}</label>
							<input type="text" name="number" class="form-control fs-4" value="{{$employee->number}}" required>
						</div>
						<div class="form-group">
							<label>{{__('messages.salary')}}</label>
							<input type="number" name="salary" class="form-control fs-4" value="{{$employee->salary}}" required>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light fs-5 btn-sm" data-bs-dismiss="modal">{{__('messages.no')}}</button>
					<input type="submit" class="btn btn-sm btn-light fs-5" value="{{__('messages.yes')}}">
				</div>
				</form>

			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection