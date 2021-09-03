@extends('layouts.home')

@section('style')
    <link href="/css/cart.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/bg.jpeg">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center" id="banner-writeup-container">
                        <div class="row">
                            <div class="col-md-6 " style=" padding-top:100px">
                                <h2 class="text-white space-bottom-medium" id="banner-writeup">We simplify the process
                                    of booking and making payments for Covid-19 UK Travel Tests for both travellers and
                                    travel agents. You’ll get up to date information on UK travel requirements and
                                    access to accredited test providers in the UK ensuring a hassle free travel
                                    experience.</h2>
                                <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                                <a href="{{ url('/product/all') }}" class="btn btn-primary btn-filled ">Book Now</a>
                            </div>
                            <div class="col-md-6 pull-right" id="banner-writeup2" style="left:10%;top:100px ">
                                <img class="background-image" alt="Background Image" src="/img/Group 6.png"
                                     style="background-repeat: no-repeat;background-size: 100% 100%">
                            </div>
                        </div>


                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>
        <section class="clients-2" style="padding-bottom:20px">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 partner_" style="margin-top:40px">
                        <h1>Our Partners</h1>
                    </div>

                    <div class="col-md-3 col-sm-4">
                        <h1><img alt="Client Logo" src="/img/london_test.png" style="max-width:200px;max-height:200px">
                        </h1>
                    </div>

                    <div class="col-md-3 col-sm-4">
                        <img alt="Client Logo" src="img/pexpo.png" style="max-width:180px;max-height:200px">
                    </div>

                    <div class="col-md-3 col-sm-4 allhealth" style="margin-top:30px">

                        <img alt="Client Logo" src="img/allhealth.png" style="max-width:200px;max-height:200px">
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </section>
        <div class="container-fluid" style="padding:0">
            <div class="header text-center bg-1" style="padding:59px;">

                <div class="container" id="banner2">
                    <p style="font-weight:600px;font-size:20px;line-height: 41px;" class="fw-600 fs-20 text-left">The
                        travel tests requirements are different for every country. It is important to check what these
                        are when you’re planning your trip.</a></p>

                    <p class="fw-700 fs-28"><a href="{{ url('/product/all') }}" type="button"
                                               class="btn btn-md bg-white"
                                               style="border-radius:25px; padding:14px 28px 13px 28px;color:">Book
                            Now</a></p>
                </div>
            </div>
        </div>
        <div class="card-container bg-sky" style="padding:70px" id="country-section" style="">
            <?php
            $countries = App\Models\Country::all();
            ?>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <div id="show-result">

                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>
            <br>
            <div class="row">

                <div class="col-sm-6 text-center mb_2">
                    <label for="">Choose the country you’re travelling to</label>
                </div>
                <div class="col-sm-5 mb_2">
                    <select name="" class="form-control country_selector" id="country" onchange="countryQuery()">
                        <option value="">Select a country</option>
                        <option value="225">United Kingdom</option>
                        @foreach($countries as $country)
                            <option value="{{$country->id}}">{{$country->nicename}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm 1"></div>
            </div>
        </div>
        <div class="container">
            <div class="country-category">

                <div class="card-container double-container fs-20 text-center">

                    <a href="/product/Green" class="link text-white">
                        <div class="card bg-2 fw-700" style="">
                            <div class="inner">
                                <v>Travelling from a Green country to the UK</v>
                            </div>
                        </div>
                    </a>
                    <a href="/product/Amber_v" class="link">
                        <div class="card bg-6 fw-700">
                            <div class="inner">
                                <v>
                                    Travelling from an Amber country
                                    (Vaccinated) to the UK
                                </v>
                            </div>
                        </div>
                    </a>
                    <a href="/product/Amber_uv" class="link text-white">
                        <div class="card bg-4 fw-700">
                            <div class="inner">
                                <v>
                                    Travelling from an Amber country
                                    (Unvaccinated) to the UK
                                </v>
                            </div>
                        </div>
                    </a>
                    <a href="/product/Red" class="link text-white">
                        <div class="card bg-5 fw-700">
                            <div class="inner">
                                <v>Travelling from a red country to the UK</v>
                            </div>
                        </div>
                    </a>
                    <a href="{{url('/product/UK')}}" class="link text-white">
                        <div class="card bg-3 fw-700">
                            <div class="inner">
                                <v>Travelling from the UK
                            </div>
                        </div>
                    </a>
                    <a href="/product/all" class="link text-white ">
                        <div class="card" style="border:none;">
                            <div class="inner">
                                <v>
                                    <button type="button" class="btn btn-md"
                                            style="border-radius:25px; padding:14px 20px 13px 20px;color:white; background:#1E50A0">
                                        View all tests
                                    </button>
                                </v>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="header bg-sky " style="">
                <div class="text-center">
                    <h3 style="">The Mandatory Covid-19 Tests for the UK follows a "traffic light system" which
                        determines the required tests based on the Country you are travelling from.<br><br>
                        <p>See table below with the list of expected tests for each Category</p></h3>
                </div>
                <div>
                </div>
            </div>
            <br>
            <div class="table-responsive">
                <div class="visible-xs text-center">
                <img src="/img/slide_sideways.gif" style="height: 65px">
                </div>
                <table className="font-16" style="overflow-x:auto !important;">
                    <thead>
                    <th class="bg-sky text-center">MEASURE REQUIRED</th>
                    <th class="bg-2 text-center">GREEN</th>
                    <th class="bg-6 text-center">AMBER(Vaccinated) **</th>
                    <th class="bg-4 text-center">AMBER(Unvaccinated)</th>
                    <th class="bg-5 text-center">RED</th>
                    </thead>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF
                                ARRIVAL</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-5" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>PRE-DEPARTURE TEST AT DESTINATION WITHIN 72 HOURS OF
                                TRAVEL</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-5" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>MANDATORY PCR TEST UPON ENTRY TO UK ON/BEFORE DAY 2</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-5" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>MANDATORY ADDITIONAL PCR TESTING ON DAY 8 OF ARRIVAL INTO THE
                                UK</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <h6 class="text-center">Required on day 8</h6>
                        </td>
                        <td class="bg-5" width="25%">
                            <h6 class="text-center">Required on day 8</h6>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>OPTIONAL DAY 5 PCR TEST<br>( Test to Release )</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <h6> You can reduce the time required for self isolation to 5 days by taking a Day 5 Test; a
                                negative Day 5 PCR Test allows you to immediately leave self isolation</h6>
                        </td>
                        <td class="bg-5" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>SELF ISOLATION</h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <h6> 10 days of Isolation at the UK Isolation address provided in your passenger locator
                                form.
                                You can reduce this time to 5days following a negative PCR result taken on Day 5 Test (
                                See above)</h6>
                        </td>
                        <td class="bg-5" width="25%">
                            <h6>10 days of Isolation in a Government approved Quarantine Hotel</h6>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="25%"><h6>FIT TO FLY( PCR Test Taken before travel out of the UK if
                                required by destination country) </h6></td>
                        <td class="bg-2" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-6" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-4" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-5" width="25%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky"></td>
                        <td class="bg-2"><a href="{{ url('/product/Green') }}"
                                            style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;"
                                            class="btn btn-primary btn-filled">Book Now</a></td>
                        <td class="bg-6"><a href="{{ url('/product/Amber_v') }}"
                                            style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;"
                                            class="btn btn-primary btn-filled">Book Now</a></td>
                        <td class="bg-4"><a href="{{ url('/product/Amber_uv') }}"
                                            style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;"
                                            class="btn btn-primary btn-filled">Book Now</a></td>
                        <td class="bg-5"><a href="{{ url('/product/Red') }}" class="btn btn-primary btn-filled"
                                            style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;">Book
                                Now</a></td>
                    </tr>

                </table>
                <div class="alert">
                    <p class="alertp">** Please note that Only Travellers who have specifically been
                            vaccinated by the UK NHS and have completed all doses at least 2weeks before travel are
                            considered eligible. Passengers from France MUST undergo Quarantine , Day 2 and 8 tests
                        irrespective of Vaccination Status</p>
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
            <div class="header bg-sky " style="padding:70px">
                <div class="text-left">
                    <h3 class="text-left header3">AT A GLANCE GUIDE FOR ARRIVALS TO THE UK FOLLOWING IMPLEMENTATION OF
                        THE'TRAFFIC LIGHT SYSTEM'</h3>
                </div>
            </div>
        </div>


        <br>
        <div style="margin-bottom: 40px;" class="container">
            <div class="table-responsive">
                <div class="visible-xs text-center">
                    <img src="/img/slide_sideways.gif" style="height: 65px">
                </div>
                <table class="table2">
                    <tr>
                        <th class="bg-white">&nbsp;</th>
                        <th class="bg-1" colspan="3">
                            <div id="child">Children resident in the UK, British Overseas Territories, Channel Islands,
                                Isle of Man, USA or a recognised European country.<br> <br>
                                The recognised European countries are the EU countries, Andorra, Iceland, Liechtenstein,
                                Monaco, Norway, San Marino, Switzerland or the Vatican City
                            </div>
                        </th>
                        <th class="bg-1 text-center" colspan="3">
                            <div id="child">Children resident in other countries</div>
                        </th>
                    </tr>
                    <tr>
                        <th class="bg-sky" style="padding: 0px 75px;">Ages (years)</th>
                        <th class="bg-2 text-center">0 - 4</th>
                        <th class="bg-4 text-center">5 - 10</th>
                        <th class="bg-5 text-center">11 - 17</th>
                        <th class="bg-2 text-center">0 - 4</th>
                        <th class="bg-4 text-center">5 - 10</th>
                        <th class="bg-5 text-center">11 - 17</th>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Quarantine (at home or in the place they are staying for 10
                                days or for the duration of their trip if it’s less than 10 days)</h6></td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Pre-departure test within 72 hours of travel. </h6></td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                        </td>
                        <td class="bg-sky" width="10%">
                            <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
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
        function countryQuery() {
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
                var close = document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss", "alert")
                $("#show-result p").addClass('alert')
                $("#show-result p").addClass('p-5')
                $("#show-result p").attr("style", "background-color: #87CEEB;color:white")
            });
        }
    </script>
@endsection