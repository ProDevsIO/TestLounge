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
                        <h2 style="color:red">Payment Received</h2><br/>
                        <img src="/img/warning.jpeg" style="height: 100px"><br/>
                        @if(isset($booking))
                            <h3>Hi, {{ $booking->first_name }} {{ $booking->last_name }}</h3><br/>
                            <p style="font-size:20px;color:#5C5C5C;">Your Payment was received. However we are currently experiencing a
                                challenge in retrieving your passenger locator form. Kindly contact admin by emailing info@uktraveltests.com</p>
                        @endif
                        <br><br>
                    </div>
                </div><!--end of row-->
            </div>

        </section>
    </div>

@endsection
