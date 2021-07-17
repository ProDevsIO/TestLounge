@extends('layouts.home')

@section('content')
@section('style')
<style>
    .background-image-holder.parallax-background {
    height: 140%;
    top: -33%;
    }
    .content{
        width:50vw;
        margin:auto;
    }
    .circle-container{
        text-align:center;
        position:absolute;
        bottom: 500px;
        display:flex;
        justify-content:space-around;
        width:100%;
        left:0;
    }
    .circle{
        background:#fff;
        width:150px;
        height:150px;
        border-radius:150px;
        display:flex;
        align-items:center;
        justify-content:space-around;
        color:#000;
        font-weight:bold;
        font-size:16px;
        text-align:center;
        padding:10px;
        margin:auto;
    }
    .content .tab-1{
        text-align:center;
        padding: 50px 15px 70px 21px;
        background:#1D3A65;
        color:#fff;
    }
    .tab-2{
        padding:0 10px 30px 10px;
        background:#BF0102;
        color:#fff;
    }
    .tab-3{
        padding:0 10px 30px 10px;
        background:#FBC001;
    }
    .tab-4{
        background:#69AF42;
        padding:0 10px 30px 10px;
        color:#fff;
    }
    .content .tab{
        box-shadow: 5px 5px 0 rgba(2, 23, 64, 1);
    }
    .tab-container{
        position:relative;
    }
    .triple-container{
        display:grid;
        grid-template-columns:repeat(3, 30%);
        justify-content:space-between;
        margin-top:15px;
    }
    .triple-container .tab2{
        position:relative;
        padding-top:100px;
        margin-bottom:100px;
    }
    li{
        margin-bottom:10px;
    }

    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */

    /* start laptop version */
    @media screen and (max-width:2450px){
        .content{
            width:80vw;
        }
    }

    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */

    /* tab version */
    @media screen and (max-width:1024px) {
        .content{
            width:95vw;
        }
        .circle-container{
            bottom:600px;
        }
    }

    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */

    /* mobile version */
    @media screen and (max-width: 800px) {
        .triple-container{
            display:block;
            margin-top:100px;
        }
        .circle-container{
            bottom:175px;
        }
        .triple-container .tab2{
            position:relative;
            padding-top:100px;
            /* bottom:50px; */
        }
    }

    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */
    /* break */

    /* mobile version */
    @media screen and (max-width: 468px) {
        
        .circle-container{
            bottom: 255px;
        }

        #amber{
            bottom: 465px !important;
        }
        
    }
