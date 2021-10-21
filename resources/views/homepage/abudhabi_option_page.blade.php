@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/uae_page.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="main-container" style="margin-bottom: 50px">




    <header class="page-header" style="height: 450px;padding-top: 50px">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/abudabi4.jpg">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center" id="banner-writeup-container">
                    <div class="row">
                        <div class="col-md-6 "style=" padding-top:200px">
                            <h2 class="text-white space-bottom-medium text-left" style="margin-top: 20px" id="banner-writeup"><b>Now travelling to Abu Dhabi?</b></h2>
                           
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
                        <p class="text-danger">Please Note that there are additional COVID-19 <br>
                         requirements for people travelling into Abu Dhabi.</p>
                    </div>
                    <div class="container-fluid" style="margin-top:50px">
                    <h3 ><b>Choose the appropriate options</b></h3>
                    </div>    
               
                    <div class="card-container double-container fs-20 text-center">
                        <a href="/view/from_o_uae/UAE" class="link text-white">
                            <div class="card bg-10 fw-700">
                                    <div class="inner"><v>I am travelling from outside UAE</v></div>
                            </div>
                        </a>
                        <a href="{{url('/view/from_within_uae/UAE')}}"  class="link text-white">
                            <div class="card bg-10 fw-700">
                                <div class="inner"><v>I am travelling from within UAE</v></div>
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