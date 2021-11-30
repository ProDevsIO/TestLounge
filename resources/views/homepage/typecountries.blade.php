@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/country.css') }}" rel="stylesheet">
   
    <style>
      
       
    </style>
@endsection
@section('content')
    <header class="title" style="max-height: 300px !important;">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/pass2.jpg">
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12 ">

                    <h1 id="cent" class="text-white">{{$type}} COUNTRIES</h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>

    <section class="container bg-white">
        <div class="row">
            <div class="card">
                <div class="card-body">
                @if(count($countries) > 0)
                    @foreach($countries as $country)
                        <h5>{{$country->country->name}}</h5>
                    @endforeach
                @else
                    <h2>No country found.</h2>
                @endif
                </div>
            </div>
        </div>  
    </section>

@endsection
@section('script')

@endsection