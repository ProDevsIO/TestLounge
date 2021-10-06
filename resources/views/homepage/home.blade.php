@extends('layouts.home')

@section('content')
@section('style')
  
   
 <link href="/css/cart.css" rel="stylesheet"/>
@endsection

    <div class="main-container" >
        <header class="page-header" style="padding-bottom:0;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image"  >
            </div>
            <div class="container" >
                <div class="row">
                    <div class="col-md-12 text-center" id="banner-writeup-container" >
                        <div class="row">
                            <div class="col-md-6 "style=" padding-top:10px">
                                <h2 class="text-white space-bottom-medium" id="banner-writeup">We simplify the process of booking and making payments for COVID-19 Travel Tests for both travellers and travel agents. You’ll get up to date information on travel requirements and access to test providers in the country of destination. This ensures you have a hassle free travel experience.</h2>
                                <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                               <p style="color: #fff;text-align: left" class="learn_more">Choose the Country you are travelling to: </p>

                                <div class="row" id="country-section" style="padding:0 !important">

                                    <div class="col-sm-12" style=""> <br><div id="show-result">

                                        </div>
                                        <br>
                                        <select name="" class="form-control" id="country" onchange="ukDirect()">
                                            <option value="">Select a country</option>
                                            <option value="225">United Kingdom</option>
                                        </select>
                                    </div>
                                    <div class="col-sm 2"></div>
                                </div>
                            </div>
                            <div class="col-md-6 pull-right" id="banner-writeup2" style=" top:-200px ">
                                <img class="background-image" alt="Background Image" src="/img/globe.png"  style="background-repeat: no-repeat;background-size: 100% 100%">
                            </div>
                        </div>


                    </div>
                </div><!--end of row-->
            </div><!--end of co-->
        </header>
        <section class="clients-2" style="padding-bottom:50px;">
				<div class="container">
					<div class="row">
                        <div class="col-md-2 col-sm-4" style="margin-top:5px; margin-bottom:30px;">
                            <h1>Our Partners</h1>
                        </div>

                        <div class="col-md-2 col-sm-4" style="margin-top:20px">
							<h1><img alt="Client Logo" src="/img/UKHT-logo-grey.png" style="max-width:120px;max-height:100px"></h1>
						</div>
						
						<div class="col-md-2 col-sm-4" style="margin-top:10px">
							<img alt="Client Logo" src="img/aims-logo-01.svg" style="max-width:150px;max-height:100px">
						</div>
						
						<div class="col-md-2 col-sm-4" style="margin-top:10px">
							<img alt="Client Logo" src="img/MedburyMedicaLogo.png" style="max-width:150px;max-height:100px">
						</div>

                        <div class="col-md-2 col-sm-4" style="margin-top:10px">
							<img alt="Client Logo" src="img/dam-health-logo.png" style="max-width:150px;max-height:100px">
						</div>

                        <div class="col-md-2 col-sm-4" style="margin-top:10px">
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
                <div class="container-fluid" style="padding:0">
                    <div class="text-center bg-1 ct" style="padding:59px;">
                        <div class="row" id="calculator">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-4 text-center">

                            <label for="">Choose the country you’re travelling to</label>
                        </div>
                        <div class="col-sm-4" style="margin-bottom: 35px;">
                            <select name="" class="form-control" id="country" onchange="ukDirect()">
                                <option value="">Select a country</option>
                                <option value="225">United Kingdom</option>
                            </select>
                        </div>
                        <div class="col-sm 2"></div>
                        </div>
                       
                    </div>
                </div>
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
                                <div class="card-container"  style="padding:70px; background-color:#1B1B1B"id="country-section" style="">
                                        <div class="row">
                                            <div class="col-md-6">  <p style="font-weight:200px;font-size:30px;line-height: 41px;color:white" class=" fs-20 text-center">Are you a travel agent? Join our network.</a></p>
                                            </div>
                                            <div class="col-md-6 text-center">
                                            <p><a href="{{ url('/register/agent') }}" type="button" class="btn btn-md bg-primary" style="margin-bottom: 30px;border-radius:25px; padding:14px 28px 13px 28px;font-family: Nunito;font-style: normal;font-weight: bolder;font-size: 16px;line-height: 19px;color: #1E50A0 !important;background-color:white !important;">Join our network</a></p>
                                            </div>
                                        </div>
                                </div>
                            <br>
                            {{--<p class="fw-700 fs-28"> <a href="{{ url('/product/all') }}" type="button" class="btn btn-md bg-primary" style="margin-bottom: 30px;border-radius:25px; padding:14px 28px 13px 28px;font-family: Nunito;font-style: normal;font-weight: bolder;font-size: 16px;line-height: 19px;color: #1E50A0 !important;background-color:white !important;">BOOK NOW</a></p>--}}
                            </div>
                            {{--<div class="col-sm-2"></div>--}}
                            {{--<div class="col-sm-4 text-center">--}}
                            {{----}}
                                {{--<label for="">Choose the country you’re travelling to</label>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm-4" style="margin-bottom: 35px;">--}}
                                {{--<select name="" class="form-control" id="country" onchange="ukDirect()">--}}
                                    {{--<option value="">Select a country</option>--}}
                                    {{--<option value="225">United Kingdom</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="col-sm 2"></div>--}}
                        </div>
                </div>
                <div class="card-container bg-sky"  style="padding:100px" id="banner2">
                         <div class="container ">
                               <p style="font-weight:600px;font-size:20px;line-height: 41px;" class="fw-600 fs-20 text-center">The travel test requirements are different for every country. It is important to check what these are when you’re planning your trip.</a></p>
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
        window.location = '/view/uk/';
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