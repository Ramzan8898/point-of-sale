@extends('index')
@section('content')

<style type="text/css">
    @media print {
        #logo {
            display: block;
        }

        .delete-row {
            display: none;
        }

        nav {
            display: none;
        }
    }

    @media screen {
        #logo {
            display: none;
        }

        .delete-row {
            display: block;
        }

        .invoice_view {
            display: none;
        }
    }
</style>

<a href="{{url('/invoices')}}" class="back" style="width:fit-content;margin-left: 20px;position: fixed;"><i class="fas fa-arrow-left"></i></a>
<div class="container-fluid p-5 main-bg">
    <form action="{{url('/create', $new_invoice_no)}}" method="POST">
        @csrf
        <div class="row clearfix">
            <input type="hidden" name="customerId" class="form-control customerId" readonly>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__('messages.bill_type')}}</label>
                    <select id="bill_type_list" name="billType" class="form-control billType fs-4" required>
                        <option value="">{{__("messages.bill_type")}}</option>
                        <option value="Cash" class="align-right">{{__('messages.cash')}}</option>
                        <option value="Credit">{{__('messages.credit')}}</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__('messages.previous_balance')}}</label>
                    <input name="account_balance" id="customer_balance" type="number" class="form-control fs-4" required readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__('messages.customer_number')}}</label>
                    <input type="text" name="customerNumber" class="form-control customerNumber fs-4" readonly>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>{{__('messages.customer_name')}}</label>
                    <select id="customer_list" name="customerName" class="form-control customerName fs-4" required>
                        @foreach($accounts as $account)
                        <option value="{{$account->name}}" data-number="{{$account->number}}" data-id="{{$account->id}}" data-balance="{{$account->balance}}">{{$account->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-12 mt-5">
                <table class="table" id="tab_logic">
                    <thead>
                        <tr>
                            <th class="text-center h4 fw-bold"></th>
                            <th class="text-center h4 fw-bold"> {{__('messages.total')}} </th>
                            <th class="text-center h4 fw-bold"> {{__('messages.quantity')}} </th>
                            <th class="text-center h4 fw-bold"> {{__('messages.price')}} </th>
                            <th class="text-center h4 fw-bold"> {{__('messages.product')}} </th>
                            <th class="text-center h4 fw-bold"> # </th>
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        <tr id='addr0'>
                            <td><i class="fas fa-trash-alt delete-row fs-5"></i></td>
                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total fs-5" readonly /></td>
                            <td><input type="number" name='qty[]' placeholder="{{__('messages.quantity')}}" class="form-control qty fs-5" step="0.00" min="0" required /></td>
                            <td><input type="number" name='price[]' placeholder="{{__('messages.price')}}" class="form-control price productPrice fs-5" step="0" min="0" /></td>
                            <td>
                                <select id="products_list" name="product[]" class="form-control productSelect fs-5" placeholder="{{__('messages.select_product')}}" required>
                                    @foreach($products as $product)
                                    <option value="{{$product->product_name}}" data-price="{{$product->product_price}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-md-12">
                <div id="add_row" class="btn btn-yellow pull-left p-2 rounded fs-5">{{__('messages.add_row')}}</div>
            </div>
        </div>

        <div class="row clearfix" style="margin-top:20px">
            <div class="pull-right col-md-4">
                <table class="table" id="tab_logic_total">
                    <tbody>
                        <tr>
                            <th class="text-center fs-4">{{__('messages.sub_total')}}</th>
                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center fs-4">{{__('messages.tax')}}</th>
                            <td class="text-center">
                                <div class="input-group mb-2 mb-sm-0">
                                    <input type="number" class="form-control" id="tax" placeholder="0">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center fs-4">{{__('messages.tax_amount')}}</th>
                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                        <tr>
                            <th class="text-center fs-4">{{__('messages.total')}}</th>
                            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="submit" class="button-30" value="Save">
            </div>
        </div>
    </form>
</div>

<script>
    // $(document).ready(function() {
    //     function updateRowIds() {
    //         $('#productTable tr').each(function(index) {
    //             $(this).attr('id', 'addr' + index);
    //             $(this).find('td:last-child').text(index + 1);
    //         });
    //     }

    //     function calc() {
    //         var total = 0;
    //         $('#productTable tr').each(function(i, element) {
    //             var qty = $(this).find('.qty').val();
    //             var price = $(this).find('.price').val();
    //             var rowTotal = qty * price;
    //             $(this).find('.total').val(rowTotal);
    //             total += parseFloat(rowTotal);
    //         });

    //         $('#sub_total').val(total.toFixed(2));
    //         var taxRate = $('#tax').val() || 0;
    //         var taxAmount = total / 100 * taxRate;
    //         $('#tax_amount').val(taxAmount.toFixed(2));
    //         $('#total_amount').val((total + taxAmount).toFixed(2));
    //     }

    //     function initializeCustomer() {
    //         // Get the first option from the customer dropdown
    //         var selectedOption = $('#customer_list option:selected');
    //         if (selectedOption.length > 0) {
    //             var customerId = selectedOption.data('id');
    //             var customerNumber = selectedOption.data('number');
    //             var customerBalance = selectedOption.data('balance');

    //             // Set the customer fields
    //             $('.customerId').val(customerId);
    //             $('.customerNumber').val(customerNumber);
    //             $('#customer_balance').val(customerBalance);
    //         }
    //     }

    //     function initializeProduct() {
    //         // Get the first product in the table and set its price
    //         var productRow = $('#productTable tr:first');
    //         var selectedProductOption = productRow.find('.productSelect option:selected');

    //         if (selectedProductOption.length > 0) {
    //             var productPrice = selectedProductOption.data('price');
    //             productRow.find('.productPrice').val(productPrice);
    //             calc(); // Recalculate totals after initializing price
    //         }
    //     }

    //     $("#add_row").click(function() {
    //         var newRow = $('#addr0').clone();
    //         newRow.find('input').val('');
    //         newRow.attr('id', 'addr' + ($('#productTable tr').length));
    //         newRow.find('td:last-child').text($('#productTable tr').length + 1);
    //         $('#productTable').append(newRow);
    //         updateRowIds();
    //         calc(); // Ensure to recalculate totals after adding new row
    //     });

    //     $('#productTable').on('click', '.delete-row', function() {
    //         if ($('#productTable tr').length > 1) {
    //             $(this).closest('tr').remove();
    //             updateRowIds();
    //             calc(); // Ensure to recalculate totals after deleting a row
    //         }
    //     });

    //     $('#productTable').on('keyup change', '.qty, .price', function() {
    //         calc();
    //     });

    //     $('#tax').on('keyup change', function() {
    //         calc();
    //     });

    //     $('#productTable').on('input', '.productSelect', function() {
    //         var selectedOption = $(this).find('option:selected');
    //         if (selectedOption.length > 0) {
    //             var productPrice = selectedOption.data('price');
    //             $(this).closest('tr').find('.productPrice').val(productPrice);
    //             calc();
    //         } else {
    //             $(this).closest('tr').find('.productPrice').val('');
    //         }
    //     });

    //     $('.customerName').on('input', function() {
    //         var selectedOption = $('#customer_list option[value="' + $(this).val() + '"]');
    //         if (selectedOption.length > 0) {
    //             var customerId = selectedOption.data('id');
    //             $('.customerId').val(customerId);
    //             var customerNumber = selectedOption.data('number');
    //             $('.customerNumber').val(customerNumber);
    //             var customerBalance = selectedOption.data('balance');
    //             $('#customer_balance').val(customerBalance);
    //         } else {
    //             $('.customerId').val('');
    //             $('.customerNumber').val('');
    //             $('#customer_balance').val('');
    //         }
    //     });

    //     // Initialize default customer and product values on page load
    //     initializeCustomer();
    //     initializeProduct();
    //     updateRowIds();
    //     calc();
    // });

    $(document).ready(function() {
        function updateRowIds() {
            $('#productTable tr').each(function(index) {
                $(this).attr('id', 'addr' + index);
                $(this).find('td:last-child').text(index + 1);
            });
        }

        function calc() {
            var total = 0;
            $('#productTable tr').each(function(i, element) {
                var qty = $(this).find('.qty').val();
                var price = $(this).find('.price').val();
                var rowTotal = qty * price;
                $(this).find('.total').val(rowTotal);
                total += parseFloat(rowTotal);
            });

            $('#sub_total').val(total.toFixed(2));
            var taxRate = $('#tax').val() || 0;
            var taxAmount = total / 100 * taxRate;
            $('#tax_amount').val(taxAmount.toFixed(2));
            $('#total_amount').val((total + taxAmount).toFixed(2));
        }

        function initializeCustomer() {
            var selectedOption = $('#customer_list option:selected');
            if (selectedOption.length > 0) {
                var customerId = selectedOption.data('id');
                var customerNumber = selectedOption.data('number');
                var customerBalance = selectedOption.data('balance');

                $('.customerId').val(customerId);
                $('.customerNumber').val(customerNumber);
                $('#customer_balance').val(customerBalance);
            }
        }

        function initializeProduct(productRow) {
            // Get the selected product in the current row and set its price
            var selectedProductOption = productRow.find('.productSelect option:selected');

            if (selectedProductOption.length > 0) {
                var productPrice = selectedProductOption.data('price');
                productRow.find('.productPrice').val(productPrice);
                calc(); // Recalculate totals after initializing price
            }
        }

        $("#add_row").click(function() {
            var newRow = $('#addr0').clone(); // Clone the first row
            newRow.find('input').val(''); // Clear input values
            newRow.attr('id', 'addr' + ($('#productTable tr').length)); // Update the row ID
            newRow.find('td:last-child').text($('#productTable tr').length + 1); // Update row number

            $('#productTable').append(newRow); // Append the new row to the table
            updateRowIds(); // Re-update the row IDs

            // Initialize the price of the default selected product for the new row
            initializeProduct(newRow);

            calc(); // Recalculate totals after adding a new row
        });

        $('#productTable').on('click', '.delete-row', function() {
            if ($('#productTable tr').length > 1) {
                $(this).closest('tr').remove();
                updateRowIds();
                calc(); // Ensure to recalculate totals after deleting a row
            }
        });

        $('#productTable').on('keyup change', '.qty, .price', function() {
            calc();
        });

        $('#tax').on('keyup change', function() {
            calc();
        });

        $('#productTable').on('input', '.productSelect', function() {
            var selectedOption = $(this).find('option:selected');
            if (selectedOption.length > 0) {
                var productPrice = selectedOption.data('price');
                $(this).closest('tr').find('.productPrice').val(productPrice);
                calc();
            } else {
                $(this).closest('tr').find('.productPrice').val('');
            }
        });

        $('.customerName').on('input', function() {
            var selectedOption = $('#customer_list option[value="' + $(this).val() + '"]');
            if (selectedOption.length > 0) {
                var customerId = selectedOption.data('id');
                $('.customerId').val(customerId);
                var customerNumber = selectedOption.data('number');
                $('.customerNumber').val(customerNumber);
                var customerBalance = selectedOption.data('balance');
                $('#customer_balance').val(customerBalance);
            } else {
                $('.customerId').val('');
                $('.customerNumber').val('');
                $('#customer_balance').val('');
            }
        });

        // Initialize default customer and product values on page load
        initializeCustomer();
        initializeProduct($('#addr0')); // Initialize the default product for the first row
        updateRowIds();
        calc();
    });
</script>

@endsection