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

    <div class="main-container" >

        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">
                        <h1 class="text-white">Pricing</h1>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="feature-selector">
            <div class="container">

            </div>

            <div class="container">
                <ul class="selector-content">
                    <li class="clearfix active">
                        <!-- <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1>A bit about us</h1>
                            </div>
                        </div> -->

                        <div class="row table-responsive">

                            <table class="table table-striped">

                                <thead>
                                <th style="width: 200px;"></th>
                                @foreach($products as $product)
                                    <th>{{ $product->name }}</th>
                                    @endforeach
                                </thead>
                                <tbody>
                                @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->name }}</td>
                                    @foreach($products as $product)
                                        <td>{{ ($vendor->product_get($product->id)) ? "£".number_format($vendor->product_get($product->id)->price_pounds) : "--"  }}</td>
                                    @endforeach
                                </tr>
                              @endforeach
                                </tbody>
                            </table>


                        </div><!--end of row-->
                    </li><!--end of individual feature content-->
                </ul>
            </div>
        </section>



    </div>

@endsection

