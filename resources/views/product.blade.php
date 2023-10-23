@extends('index')
@section('content')
<div class="container p-5" >
	<div class="row">
		<div class="col-4">
			<form method="POST" action="{{url('/add_new_product/create')}}" style="box-shadow: 2px 2px 5px 1px #fccccc;padding: 30px;">
				@csrf
				<div class="form-group">
					<label for="product_name">Product Name:</label>
					<input type="text" name="product_name" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="product_price">Product Price:</label>
					<input type="number" name="product_price"class="form-control" required>
				</div>
				<input type="submit" class="btn btn-success">
			</form>	
		</div>
		<div class="offset-2 col-6">
			<table class="table">
				<thead>
					<tr>
						{{-- <th>Id</th> --}}
						<th>Name</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($products as $product)
					<tr>
						{{-- <td>{{$product->id}}</td> --}}
						<td>{{$product->product_name}}</td>
						<td>{{$product->product_price}}</td>
						<td><a href="#" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}">Edit</a>
							<a href="{{url('/add_new_product' , $product->id)}}" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>		
	</div>
</div>

<!--Edit Modal -->
@foreach($products as $product)
<div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">Edit Product</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				{{$product->id}}
				<form method="POST" action="{{url('/add_new_product/edit' , $product->id)}}" style="box-shadow: 2px 2px 5px 1px #fccccc;padding: 30px;">
					@csrf
					<div class="form-group">
						<label for="product_name">Product Name:</label>
						<input type="text" name="product_name" value="{{$product->product_name}}" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="product_price">Product Price:</label>
						<input type="number" name="product_price" value="{{$product->product_price}}" class="form-control" required>
					</div>
					<input type="submit" class="btn btn-success" value="Update">
				</form>	        
			</div>
		</div>
	</div>
</div>
@endforeach
@endsection