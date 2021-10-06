@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/uk_page.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-container" style="margin-bottom: 50px">




    <header class="page-header" style="height: 450px;padding-top: 50px">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/london.jpg" >
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" id="banner-writeup-container">
                    <div class="row">
                        <div class="col-md-6 "style=" padding-top:10px">
                            <h2 class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>UNITED KINGDOM</b></h2>
                            <p style="color: #fff;text-align: left">
                                The Mandatory Covid-19 Tests for entry into the UK, depend on your vaccinations status and what Country you are travelling from.
                                <!-- <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a> -->
                            <div id="show-result">

                            </div>
                            <select name="" class="form-control" id="country" onchange="countryQuery()">
                                <option value="">Select a country</option>
                                <option value="225">United Kingdom</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->nicename}} </option>
                                @endforeach
                            </select>
                        </div>
                        <!-- <div class="col-md-6 pull-right" id="banner-writeup2" style="left:10%;top:100px ">
                            <img class="background-image" alt="Background Image" src="/img/Group 6.png"  style="background-repeat: no-repeat;background-size: 100% 100%">
                        </div> -->
                    </div>


                </div>
            </div><!--end of row-->
        </div><!--end of co-->
    </header>

            <div class="container">
                <div class="country-category">    
                    
                    <div class="card-container double-container fs-20 text-center">
                    
                    <a href="/product/all" class="link ">
                            <div class="card" style="color:black">
                                <div class="inner"><v>PURCHASE OR VIEW ALL TESTS </v></div>
                            </div>
                        </a>
                        <a href="/product/Amber_v" class="link">
                            <div class="card bg-2 fw-700">
                                    <div class="inner">
                                        <v>
                                        Purchase Tests for fully vaccinated
                                        </v>
                                    </div>
                            </div>
                        </a>
                        <a href="/product/Amber_uv" class="link text-white">
                            <div class="card bg-4 fw-700">
                                    <div class="inner">
                                        <v>
                                        Purchase Tests for unvaccinated /Not fully vaccinated
                                        </v>
                                    </div>
                            </div>
                        </a>
                         <!-- <a href="/product/Green" class="link text-white">
                            <div class="card bg-2 fw-700" style="">
                                    <div class="inner"><v>Purchase Test if you are travelling from a green country</v></div>
                            </div>
                        </a> -->
                        <a href="/product/Red" class="link text-white">
                            <div class="card bg-5 fw-700">
                                    <div class="inner"><v>Information for Red List countries</v></div>
                            </div>
                        </a>
                        <!-- <a href="{{url('/product/UK')}}"  class="link text-white">
                            <div class="card bg-3 fw-700">
                                <div class="inner"><v>Purchase test if you are travelling from the UK</v></div>
                            </div>
                        </a> -->
                       
                    </div>
                </div>
            </div>
           
        <div class="container">
            <div class="header bg-sky " style="">
                <div class="text-center">
                    <h3 style=""><p>See table below with the list of requirement and expected tests for each Category</p> </h3></div>
                <div>            
            </div>
        </div>

        <div class="table-responsive">
            <div class="visible-xs text-center">
                <img src="/img/slide_sideways.gif" style="height: 65px">
            </div>
            <table className="font-16" style="overflow-x:auto !important;">
                <thead>
                    <th class="bg-sky text-center">MEASURE REQUIRED</th>
                    <th class="bg-2 text-center">Vaccinated **</th>
                    <th class="bg-4 text-center">Unvaccinated</th>
                    <th class="bg-5 text-center">TRAVELLING FROM A RED COUNTRY</th>
                </thead>
                <tr>
                     <td class="bg-sky" width="25%"><h6>PRE-DEPARTURE TEST AT DESTINATION WITHIN 72 HOURS OF TRAVEL</h6></td>
                    
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5"  width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>COMPLETE A PASSENGER LOCATOR FORM WITHIN 48 HOURS OF ARRIVAL</h6></td>
                   
                    <td class="bg-2" width="25%">
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
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>MANDATORY ADDITIONAL PCR TESTING ON DAY 8 OF ARRIVAL INTO THE UK</h6></td>
                
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>  
                    </td>
                    <td class="bg-4" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/ios-glyphs/30/000000/checkmark--v1.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6 >OPTIONAL DAY 5 PCR TEST<br>( Test to Release )</h6></td>
                    
                    <td class="bg-2" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/> 
                    </td>
                    <td class="bg-4" width="25%">
                    <h6> You can reduce the time required for self isolation to 5 days by taking a Day 5 Test; a negative Day 5 PCR Test allows you to immediately leave self isolation</h6>
                    </td>
                    <td class="bg-5" width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>SELF ISOLATION</h6></td>
                   
                    <td class="bg-2"  width="25%">
                    <img src="https://img.icons8.com/material-sharp/24/000000/delete-sign.png"/>
                     </td>
                    <td class="bg-4" width="25%">
                        <h6> 10 days of Isolation at the UK Isolation address provided in your passenger locator form.
                            You can reduce this time to 5days  following a negative PCR result taken on  Day 5 Test (  See above)</h6>
                    </td>
                    <td class="bg-5" width="25%">
                        <h6>10 days of Isolation in a Government approved Quarantine Hotel</h6>
                    </td>
                </tr>
                <tr>
                    <td class="bg-sky" width="25%"><h6>FIT TO FLY( PCR Test Taken before travel out of the UK  if required by destination country) </h6></td>
                   
                    <td class="bg-2" width="25%">
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
                    <td class="bg-2">  <a href="{{ url('/product/Amber_v') }}" style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-4">  <a href="{{ url('/product/Amber_uv') }}" style="font-family: Nunito;font-style: normal;font-weight: lighter;font-size: 13.625px;line-height: 19px;" class="btn btn-primary btn-filled">Book Now</a></td>
                    <td class="bg-5"> Unavailable</td>
                </tr>
                
            </table>
            <div class="alert">
               <p style="font-family: Nunito;font-style: normal;font-weight: normal;font-size: 18px;line-height: 25px;"><span style="font-size:30px;color:black;">**</span> Please note that Only Travellers <b>who have specifically been vaccinated by the UK NHS and have completed all doses at least 2weeks before travel are considered eligible</b>.</p>
            </div>
            
        
        </div>
        <br>
        </div>
        <div class="container">
                <div class="header bg-sky " style="padding:70px">
                    <div class="text-left">
                        <h3 class="text-left">Guide for Children Arriving in the UK</h3>
                    </div>
                </div>
            </div>
        
        
        <br>
        <div class="container">
            <div class="table-responsive">
                <div class="visible-xs text-center">
                    <img src="/img/slide_sideways.gif" style="height: 65px">
                </div>
                <table className="font-16">
                    <tr>
                        <th class="bg-white">&nbsp;</th>
                        <th class="bg-1" colspan="3">
                            <div id="child">Children resident in the UK, British Overseas Territories, Channel Islands, Isle of Man, USA or a recognised European country.<br> <br>
                            The recognised European countries are the EU countries, Andorra, Iceland, Liechtenstein, Monaco, Norway, San Marino, Switzerland or the Vatican City</div>
                        </th>
                        <th class="bg-1 text-center" colspan="3"><div id="child">Children resident in other countries</div></th>
                    </tr>
                    <tr>
                        <th class="bg-sky">Ages (years)</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-4">5 - 10</th>
                        <th class="bg-5">11 - 17</th>
                        <th class="bg-2">0 - 4</th>
                        <th class="bg-4">5 - 10</th>
                        <th class="bg-5">11 - 17</th>
                    </tr>
                    <tr>
                        <td class="bg-sky" width="35.5%"><h6>Quarantine (at home or in the place they are staying for 10 days or for the duration of their trip if it’s less than 10 days)</h6> </td>
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