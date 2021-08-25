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
        <section class="contact-photo">


            <div class="container">
                <div class="row">

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        <h2 style="color:#0fad00">Payment is successful</h2><br/>
                        <img src="/img/success.png" style="height: 100px">
                        @if(isset($booking))
                            <h3>Hi, {{ $booking->first_name }} {{ $booking->last_name }}</h3>
                            <p style="font-size:20px;color:#5C5C5C;">Thank you for booking with us, Here is your
                                code    
                                @foreach(json_decode($booking->booking_code) as $code)
                                    {{$code}},
                                @endforeach
                                An email has also been sent to you. Be sure to also check your junk mail also.<br/>
                                To fill your passenger location form <a href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion"
                                               target="_blank" style="color: blue">Click here.</a>
                                @if($booking->referral_code)
                                    <br/> <br/> <a href="{{ url('/booking?ref='.$booking->referral_code) }}"
                                                   class="btn btn-primary">Make another booking</a>
                                @endif
                            </p>
                          

                        @endif
                        <br><br>
                    </div>
                </div><!--end of row-->
            </div>

        </section>
    </div>

@endsection
