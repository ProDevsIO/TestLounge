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

<div class="space-medium">
        <!--space-medium-->
        <div class="container">


            <div class="container">
                <div class="row">

                    <div class="col-sm-6 col-sm-offset-3 text-center">
                        <h2 style="color:#0fad00">Payment is successful</h2><br/>
                        <img src="/img/success.png" style="height: 100px">
                        
                        @if(isset($booking))
                            <h3>Hi, {{ $booking->first_name }} {{ $booking->last_name }}</h3>
                            <p style="font-size:20px;color:#5C5C5C;">
                                <?php
                                $codes = json_decode($booking->booking_code);

                                    if($booking->dam_address != null){
                                        $address  = json_decode($booking->dam_address);
                                    } 
                                ?>
                             
                               @if(isset($address))
                                    The test lab for walkin is located at {{$address->address}},{{$address->city}}, {{$address->country}}.
                               @endif
                                
                     @if(count($codes) > 1)
                                Thank you for booking with us, Here are your
                                codes
                                    @else
                                        Thank you for booking with us, Here is your
                                        code
                         @endif
                                @foreach($codes as $code)
                                    {{$code}},
                                @endforeach
                                An email has also been sent to you. Please also check your junk mail.<br/>
                                To fill your passenger location form <a
                                        href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion"
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
