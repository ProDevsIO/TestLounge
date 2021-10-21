@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/uae_page.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-container" style="margin-bottom: 50px">




    <header class="page-header" style="height: 450px;padding-top: 50px">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/abudabi3.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" id="banner-writeup-container">
                    <div class="row">
                        <div class="col-md-6 "style=" padding-top:200px">
                            <h2 id="h9" class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>UNITED ARAB EMIRATES</b></h2>
                           
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
                    <div class="container-fluid" style="margin-top:50px">
                    <h3 ><b>Choose the appropriate options</b></h3>
                    </div>    
               
                    <div class="card-container double-container fs-20 text-center">
                        <a href="/view/to/UAE" class="link">
                            <div class="card bg-3 fw-700 ">
                                    <div class="inner">
                                        <v>
                                        Are you travelling to United Arab Emirates?
                                        </v>
                                    </div>
                            </div>
                        </a>
                        <a href="/view/from/UAE" class="link text-white">
                            <div class="card bg-2 fw-700 ">
                                    <div class="inner">
                                        <v>
                                        Are you departing from United Arab Emirates?
                                        </v>
                                    </div>
                            </div>
                        </a>
                        
                        <a href="/view/through/UAE" class="link text-white">
                            <div class="card bg-11 fw-700">
                                    <div class="inner"><v>Are you transiting through United Arab Emirates</v></div>
                            </div>
                        </a>
                        <a href="{{url('/view/abudhabi')}}"  class="link text-white">
                            <div class="card bg-10 fw-700">
                                <div class="inner"><v>Are you travelling to Abu Dhabi?</v></div>
                            </div>
                        </a>
                       
                    </div>
                </div>
            </div>
       
</div>
@endsection

@section('script')
    <script>

       
    </script>
@endsection