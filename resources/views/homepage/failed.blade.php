@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <style>
        .iti{
            width: 100%;
        }
        .show_required{
            color: red;
        }
    </style>
@endsection
@section('content')

    <div class="main-container">
        <section class="contact-photo">


            <div class="container">
                <div class="row">

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        <h2 style="color:red">Payment Failed</h2><br/>
                        <img src="/img/failed.png" style="height: 100px"><br/>
                        @if(isset($booking))
                            <h3>Hi, {{ $booking->first_name }} {{ $booking->last_name }}</h3><br/>
                            <p style="font-size:20px;color:#5C5C5C;">Your Payment Failed, if you would love to try again, kindly click these button<br/> <br/> <a href="{{ url('/make/payment/'.$booking->transaction_ref) }}" class="btn btn-primary">Retry Payment</a></p>

                        @endif
                        <br><br>
                    </div>
                </div><!--end of row-->
            </div>

        </section>
    </div>

@endsection
