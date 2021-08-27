@extends('layouts.home')

@section('content')
@section('style')
    <style>
       
        body {
            font-size: 14px;
           
            padding: 0;
            margin: 0;
        }
        .bg-1 {
            background: #2e5c99;
            color: #fff;
        }
        .bg-2 {
            background: #92D050;
            color: #fff;
        }
        .bg-3 {
            background: #FFC000;
            color: #fff;
        }
        .bg-4 {
            background: #E60000;
            color: #fff;
        }
        .font-30 {
            font-size: 30px;
        }
        .header{
            padding:100px;
            display:grid;
            grid-template-columns:3fr 1fr;
        }

        .shadow {
        position: relative;
        box-shadow: 0 0 25px 0 rgba(50,50,50,.3) inset;
        }

        .shadow:after {
        content: "";
        position: relative;
        }

        .curved:after, .curved-2:after {
        position: relative;
        z-index: -2;
        }

        .curved:after {
        position: absolute;
        top: 50%;
        left: 12px;
        right: 12px;
        bottom: 0;
        box-shadow: 0 0px 10px 7px rgba(100,100,100,0.5);
        border-radius: 450px / 15px
        }
            table{
                border-collapse:collapse;
                /* width:1000px; */
                /* margin-top:20px; */
                width:100%;
            }
            thead{
                border-bottom:.5px solid #293459;
            }
            th{
                color:#FD6244;
                border:2px solid #fff;
                padding:15px;
                border-top:none;
            }
            /* img{
                width:10px;
                margin-left:10px;
            } */
            tr{
                text-align:center;
            }
            tr:nth-child(odd){
                background:#A6C3E0;
            }
            tr:nth-child(even){
                background:#d4e9ff;
            }
            td{
                padding:15px;
                border:2px solid #fff;
            }
            .icon{
                height:50px;
                width:auto;
            }
            th:last-child, td:last-child{
                border-right:none;
            }
            th:first-child, td:first-child{
                border-left:none;
            }
        
        .card {
            margin-bottom: 1.5rem;
            box-shadow: 0 0.25rem 0.5rem rgba(0,0,0,.025);
        }
        .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #e5e9f2;
            border-radius: .2rem;
        }
        .accordion li.active .text {
            padding: 24px;
            max-height: 1500px !important;
            border-bottom: 2px solid #dadada;
            opacity: 8 !important;
        }
        .background-image-holder.parallax-background {
        height: 140%;
        top: -33%;
        }
        .content{
            width:80vw;
            margin:auto;
        }
        .header{
            display:flex ;
        }
    </style>
    <style> 
        .fs-18{
            font-size:18px;
        }
        
        .h{
            text-align:center;
            margin:30px 0;
            font-weight:500;
        }
        .table{
            background: #FFFFFF;
            border-radius: 7px;
            font-weight:600;
        }
        .table .table-item{
            display:grid;
            grid-template-columns:1fr 1fr 1fr;
            padding:15px 63px;
            border-bottom:1px solid #eeeeee;
            align-items:center;
            transition:.4s ease-in-out all;
            min-height:75px;

        }
        .table .table-head{
            background:#0C6685;
            padding:35px 63px;
            color:#fff;
            border-radius:7px 7px 0 0;
            border:none;
        }
        .table .table-item div{
            width:206px;
            padding-right:0px;
        }
        .table .table-item div:last-child{
            padding:0;
        }
        .table .table-item-2{
            grid-template-columns:1fr 2fr;
        }
        .table .table-item-2 .table-col-2{
            text-align:center;
            width:100%;
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* start laptop version */
        @media screen and (max-width: 2450px) {
           
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* tab version */
        @media screen and (max-width: 1024px) {
            
            .table .table-item div{
                width:auto;
                padding-right:50px;
            }
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* mobile version */
        @media screen and (max-width: 800px) {
           
            .inner{
                display:flex;
                flex-wrap:nowrap;
                overflow:hidden;
                overflow-x:auto;
            }
            /* .table{
                width:1000px;
            } */
            .table .table-item{
                width:700px;
                /* min-width:150px; */
            }
            .table .table-item div{
                width:auto;
                padding-right:60px;
            }
        }

        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */
        /* break */

        /* mobile version */
        @media screen and (max-width: 468px) {
        }
    </style>
    <style>
   
    .link{
        text-decoration:none;
        color:white;
    }

    /***** background */
    .bg-1 {
        background: #1A8BB3;
        color: #fff;
    }
    .bg-2 {
        background: #7FC8A9;
        color: #fff;
    }
    .bg-3 {
        background:#FA8072;
        color:#fff;
    }
    .bg-4{
        background:#F6D167;
        color:#fff;
    }
    .bg-5{
        background:#DF2E2E;
        color:#fff;
    }
    .bg-6{
        background:#989898;
        color:#fff;
    }
    .bg-7{
        background:#F3F3F3;
    }
    .bg-8{
        background:#616161;
    }
    .bg-9{
        background:#8d8d8d;
    }
    .bg-10{
        background:#D22F27;
    }
    .bg-11{
        background:#eaeaea;
    }
    .bg-white{
        background:#fff;
    }
    .bg-none{
        background:none;
    }

    /***** color */
    .color-1{
        color:#1A8BB3;
    }
    .color-2{
        color:#7FC8A9;
    }
    .color-3{
        color:#FA8072;
    }
    .color-4{
        color:#F6D167;
    }
    .color-5{
        color:#DF2E2E;
    }
    .color-6{
        color:#989898;
    }
    .color-7{
        color:#F3F3F3;
    }
    .color-8{
        color:#616161;
    }
    .color-9{
        color:#8d8d8d;
    }
    .color-10{
        color:#D22F27;
    }
    .color-11{
        color:#eaeaea;
    }
    .color-black{
        color:#000;
    }

  

    /***** font size */
    .fs-30 {
        font-size: 30px;
    }
    .fs-28{
        font-size:28px;
    }
    .fs-20{
        font-size:20px;
    }
    .fs-18{
        font-size:18px;
    }
    .fs-16{
        font-size:16px;
    }

    /***** font weight */
    .fw-700{
        font-weight:700;
    }
    .fw-600{
        font-weight:600;
    }
    .fw-500{
        font-weight:500;
    }

    /***** alignment */
    .text-center{
        text-align:center;
    }
    .text-left{
        text-align:left;
    }
    .text-right{
        text-align:right;
    }

    /***** containers */
    .double-container{
        display:grid;
        grid-template-columns:repeat(2, 45%);
        justify-content:space-between;
    }

    /***** country category */
    .country-category{
        padding:0 200px;
    }
    .country-category .card-container{
        margin:50px 0;
    }
    .country-category .card-container .card{
        height:142px;
        border-radius:10px;
        display:flex;
        align-items:center;
        justify-content:center;
        margin-bottom:30px;
    }
    .country-category .card-container .card .inner{
        padding:40px;
    }


    /* start laptop version */
    @media screen and (max-width: 2450px) {
    }

    /* tab version */
    @media screen and (max-width: 1024px) {
        section{
            padding:50px;
        }

        /***** cart */
        .cart{
            padding:0;
        }

        /***** country category */
        .country-category, .form-page{
            padding:0;
        }

        /***** form page */
        .form-page form{
            padding:50px 0;
        }
    }

   
    /* mobile version */
    @media screen and (max-width: 800px) {
        .cart .cart-container .card{
            grid-template-columns:2fr 1fr 2fr 2fr;
        }
    }


    /* mobile version */
    @media screen and (max-width: 468px) {
        section{
            padding:50px 20px;
        }

        button{
            display:block;
            width:100%;
        }

        .double-container{
            display:block;
        }

        /***** navigation */
        .navigation{
            display:none;
        }

        /***** cart */
        .cart .cart-container .card{
            display:block;
        }
        .cart .cart-container .card-item{
            height:auto;
            display:flex;
            align-items:center;
            justify-content:center;
            border-right:none;
            border-bottom:1px solid #c2c2c2;
          
        }
        .cart .cart-container .card-item:first-child{
            justify-content:center;
           
        }
        .cart .cart-container .card-item:last-child{
            justify-content:center;
            
        }

        /***** form page */
        .form-page form{
            box-shadow:none;
            border:none;
        }
        .form-page form .button-container button{
            margin:0 0 28px 0;
        }
    }
 </style>
@endsection

    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/banner.jpg">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img alt="logo" class="logo hidden-xs" src="/img/logo-light.png">
                        <h1 class="text-white space-bottom-medium text-center">Welcome to Travel Tests Global. We simplify the process of booking and making payments for Covid-19 Travel Tests for both travellers and travel agents. You’ll get up to date information on travel requirements and access to test providers in the country of destination. This ensures you have a hassle free travel experience.</h1>
                        <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                        <a href="{{ url('/product/all') }}" class="btn btn-primary btn-filled">Book Now</a>
                        
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>
        <section class="clients-2" style="padding-bottom:20px">
				<div class="container">
					<div class="row">
                        <div class="col-md-3 col-sm-4" style="margin-top:40px">
                            <h1>Our Partners</h1>
                        </div>

                        <div class="col-md-3 col-sm-4">
							<h1><img alt="Client Logo" src="/img/london_test.png" style="max-width:200px;max-height:200px"></h1>
						</div>
						
						<div class="col-md-3 col-sm-4">
							<img alt="Client Logo" src="img/pexpo.png" style="max-width:180px;max-height:200px">
						</div>
						
						<div class="col-md-3 col-sm-4" style="margin-top:30px">
                            
							<img alt="Client Logo" src="img/allhealth.png" style="max-width:200px;max-height:200px">
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
			</section><br/>
            <div class="country-category">
                <div class="header text-center bg-1" style="padding:59px;">
                    
                    <div class="container ">
                        <p class="fw-700 fs-28">BOOK NOW</p>
                        <p class="fw-600 fs-20">The travel tests requirements are different for every country. It is important to check what these are when you’re planning your trip.</a></p>
                    </div>
                </div>
                <div class="card-container"  style="margin-left:20px; margin-right:20px;"id="country-section" style="">
                    <div id="show-result">

                    </div>
                    <label for="">Choose the country you’re travelling to</label>
                         <?php 
                            $countries = App\Models\Country::all();
                        
                        ?>
                    <select name="" class="form-control" id="country" onchange="countryQuery()">
                        <option value="">Select a country</option>
                        <option value="225">United Kingdom</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->nicename}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="card-container double-container fs-20 text-center">
                   
                    <a href="/product/Green" class="link text-white">
                        <div class="card bg-2 fw-700">
                                <div class="inner">Travelling from a Green country to the UK</div>
                        </div>
                    </a>
                    <a href="/product/Amber_v" class="link">
                        <div class="card bg-4 fw-700">
                                <div class="inner">
                                    Travelling from an Amber country 
                                    (Vaccinated) to the UK
                                </div>
                        </div>
                    </a>
                    <a href="/product/Amber_uv" class="link text-white">
                        <div class="card bg-4 fw-700">
                                <div class="inner">
                                    Travelling from an Amber country
                                    (Unvaccinated) to the UK
                                </div>
                        </div>
                    </a>
                    <a href="/product/Red" class="link text-white">
                        <div class="card bg-5 fw-700">
                                <div class="inner">Travelling from a red country to the UK</div>
                        </div>
                    </a>
                    <a href="{{url('/product/UK')}}"  class="link text-white">
                        <div class="card bg-3 fw-700">
                            <div class="inner">Travelling from the UK</div>
                        </div>
                    </a>
                    <a href="/product/all" class="link text-white ">
                        <div class="card fw-600" style="border: 2px solid black;">
                            <div class="inner color-1">View all tests</div>
                        </div>
                    </a>
                </div>
            </div>
        <div class="container">
            <div class="header shadow curved bg-1 font-30" style="">
                <div class="text-center">
                    <h3 style="color:white;font-weight:600px">The Mandatory Covid-19 Tests for the UK follows a "traffic light system" which determines the required tests based on the  Country you are travelling from.</h3><br><br> <p>See table below with the list of expected tests for each Category</p></div>
                <div>            
            </div>
        </div>
        <br>
        <div class="table-responsive">
            <table className="font-16" style="overflow-x:auto !important;">
                <thead>
                    <th class="bg-1 text-center">MEASURE REQUIRED</th>
                    <th class="bg-2 text-center">GREEN</th>
                    <th class="bg-4 text-center">AMBER(Vaccinated) **</th>
                    <th class="bg-4 text-center">AMBER(Unvaccinated)</th>
                    <th class="bg-3 text-center">RED</th>
                </thead>
                <tr>
                    <td width="25%"><h6>COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</h6></td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6>PRE-DEPARTURE TEST AT DESTINATION WITHIN 72 HOURS OF TRAVEL</h6></td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6>MANDATORY PCR TEST UPON ENTRY TO UK ON/BEFORE DAY 2</h6></td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6>MANDATORY ADDITIONAL PCR TESTING ON DAY 8 OF ARRIVAL INTO THE UK</h6></td>
                    <td width="25%">
                    <img src="/img/close-cross.svg" class="icon" />
                    </td>
                    <td width="25%">
                     <img src="/img/close-cross.svg" class="icon" />   
                    </td>
                    <td width="25%">
                    <h6>Required on day 8</h6>
                    </td>
                    <td width="25%">
                        <h6>Required on day 8</h6>
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6 >OPTIONAL DAY 5 PCR TEST<br>( Test to Release )</h6></td>
                    <td width="25%">
                    <img src="/img/close-cross.svg" class="icon" />
                    </td>
                    <td width="25%">
                     <img src="/img/close-cross.svg" class="icon" />   
                    </td>
                    <td width="25%">
                    <h6> You can reduce the time required for self isolation to 5 days by taking a Day 5 Test; a negative Day 5 PCR Test allows you to immediately leave self isolation</h6>
                    </td>
                    <td width="25%">
                    <img src="/img/close-cross.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6>SELF ISOLATION</h6></td>
                    <td width="25%">
                    <img src="/img/close-cross.svg" class="icon" />
                    </td>
                    <td width="25%">
                      <img src="/img/close-cross.svg" class="icon" />
                     </td>
                    <td width="25%">
                        <h6> 10 days of Isolation at the UK Isolation address provided in your passenger locator form.
                            You can reduce this time to 5days  following a negative PCR result taken on  Day 5 Test (  See above)</h6>
                    </td>
                    <td width="25%">
                        <h6>10 days of Isolation in a Government approved Quarantine Hotel</h6>
                    </td>
                </tr>
                <tr>
                    <td width="25%"><h6>FIT TO FLY( PCR Test Taken before travel out of the UK  if required by destination country) </h6></td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                        <img src="/img/check-mark.svg" class="icon" />
                    </td>
                    <td width="25%">
                      <img src="/img/check-mark.svg" class="icon" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td class="bg-2">  <a href="{{ url('/product/Green') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-4">  <a href="{{ url('/product/Amber_v') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-4">  <a href="{{ url('/product/Amber_uv') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-3"> <a class="btn btn-primary btn-filled">Not available</a></td>
                </tr>
                
            </table>
            <div class="alert alert-danger">
               <span style="font-size:30px;color:white;">**</span> Please note that Only Travellers <b>who have specifically been vaccinated by the UK NHS and have completed all doses at least 2weeks before travel are considered eligible</b>. Passengers from France MUST undergo Quarantine , Day 2 and 8 tests irrespective of Vaccination Status
            </div>
            
        
        </div>
        <br>
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
    
            <div class="container">
                <div class="header shadow curved bg-1 font-30 " style="padding:50px">
                    <div class="text-center">
                        <h3 style="color:white;font-weight:600px">AT A GLANCE GUIDE FOR ARRIVALS TO THE UK FOLLOWING IMPLEMENTATION OF THE'TRAFFIC LIGHT SYSTEM'</h3>
                    </div>
                </div>
            </div>
        
        
        <br>
        <div class="container">
            <div class="table-responsive">
                <table className="font-16">
                    <tr>
                        <th class="bg-1">&nbsp;</th>
                        <th class="bg-1" colspan="3">
                            <b class="fs-25">Children resident in the UK, British Overseas Territories, Channel Islands, Isle of Man, USA or a recognised European country. </b><br /><br />
                            The recognised European countries are the EU countries, Andorra, Iceland, Liechtenstein, Monaco, Norway, San Marino, Switzerland or the Vatican City
                        </th>
                        <th class="bg-1" colspan="3"><b class="fs-25">Children resident in other countries</b></th>
                    </tr>
                    <tr>
                        <th class="bg-1">Ages (years)</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-3">5 - 10</th>
                        <th class="bg-4">11 - 17</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-3">5 - 10</th>
                        <th class="bg-4">11 - 17</th>
                    </tr>
                    <tr>
                        <td width="35.5%"><h6>Quarantine (at home or in the place they are staying for 10 days or for the duration of their trip if it’s less than 10 days)</h6> </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                    </tr>
                    <tr>
                        <td width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                    </tr>
                    <tr>
                        <td width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                    </tr>
                    <tr>
                        <td width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/close-cross.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                        <td width="10%">
                            <img src="/img/check-mark.svg" class="icon" />
                        </td>
                    </tr>
                </table>
                <br>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script>
    //  function show() {
    //        console.log(1);
    //         $("#country-section").show();
    //    }

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
                $("#show-result p").addClass('p-5')
                $("#show-result p").attr("style", "background-color: #4169e1;color:white")
               
            });
       }
</script>
@endsection