@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/country.css') }}" rel="stylesheet">
    <style>
        option{
            background-color: black;
            color:white;
        }
        option:checked{
            background-color: white !important;
            color:black;
        }
        select option:hover {
            box-shadow: 0 0 10px 100px #000 inset;
        }
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

                    <h1 id="cent" class="text-white">{{$countries->name}}</h1>
                </div>
                <br><br>
            </div>
            <!--end of row-->
        </div>
        <!--end of container-->
    </header>

    <section class="container bg-white">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4"><h3>Choose the appropriate travelling option</h3></div>
            <div class="col-md-5">
                            <select name="" class="form-control" id="action" onchange="redirect('{{$countries->id}}')">
                                <option value="">Select a country</option>
                                <option value="departure">Departure</option>
                                <option value="arrival">On arrival</option>
                               
                            </select>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div id="loader"></div>
    </section>

@endsection
@section('script')
<script>
    function redirect(id)
    {
        Rocket.loader({
            target: '#loader',
            body: 'Loading'
        });

        var country_id = id;
        var action = document.getElementById("action").value;
        console.log(country_id, action);
        window.location = '/travel/details/'+ country_id+ '/'+ action;
    }
</script>
@endsection