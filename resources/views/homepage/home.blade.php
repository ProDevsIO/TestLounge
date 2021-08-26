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
                        <h1 class="text-white space-bottom-medium text-center">We simplify the process of booking and making payments for Covid-19 Travel Tests for both travellers and travel agents. You’ll get up to date information on UK travel requirements and access to accredited test providers in the UK ensuring a  hassle free travel experience.</h1>
                        <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a>
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
                    <th class="bg-3 text-center">AMBER(Vaccinated) **</th>
                    <th class="bg-3 text-center">AMBER(Unvaccinated)</th>
                    <th class="bg-4 text-center">RED</th>
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
                    <td style="background-color:green">  <a href="{{ url('/product/Green') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td style="background-color:red">  <a href="{{ url('/product/Amber_v') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td style="background-color:red">  <a href="{{ url('/product/Amber_uv') }}" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td style="background-color:orange"> <a class="btn btn-primary btn-filled">Not available</a></td>
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
        </section> -->
       
    
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
            </div>
        </div>
        
        

            <div class="country-category">
                <div class="header text-center" style="padding:20px; padding-top:100px;">
                    
                    <div class="container">
                        <p class="fw-700 fs-28">Select your country category</p>
                        <p class="fw-600 fs-20">To Know your country category,  <a href="javascript:;"  onclick="show()"><span class="color-1">click here </span></a></p>
                    </div>
                </div>
                <div class="card-container" id="country-section" style="display:none">
                    <div id="show-result">

                    </div>
                    <label for="">Select a country</label>
                         <?php 
                            $countries = App\Models\Country::all();
                        
                        ?>
                    <select name="" class="form-control" id="country" onchange="countryQuery()">
                        <option value="">select a country</option>
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
                    <a href="/product/all" class="link text-white">
                        <div class="card fw-600">
                            <div class="inner color-1">View all tests</div>
                        </div>
                    </a>
                </div>
            </div>
            
      

        <section class="pure-text-centered" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                        <span class="sub alt-font">popular questions</span>
                        <h1><strong>GUIDELINES FOR TRAVEL TESTS GLOBAl</strong></h1>
                        <ul style="text-align: justify; list-style-type: square; font-size:18px;padding: 0px 20px;">
                            <li>Run a PCR Test in your country of origin 72 hours before your trip to the UK. Evidence of a negative PCR Test is <b>MANDATORY</b> for entry into the UK. You can book your test <a href="/pick" class="">Here</a> </li>
                           <br/> <li> Book and Pay for your travel tests  <a href="{{ url('/product/all') }}" class="">Book Now</a>. Evidence of booking and payment is <b>MANDATORY</b> before you can board a flight to the UK</li>
                            <br/><li>Following Payment, you will immediately receive your Passenger locator Number and receipt of payment.</li>
                            <br/> <li>This number will be used to Complete your Passenger locator form <a href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion" target="_blank">Here</a>.You must show evidence that you have completed your Passenger locator form before you will be allowed to board a flight into the UK</li>
                            <br/> <li>You may also need to show your receipt of payment for your test before you are allowed to board a flight to the UK; <br>
                                Please have these documents handy at the airport ; both electronic and printed copies are accepted by airlines</li>
                            <br/> <li>Following your arrival into the UK, you will receive the  test packages you booked for on or before the 2nd day of your  arrival.</li>
                            <br/> <li>You must carry out a self test on your 1st or 2nd day of arrival into the UK . The directions on how to carry out a self test, how to activate your test and where to send your test samples to are all written  on the pack  you will receive. Click to watch video on how to carry out a self test. <a href="https://youtu.be/8lo6g-TYZ-c" target="_blank">Watch</a>.</li>
                            <br/> <li> Following your self test, you will drop your sample at the designated points nearest to you as directed on the test pack you will recieve </li>
                            <br/> <li> You will also be expected to "Activate" your test by visiting the website that will be indicated on the pack you will receive and by following the simple instructions on this website. This is required to analyse your test and send your results </li>
                            <br/> <li> If you have  purchased a Fit to Fly Test or Package, for your exit out of the UK to another country, check the country guidelines for when you are expected to carry out your PCR test before flying. </li>
                        </ul>
                        <br/>   <p class="lead" style="text-align: justify;">
                            You can also get more information about travel requirements for other countries <a href="https://calculator.prodevs.io/" target="_blank" style="color:#428bca; text-decoration:none;font-size:18px;"> here </a>. <br>
                            Follow the guidelines above on how to carry out a self test and activate your tests <br>

                            All test Results are available 24 hours from receipt of samples in the Laboratory <br><br></p>
                        <div class="alert alert-warning">
                       <p class="lead" style="text-align: justify;">     * Disclaimer : <br>
                            Country guidelines change from time to time and the information provided here is a guide. Please ensure to confirm country and airline regulations with relevant authorities at your destination. Traveltestsltd will not take any responsibility for challenges that arise as a result of information provided here
                       </p></div>
                        <p class="lead" style="text-align: justify">
                        <!-- <p style="text-align: justify">You must book and pay for all of our tests on our website; You
                            can schedule a test ahead of time. We will send a confirmation email with your Passenger
                            Locator Number and a receipt to you.
                        <p>
                        <p style="text-align: justify"> We shall then dispatch a courier to deliver your swab for all
                            PCR tests. Then, using the instructions supplied, activate your kit and return it to our
                            laboratory for testing. The results will be emailed to you within 24 hours of receiving them
                            at the lab. You will obtain a certificate certifying your mark for the Fit to Fly and Test
                            to Release tests, which you will either need to carry with you to the airport or which will
                            allow you to terminate your quarantine.</p>
                        <p style="text-align: justify"> If you are returning from a Green country, you must do a Day 2
                            exam, and if you are returning from an Amber country, you must conduct a Day 2 and 8 Test.
                            For Amber Countries, Test to Release (Day 5) is an option that may help you to shorten your
                            10-day quarantine. To ensure delivery on the correct day, book this separately from your Day
                            2 and 8 tests.</p>
                        <p style="text-align: justify">Before your appointment, read the section FAQ SECTION to make
                            sure you have everything you'll need.</p> -->
                        <br/>
                        <p><a href="/#faq" class="btn btn-primary">FAQs</a>

                            <a href="{{ url('/product/all') }}" class="btn btn-primary btn-filled">Book Now</a></p>
                        </p>
                    </div>
                </div><!--end of row-->

            </div><!--end of container-->
        </section>


        <section class="accordion-section" id="faq">
            <div class="container">
                <div class="row">

                    <div class="col-sm-12 col-md-12">
                        <h1><strong>FAQs</strong></h1>

                        <ul class="accordion">
                            <li class="active">
                                <div class="title"><span>WHY SHOULD I TAKE THE TEST?</span></div>
                                <div class="text">
                                    <p style="font-size:18px;">
                                        All visitors to the United Kingdom, including British nationals, must show proof
                                        of a negative Covid test within 72 hours of arrival.</p>
                                    <p style="font-size:18px;"> Residents of the United Kingdom traveling from the "red list," including South
                                        Africa, India, Namibia, and the United Arab Emirates, are allowed to enter the
                                        country but must quarantine and undergo testing upon arrival.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="title"><span>WHAT ARE THE CONSTRAINTS?</span></div>
                                <div class="text">
                                    <p style="font-size:18px;">
                                        Before entering the UK, all visitors must provide a negative test within the
                                        last 72 hours and fill out a Passenger Locator Form.</p>
                                    <p style="font-size:18px;"> In England, Scotland, Wales, and Northern Ireland, a traffic light-based
                                        transport system (red, amber, and green) is presently in operation.</p>
                                    <p style="font-size:18px;"> Non-UK residents from countries on the red list are now denied access to the
                                        United Kingdom.</p>
                                    <p style="font-size:18px;"> Residents returning from destinations on the red list, such as South Africa and
                                        India, must stay in a hotel for ten days.</p>
                                    <p style="font-size:18px;"> These passengers must purchase a "quarantine package" before arriving in the UK
                                        - which covers their stay in hotel quarantine, food, and drink while there
                                        (Personal expenses).

                                    </p>

                                </div>
                            </li>

                            <li>
                                <div class="title"><span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM AN AMBER COUNTRY?</span>
                                </div>
                                <div class="text" >
                                    <p style="font-size:18px;">
                                        These are the things you must do if you have spent more than ten days in an
                                        amber country or territory before arriving in the United Kingdom.</p>
                                    <p style="font-size:18px;"> Before Visiting the United Kingdom</p>
                                    <p style="font-size:18px;">It would help if you accomplish the following before visiting the United
                                        Kingdom:</p>
                                    <ul style="font-size:18px;">


                                        <li>- Take a COVID-19 test to see if you're at risk.</li>
                                        <li>- Book and pay for COVID-19 travel tests on days 2 and 8 after arriving in the
                                            United Kingdom.
                                        </li>
                                        <li>- Fill out a passenger location form.</li>
                                    </ul>

                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="title"><span>WHEN YOU ARRIVE IN THE UK, YOU MUST:</span></div>
                                <div class="text">

                                    <p style="font-size:18px;"> For ten days, quarantine at home or wherever you are staying.</p>
                                    <ul style="font-size:18px">
                                        <li>- On or before Day 2 and on or after Day 8, take a COVID-19 test</li>
                                        <li> - Read up on quarantine and COVID-19 testing.</li>
                                        <li> - The day two and day eight tests are not required for children under the
                                            age of four.
                                        </li>
                                        <li> - If you pay for a private COVID-19 exam under the Test to Release scheme,
                                            you could be able to get out of quarantine sooner.
                                        </li>
                                    </ul><br/>
                                    <p style="font-size:18px;"> The amber list isn't all-inclusive. You should not presume that a country or
                                        territory is on the green or red list if it is not on this list.

                                    </p>

                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A RED COUNTRY?</span></div>
                                <div class="text">

                                    <p style="font-size:18px;"> These are the things you must do if you visited a nation or territory on the red
                                        list in the 10 days leading up to your arrival in England.</p>
                                    <p style="font-size:18px;"> If you have spent the previous 10 days in a country or territory on the red
                                        list, you will be allowed to enter the UK only if you are a British or Irish
                                        national or have residency rights in the UK.</p>
                                    <p style="font-size:18px;"> Even if you have been fully vaccinated, you must observe these regulations.</p>
                                    <br/>
                                    <p><b>Before Departure for England</b></p>
                                    <p style="font-size:18px;">It would help if you did the following before going to England:
                                    <ul style="font-size:18px;">
                                        <li> - COVID-19 Test</li>
                                        <li> - Book a hotel package that includes two COVID-19 examinations.</li>
                                        <li> - You should fill out a passenger locator form</li>
                                    </ul></p><br/>
                                    <p><b>When you get to England</b></p>
                                    <p>It would be best if you did the following when you arrive in England:</p>
                                    <ul style="font-size:18px;">
                                        <li>- 2 COVID-19 tests during quarantine in a managed hotel</li>
                                    </ul>

                                </div>
                            </li>
                            <li>
                                <div class="title" >
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A GREEN COUNTRY?</span></div>
                                    <div class="text">

                                        <p style="font-size:15px;"> This section explains what you'll need to do if you're coming to England from one of the countries or territories on the green list. In the past 10 days, you must have only visited or traveled through a green list nation or the United Kingdom, Ireland, the Channel Islands, or the Isle of Man.
                                        </p>
                                            <p style="font-size:15px;">Even if you have been fully vaccinated, you must observe these regulations</p>
                                        <br/>
                                        <p> <b> Before Going to England</b></p>
                                        <p style="font-size:15px;"> It would help if you did the following before visiting England:</p>
                                        <ul style="font-size:15px;">
                                        <li>-	Take a COVID-19 test to see if you're at risk.</li>
                                            <li> -	Make a reservation and pay for a Day 2 COVID-19 test – to be taken once in England.</li>
                                            <li>  -	Fill out a passenger locator form.</li>
                                        </ul>
                                        <br/>
                                        <p> <b>When you arrive in England</b></p>
                                            <ul style="font-size:15px;">
                                                <li> -	On or before the second day after your arrival, you must take a COVID-19 test.</li>
                                                <li>  -	This test is not required for children under the age of four.</li>
                                                <li>  -	Unless the test result is positive, you do not need to quarantine.</li>
                                                <li>  -	If NHS Test & Trace informs you that you traveled to England with someone who tested positive for COVID-19, you must quarantine.</li>
                                            </ul>
                                        <p style="font-size:15px;">    If you've visited one of the countries or territories on the red list, or If you visited or passed through a nation or territory on the red list in the ten days leading up to your arrival in England, you must adhere to the red list requirements.</p>
                                        <p style="font-size:15px;">  If you have been in or through an amber list nation or territory in the ten days leading up to your arrival in England and have not visited a red list country, you must observe the amber list guidelines.</p>
                                        <p style="font-size:15px;"> A country or territory can be changed from the green list to the amber or red list if conditions change.</p>
                                            <p style="font-size:15px;">If a country or territory on the green list is on the verge of being demoted to amber, it will be added to the green watch list.</p>
                                        <p style="font-size:15px;"> A country or territory may be shifted between lists without warning if situations change suddenly.</p>

                                    </div>
                                </div>
                            </li>
                        </ul><!--end of accordion-->

                     </div>

                </div><!--end of row-->
            </div>
        </section>




    </div>


@endsection
@section('script')
<script>
     function show() {
           console.log(1);
            $("#country-section").show();
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
                $("#show-result p").addClass('alert alert-info')
            });
       }
</script>
@endsection