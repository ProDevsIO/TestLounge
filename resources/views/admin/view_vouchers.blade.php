@extends('layouts.admin')
@section('style')
    <link href="/assets/vendor/data-tables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
       
        /* .dataTables_length{
            display:flex;
        }
        .dataTables_filter{
            float:right;
            margin:0;
            padding:0;
        } */
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                @include('errors.showerrors')
<h1>yes</h1>
            </div>
        </div>
    </div>
@endsection