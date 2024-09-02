@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="row">
		<div class=" col-6">
			<table class="table table-dark">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
						<th class="h4 fw-bold ">{{__('messages.action')}}</th>
						<th class="h4 fw-bold">{{__('messages.price')}}</th>
						<th class="h4 fw-bold">{{__('messages.name')}}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						<!-- <td>{{$product->id}}</td> -->
						<td><a href="{{url('/add_new_product' , $product->id)}}" class="btn btn-red">{{__('messages.delete')}}</a>
							<a href="#" class="btn btn-yellow" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}">{{__('messages.edit')}}</a>
							
						</td>
						<td class="fs-6">{{$product->product_price}}</td>
						<td class="fs-6">{{$product->product_name}}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
		<div class="col-4 offset-2">
			<form method="POST" action="{{url('/add_new_product/create')}}" style="padding: 30px;">
				@csrf
				<div class="form-group">
					<label for="product_name">:{{__('messages.product_name')}}</label>
					<input type="text" name="product_name" class="form-control" required>
				</div>
				<div class="form-group mt-2 mb-2">
					<label for="product_price">:{{__('messages.product_price')}}</label>
					<input type="number" name="product_price"class="form-control" required>
				</div>
				<input type="submit" class="btn btn-blue" value="{{__('messages.submit')}}">
			</form>	
		</div>	
	</div>
</div>

<!--Edit Modal -->
@foreach($products as $product)
<div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">{{__('messages.edit')}}</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="{{url('/add_new_product/edit' , $product->id)}}" style="box-shadow: 2px 2px 5px 1px #fccccc;padding: 30px;">
					@csrf
					<div class="form-group">
						<label for="product_name">:{{__('messages.product_name')}}</label>
						<input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="product_price">:{{__('messages.product_price')}}</label>
						<input type="number" name="product_price" value="{{$product->product_price}}" class="form-control" required>
					</div>
					<input type="submit" class="btn btn-success" value="{{__('messages.update')}}">
				</form>	        
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection