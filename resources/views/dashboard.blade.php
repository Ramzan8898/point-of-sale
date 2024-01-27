@extends('index')
@section('content')
<style>
    .table-container {
        height: 300px; /* Set the height for the table body */
        overflow-y: auto; /* Enable vertical scrolling for the table body */
    }

    .fixed-header-table thead {
        position: sticky;
        top: 0;
        background-color: #f8f9fa; /* Set the background color for the fixed header */
    }
</style>
<div class="container p-4" style="width:-webkit-fill-available;background-color: #dfdfdf;">
	<div class="content">
		<h1 class="text-end">جائزہ</h1>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
@endsection