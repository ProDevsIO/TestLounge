@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="main-container">

        <header class="title" style="max-height: 200px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-white">COVID TESTING</h1>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="duplicatable-content">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h1>Test Packages Explained</h1>
                    </div>
                </div><!--end of row-->

                <div class="row">
                    @foreach($products as $product)
                    <div class="col-sm-6">
                        <div class="feature feature-icon-large">
                            <div class="pull-left">
                                <i class="icon icon-calendar"></i>
                            </div>
                            <div class="pull-right">
                                <h5>{{ $product->name }}</h5>
                                <p>
                               {{ $product->description }}
                                </p>
                                <a href="{{ url('/product/all') }}" class="btn btn-primary">Book</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!--end of row-->
            </div>

        </section>




    </div>

@endsection