</style>
@endsection

    <div class="main-container">
        <header class="page-header">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/banner.jpg">
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img alt="logo" class="logo" src="/img/logo-light.png">
                        <h1 class="text-white space-bottom-medium text-center">We simplify the process of booking and making payments for Covid 19 UK Travel Tests for both travellers and travel agents. You’ll get up to date information on UK travel requirements and access to accredited test providers in the UK ensuring a  hassle free travel experience.</h1>
                        <a href="/#popular" class="btn btn-primary  btn-white">Learn more</a>
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
			</section><br/>
        <div class="content">
            <div class="header tab-1 tab">
               <h5 class="text-white">As we continue to monitor the global landscape</h5> 
            </div>
            <div class="triple-container">
                <div class="tab-2 tab tab2">
                    <div class="circle-container" style="margin-bottom:40px;">
                        <div class="circle tab"><a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" style="text-decoration:underline;"><span>Red<br />Countries</span></a></div>
                    </div>

                    <ol style="font-size:18px;font-family:poppins;margin:top:10px;list-style-type:square;">
                        <li> These are entry requirements for countries on the Red List</li>
                        <li>  Must Complete a Passenger Locator Form pre depature to the UK</li>
                        <li>10 Full days of Mandatory Qurantine in a Government Approved  Hotel inclusive of 2 PCR Tests on Day 2 and Day 8  ( where date of arrival is day 0)</li>
                    </ol>
                </div>
                <div class="tab-3 tab tab2">
                    <div class="circle-container" style="margin-bottom:40px;" id="amber">
                        <div class="circle tab"><a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" style="text-decoration:underline;"><span>Amber<br />Countries</span></a></div>
                    </div>
                   
                    <ol style="color: #fff;font-size:18px;font-family:poppins;list-style-type:square;">
                    <h5 style="color: #fff;font-size:18px;font-family:poppins;">(Vaccinated)</h5>
                        <li>These are travellers arriving from Amber list Countries who have received 2 doses of an NHS administered Covid vaccine 14 days before travel into the UK</li>
                        <li>Require a Negative  Covid 19 PCR Test 72 hours pre- dedepature to the UK ( children 10 years and below do not require a pre- depature test)</li>
                        <li>Must Complete a Passenger Locator Form pre depature to the UK</li>
                       <li>Do not require Quarantine</li>
                       <li> Mandatory Day 2 Post UK Arrival Test ( children 4 years and below do not require a Day 2 Test)</li>
                       <p>(Book an Amber List (Vaccinated)Travel Test/ Package)</p>
                    </ol>
                    
                </div>
                <div class="tab-4 tab tab2">
                    <div class="circle-container" style="margin-bottom:40px;">
                        <div class="circle tab"><a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" style="text-decoration:underline;"><span>Green<br />Countries</span></a></div>
                    </div>

                    <ol class="text-center" style="font-size:18px;font-family:poppins;margin:top:10px;list-style-type:square;">
                        <li>Travellers from Green List Countries</li>
                        <li>Require a Negative PCR Test 72 hours before pre depature into the UK</li>
                        <li>Do not require Quarantine </li>
                        <li>Mandatory Day 2 Post UK Arrival Test </li>
                        <p>(Book a Green List Travel Test /Package)</p>
                    </ol>
                </div>
            </div>
        </div>
        <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                    <div class="col-xs-12 text-center">
                        <h5 class="text-white">To view a country's color code please click the button below.  </h5>
                    </div>

                    <div class="col-12 col-xs-12 text-center">
                        <a href="https://calculator.prodevs.io/" target="_blank" class="btn btn-primary btn-white">Travel Calculator</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="pure-text-centered" id="popular">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center">
                        <span class="sub alt-font">popular question</span>
                        <h1><strong>HOW DO I GET TESTED?</strong></h1>
                        <ul style="text-align: justify; font-weight:900;list-style-type: square; font-size:18px;font-family:poppins">
                            <li>Run a PCR Test in your country of origin 72 hours before your trip to the UK. Evidence of a negative PCR Test is Mandatory for entry into the UK. You can book your test here ( insert booking link that takes to a drop down to select various countries  but only Nigeria will show for now and only Medbury Laboratory when you click on Nigeria)</li>
                            <li> Book and Pay for your UK travel tests  <a href="{{ url('/booking') }}" class="">Book Now</a>. Evidence of booking and payment is Mandatory before you can board a flight to the UK</p></li>
                            <li>Following Payment, you will immediately receive your Passenger locator Number and receipt of payment.</li>
                            <li>This number will be used to Complete your Passenger locator form <a href=" https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion">Here</a>.You must show evidence that you have completed your Passenger locator form before you will be allowed to board a flight into the UK</li>
                            <li>You may also need to show your reciept of payment for your UK test before you are allowed to board a flight to the UK; <br>
                                Please have these documents handy at the airport ; both electronic and printed copies are accepted by airlines</li>
                            <li>Following your arrival into the UK, you will receive the  test packages you booked for on or before the 2nd day of your  arrival.</li>
                            <li>You must carry out a self test on your 1st or 2nd day of arrival into the UK . The directions on how to carry out a self test, how to activate your test and where to send your test samples to are all written  on the pack  you will receive.( click to watch video on how to carry out a self test) <a href="https://youtu.be/8lo6g-TYZ-c">Watch</a>.</li>
                            <li> Following your self test, you will drop your sample at the designated points nearest to you as directed on the test pack you will recieve </li>
                            <li> You will also be expected to "Activate" your test by visiting the website that will be indicated on the pack you will receive and by following the simple instructions on this website. This is required to analyse your test and send your results </li>
                           <li> If you have  purchased a Fit to Fly Test or Package, for your exit out of the UK to another country, check the country guidelines for when you are expected to carry out your PCR test before flying. </li>
                        </ul>
                        <p class="lead" style="text-align: justify;font-family:poppins;font-weight:300;">
                            You can also get more information about travel requirements for other countries <a href="https://calculator.prodevs.io/" style="color:#428bca; text-decoration:none;font-size:18px;"> here </a>. <br>
                            Follow the guidelines above on how to carry out a self test and activate your tests <br>

                            All test Results are available 24 hours from reciept of samples in the Laboratory <br><br>

                            * Disclaimer : <br>
                            Country guidelines change from time to time and the information provided here is a guide. Please ensure to confirm country and airline regulations with relevant authorities at your destination . UKTravelTests will not take any responsibility for challenges that arise as a result of information provided here
                        </p>
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
                        <p><a href="/#faq" class="btn btn-primary">FAQs</a>

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
                                    <p style="font-size:18px;font-family:poppins">
                                        All visitors to the United Kingdom, including British nationals, must show proof
                                        of a negative Covid test within 72 hours of arrival.</p>
                                    <p style="font-size:18px;font-family:poppins"> Residents of the United Kingdom traveling from the "red list," including South
                                        Africa, India, Namibia, and the United Arab Emirates, are allowed to enter the
                                        country but must quarantine and undergo testing upon arrival.
                                    </p>
                                </div>
                            </li>

                            <li>
                                <div class="title"><span>What Are The Constraints?</span></div>
                                <div class="text">
                                    <p style="font-size:18px;font-family:poppins">
                                        Before entering the UK, all visitors must provide a negative test within the
                                        last 72 hours and fill out a Passenger Locator Form.</p>
                                    <p style="font-size:18px;font-family:poppins"> In England, Scotland, Wales, and Northern Ireland, a traffic light-based
                                        transport system (red, amber, and green) is presently in operation.</p>
                                    <p style="font-size:18px;font-family:poppins"> Non-UK residents from countries on the red list are now denied access to the
                                        United Kingdom.</p>
                                    <p style="font-size:18px;font-family:poppins"> Residents returning from destinations on the red list, such as South Africa and
                                        India, must stay in a hotel for ten days.</p>
                                    <p style="font-size:18px;font-family:poppins"> These passengers must purchase a "quarantine package" before arriving in the UK
                                        - which covers their stay in hotel quarantine, food, and drink while there
                                        (Personal expenses).

                                    </p>

                                </div>
                            </li>

                            <li>
                                <div class="title"><span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM AN AMBER COUNTRY?</span>
                                </div>
                                <div class="text" >
                                    <p style="font-size:18px;font-family:poppins">
                                        These are the things you must do if you have spent more than ten days in an
                                        amber country or territory before arriving in the United Kingdom.</p>
                                    <p style="font-size:18px;font-family:poppins"> Before Visiting the United Kingdom</p>
                                    <p style="font-size:18px;font-family:poppins">It would help if you accomplish the following before visiting the United
                                        Kingdom:</p>
                                    <ul style="font-size:18px;font-family:poppins">


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

                                    <p style="font-size:18px;font-family:poppins"> For ten days, quarantine at home or wherever you are staying.</p>
                                    <ul style="font-size:18px;font-family:poppins">
                                        <li>- On or before Day 2 and on or after Day 8, take a COVID-19 test</li>
                                        <li> - Read up on quarantine and COVID-19 testing.</li>
                                        <li> - The day two and day eight tests are not required for children under the
                                            age of four.
                                        </li>
                                        <li> - If you pay for a private COVID-19 exam under the Test to Release scheme,
                                            you could be able to get out of quarantine sooner.
                                        </li>
                                    </ul><br/>
                                    <p style="font-size:18px;font-family:poppins"> The amber list isn't all-inclusive. You should not presume that a country or
                                        territory is on the green or red list if it is not on this list.

                                    </p>

                                </div>
                            </li>
                            <li>
                                <div class="title">
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A RED COUNTRY?</span></div>
                                <div class="text">

                                    <p style="font-size:18px;font-family:poppins"> These are the things you must do if you visited a nation or territory on the red
                                        list in the 10 days leading up to your arrival in England.</p>
                                    <p style="font-size:18px;font-family:poppins"> If you have spent the previous 10 days in a country or territory on the red
                                        list, you will be allowed to enter the UK only if you are a British or Irish
                                        national or have residency rights in the UK.</p>
                                    <p style="font-size:18px;font-family:poppins"> Even if you have been fully vaccinated, you must observe these regulations.</p>

                                    <b>Before Departure for England</b>
                                    <p style="font-size:18px;font-family:poppins">It would help if you did the following before going to England:
                                    <ul style="font-size:18px;font-family:poppins">
                                        <li> - COVID-19 Test</li>
                                        <li> - Book a hotel package that includes two COVID-19 examinations.</li>
                                        <li> - You should fill out a passenger locator form</li>
                                    </ul></p>
                                    <b>When you get to England</b><br/>
                                    It would be best if you did the following when you arrive in England:
                                    <ul style="font-size:18px;font-family:poppins">
                                        <li>- 2 COVID-19 tests during quarantine in a managed hotel</li>
                                    </ul>

                                </div>
                            </li>
                            <li>
                                <div class="title" >
                                    <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A GREEN COUNTRY?</span></div>
                                    <div class="text">

                                        <p style="font-size:15px;font-family:poppins"> This section explains what you'll need to do if you're coming to England from one of the countries or territories on the green list. In the past 10 days, you must have only visited or traveled through a green list nation or the United Kingdom, Ireland, the Channel Islands, or the Isle of Man.
                                        </p>
                                            <p style="font-size:15px;font-family:poppins">Even if you have been fully vaccinated, you must observe these regulations</p>

                                        <b> Before Going to England</b>
                                        <p style="font-size:15px;font-family:poppins"> It would help if you did the following before visiting England:</p>
                                        <ul style="font-size:15px;font-family:poppins">
                                        <li>-	Take a COVID-19 test to see if you're at risk.</li>
                                            <li> -	Make a reservation and pay for a Day 2 COVID-19 test – to be taken once in England.</li>
                                            <li>  -	Fill out a passenger locator form.</li>
                                        </ul>
                                            <b>When you arrive in England</b><br/>
                                            <ul style="font-size:15px;font-family:poppins">
                                                <li> -	On or before the second day after your arrival, you must take a COVID-19 test.</li>
                                                <li>  -	This test is not required for children under the age of four.</li>
                                                <li>  -	Unless the test result is positive, you do not need to quarantine.</li>
                                                <li>  -	If NHS Test & Trace informs you that you traveled to England with someone who tested positive for COVID-19, you must quarantine.</li>
                                            </ul>
                                        <p style="font-size:15px;font-family:poppins">    If you've visited one of the countries or territories on the red list, or If you visited or passed through a nation or territory on the red list in the ten days leading up to your arrival in England, you must adhere to the red list requirements.</p>
                                        <p style="font-size:15px;font-family:poppins">  If you have been in or through an amber list nation or territory in the ten days leading up to your arrival in England and have not visited a red list country, you must observe the amber list guidelines.</p>
                                        <p style="font-size:15px;font-family:poppins"> A country or territory can be changed from the green list to the amber or red list if conditions change.</p>
                                            <p style="font-size:15px;font-family:poppins">If a country or territory on the green list is on the verge of being demoted to amber, it will be added to the green watch list.</p>
                                        <p style="font-size:15px;font-family:poppins"> A country or territory may be shifted between lists without warning if situations change suddenly.</p>

                                    </div>
                                </div>
                            </li>
                        </ul><!--end of accordion-->

                     </div>

                </div><!--end of row-->
            </div>
        </section>




    </div>


@endsection