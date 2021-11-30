@extends('layouts.home')

@section('style')

    <link href="/css/cart.css" rel="stylesheet"/>
    <style>
        @media all and (max-width: 1050px) {

            #myCarousel{
                position: absolute;
                top: 200px;
            }


            .carousel-img{
                width: 100%;
                height:100vh !important;
                object-fit: cover;

            }
            .travel_agent_form{
                margin-top: 0px;
            }
        }
        .page-header{
            height: 100% !important;
        }

        .travel_agent_form{
            margin-top: 15px;
        }

        .inner{
            display:block;
        }
        .p_desc{
            margin-top: 30px;
        }

        @media only screen and (min-width: 320px) and (max-width: 767px){
            h1 {
                font-size: 25px !important;
            }
        }
    </style>
@endsection
@section('content')


    <div class="main-container" >
        <header class="page-header" style="padding-bottom:0;">
            <div class="background-image-holder parallax-background">
                <!-- <img class="background-image" alt="Background Image" src="/img/pass2.jpg"  > -->
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    
                    <!-- <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol> -->

                  
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="img/pass1.jpg" alt="Los Angeles" class="carousel-img">
                        </div>
                        
                        <div class="item ">
                            <img src="img/pass5.jpg" alt="Los Angeles" class="carousel-img">
                        </div>
                        <div class="item ">
                            <img src="img/pass4.jpg" alt="Los Angeles" class="carousel-img">
                        </div>
                        <div class="item">
                            <img src="img/pass2.jpg" alt="Chicago"  class="carousel-img">>
                        </div>
                        
                        <div class="item">
                            <img src="img/pass3.jpg" alt="New york" class="carousel-img">
                        </div>
                    </div>

                    
                    <!-- <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                    </a> -->
                </div>
            </div>
            <div class="container" style="top:-23px;">
                <div class="row">
                    <div class="col-md-12 text-center" id="banner-writeup-container" >
                        <div class="row">
                            <div class="col-md-6 "style=" padding-top:10px">
                                <h2 class="text-white space-bottom-medium"  id="banner-writeup">We simplify the process of booking and making payments for COVID-19 Travel Tests for both travellers and travel agents. You’ll get up to date information on travel requirements and access to test providers in the country of destination. This ensures you have a hassle free travel experience.</h2>
                                <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                               <p style="color: #fff;text-align: left" class="learn_more">Choose the Country you are travelling to: </p>

                                <div class="row" id="country-section" style="padding:0 !important;margin-top:10px;">

                                    <div class="col-sm-11" style="margin-bottom: 100px;">
                                        <select name="" class="form-control" id="country" onchange="ukDirect()">
                                            <option value="">Select a country</option>
                                            <option value="united-kingdom-1">United Kingdom</option>
                                            <option value="united-arab-emirates-1">United Arab Emirates</option>
                                            <option value="nigeria-1">Nigeria</option>
                                            @foreach($scountries as $scountry)
                                                <option value="{{$scountry->country->slug_name}}"> {{$scountry->country->nicename}} </option>
                                            @endforeach
                                        </select>
                                        <div id="loader"></div>
                                    </div>

                                </div>
                            </div>
                            <!-- <div class="col-md-6 pull-right" id="banner-writeup2" style=" top:-200px ">
                                <img class="background-image" alt="Background Image" src="/img/globe.png"  style="background-repeat: no-repeat;background-size: 100% 100%">
                            </div> -->
                        </div>


                    </div>
                </div><!--end of row-->
            </div><!--end of co-->
        </header>
        <section class="clients-2" style="padding-bottom:50px;padding-top:50px;">
				<div class="container">
					<div class="row">
                        <div class="col-md-2 col-sm-4" style="margin-top:5px;">
                            <h1 class="partner_heading">Our Partners</h1>
                        </div>

                        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-top:10px">
							<h1><img alt="Client Logo" src="/img/UKHT-logo-grey.png" style="max-width:120px;max-height:100px"></h1>
						</div>
						
						<div class="col-md-2 col-sm-4 col-xs-6" style="margin-top:10px">
							<img alt="Client Logo" src="img/aims-logo-01.svg" style="max-width:150px;max-height:100px">
						</div>

						<div class="col-md-2 col-sm-4 col-xs-6" style="margin-top:10px">
							<img alt="Client Logo" src="img/MedburyMedicaLogo.png" style="max-width:150px;max-height:100px">
						</div>

                        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-top:10px">
							<img alt="Client Logo" src="img/dam-health-logo.png" style="max-width:150px;max-height:100px">
						</div>

                        <div class="col-md-2 col-sm-4 col-xs-6" style="margin-top:10px">
							<img alt="Client Logo" src="img/gebelablogo.png" style="max-width:150px;max-height:100px">
						</div>
						
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client4.png">--}}
						{{--</div>--}}
						{{----}}
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client5.png">--}}
						{{--</div>--}}
						{{----}}
						{{--<div class="col-md-2 col-sm-4">--}}
							{{--<img alt="Client Logo" src="img/client6.png">--}}
						{{--</div>--}}
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
        <section class="primary-features duplicatable-content">
            <div class="container">
                <h1 class="text-center" style="color: white !important;margin-top: -35px">3 Key Steps to follow</h1>
                <div class="row">
                    <div class="col-md-4 col-sm-6 clearfix">
                        <div class="feature feature-icon-small">
                            <i class="icon icon-search"></i>
                            <h6 class="text-white">Select a country</h6>
                            <p class="text-white">
                                Various countries have different covid 19 protocol for arrival into the country and departure.
                            </p>
                        </div><!--end of feature-->
                    </div>

                    <div class="col-md-4 col-sm-6 clearfix">
                        <div class="feature feature-icon-small">
                            <i class="icon icon-scope"></i>
                            <h6 class="text-white">Review the Country Requirement</h6>
                            <p class="text-white">
                                Review the country requirments and the various test to book to ensure you have a smooth entry or departure process
                            </p>
                        </div><!--end of feature-->
                    </div>

                    <div class="col-md-4 col-sm-6 clearfix">
                        <div class="feature feature-icon-small">
                            <i class="icon icon-target"></i>
                            <h6 class="text-white">Book the test</h6>
                            <p class="text-white">
                                Book the test easily and get connected with the lab and all necessary documentation needed for you to have a smooth ride
                            </p>
                        </div><!--end of feature-->
                    </div>

                </div><!--end of row-->

            </div><!--end of container-->
        </section>
                <div class="card-container"  style="padding:70px"id="country-section" style="">
                            <?php 
                                $countries = App\Models\Country::all();
                            
                            ?>
                        <div class="row" id="calculator">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <div id="show-result">

                                </div>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                        <br>
                        <div class="row" >
                            <div class="container" id="banner2">
                                <div class="card-container"  style="padding:70px; background-color:#1B1B1B" id="country-section">
                                        <div class="row">
                                            <div class="col-md-6">  <p style="font-weight:200px;font-size:30px;line-height: 41px;color:white" class="travel_agent_form fs-20 text-center">Are you a travel agent? Join our network.</a></p>
                                            </div>
                                            <div class="col-md-6 text-center" style="height:100px;">
                                            <p><a href="{{ url('/register/agent') }}" target="_blank" type="button" class="btn btn-md bg-primary" style="margin-top: 30px;border-radius:25px; padding:14px 28px 13px 28px;font-family: Nunito;font-style: normal;font-weight: bolder;font-size: 16px;line-height: 19px;color: #1E50A0 !important;background-color:white !important;">Join our network</a></p>
                                            </div>
                                        </div>
                                </div>
                            <br>
                            </div>

                        </div>
                </div>

        <section class="no-pad clearfix">

            <div class="col-md-6 col-sm-12 no-pad">

                <div class="feature-box">

                    <div class="background-image-holder overlay" style="background: url(&quot;img/header2.jpg&quot;) 50% 0%;">
                        <img class="background-image" alt="Background Image" src="/img/bigben2.jpg" style="display: none;">
                    </div>

                    <div class="inner mt-2">
                        <h3 class="text-white">Travelling to UK.</h3>
                        <p class="text-white p_desc">
                            To know more about the country requirements and the test to book, click the link below
                        </p>
                        <a href="{{ url('/view/country/united-kingdom-1') }}" target="_blank" class="btn btn-primary btn-white">Tell Me More</a>
                    </div>
                </div>

            </div>

            @foreach($display_countries as $country)
            <div class="col-md-6 col-sm-12 no-pad">

                <div class="feature-box">

                    <div class="background-image-holder overlay" style="background: url(&quot;img/header2.jpg&quot;) 50% 0%;">

                        @if($country->image != null)
                        <img class="background-image" alt="Background Image" src="{{ url($country->image) }}" style="display: none;">
                        @else
                        <img class="background-image" alt="Background Image" src="img/pass1.jpg" style="display: none;">
                        @endif
                    </div>

                    <div class="inner mt-2">
                        <h3 class="text-white">Travelling to {{ ucfirst(strtolower(optional($country->country)->name)) }}.</h3>
                        <p class="text-white p_desc">
                            To know more about the country requirements and the test to book, click the link below
                        </p>
                        
                        <a href="{{ url('/view/country/'.optional($country->country)->slug_name) }}" target="_blank" class="btn btn-primary btn-white">Tell Me More</a>
                    </div>
                </div>

            </div>
            @endforeach


        </section>

                <div class="card-container bg-sky"  style="padding:100px" id="banner3">
                         <div class="container check_calculator_p">
                               <p style="    font-weight: 600;
    font-size: 20px;
    line-height: 41px;
    color: #524f4f;" class="fw-600 fs-20 text-center ">The travel test requirements are different for every country. It is important to check what these are when you’re planning your trip.</a></p>
                         </div>
                 </div>
     
        <!-- <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                   
                    <div class="col-md-12 col-xs-12 text-center">
                        <h5 class="text-white">If you do not know what category your country of origin belongs to , please click on this link for more information</h5>
                        <a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" target="_blank" class="btn btn-primary btn-white">Click here</a>
                  
                    </div>
                </div>
            </div>
        </section>
       <br> -->
    
          
    </div>


