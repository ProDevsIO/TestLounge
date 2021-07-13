@extends('layouts.home')

@section('content')

    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/banner.jpg">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img alt="logo" class="logo" src="/img/logo-light.png">
                        <h1 class="text-white space-bottom-medium">Are you traveling to the UK? And you want to make your UK Covid Testing Booking?</h1>
                        <a target="_blank" href="#" class="btn btn-primary btn-white">Learn more</a>
                        <a href="{{ url('/booking') }}" class="btn btn-primary btn-filled">Book Now</a>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>

        <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-sm-6 col-xs-12 pull-left">
                        <h3 class="text-white">Covid19 Tests for International Arrivals – Day 2 and 8 Amber Country </h3>
                    </div>

                    <div class="col-sm-4 col-xs-12 pull-right text-right">
                        <a href="/booking" class="btn btn-primary btn-white">Self-Test Available Here</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="feature-selector">

            <div class="container">
                <ul class="selector-content">
                    <li class="clearfix active">
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <h1>Are you planning a trip to the United Kingdom? Here's what you should know;</h1>
                            </div>
                        </div><!--end of row-->

                        <div class="row">
                            <div class="col-sm-6">
                                <h3><b>Who is eligible to travel?</b></h3><br/>
                                <p>
                                    All visitors to the United Kingdom, including British nationals, must show proof of a negative Covid test within 72 hours of arrival.</p>
                                <p>
                                    Residents of the United Kingdom traveling from the "red list," including South Africa, India, Namibia, and the United Arab Emirates, are allowed to enter the country but must quarantine and undergo testing upon arrival.
                                </p>
                            </div>

                            <div class="col-sm-6">
                                <h3><b>What are the constraints?</b></h3><br/>
                                <p>
                                    Before entering the UK, all visitors must provide a negative test within the last 72 hours and fill out a Passenger Locator Form.</p>
                                <p>   In England, Scotland, Wales, and Northern Ireland, a traffic light-based transport system (red, amber, and green) is presently in operation.</p>
                                <p>    Non-UK residents from countries on the red list are now denied access to the United Kingdom.
                                </p>
                            </div>
                        </div><!--end of row-->
                    </li><!--end of individual feature content-->

                    {{--<li class="clearfix">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 text-center">--}}
                                {{--<h1>Many appealing ways to present information</h1>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}

                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}
                    {{--</li><!--end of individual feature content-->--}}

                    {{--<li class="clearfix">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 text-center">--}}
                                {{--<h1>Several appealing ways to present information</h1>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}

                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}
                    {{--</li><!--end of individual feature content-->--}}

                    {{--<li class="clearfix">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-sm-12 text-center">--}}
                                {{--<h1>Numerous appealing ways to present information</h1>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}

                        {{--<div class="row">--}}
                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}

                            {{--<div class="col-sm-6">--}}
                                {{--<p class="lead">--}}
                                    {{--Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem.--}}
                                {{--</p>--}}
                            {{--</div>--}}
                        {{--</div><!--end of row-->--}}
                    {{--</li><!--end of individual feature content-->--}}


                </ul>
            </div>
        </section>

        <div class="text-center">
           <p style="color: red"> More content is coming in... Platform is still Under Construction<br/></p>
        </div>

        {{--<section class="video-inline">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-6 col-sm-12">--}}
                        {{--<h1 class="space-bottom-medium">Pivot is an effortlessly simple startup template with usable features.</h1>--}}
                        {{--<p class="lead space-bottom-medium">--}}
                            {{--Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.--}}
                        {{--</p>--}}
                        {{--<a href="#" class="btn btn-primary">See Features</a>--}}
                        {{--<a href="#" class="btn btn-primary btn-text-only">Learn More</a>--}}
                    {{--</div>--}}

                    {{--<div class="col-md-6 col-sm-12">--}}
                        {{--<div class="inline-video-wrapper">--}}
                            {{--<video controls="">--}}
                                {{--<source src="video/video.webm" type="video/webm">--}}
                                {{--<source src="video/video.mp4" type="video/mp4">--}}
                                {{--<source src="video/video.ogv" type="video/ogg">--}}
                            {{--</video>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div><!--end of row-->--}}
            {{--</div><!--end of container-->--}}
        {{--</section>--}}

        {{--<section class="no-pad clearfix">--}}

            {{--<div class="col-md-6 col-sm-12 no-pad">--}}

                {{--<div class="feature-box">--}}

                    {{--<div class="background-image-holder overlay">--}}
                        {{--<img class="background-image" alt="Background Image" src="img/hero1.jpg">--}}
                    {{--</div>--}}

                    {{--<div class="inner">--}}
                        {{--<span class="alt-font text-white">Pivot Stands Out</span>--}}
                        {{--<h1 class="text-white">Here is a large, attention seeking feature box</h1>--}}
                        {{--<p class="text-white">--}}
                            {{--Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.--}}
                        {{--</p>--}}
                        {{--<a href="#" class="btn btn-primary btn-white">Tell Me More</a>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}

            {{--<div class="col-md-6 col-sm-12 no-pad">--}}

                {{--<div class="feature-box">--}}

                    {{--<div class="background-image-holder overlay">--}}
                        {{--<img class="background-image" alt="Background Image" src="img/box2.jpg">--}}
                    {{--</div>--}}

                    {{--<div class="inner">--}}
                        {{--<span class="alt-font text-white">Pivot Stands Out</span>--}}
                        {{--<h1 class="text-white">Here is a large, attention seeking feature box</h1>--}}
                        {{--<p class="text-white">--}}
                            {{--Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.--}}
                        {{--</p>--}}
                        {{--<a href="#" class="btn btn-primary btn-white">Tell Me More</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</section>--}}

        {{--<section class="clients-2">--}}
            {{--<div class="container">--}}
                {{--<div class="row">--}}
                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client1.png">--}}
                    {{--</div>--}}

                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client2.png">--}}
                    {{--</div>--}}

                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client3.png">--}}
                    {{--</div>--}}

                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client4.png">--}}
                    {{--</div>--}}

                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client5.png">--}}
                    {{--</div>--}}

                    {{--<div class="col-md-2 col-sm-4">--}}
                        {{--<img alt="Client Logo" src="img/client6.png">--}}
                    {{--</div>--}}
                {{--</div><!--end of row-->--}}
            {{--</div><!--end of container-->--}}
        {{--</section>--}}
    </div>


@endsection