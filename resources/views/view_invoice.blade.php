@extends('index')
@section('content')

<style type="text/css">
	@media print {

		nav,
		.print_btn,
		.back {
			display: none;
		}

		.shop {
			display: block !important;
		}

		.modal-body .container .row1 .row .shop .span4 address .add {
			background-color: #000000 !important;
		}

		.table>:not(caption)>*>* {
			border-bottom-width: 0px !important;
		}
	}

	@media screen {
		nav {
			display: none;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			margin: 0px;
		}
	}
</style>
<div class="container-fluid">
	<div class="container-fluid">
		<a href="{{url('/invoices')}}" class="back" style="width:fit-content;"><i class="fas fa-arrow-left"></i></a>
		<button class="btn btn-success print_btn" style="width:fit-content;" onclick="window.print()">Print</button>
	</div>
	<div class="container invoice_header">
		<div class="shop">
			<div class="span4 d-flex justify-content-center" style="gap: 8px;">
				<address style="text-align:right;margin-top: 0px ;">
					<strong style="font-size: 56px;">جیو برتن سٹور
					</strong>
					<p style="font-size:24px;mix-blend-mode: darken;" class="add ">اندرون گلی ،ظہور پلازہ
						نوری گیٹ سرگودھا </p>
					<p>فون نمبر: 6051935-0300</p>
				</address>
				
			</div>
		</div>
		<div class="customer_name d-flex align-items-center justify-content-end gap-5 mb-3">
			<h5>{{$invoice->customer_name}}</h5>
			<h3>{{__('messages.customer')}}</h3>
		</div>
		<div class="invoice d-flex align-items-center justify-content-end gap-5 mb-3">
			<h5>{{$invoice->invoice_number}}</h5>
			<h3>{{__('messages.invoice')}}</h3>
		</div>
		<div class="date d-flex align-items-center justify-content-end gap-5 mb-3">
			<h5>{{$invoice->created_at->format('Y-m-d')}}</h5>
			<h3>{{__('messages.date')}}</h3>
		</div>
	</div>
	<div class="container w-50 products">
		<table class="table table-sm">
			<thead>
				<tr>
					<th class=" text-center fs-4" scope="col">{{__('messages.total')}}</th>
					<th class=" text-center fs-4" scope="col">{{__('messages.quantity')}}</th>
					<th class=" text-center fs-4" scope="col">{{__('messages.price')}}</th>
					<th class="text-center fs-4" scope="col">{{__('messages.product')}}</th>
				</tr>
			</thead>
			<tbody class="table-group-divider">
				@foreach($inv_prod as $pro)
				<tr>
					<td class="fs-5 text-center">{{$pro->product_total}}</td>
					<td class="fs-5 text-center">{{$pro->product_qty}}</td>
					<td class="fs-5 text-center">{{$pro->product_price}}</td>
					<td class="fs-4 text-center">{{$pro->product_name}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div class="total">
			<div class="container row ">
				<div class="col sub_total d-flex gap-5 align-items-center">
					<h5>{{$invoice->sub_total}}</h5>
					<h3 class="fw-bold">{{__('messages.sub_total')}}</h3>
				</div>
				<div class="col prev_blnc d-flex gap-5 align-items-center">
					<h5>{{$balance}}</h5>
					<h3 class="fw-bold">{{__('messages.balance')}}</h3>
				</div>
			</div>
			<div class="container d-flex gap-5 align-items-center ">
				<h5>{{$invoice->total}}</h5>
				<h3 class="fw-bold">{{__('messages.total')}}</h3>
			</div>
		</div>
	</div>
</div>
@endsection