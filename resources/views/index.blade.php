<!DOCTYPE html>
<html>

<head>
	<title>Geo</title>
	<link rel="stylesheet" href="{{url('public/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{url('public/css/all.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="{{url('public/css/style.css')}}">
	<script src="{{url('public/js/jquery.js')}}"></script>
	<style type="text/css">
	</style>
</head>

<body>
	<div class="d-flex overflow-hidden">
		@yield('content')
		@include('layouts.sidebar')
	</div>
	<script src="{{url('public/js/bootstrap.min.js')}}"></script>
	<script src="{{url('public/js/all.min.js')}}"></script>
</body>

</html>