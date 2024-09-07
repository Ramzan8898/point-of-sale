@extends('index')
@section('content')
<style>
    .table-container {
        height: 300px;
        overflow-y: auto;

    }

    .fixed-header-table thead {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
    }
</style>
<div class="container-fluid p-5 main-bg" style="width:-webkit-fill-available;">
    <div class="content">
        <h1 class="text-end">جائزہ</h1>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
@endsection