@extends('index')
@section('content')
<div class="container p-5">
	<div class="content">
		<div class="animated fadeIn">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header d-flex justify-content-between ">
							<button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">ملازم شامل کریں  </button>
							<strong class="card-title text-dark h3">ملازم </strong>
						</div>
						<div class="table-stats order-table ov-h">
							<table class="table table-stripe">
								<thead>
									<tr class="fw-bold">
										<th class="h4 fw-bold">عمل  </th>
										<th class="h4 fw-bold">تنخواہ </th>
										<th class="h4 fw-bold">فون نمبر </th>
										<th class="h4 fw-bold">نام </th>
										<th class="serial fw-bold">#</th>
									</tr>
								</thead>
								<tbody>
									@if(count($employees) === 0)
									<tr>
										<td colspan="5"><h6 class="p-3 text-center " style="opacity: 0.5">...کوئی ملازم نہیں  </h6></td>
									</tr>
									@else
									@foreach($employees as $employee)
									<tr>
										<td class="action" style="width:200px;">
											<a href="{{url('/employee/edit' , $employee->id)}}" class="btn-edit" data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{$employee->id}}">  تبدیلی  </a>
											<a href="{{url('/employee/delete' , $employee->id)}}" class="btn-delete">ختم </a>
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
					<h1 class="modal-title fs-3" id="staticBackdropLabel">ملازم بنائیں  </h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/create')}}">
						@csrf
						<div class="form-group">
							<label>نام </label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>فون نمبر  </label>
							<input type="text" name="number" class="form-control" required>
						</div>
						<div class="form-group">
							<label>تنخواہ  </label>
							<input type="number" name="salary" class="form-control" required>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بند کریں  </button>
						<button type="submit" class="btn btn-primary">بنا لیں  </button>
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
					<h5 class="modal-title" id="staticBackdropLabel1">درستگی  </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="{{url('/employee/edit' , $employee->id)}}">
						@csrf
						<div class="form-group">
							<label>نام</label>
							<input type="text" name="name" class="form-control" value="{{$employee->name}}" required>
						</div>
						<div class="form-group">
							<label>فون نمبر  </label>
							<input type="text" name="number" class="form-control" value="{{$employee->number}}" required>
						</div>
						<div class="form-group">
							<label>تنخواہ  </label>
							<input type="number" name="salary" class="form-control" value="{{$employee->salary}}" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بند کردیں</button>
						<input type="submit" class="btn btn-primary" value="درستگی">
					</div>
				</form>

			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection