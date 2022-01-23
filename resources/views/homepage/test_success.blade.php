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

                    <div class="col-sm-6 col-sm-offset-3 text-center m-5">
                        <div class="card-body">
                        <h2 style="color:#0fad00">Registration is complete</h2><br/>
                        <img src="/img/success.png" style="height: 100px">
                        
                        @if(isset($user))
                            <h3>Hi, {{ $user['first_name'] }} {{ $user['last_name'] }}</h3>
                            <p style="font-size:20px;color:#5C5C5C;">
                               Thank you for completing your PCR registration.   
                            <br/>
                             </p>


                        @endif
                        </div>
                        <br><br>
                    </div>
                </div><!--end of row-->
            </div>

        </section>
    </div>

@endsection
