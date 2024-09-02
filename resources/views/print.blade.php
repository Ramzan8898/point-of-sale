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

        modal-body .container .row1 .row .shop .span4 address .add {
            background-color: #000000 !important;
        }
    }

    /*  .shop{
        display: none;
    }*/
</style>
<!-- <div class="modal-header">
    <h1 class="modal-title fs-5" id="staticBackdropLabel">Invoice</h1>
    <button type="button" class="btn-close" aria-label="Close"></button>
</div> -->
<div class="modal-body print">
    <div class="container">
        <div class="row1" style="display:flex;flex-direction: column;">
            <div class="row">
                <div class="shop">
                    <div class="span4 d-flex justify-content-center" style="gap: 8px;">
                        <address style="text-align:right;margin-top: 0px ;">
                            <strong style="font-size: 56px;">جیو برتن سٹور
                            </strong>
                            <p style="font-size:24px;" class="add">اندرون گلی ،ظہور پلازہ
                                نوری گیٹ سرگودھا </p>
                            <p>فون نمبر: 6051935-0300</p>
                        </address>
                        <!-- <img src="{{asset('/geo-news-logo.png')}}" class="img-rounded logo" width="80" height="90"> -->
                    </div>
                </div>
                <a href="{{url('/invoices')}}" class="btn btn-success back" style="width:fit-content;margin-left: 20px;">Back</a>
                <button class="btn btn-success print_btn" style="width:fit-content;" onclick="window.print('.print')">Print</button>

                <div class="span4 well" style="display:flex; justify-content:flex-end;">
                    <table class="invoice-head">
                        <tbody>
                            <tr>
                                <td style="font-size: 24px;display:flex;justify-content: end;">{{$invoice->customer_name}}</td>
                                <td style="font-size: 24px"><strong>:کسٹمر </strong></td>
                            </tr>
                            <tr>
                                <td style="font-size: 24px;display:flex;justify-content: end;">{{$invoice->invoice_number}}</td>
                                <td class="pull-right" style="font-size: 24px"><strong>:#انوايس </strong></td>
                            </tr>
                            <tr>
                                <td style="font-size: 20px;display:flex;justify-content: end;">{{$invoice->created_at}}</td>
                                <td class="pull-right" style="font-size: 24px"><strong>:تاریخ</strong></td>
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
                                <th style="font-size:24px;">کل</th>
                                <th style="font-size:24px;">مقدار</th>
                                <th style="font-size:24px;">قیمت</th>
                                <th style="font-size:24px;">مصنوعات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->invoice_products as $pro)
                            <tr>
                                <td>{{$pro->product_total}}</td>
                                <td>{{$pro->product_qty}}</td>
                                <td>{{$pro->product_price}}</td>
                                <td>{{$pro->product_name}}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td><strong>{{$invoice->sub_total}}</strong></td>
                                <td><strong style="font-size:24px">ذیلی کل</strong></td>
                            </tr>
                            <tr>
                                <td><strong>{{$invoice->total}}</strong></td>
                                <td><strong style="font-size:24px;">ٹوٹل</strong></td>
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
@endsection