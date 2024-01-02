<!DOCTYPE html>
<html>
<head>
	<title>Geo</title>
	<link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('public/css/all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/css/style.css')}}">
	<script src="{{url('public/js/jquery.js')}}"></script>
</head>
<body>
	<div class="d-flex overflow-hidden">
		@include('layouts.sidebar')
		@yield('content')
		
	</div>

	<script src="{{url('public/js/bootstrap.min.js')}}"></script>
	<script src="{{url('public/js/all.min.js')}}"></script>

	<script>
		$(document).ready(function() {
    // Handle the change event of the radio input
    $('.detail').on('change', function(e) {
        // Retrieve the selected value
        e.preventDefault();
        var radioValue = $(this).val();

        // Make the AJAX request
        $.ajax({
        	url: "{{ route('get_records') }}",
        	type: "GET",
        	data: { radio_value: radioValue },
        	dataType: "json",
        	success: function(response) {
                // console.log(response.transactions);
                $('.transactions').html(response.transactions);
                // $('.sale').html(response.sale);
                // $('.profit').html(response.profit);

            },
            error: function(xhr, status, error) {
                // Handle the error response
                console.log(error);
            }
        });
    });
});
</script>

</body>
</html>