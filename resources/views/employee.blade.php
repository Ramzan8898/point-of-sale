@extends('index')
@section('content')
<div class="container p-5">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between">
							<strong class="card-title text-dark">Employee</strong>
							<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Add Employee</button>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table ">
								<thead>
									<tr>
										<th class="serial">#</th>
										<th>Name</th>
										<th>Phone</th>
										<th>Salary</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($employees) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">No Employees...</h6></td>
									</tr>
									@else
									@foreach($employees as $employee)
									<tr>
										<td class="id">{{$employee->id}}</td>
										<td class="name">{{$employee->name}}</td>
										<td class="number">{{$employee->number}}</td>
										<td class="salary">{{$employee->salary}}</td>
										<td class="action">
											<a href="{{url('/employee/edit' , $employee->id)}}" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$employee->id}}">Edit</a>
											<a href="{{url('/employee/delete' , $employee->id)}}" class="btn btn-danger">Delete</a>
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
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="staticBackdropLabel">Create Employee</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/create')}}">
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
	</div>
	<!--create user Modal end -->

	<!-- Modal -->
	@foreach($employees as $employee)
	<div class="modal fade" id="staticBackdrop1{{$employee->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel1" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel1">Edit Employee</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/edit' , $employee->id)}}">
						@csrf
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" value="{{$employee->name}}">
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="number" class="form-control" value="{{$employee->number}}">
						</div>
						<div class="form-group">
							<label>Salary</label>
							<input type="number" name="salary" class="form-control" value="{{$employee->salary}}">
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
</div>
@endsection