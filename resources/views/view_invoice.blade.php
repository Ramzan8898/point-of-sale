@extends('index')
@section('content')

<div class="modal-header">
	<h1 class="modal-title fs-5" id="staticBackdropLabel">Invoice</h1>
	<button type="button" class="btn-close" aria-label="Close"></button>
</div>
<div class="modal-body ">
	<div class="container">
		<div class="row1" style="display:flex;">
			<div class="row">
			<!--<div class="span4 d-flex " style="gap: 8px; margin-right: -100px;">
							
					<address style="text-align:right;margin-top: 0px ;">
						<strong style="font-size: 32px;">جیو برتن سٹور
							</strong><br>

						<p style="font-size:24px;">اندرون گلی  ،ظہور پلازہ <br>
								نوری گیٹ سرگودھا </p>
						<p>فون نمبر: 6051935-0300</p>
					</address>
					<img src="{{asset('/geo-news-logo.png')}}" class="img-rounded logo" width="80" height="90">
				</div> -->
				<div class="span4 well">
					<table class="invoice-head">
						<tbody>
							<tr>
								<td>{{$invoice->customer_name}}</td>
								<td class="pull-right"><strong>کسٹمر </strong></td>
							</tr>
							<tr>
								<td>{{$invoice->invoice_number}}</td>
								<td class="pull-right"><strong>انوايس #</strong></td>
							</tr>
							<tr>
								<td>{{$invoice->created_at}}</td>
								<td class="pull-right"><strong>تاریخ</strong></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
			<div class="row mt-3">
				<div class="span8 well invoice-body">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>مصنوعات</th>
								<th>قیمت</th>
								<th>مقدار</th>
								<th>کل</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inv_prod as $pro)
							<tr>
								<td>{{$pro->product_name}}</td>
								<td>{{$pro->product_price}}</td>
								<td>{{$pro->product_qty}}</td>
								<td>{{$pro->product_total}}</td>
							</tr>
							@endforeach
							<tr><td colspan="4"></td></tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td><strong>Sub Total</strong></td>
								<td><strong>{{$invoice->sub_total}}</strong></td>
							</tr>
							<tr>
								<td colspan="2">&nbsp;</td>
								<td><strong>Total</strong></td>
								<td><strong>{{$invoice->total}}</strong></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="span8 well invoice-thank">
					<h5 style="text-align:center;">Thank You!</h5>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Invoice View Model End  -->

@endsection