@endsection
@section('script')
<script>



    function show() {
        console.log(1);
        $("#country-section").show();

        $("#travel").attr("disabled","disabled")
    }

    function ukDirect()
    {
        Rocket.loader({
            target: '#loader',
            body: 'Loading'
        });
        var country_id = document.getElementById("country").value;
        window.location = '/view/country/'+ country_id;
    }

    function ukDirect1()
    {
        var country_id = document.getElementById("country1").value;
     
        window.location = '/view/country/'+ country_id;
    }

    function countryQuery()
    {

        var country_id = document.getElementById("country").value;
        console.log(country_id);
        var url = '/country/query/' + country_id;
        $("#show-result")
            .find('p')
            .remove()
            .end();
        $.get(url, function (data) {

            var holder = document.getElementById("show-result");
            var newNode = document.createElement('p');
            var close =  document.createElement('a');
            newNode.innerHTML = data;
            close.innerHTML = "X";
            holder.appendChild(newNode);
            newNode.appendChild(close);
            $("#show-result p a").addClass('close')
            $("#show-result p a").attr("data-dismiss","alert")
            $("#show-result p").addClass('alert')
            $("#show-result p").addClass('p-2')
            $("#show-result p").attr("style", "background-color: #1E50A0;color:white;margin-bottom: 5px;")

        });
    }
</script>
@endsection