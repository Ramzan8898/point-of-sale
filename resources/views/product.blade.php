@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="row">
		<div class="col-6">
			<h1 class="text-end">{{__('messages.products')}}</h1>
			<table class="table table-striped table-light table-hover ">
				<thead>
					<tr>
						<!-- <th>Id</th> -->
						<th class="h4 fw-bold ">{{__('messages.action')}}</th>
						<th class="h4 fw-bold">{{__('messages.price')}}</th>
						<th class="h4 fw-bold">{{__('messages.name')}}</th>
					</tr>
				</thead>
				<tbody>
					@if(count($products) === 0)
					<tr>
						<td colspan="5">
							<h3 class="p-3 text-center " style="opacity: 0.5">...{{__('messages.no_products')}}</h3>
						</td>
					</tr>
					@else
					@foreach($products as $product)
					<tr>
						<!-- <td>{{$product->id}}</td> -->
						<td><a href="{{url('/delete' , $product->id)}}"><i class="far fa-trash-alt icon"></i></a>
							<a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$product->id}}"><i class="far fa-edit icon"></i></a>

						</td>
						<td class="fs-5">{{$product->product_price}}</td>
						<td class="fs-4">{{$product->product_name}}</td>
					</tr>
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
		<div class="col-4 offset-2">
			<form method="POST" action="{{url('/product/create')}}" style="padding: 30px;">
				@csrf
				<div class="form-group d-flex flex-column gap-2 mb-2">
					<label for="product_name">:{{__('messages.product_name')}}</label>
					<input type="text" name="product_name" class="form-control fs-4" required>
				</div>
				<div class="form-group d-flex flex-column gap-2 mb-2">
					<label for="product_price">:{{__('messages.product_price')}}</label>
					<input type="number" name="product_price" class="form-control fs-4" required>
				</div>
				<input type="submit" class="btn btn-light fs-5" value="{{__('messages.submit')}}">
			</form>
		</div>
	</div>
</div>

<!--Edit Product Modal -->
@foreach($products as $product)
<div class="modal fade" id="staticBackdrop{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content" style="background-color: #3f2259;color:beige">
			<div class="modal-header">
				<button type="button" class="btn-close bg-light m-0" data-bs-dismiss="modal" aria-label="Close"></button>
				<h2 class="modal-title" id="staticBackdropLabel">{{__('messages.edit')}}</h2>
			</div>
			<form method="POST" action="{{url('/product/edit' , $product->id)}}">
				<div class="modal-body">
					@csrf
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label for="product_name">{{__('messages.product_name')}}</label>
						<input type="text" name="product_name" value="{{$product->product_name}}" class="form-control fs-4" required>
					</div>
					<div class="form-group d-flex flex-column gap-2 mb-2">
						<label for="product_price">{{__('messages.product_price')}}</label>
						<input type="number" name="product_price" value="{{$product->product_price}}" class="form-control fs-5" required>
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
@endforeach
@endsection