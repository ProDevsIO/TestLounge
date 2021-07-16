@extends('layouts.home')

@section('content')
@section('style')
<style>
    .background-image-holder.parallax-background {
    height: 140%;
    top: -33%;
    }
</style>
@endstyle

    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/banner.jpg">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img alt="logo" class="logo" src="/img/logo-light.png">
                        <h1 class="text-white space-bottom-medium text-center">Identifying and Booking a Covid Test at an Accredited UK Laboratory can be quite daunting .The UK Travel Test Platform helps aggregate Accredited and Vetted Test Providers and provides a simplified guide on how to travel to the UK hassle free.</h1>
                        <a target="_blank" href="#" class="btn btn-primary btn-white">Learn more</a>
                        <a href="{{ url('/booking') }}" class="btn btn-primary btn-filled">Book Now</a>
                    </div>
                </div><!--end of row-->
            </div><!--end of container-->
        </header>
        <section class="clients-2">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client1.png">
						</div>
						
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client2.png">
						</div>
						
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client3.png">
						</div>
						
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client4.png">
						</div>
						
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client5.png">
						</div>
						
						<div class="col-md-2 col-sm-4">
							<img alt="Client Logo" src="img/client6.png">
						</div>
					</div><!--end of row-->
				</div><!--end of container-->
			</section>
        <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xs-12 text-center">
                        <h5 class="text-white">To view your countries color code please click the button below.  </h5>
                    </div>

                    <div class="col-12 col-xs-12 text-center">
                        <a href="https://calculator.prodevs.io/" target="_blank" class="btn btn-primary btn-white">Travel Calculator</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pure-text-centered">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                        <span class="sub alt-font">popular question</span>
                        <h1><strong>HOW DO I GET TESTED?</strong></h1>
                        <ul style="text-align: justify; font-weight:900;list-style-type: square; font-size:18px;font-family:poppins">
                            <li> Book and Pay for your UK travel tests  <a href="{{ url('/booking') }}" class="">Book Now</a>.</p></li>
                            <li>Following Payment, you will immediately receive your Passenger locator Number and Reciept of payment.</li>
                            <li>This number will be used to Complete your Passenger locator form ( insert link to form).</li>
                            <li>You may need to show your completed passenger locator form and reciept of payment for your test before you are allowed to board a flight to the UK; please have this handy at the airport.</li>
                            <li>You will receive your test package on or before the 2nd day of your arrival into the UK. </li>
                            <li> You will carry out  self test on your 2nd day in the UK by following the directions on the pack ( click to watch video on how to carry out a self test.</li>
                            <li> You will carry out  self test on your 2nd day in the UK by following the directions on the pack ( click to watch video on how to carry out a self test.</li>
                            <li>You will visit this site and fill this form ( insert link) to activate your test.</li>
                            <li>Your result will be ready within 24 hours.</li>
                            <li>Repeat same for your Mandatory Day 8 and Optional Day 5 tests.</li>
                        </ul>
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
                        <p><a target="_blank" href="#faq" class="btn btn-primary">FAQs</a>

                            <a href="{{ url('/booking') }}" class="btn btn-primary btn-filled">Book Now</a></p>
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
                                <div class="title"><span>Why Should I Take The Test?</span></div>
                                <div class="text">
                                    <p>
                                        All visitors to the United Kingdom, including British nationals, must show proof
                                        of a negative Covid test within 72 hours of arrival.</p>
                                    <p> Residents of the United Kingdom traveling from the "red list," including South
                                        Africa, India, Namibia, and the United Arab Emirates, are allowed to enter the
                                        country but must quarantine and undergo testing upon arrival.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="title"><span>What Are The Constraints?</span></div>
                                <div class="text">
                                    <p>
                                        Before entering the UK, all visitors must provide a negative test within the
                                        last 72 hours and fill out a Passenger Locator Form.</p>
                                    <p> In England, Scotland, Wales, and Northern Ireland, a traffic light-based
                                        transport system (red, amber, and green) is presently in operation.</p>
                                    <p> Non-UK residents from countries on the red list are now denied access to the
                                        United Kingdom.</p>
                                    <p> Residents returning from destinations on the red list, such as South Africa and
                                        India, must stay in a hotel for ten days.</p>
                                    <p> These passengers must purchase a "quarantine package" before arriving in the UK
                                        - which covers their stay in hotel quarantine, food, and drink while there
                                        (Personal expenses).

                                    </p>

                                </div>
                            </li>

                            <li>
                                <div class="title"><span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM AN AMBER COUNTRY?</span>
                                </div>
                                <div class="text">
                                    <p>
                                        These are the things you must do if you have spent more than ten days in an
                                        amber country or territory before arriving in the United Kingdom.</p>
                                    <p> Before Visiting the United Kingdom</p>
                                    <p>It would help if you accomplish the following before visiting the United
                                        Kingdom:</p>
                                    <ul>


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
                                <div class="title"><span>When you arrive in the UK, you must:</span></div>
                                <div class="text">

                                    <p> For ten days, quarantine at home or wherever you are staying.</p>
                                    <ul>
                                        <li>- On or before Day 2 and on or after Day 8, take a COVID-19 test</li>
                                        <li> - Read up on quarantine and COVID-19 testing.</li>
                                        <li> - The day two and day eight tests are not required for children under the
                                            age of four.
                                        </li>
                                        <li> - If you pay for a private COVID-19 exam under the Test to Release scheme,
                                            you could be able to get out of quarantine sooner.
                                        </li>
                                    </ul><br/>
                                    <p> The amber list isn't all-inclusive. You should not presume that a country or
                                        territory is on the green or red list if it is not on this list.

                                    </p>

                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A RED COUNTRY?</span></div>
                                <div class="text">

                                    <p> These are the things you must do if you visited a nation or territory on the red
                                        list in the 10 days leading up to your arrival in England.</p>
                                    <p> If you have spent the previous 10 days in a country or territory on the red
                                        list, you will be allowed to enter the UK only if you are a British or Irish
                                        national or have residency rights in the UK.</p>
                                    <p> Even if you have been fully vaccinated, you must observe these regulations.</p>

                                    <b>Before Departure for England</b>
                                    <p>It would help if you did the following before going to England:
                                    <ul>
                                        <li> - COVID-19 Test</li>
                                        <li> - Book a hotel package that includes two COVID-19 examinations.</li>
                                        <li> - You should fill out a passenger locator form</li>
                                    </ul></p>
                                    <b>When you get to England</b><br/>
                                    It would be best if you did the following when you arrive in England:
                                    <ul>
                                        <li>- 2 COVID-19 tests during quarantine in a managed hotel</li>
                                    </ul>

                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A GREEN COUNTRY?</span></div>
                                <div class="text">

                                   <p> This section explains what you'll need to do if you're coming to England from one of the countries or territories on the green list. In the past 10 days, you must have only visited or traveled through a green list nation or the United Kingdom, Ireland, the Channel Islands, or the Isle of Man.
                                   </p>
                                    <p>Even if you have been fully vaccinated, you must observe these regulations</p>

                                   <b> Before Going to England</b><br/>
                                   <p> It would help if you did the following before visiting England:</p>
                                  <ul>
                                   <li>-	Take a COVID-19 test to see if you're at risk.</li>
                                     <li> -	Make a reservation and pay for a Day 2 COVID-19 test – to be taken once in England.</li>
                                    <li>  -	Fill out a passenger locator form.</li>
                                  </ul><br/>
                                    <b>When you arrive in England</b><br/>
                                    <ul>
                                  <li> -	On or before the second day after your arrival, you must take a COVID-19 test.</li>
                                        <li>  -	This test is not required for children under the age of four.</li>
                                        <li>  -	Unless the test result is positive, you do not need to quarantine.</li>
                                        <li>  -	If NHS Test & Trace informs you that you traveled to England with someone who tested positive for COVID-19, you must quarantine.</li>
                                    </ul><br/>
                                 <p>   If you've visited one of the countries or territories on the red list, or If you visited or passed through a nation or territory on the red list in the ten days leading up to your arrival in England, you must adhere to the red list requirements.</p>
                                  <p>  If you have been in or through an amber list nation or territory in the ten days leading up to your arrival in England and have not visited a red list country, you must observe the amber list guidelines.</p>
                                   <p> A country or territory can be changed from the green list to the amber or red list if conditions change.</p>
                                    <p>If a country or territory on the green list is on the verge of being demoted to amber, it will be added to the green watch list.</p>
                                   <p> A country or territory may be shifted between lists without warning if situations change suddenly.</p>

                                </div>
                            </li>
                        </ul><!--end of accordion-->

                     </div>

                </div><!--end of row-->
            </div>
        </section>




    </div>


@endsection