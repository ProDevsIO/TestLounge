@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/uae_page.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-container" style="margin-bottom: 50px">

    <header class="page-header" style="height: 450px;padding-top: 50px">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/abudabi.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" id="banner-writeup-container">
                    <div class="row">
                        <div class="col-md-6 "style=" padding-top:200px">
                        @if($where == 'to')
                            <h2 class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>Now travelling to United <br>Arab Emirates</b></h2>
                        @elseif($where == 'from')
                        <h2 class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>Now from to United <br>Arab Emirates</b></h2>
                        @elseif($where == 'through')
                        <h2 class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>Now transiting through United <br>Arab Emirates</b></h2>
                        @endif
                        </div>
                        <!-- <div class="col-md-6 pull-right" id="banner-writeup2" style="left:10%;top:100px ">
                            <img class="background-image" alt="Background Image" src="/img/Group 6.png"  style="background-repeat: no-repeat;background-size: 100% 100%">
                        </div> -->
                    </div>


                </div>
            </div><!--end of row-->
        </div><!--end of co-->
    </header>
    @if($where == 'to')
            <div class="container" style="padding:0">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">

                                <p>All travellers to the UAE (vaccinated or unvaccinated) must hold a negative COVID 19 PCR test report at the departure airport.</p>
                                <small class="color-1">To see the COVID 19 testing requirements applicable to you, please select the country you are travelling from.</small>
                            </div>
                            <div class="col-sm-6" style="margin-top: 35px;">
                                <select name="" class="form-control" id="country" onchange="getPerequisite()">
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}"> {{$country->nicename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>              
                    </div>
            </div>
            <!-- info for supported countries testing b4 u depart -->
            <div class="container support " style="display:none">
                <div class="row" style="">
                    <h3><b>Testing before you depart</b></h3>
                    <p class="text-danger">You are required to hold verifiable reports of the following tests:</p>

                    <div class="col-lg-4"> 
                        <div class="panel" id="UAE_depart"> 
                            <div class="panel-body">
                                <p>1. A valid COVID-19 PCR test certificate with a QR code for a test conducted within 48 hours, validity should be calculated from the time the sample was collected, prior to departure from an approved health facility.</p>
                            </div>
                            <center>
                              <a type="button" class="btn bg-1 btn-md ">Book this test $95</a>
                            </center>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="panel" id="UAE_depart"> 
                            <div class="panel-body">
                                <p>2. A rapid PCR test report with a QR code for a test conducted at the departure airport within 6 hours of departure.</p>
                            </div>
                            <center>
                            <a type="button" class="btn bg-1 btn-md ">Book this test $95</a>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="panel bg-1" id="UAE_depart1"> 
                            <div class="panel-body" >
                                <p>Do you know you can do both tests now at a discounted price ?</p>
                            </div>
                            <center>
                              
                            <a type="button" class="btn bg-white btn-md" style="color:black !important; ">Book this test $180</a>
                            </center>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="container support"  style="margin-top:100px;display:none">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">
                            <h3><b>Testing on Arrival</b></h3>
                                <small class="color-1">To see the COVID 19 testing requirements applicable to you, please select the country you are travelling from.</small>
                            </div>
                            <div class="col-sm-6" style="margin-top: 35px;">
                                <select name="" class="form-control" id="countryAfter" onchange="getPerequisiteAfter()">
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}"> {{$country->nicename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>              
                    </div>

                    <div class="text-left after_others" style="margin-top:100px; display:none">
                        <p><label class="text-danger">You are <b>NOT</b> required to:</label><br>
                        Take another COVID-19 PCR test on arrival at Dubia international airports.
                        </p>
                    </div>

                    <div class="text-left after_support" style="margin-top:100px;display:none">
                        <p><label class="text-danger">You are required to:</label><br>
                        Take another COVID-19 PCR test on arrival at UAE airports.<br> This test is provided free of charge by UAE government.
                        </p>
                    </div>
                    <br>
                    <div class="text-left" style="margin-top:100px">
                        <p class="text-danger" data-toggle="collapse" data-target="#demo"><label>Click to find out if your are exempted</label></p>
                        <div id="demo" class="collapse">
                            <p>You willl be exempted from testing at departure airport if:</p>
                            <ol>
                                <li>You are a UAE national.</li>
                                <li> A passenger accompanying a first degree UAE national’s relative or domestic workers.</li>
                                <li>Domestic workers escorting a UAE national sponsor during travel. A</li>
                                <li>A child under the age of 12 and passengers who have a moderate or severe disability except visual impairment. <a href="">See List</a></li>
                                <li>There are specific test exemptions as per your country of origin and final desination.</li>
                            </ol>
                        </div>
                    </div>
            </div>
             <!-- end of info for supported countries testing b4 u depart -->
            <!-- info for supported countries testing on arrival -->
             <div class="container othersb4 " style="display:none">
                <div class="row" style="">
                    <h3><b>Testing before you depart</b></h3>
                    <p class="text-danger">You are required to hold verifiable reports of the following tests:</p>

                    <div class="col-lg-4"> 
                        <div class="panel" id="UAE_depart"> 
                            <div class="panel-body">
                                <p>1. A negative COVID-19 RT-PCR test certificate for a test taken more than 72 hours before departure.</p>
                            </div>
                            <center>
                              <a type="button" class="btn bg-1 btn-md ">Book this test $95</a>
                            </center>
                        </div>
                    </div>

                    <div class="col-lg-4">
                       
                    </div>

                    <div class="col-lg-4">
                        <div class="panel" id="UAE_depart"> 
                            <div class="panel-body" >
                                <p>2. Rapid PCR test at departure airport is not required.</p>
                            </div>
                           
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="container othersb4"  style="margin-top:100px;display:none">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">
                            <h3><b>Testing on Arrival</b></h3>
                                <small class="color-1">To see the COVID 19 testing requirements applicable to you, please select the country you are travelling from.</small>
                            </div>
                            <div class="col-sm-6" style="margin-top: 35px;">
                                <select name="" class="form-control" id="countryAfter2" onchange="getPerequisiteAfter2()">
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}"> {{$country->nicename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>              
                    </div>

                    <div class="text-left after_support" style="margin-top:100px;display:none;">
                        <p><label class="text-danger">You are required to:</label><br>
                        Take another COVID-19 PCR test on arrival at UAE airports.<br> This test is provided free of charge by UAE government.
                        </p>
                    </div>

                    <div class="text-left after_others" style="margin-top:100px;display:none;">
                        <p><label class="text-danger">You are <b>NOT</b> required to:</label><br>
                        Take another COVID-19 PCR test on arrival at Dubia international airports.
                        </p>
                    </div>

                    <br>
                    
                    <div class="text-left" style="margin-top:100px">
                        <p class="text-danger" data-toggle="collapse" data-target="#demo"><label>  Click to find out if your are exempted</label></p>
                        
                        <div id="demo" class="collapse"> 
                             <p>You willl be exempted from testing at departure airport if:</p>
                        
                            <ol>
                                <li>You are a UAE national.</li>
                                <li> A passenger accompanying a first degree UAE national’s relative or domestic workers.</li>
                                <li>Domestic workers escorting a UAE national sponsor during travel. A</li>
                                <li>A child under the age of 12 and passengers who have a moderate or severe disability except visual impairment. <a href="">See List</a></li>
                                <li>There are specific test exemptions as per your country of origin and final desination.</li>
                            </ol>
                        </div>
                    </div>
            </div>
            <!-- end of info for supported countries testing on arrival -->
    @elseif($where == 'from')
                 <div class="container" style="padding:0">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">

                                <p>All travellers to the UAE (vaccinated or unvaccinated) must hold a negative COVID 19 PCR test report at the departure airport.</p>
                                <small class="color-1">To see the COVID 19 testing requirements applicable to you, please select the country you are travelling from.</small>
                            </div>
                            <div class="col-sm-6" style="margin-top: 35px;">
                                <select name="" class="form-control" id="country" onchange="getPerequisite()">
                                    <option value="">Select a country</option>
                                    <option value="156">Nigeria</option>
                                   
                                </select>
                            </div>
                        </div>              
                    </div>
                 </div>
                <div class="container support " style="display:none">
                    <div class="row" style="">
                        <h3><b>Testing before you depart</b></h3>
                        <p class="text-danger">You are required to hold verifiable reports of the following tests:</p>

                        <div class="col-lg-4"> 
                            <div class="panel" id="UAE_depart"> 
                                <div class="panel-body">
                                    <p>1. A valid negative COVID-19 PCR test certificate with a QR code for a test conducted within 72 hours, validity should be calculated from the time the sample was collected, prior to departure from an approved health facility.</p>
                                </div>
                                <center>
                                <a type="button" class="btn bg-1 btn-md ">Book this test</a>
                                </center>
                            </div>
                        </div>

                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4">
                            <div class="panel" id="UAE_depart"> 
                                <div class="panel-body" >
                                    <p>2. Register via online national travel portal(Nigeria International Travel Portal ( <a href="https://nitp.ncdcgov.ng" style="color:red; text-decoration:underline;"> https://nitp.ncdcgov.ng </a>) and proceed to fill in the online Health Declaration / Self-Reporting form located on the portal. On this portal, passengers must do the following: <br>
                                    a. Upload your negative COVID 19 PCR test on the portal<br>
                                    b. Select your preferred Sample/Laboratory Collection Center for your PCR test to be done after arrival.<br>
                                    c. Download the permit to Travel Certificate QR code using the  “Get Permit to Travel” button</p>
                                </div>
                                <center>
                                
                                <a type="button" class="btn bg-1 btn-md">I need help with NIT Portal Registration</a>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container support"  style="margin-top:100px;display:none">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">
                            <h3><b>Testing on Arrival</b></h3>
                                <small class="color-5">To see the COVID 19 testing requirements applicable to you, please select the country you are travelling from.</small>
                            </div>
                            
                        </div>              
                    </div>
                    <div class="row" style="">

                        <div class="col-lg-4"> 
                            <div class="panel" id="UAE_depart"> 
                                <div class="panel-body">
                                    <p>1. You do not need to observe the mandatory 7 day self-isolation period. However, you are required to take a COVID 19 PCR test on Day 2 after arrival.</p>
                                </div>
                                <center>
                                <a type="button" class="btn bg-1 btn-md ">Book this test</a>
                                </center>
                            </div>
                        </div>

                        <div class="col-lg-4">

                        </div>
                        <div class="col-lg-4">
                            <div class="panel bg-1" id="UAE_depart1"> 
                                <div class="panel-body" >
                                    <p>2. If vaccinated or Not fully vaccinated: you are required to observe a 7 day self isolation and take two COVID 19 test on Day 2 and Day 7 after arrival.</p>
                                </div>
                                <center>
                                
                                <a type="button" class="btn bg-white btn-md" style="color:black !important">Book this test</a>
                                </center>
                            </div>
                        </div>
                    </div>

                    <div class="text-left after_others" style="margin-top:100px; display:none">
                        <p><label class="text-danger">You are <b>NOT</b> required to:</label><br>
                        Take another COVID-19 PCR test on arrival at Dubia international airports.
                        </p>
                    </div>

                    <div class="text-left after_support" style="margin-top:100px;display:none">
                        <p><label class="text-danger">You are required to:</label><br>
                        Take another COVID-19 PCR test on arrival at UAE airports.<br> This test is provided free of charge by UAE government.
                        </p>
                    </div>
                    <br>
                    <div class="text-left" style="margin-top:100px">
                        <p class="text-danger" data-toggle="collapse" data-target="#demo"><label>Click to find out if your are exempted</label></p>
                        <div id="demo" class="collapse">
                            <p> <b>You willl be exempted from uploading at pre-departure PCR test on NITP if:</b></p>
                            <div class="container">
                                <ul style="list-style-type: circle">
                                    <li>You are a child under the age of 10.</li> 
                                 </ul>
                            </div>
                            <p> <b>You willl be exempted from paying for repeat PCR test 7 days after arrival if you are:</b></p>
                            <div class="container">
                                <ul style="list-style-type: circle">
                                    <li>You are a child under the age of 10.</li> 
                                    <li>A Diplomat</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
    @elseif($where == 'through')
                <div class="container" style="padding:0">
                    <div class="text-center" style="padding-top:59px;padding-bottom:59px;">
                        <div class="row" id="calculator">
                       
                            <div class="col-sm-6 text-left">

                                <p class="color-1">Choose the Country you are travelling from to get information about COVID 19 travel and testing requirements.</p>
                               
                            </div>
                            <div class="col-sm-6" style="margin-top: 10px;">
                                <select name="" class="form-control" id="country" onchange="getPerequisite()">
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{$country->id}}"> {{$country->nicename}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>              
                    </div>
                </div>
                <div class="container support " style="display:none">
                    <div class="row" style="">
                        <h3><b>Testing before you depart</b></h3>
                        <p class="text-danger">You are required to hold verifiable reports of the following tests:</p>

                        <div class="col-lg-4"> 
                            <div class="panel" id="UAE_depart"> 
                                <div class="panel-body">
                                    <p>1. A valid negative COVID-19 PCR test certificate with a QR code for a test conducted within 72 hours.</p>
                                </div>
                                <center>
                                <a type="button" class="btn bg-1 btn-md ">Book this test</a>
                                </center>
                            </div>
                        </div>

                       
                    </div>
                </div>
                <div class="container othersb4 " style="display:none">
                    <div class="row" style="">
                        <div class="col-lg-6"> 
                        <p class="text-danger">Transit passengers from this country are not required to present this certificate during transit through UAE airports unless it is mandated by their destination.</p>
                        </div> 
                    </div>
                </div>
    @endif
</div>
@endsection

@section('script')
    @if($where == 'to')
    <script>

        function getPerequisite()
        {
            var country_id = document.getElementById("country").value;
            console.log(country_id);
            if(country_id == 18 || country_id == 68 || country_id == 99 || country_id == 156 || country_id == 162 ||
            country_id == 200 || country_id == 197 || country_id == 222 || country_id == 232 || country_id == 238 ){
                var $uae = $(".support");
                var $uaeO = $(".othersb4");
                $uaeO.hide();
                $uae.show();
            }else{
                var $uaeO = $(".othersb4");
                var $uae = $(".support");
                $uae.hide();
                $uaeO.show();
                
            }


        
        }
        function getPerequisiteAfter()
        {
            var country_id = document.getElementById("countryAfter").value;
            console.log(country_id);
            if(country_id == 54 || country_id == 56 || country_id == 59 || country_id == 63 || country_id == 66 ||
            country_id == 68 || country_id == 79 || country_id == 222 || country_id == 81 || country_id == 83 || country_id == 89
            || country_id == 99 || country_id == 100 || country_id == 101 || country_id == 102 || country_id == 104 || country_id == 108 || country_id == 110
            || country_id == 114 || country_id == 115 || country_id == 132 || country_id == 118 || country_id == 140 || country_id == 149 || country_id == 146
            || country_id == 162 || country_id == 171 || country_id == 169 || country_id == 174 || country_id == 178 || country_id == 177 || country_id == 188
            || country_id == 193 || country_id == 196 || country_id == 197 || country_id == 201 || country_id == 200 || country_id == 207 || country_id == 209
            || country_id == 210 || country_id == 211 || country_id == 217 || country_id == 218 || country_id == 219 || country_id == 222 || country_id == 223 
            || country_id == 229 || country_id == 232 || country_id == 238 || country_id == 239)
            {
                var $uae = $(".after_support");
                var $uaeO = $(".after_others");
                $uaeO.hide();
                $uae.show();
            }else{
                var $uae = $(".after_support");
                var $uaeO = $(".after_others");
                $uae.hide();
                $uaeO.show();
            }
    
        }

        function getPerequisiteAfter2()
        {
            var country_id = document.getElementById("countryAfter2").value;
            console.log(country_id);
            if(country_id == 54 || country_id == 56 || country_id == 59 || country_id == 63 || country_id == 66 ||
            country_id == 68 || country_id == 79 || country_id == 222 || country_id == 81 || country_id == 83 || country_id == 89
            || country_id == 99 || country_id == 100 || country_id == 101 || country_id == 102 || country_id == 104 || country_id == 108 || country_id == 110
            || country_id == 114 || country_id == 115 || country_id == 132 || country_id == 118 || country_id == 140 || country_id == 149 || country_id == 146
            || country_id == 162 || country_id == 171 || country_id == 169 || country_id == 174 || country_id == 178 || country_id == 177 || country_id == 188
            || country_id == 193 || country_id == 196 || country_id == 197 || country_id == 201 || country_id == 200 || country_id == 207 || country_id == 209
            || country_id == 210 || country_id == 211 || country_id == 217 || country_id == 218 || country_id == 219 || country_id == 222 || country_id == 223 
            || country_id == 229 || country_id == 232 || country_id == 238 || country_id == 239)
            {
                var $uae = $(".after_support");
                var $uaeO = $(".after_others");
                $uaeO.hide();
                $uae.show();
            }else{
                var $uae = $(".after_support");
                var $uaeO = $(".after_others");
                $uae.hide();
                $uaeO.show();
            }
    
        }
    </script>
    @elseif($where == 'from')   
    <script>
        function getPerequisite()
        {
            var country_id = document.getElementById("country").value;
            console.log(country_id);
            if(country_id == 156 ){
                var $uae = $(".support");
                var $uaeO = $(".othersb4");
                $uaeO.hide();
                $uae.show();
            }else{
                var $uaeO = $(".othersb4");
                var $uae = $(".support");
                $uae.hide();
                $uaeO.show();
                
            }
        
        } 
    </script>
    @elseif($where == 'through')
    <script>
            function getPerequisite()
            {
                var country_id = document.getElementById("country").value;
                console.log(country_id);
                if(country_id == 18 || country_id == 68 || country_id == 99 || country_id == 156 || country_id == 162 ||
                country_id == 200 || country_id == 197 || country_id == 222 || country_id == 232 || country_id == 238 ){
                    var $uae = $(".support");
                    var $uaeO = $(".othersb4");
                    $uaeO.hide();
                    $uae.show();
                }else{
                    var $uaeO = $(".othersb4");
                    var $uae = $(".support");
                    $uae.hide();
                    $uaeO.show();
                    
                }
            }
    </script>
    @endif
@endsection