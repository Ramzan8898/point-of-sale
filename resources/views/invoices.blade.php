@extends('index')
@section('content')
<div class="container-fluid p-5 main-bg">
	<div class="content">
		<div class="mb-3 d-flex justify-content-end gap-4">
			<a href="{{url('/create' , $new_invoice_no )}}" class="button-30 "><i class="far fa-plus-square icon"></i></a>
			<strong class="h1">{{__('messages.invoices')}}</strong>
		</div>
		<table class="table table-light table-hover table-striped">
			<thead>
				<tr>
					<th class="h4 fw-bold">{{__('messages.action')}}</th>
					<th class="h4 fw-bold">{{__('messages.total')}}</th>
					<th class="h4 fw-bold">{{__('messages.sub_total')}}</th>
					<th class="h4 fw-bold">{{__('messages.date')}}</th>
					<th class="h4 fw-bold">{{__('messages.bill')}}</th>
					<th class="h4 fw-bold">{{__('messages.customer')}}</th>
					<th class="h4 fw-bold">Inv#</th>
				</tr>
			</thead>
			<tbody>
				@if(count($invoices) === 0)
				<tr>
					<td colspan="7">
						<h3 class="p-3 text-center " style="opacity: 0.5">...{{__('messages.no_invoices')}}</h3>
					</td>
				</tr>
				@else
				@foreach($invoices as $invoice)
				<tr>
					<td class="action">
						<a href="{{url('/invoice/delete' , $invoice->invoice_number)}}"><i class="far fa-trash-alt icon"></i></a>
						<a href="{{url('/view' , $invoice->invoice_number)}}" class="btn-blue "><i class="far fa-eye icon"></i></a>
						<a href="{{url('/edit_invoice' , $invoice->invoice_number)}}"><i class="far fa-edit icon"></i></a>
					</td>
					<td>{{$invoice->total}}</td>
					<td>{{$invoice->sub_total}}</td>
					<td>{{$invoice->created_at->format('Y-m-d')}}</td>
					<td>{{$invoice->bill_type}}</td>
					<td class="name">{{$invoice->customer_name}}</td>
					<td>{{$invoice->invoice_number}}</td>

				</tr>
				@endforeach
				@endif
			</tbody>
		</table>
	</div>
</div>
@endsection