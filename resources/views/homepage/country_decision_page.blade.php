@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/country.css') }}" rel="stylesheet">
    <style>

        @media only screen and (min-width: 320px) and (max-width: 767px){
        h1 {
            font-size: 25px;
        }
        }
        option{
            background-color: black;
            color:white;
        }
        option:checked{
            background-color: white !important;
            color:black;
        }
        select option:hover {
            box-shadow: 0 0 10px 100px #000 inset;
        }

        .check_calculator_p p{
            line-height: 28px !important;
            padding: 10px 0px;
            font-size: 16px !important;
        }

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

                    <h1 id="cent" class="text-white">{{$countries->name}}</h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>

    <section class="container bg-white">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4"><h3>Choose the appropriate travelling option</h3></div>
            <div class="col-md-5">
                            <select name="" class="form-control" id="action" onchange="redirect('{{$countries->id}}')">
                                <option value="">Select a country</option>
                                <option value="departure">Departure</option>
                                <option value="arrival">On arrival</option>
                               
                            </select>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div id="loader"></div>
    </section>

    <section class="primary-features duplicatable-content">
        <div class="container">
            <h1 class="text-center" style="color: white !important;margin-top: -35px">3 Key Steps to follow</h1>
            <div class="row">
                <div class="col-md-4 col-sm-6 clearfix">
                    <div class="feature feature-icon-small">
                        <i class="icon icon-search"></i>
                        <h6 class="text-white">Select a country</h6>
                        <p class="text-white" style="color: #fff !important;">
                            Various countries have different covid 19 protocol for arrival into the country and departure.
                        </p>
                    </div><!--end of feature-->
                </div>

                <div class="col-md-4 col-sm-6 clearfix">
                    <div class="feature feature-icon-small">
                        <i class="icon icon-scope"></i>
                        <h6 class="text-white">Review the Country Requirement</h6>
                        <p class="text-white" style="color: #fff !important;">
                            Review the country requirments and the various test to book to ensure you have a smooth entry or departure process
                        </p>
                    </div><!--end of feature-->
                </div>

                <div class="col-md-4 col-sm-6 clearfix">
                    <div class="feature feature-icon-small">
                        <i class="icon icon-target"></i>
                        <h6 class="text-white">Book the test</h6>
                        <p class="text-white" style="color: #fff !important;">
                            Book the test easily and get connected with the lab and all necessary documentation needed for you to have a smooth ride
                        </p>
                    </div><!--end of feature-->
                </div>

            </div><!--end of row-->

        </div><!--end of container-->
    </section>


    <div class="card-container bg-sky"  style="padding:100px" id="banner3">
        <div class="container check_calculator_p">
            <p style="    font-weight: 600;
    font-size: 20px;
    line-height: 41px;
    color: #524f4f;" class="fw-600 fs-20 text-center ">The travel test requirements are different for every country. It is important to check what these are when you’re planning your trip.</a></p>
        </div>
    </div>

@endsection
@section('script')
<script>
    function redirect(id)
    {
        Rocket.loader({
            target: '#loader',
            body: 'Loading'
        });

        var country_id = id;
        var action = document.getElementById("action").value;
        console.log(country_id, action);
        window.location = '/travel/details/'+ country_id+ '/'+ action;
    }
</script>
@endsection