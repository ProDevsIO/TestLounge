@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/country.css') }}" rel="stylesheet">
   
    <style>
      
       
    </style>
@endsection
@section('content')
    <header class="title" style="max-height: 300px !important;">
        <div class="background-image-holder parallax-background">
            <img class="background-image" alt="Background Image" src="/img/pass2.jpg">
        </div>
        <div class="container align-bottom">
            <div class="row">
                <div class="col-xs-12 ">

                    <h1 id="cent" class="text-white">{{optional(optional($countries)->country)->name}}</h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>

    <section class="container-fluid bg-white">
        <div class="row">
            <div class="card">
                @if($action == "departure")
                <div clas="col-md-12 p-2">
                    <center><h1 id="travel-head"> <b>Pre-departure</b></h1></center>
                    
                    <ul class="nav nav-pills nav-justified">
                        
                        <li class="active"><a data-toggle="pill" href="#menu1"><b>IF FULLY VACCINATED</b> </a><br></li>
                        
               
                        <li><a data-toggle="pill" href="#menu2"> <b>IF UNVACCINATED / PARTIALLY VACCINATED</b> </a></li>
                   
                    </ul>

                    <div class="tab-content">
                        <br><br>
                        <div id="menu1" class="tab-pane fade in active container" >
                           {!! optional($countries)->departure_vaccinated!!}
                        </div>
                        <div id="menu2" class="tab-pane fade container">
                             {!! optional($countries)->depature_unvaccinated!!}
                        </div>
                    </div>
                   
                   
                </div>
                @else
                <div clas="col-md-12 p-2">
                    <center><h1 id="travel-head"> <b>Arrival</b></h1></center>
                    
                    <ul class="nav nav-pills nav-justified">
                        
                        <li class="active"><a data-toggle="pill" href="#menu1"><b>IF FULLY<br> VACCINATED</b> </a></li>
                        
               
                        <li><a data-toggle="pill" href="#menu2"> <b>IF UNVACCINATED / PARTIALLY VACCINATED</b> </a></li>
                   
                    </ul>

                    <div class="tab-content">
                        <br><br>
                        <div id="menu1" class="tab-pane fade in active container" >
                           {!!optional($countries)->arrival_vaccinated!!}
                        </div>
                        <div id="menu2" class="tab-pane fade container">
                             {!! optional($countries)->arrival_unvaccinated!!}
                        </div>
                    </div>
                   
                   
                </div>
                @endif
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
     
    function redirect(id)
    {
        var country_id = id;
        var action = document.getElementById("action").value;
        console.log(country_id, action);
        window.location = '/travel/details/'+ country_id+ '/'+ action;
    }

   
</script>
@endsection