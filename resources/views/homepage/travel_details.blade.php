@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/country.css') }}" rel="stylesheet">

    <style>
        #cent {
            font-size: 30px;
        }
        #all{
                color: #428bca !important;
                text-decoration: underline;
        }

        @media only screen and (max-width: 600px) {
            .nav-justified > li {
                float: left;
                width: 50%;
            }

            .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
                padding: 10px;
            }

            .nav-pills > li > a, .nav-pills > li > a:focus, .nav-pills > li > a:hover {
                padding: 10px;
            }

            .nav-pills > li + li {
                margin-left: 0px;
            }

            .if_full {
                margin-top: 40px;
                margin-bottom: 39px;
            }
        }
    </style>
@endsection
@section('content')
    <header class="title" style="max-height: 400px !important;">
        <div class="background-image-holder parallax-background">
            @if($countries->image == null)
                <img class="background-image" alt="Background Image" src="/img/pass2.jpg">
            @else
                <img class="background-image" alt="Background Image" src="{{ url('/page_img/'. $countries->image)}}">
            @endif
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12 ">

                    <h1 id="cent" class="text-white">Home > <a style="color: white"
                                                               href="{{ url( env('APP_URL', 'http://127.0.0.1:8000/'). 'view/country/' .$countries->country->slug_name) }}">{{ ucfirst(strtolower(optional(optional($countries)->country)->name))}}</a> @if($action == "departure")
                            > Pre-departure
                        @else
                            > Arrival
                        @endif</h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>

    <section class="container-fluid bg-white" style="padding-top: 0px">
        <div class="row">
            <div class="card">
                <div clas="col-md-12">
                    <ul class="nav nav-pills nav-justified">
                        <li class="active" style="border-right: 2px solid #d7d0d0">
                            <a data-toggle="pill" href="#menu1" class="if_full"><b>IF FULLY <br/>
                                    VACCINATED</b> </a>
                        </li>
                        <li><a data-toggle="pill" href="#menu2"> <b>IF UNVACCINATED /<br/> PARTIALLY VACCINATED</b> </a>
                        </li>
                    </ul>

                    @if($action == "departure")
                        <div class="tab-content">
                            <br><br>
                            <div id="menu1" class="tab-pane fade in active container">

                                @php
                            
                                     $products = $countries->products;
                                     $string_product ="";
                                     $string_product .= '<div class="row">';
                                     foreach($products as $product)
                                     {
                                        $slug = $product->slug;
                                        $string_product .= '<div class="col-md-3 text-center" >
                                                                    <div class="card" style=" background-color: #1E50A0!important;color:white;min-height: 180px;">
                                                                        <div class="card-body " style="padding: 30px">
                                                                        <p style="color:white !important">
                                                                        '.$product->name.'</p>
                                                                        <a href="/view/product/'.$slug.'" id="add_button" class="btn btn-">View Page</a>
                                                                        </div>
                                                                    </div>
                                                            </div>';
                                     }
                                     $string_product .="</div>";

                                     $departure_vaccinated = optional($countries)->departure_vaccinated;

                                    $departure_vaccinated = str_replace('<a href="loop">All Test(s)</a>', "$string_product",$departure_vaccinated);
                                  
                                    $departure_vaccinated = str_replace('<a href="all"', "<a id='all' href='".url(env('APP_URL')."product/country/".$countries->country->slug_name)."'",$departure_vaccinated);

                                    $departure_vaccinated = str_replace("<a href", "<a href",$departure_vaccinated);
                                @endphp
                                {!! $departure_vaccinated !!}
                            </div>
                            <div id="menu2" class="tab-pane fade container">
                                @php
                            
                                     $products = $countries->products;
                                     $string_product ="";
                                     $string_product .= '<div class="row">';
                                     foreach($products as $product)
                                     {
                                        $slug = $product->slug;
                                        $string_product .= '<div class="col-md-3 text-center" >
                                                                    <div class="card" style=" background-color: #1E50A0!important;color:white;min-height: 180px;">
                                                                        <div class="card-body " style="padding: 30px">
                                                                        <p style="color:white !important">
                                                                        '.$product->name.'</p>
                                                                        <a href="/view/product/'.$slug.'" id="add_button" class="btn btn-">View Page</a>
                                                                        </div>
                                                                    </div>
                                                            </div>';
                                     }
                                     $string_product .="</div>";
                                     $departure_unvaccinated  = optional($countries)->departure_unvaccinated;

                                    $departure_unvaccinated  = str_replace('<a href="loop">All Test(s)</a>', "$string_product", $departure_unvaccinated );
                                  
                                    $departure_unvaccinated = str_replace('<a href="all"', "<a id='all' href='".url(env('APP_URL')."product/country/".$countries->country->slug_name)."'",$departure_unvaccinated);

                                    $departure_unvaccinated = str_replace("<a href", "<a href",$departure_unvaccinated);
                                @endphp
                                {!! $departure_unvaccinated !!}
                            </div>
                        </div>
                    @else
                        <div class="tab-content">
                            <br><br>
                            <div id="menu1" class="tab-pane fade in active container" style="padding: 0px 30px">

                                @php
                                     $products = $countries->products;
                                     $string_product ="";
                                     $string_product .= '<div class="row">';
                                     foreach($products as $product)
                                     {
                                        $slug = $product->slug;
                                        $string_product .= '<div class="col-md-3 text-center" >
                                                                    <div class="card" style=" background-color: #1E50A0!important;color:white;min-height: 180px;">
                                                                        <div class="card-body " style="padding: 30px">
                                                                        <p style="color:white !important">
                                                                        '.$product->name.'</p>
                                                                        <a href="/view/product/'.$slug.'" id="add_button" class="btn btn-">View Page</a>
                                                                        </div>
                                                                    </div>
                                                            </div>';
                                     }
                                     $string_product .="</div>";
                                    $arrival_vaccinated = optional($countries)->arrival_vaccinated;
                                    $arrival_vaccinated = str_replace('<a href="loop">All Test(s)</a>', "$string_product",$arrival_vaccinated);
                                  
                                    $arrival_vaccinated = str_replace('<a href="all"', "<a id='all' href='".url(env('APP_URL')."product/country/".optional($countries->country)->slug_name)."'",$arrival_vaccinated);

                                 
                                    $arrival_vaccinated = str_replace("<a href", "<a href",$arrival_vaccinated);
                                @endphp
                                {!! $arrival_vaccinated !!}
                            </div>
                            <div id="menu2" class="tab-pane fade container">
                                @php
                                
                                     $products = $countries->products;
                                     $string_product ="";
                                     $string_product .= '<div class="row">';
                                     foreach($products as $product)
                                     {
                                        $slug = $product->slug;
                                        $string_product .= '<div class="col-md-3 text-center" >
                                                                    <div class="card" style=" background-color: #1E50A0!important;color:white;min-height: 180px;">
                                                                        <div class="card-body " style="padding: 30px">
                                                                        <p style="color:white !important">
                                                                        '.$product->name.'</p>
                                                                        <a href="/view/product/'.$slug.'" id="add_button" class="btn btn-">View Page</a>
                                                                        </div>
                                                                    </div>
                                                            </div>';
                                     }
                                    $string_product .="</div>";
                                    $arrival_unvaccinated = optional($countries)->arrival_unvaccinated;

                                    $arrival_unvaccinated = str_replace('<a href="loop">All Test(s)</a>', "$string_product",$arrival_unvaccinated);
    
                                    $arrival_unvaccinated = str_replace('<a href="all"', "<a id='all' class='btn btn-danger' href='".url(env('APP_URL')."product/country/".optional($countries->country)->slug_name)."'",$arrival_unvaccinated);
                                  
                                    $arrival_unvaccinated = str_replace("<a href", "<a href",$arrival_unvaccinated);
                                @endphp
                                {!! $arrival_unvaccinated !!}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-12 p-2">
                    <div class="container">
                        {!! optional($countries)->faq !!}
                    </div>

                </div>

            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>

        function redirect(id) {
            var country_id = id;
            var action = document.getElementById("action").value;
            console.log(country_id, action);
            window.location = '/travel/details/' + country_id + '/' + action;
        }


    </script>
@endsection