@extends('layouts.home')
@section('style')

    <style>
        body {
            font-size: 14px;
            font-family: 'Raleway', sans-serif;
            padding: 0;
            margin: 0;
            width: 100vw;
        }

        .link {
            text-decoration: none;
        }

        /***** background */
        .bg-1 {
            background: #1A8BB3;
            color: #fff;
        }

        .bg-2 {
            background: #7FC8A9;
            color: #fff;
        }

        .bg-3 {
            background: #FA8072;
            color: #fff;
        }

        .bg-4 {
            background: #F6D167;
            color: #fff;
        }

        .bg-5 {
            background: #DF2E2E;
            color: #fff;
        }

        .bg-6 {
            background: #989898;
            color: #fff;
        }

        .bg-7 {
            background: #F3F3F3;
        }

        .bg-8 {
            background: #616161;
        }

        .bg-9 {
            background: #8d8d8d;
        }

        .bg-10 {
            background: #D22F27;
        }

        .bg-11 {
            background: #eaeaea;
        }

        .bg-white {
            background: #fff;
        }

        .bg-none {
            background: none;
        }

        /***** color */
        .color-1 {
            color: #1A8BB3;
        }

        .color-2 {
            color: #7FC8A9;
        }

        .color-3 {
            color: #FA8072;
        }

        .color-4 {
            color: #F6D167;
        }

        .color-5 {
            color: #DF2E2E;
        }

        .color-6 {
            color: #989898;
        }

        .color-7 {
            color: #F3F3F3;
        }

        .color-8 {
            color: #616161;
        }

        .color-9 {
            color: #8d8d8d;
        }

        .color-10 {
            color: #D22F27;
        }

        .color-11 {
            color: #eaeaea;
        }

        .color-black {
            color: #000;
        }

        /***** border */
        .bd-1 {
            border: 1px solid #1A8BB3;
        }

        section {
            padding: 50px 25vw;
        }

        /***** font size */
        .fs-30 {
            font-size: 30px;
        }

        .fs-28 {
            font-size: 28px;
        }

        .fs-20 {
            font-size: 20px;
        }

        .fs-18 {
            font-size: 18px;
        }

        .fs-16 {
            font-size: 16px;
        }

        /***** font weight */
        .fw-700 {
            font-weight: 700;
        }

        .fw-600 {
            font-weight: 600;
        }

        .fw-500 {
            font-weight: 500;
        }

        /***** alignment */
        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        /***** button */
        button {
            outline: none;
            border: none;
            background: none;
            box-sizing: border-box;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-1 {
            padding: 17px;
        }

        .btn-2 {
            padding: 7px 12.5px;
        }

        .btn-3 {
            padding: 13px 85px;
        }

        .btn-4 {
            padding: 20px 45px;
        }

        .btn-5 {
            padding: 15px;
            border-radius: 13px;
        }


        /***** containers */
        .double-container {
            display: grid;
            grid-template-columns: repeat(2, 45%);
            justify-content: space-between;
        }




        /***** purchase */
        .purchase {
            padding: 0 30pxpx;
        }

        .purchase .card-container {
            margin: 50px 0;
        }

        .purchase .card-container .card {
            /* padding:24px 155px 24px 45px; */
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .purchase .card-container .card .currency {
            margin-left: 18px;
        }

        .purchase .card-container .card .quantity {
            margin: 0 13px;
        }

        .purchase .card-container .card .quantity-summary {
            margin-left: 13px;
        }

        /***** cart */
        .cart {
            padding: 0 123px;
        }

        .cart .cart-container {
            margin: 50px 0;
        }

        .cart .cart-container .card {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 2fr;
            border-radius: 5px;
            margin-bottom: 25px;
        }

        .cart .cart-container .heading {
            margin-bottom: 15px;
        }

        .cart .cart-container .card-item {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-right: 1px solid #c2c2c2;
            padding: 20px;
        }

        .cart .cart-container .card-item:first-child {
            justify-content: flex-start;
            padding-left: 45px;
        }

        .cart .cart-container .card-item:last-child {
            justify-content: flex-end;
            border: none;
            padding-right: 45px;
        }

        .cart .cart-container .card-item .remove-icon {
            margin-right: 8px;
        }

        .cart .cart-container .total {
            text-align: right;
        }

        .cart .cart-container .total .price {
            margin-left: 22px;
        }

        .cart .cart-container .button-container {
            margin: 83px 0 50px 0;
            text-align: right;
        }


        /* start laptop version */
        @media screen and (max-width: 2450px) {}



        /* tab version */
        @media screen and (max-width: 1024px) {
            section {
                padding: 50px;
            }

        }

        /* mobile version */
        @media screen and (max-width: 468px) {
            #h9{
                text-align:center;
            }
            section{
                padding:50px 20px;
            }

            button {
                display: block;
                width: 100%;
            }

            /***** purchase */
            .purchase {
                padding: 0;
            }

            .purchase .card-container .card {
                padding: 24px 20px;
                display: block;
            }

            .purchase .card-container .card .purchase-name {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }

            .purchase .card-container .card .btn-2 {
                display: inline-block;
                width: auto;
            }
        }

    </style>
@endsection
@section('content')
    <div class="main-container">

        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background">
                <img class="background-image" alt="Background Image" src="/img/hero14.jpg">
            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12">

                        <h1 id="h9" class="text-white">COUNTRY TESTS</h1>
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </header>
        <section class="content">
            <div class="jumbotron bg-white">
                <div class="purchase">
                    <div class="header text-center">
                        <!-- <div class="fw-700 fs-28">Travelling from the UK</div> -->
                    </div>
                    <div class="card-container">
                        @if (count($products) > 0)

                            <div class="container" id="show-result">

                            </div>
                            <br>
                            @foreach ($products as $vproduct)

                                <div class="container bg-7" style="padding:20px;margin-bottom:20px">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <p class="text-center"><span
                                                    class="color-8 ">{{ optional(optional($vproduct)->product)->name }}</span>
                                            </p>
                                            <hr>
                                            <p class="text-center"><span
                                                    class="color-8 ">{{ optional(optional($vproduct)->vendor)->name }}</span>
                                            </p>
                                            <hr>
                                            <p class="text-center"><span
                                                    class=" ">£{{ optional($vproduct)->price_pounds }}</span></p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="container" style="padding-top:70px">
                                                {{-- <a onclick ="addCart('{{$vproduct->product->id}}', '{{$vproduct->vendor->id}}')" --}}

                                                @if ($vproduct->cartItem)
                                                    <a type="button" data-product_id="{{ $vproduct->product->id }}"
                                                        data-vendor_id="{{ $vproduct->vendor->id }}"
                                                        class="btn btn-block btn-info cart_btn"
                                                        style="background-color: #BC5636;">
                                                        Remove from cart
                                                    </a>
                                                @else
                                                    <a type="button" data-product_id="{{ $vproduct->product->id }}"
                                                        data-vendor_id="{{ $vproduct->vendor->id }}"
                                                        class="btn btn-block btn-info cart_btn"
                                                        style="background-color: #46b8da;">
                                                        Add to cart
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                            <div class="row">
                                <div class="col-sm-5" style="padding:2%"></div>
                                <div class="col-sm-4" style="padd"></div>
                                <div class="col-sm-3 p-2"><a href="{{ url('/view/cart') }}" type="button" class="btn btn-block btn-info" style="background-color: #46b8da;">Go to cart</a></div>
                            </div>
                        @else
                            <h4 class="text-center">No product available for now</h4>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @if($faq == 1)
        <section class="strip bg-secondary-1">
            <div class="container">
                <div class="row clearfix">
                    <!-- <div class="col-md-6 col-xs-12 text-center">
                         <h5 class="text-white">Not sure of which package or color code your.  </h5>
                         <a href="https://calculator.prodevs.io/" target="_blank" class="btn btn-primary btn-white">Book now</a>

                    </div> -->

                    <div class="col-md-12 col-xs-12 text-center">
                        <h5 class="text-white">If you do not know what category your country of origin belongs to , please click on this link for more information</h5>
                        <a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england" target="_blank" class="btn btn-primary btn-white">Click here</a>

                    </div>
                </div>
            </div>
        </section>
        <section class="pure-text-centered" id="popular">
            <div class="container" style="width:100%;">
                <div class="row">
                    <div class="col-sm-10 col-md-12 text-center">
                        <span class="sub alt-font">popular questions</span>
                        <h1><strong>GUIDELINES FOR TRAVEL TESTS GLOBAL</strong></h1>
                        <ul style="text-align: justify; list-style-type: square; font-size:18px;padding: 0px 20px;">
                            <li>Run a PCR Test in your country of origin 72 hours before your trip to the UK. Evidence of a negative PCR Test is <b>MANDATORY</b> for entry into the UK. You can book your test <a href="/pick" class="">Here</a> </li>
                           <br/> <li> Book and Pay for your travel tests  <a href="{{ url('/product/all') }}" class="">Book Now</a>. Evidence of booking and payment is <b>MANDATORY</b> before you can board a flight to the UK</li>
                            <br/><li>Following Payment, you will immediately receive your Passenger locator Number and receipt of payment.</li>
                            <br/> <li>This number will be used to Complete your Passenger locator form <a href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion" target="_blank">Here</a>.You must show evidence that you have completed your Passenger locator form before you will be allowed to board a flight into the UK</li>
                            <br/> <li>You may also need to show your receipt of payment for your test before you are allowed to board a flight to the UK; <br>
                                Please have these documents handy at the airport ; both electronic and printed copies are accepted by airlines</li>
                            <br/> <li>Following your arrival into the UK, you will receive the  test packages you booked for on or before the 2nd day of your  arrival.</li>
                            <br/> <li>You must carry out a self test on your 1st or 2nd day of arrival into the UK . The directions on how to carry out a self test, how to activate your test and where to send your test samples to are all written  on the pack  you will receive. Click to watch video on how to carry out a self test. <a href="https://youtu.be/8lo6g-TYZ-c" target="_blank">Watch</a>.</li>
                            <br/> <li> Following your self test, you will drop your sample at the designated points nearest to you as directed on the test pack you will recieve </li>
                            <br/> <li> You will also be expected to "Activate" your test by visiting the website that will be indicated on the pack you will receive and by following the simple instructions on this website. This is required to analyse your test and send your results </li>
                            <br/> <li> If you have  purchased a Fit to Fly Test or Package, for your exit out of the UK to another country, check the country guidelines for when you are expected to carry out your PCR test before flying. </li>
                        </ul>
                        <br/>   <p class="lead" style="text-align: justify;">
                            You can also get more information about travel requirements for other countries <a href="https://calculator.prodevs.io/" target="_blank" style="color:#428bca; text-decoration:none;font-size:18px;"> here </a>. <br>
                            Follow the guidelines above on how to carry out a self test and activate your tests <br>

                            All test Results are available 24 hours from receipt of samples in the Laboratory <br><br></p>
                        <div class="alert alert-warning">
                       <p class="lead" style="text-align: justify;">     * Disclaimer : <br>
                            Country guidelines change from time to time and the information provided here is a guide. Please ensure to confirm country and airline regulations with relevant authorities at your destination. Traveltestsltd will not take any responsibility for challenges that arise as a result of information provided here
                       </p></div>
                        <p class="lead" style="text-align: justify">
                        <br/>

                    </div>
                </div><!--end of row-->

            </div><!--end of container-->
        </section>
            <section class="content" id="faq">
                <div class="container" style="width:100%;">
                    <div class="row">

                        <div class="col-sm-12 col-md-12">
                            <h1><strong>FAQs</strong></h1>

                            <ul class="accordion">
                                <li class="active">
                                    <div class="title"><span>WHY SHOULD I TAKE THE TEST?</span></div>
                                    <div class="text">
                                        <p style="font-size:18px;">
                                            All visitors to the United Kingdom, including British nationals, must show proof
                                            of a negative Covid test within 72 hours of arrival.</p>
                                        <p style="font-size:18px;"> Residents of the United Kingdom traveling from the "red list," including South
                                            Africa, India, Namibia, and the United Arab Emirates, are allowed to enter the
                                            country but must quarantine and undergo testing upon arrival.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <div class="title"><span>WHAT ARE THE CONSTRAINTS?</span></div>
                                    <div class="text">
                                        <p style="font-size:18px;">
                                            Before entering the UK, all visitors must provide a negative test within the
                                            last 72 hours and fill out a Passenger Locator Form.</p>
                                        <p style="font-size:18px;"> In England, Scotland, Wales, and Northern Ireland, a traffic light-based
                                            transport system (red, amber, and green) is presently in operation.</p>
                                        <p style="font-size:18px;"> Non-UK residents from countries on the red list are now denied access to the
                                            United Kingdom.</p>
                                        <p style="font-size:18px;"> Residents returning from destinations on the red list, such as South Africa and
                                            India, must stay in a hotel for ten days.</p>
                                        <p style="font-size:18px;"> These passengers must purchase a "quarantine package" before arriving in the UK
                                            - which covers their stay in hotel quarantine, food, and drink while there
                                            (Personal expenses).

                                        </p>

                                    </div>
                                </li>

                                <li>
                                    <div class="title"><span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM AN AMBER COUNTRY?</span>
                                    </div>
                                    <div class="text" >
                                        <p style="font-size:18px;">
                                            These are the things you must do if you have spent more than ten days in an
                                            amber country or territory before arriving in the United Kingdom.</p>
                                        <p style="font-size:18px;"> Before Visiting the United Kingdom</p>
                                        <p style="font-size:18px;">It would help if you accomplish the following before visiting the United
                                            Kingdom:</p>
                                        <ul style="font-size:18px;">


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
                                    <div class="title"><span>WHEN YOU ARRIVE IN THE UK, YOU MUST:</span></div>
                                    <div class="text">

                                        <p style="font-size:18px;"> For ten days, quarantine at home or wherever you are staying.</p>
                                        <ul style="font-size:18px">
                                            <li>- On or before Day 2 and on or after Day 8, take a COVID-19 test</li>
                                            <li> - Read up on quarantine and COVID-19 testing.</li>
                                            <li> - The day two and day eight tests are not required for children under the
                                                age of four.
                                            </li>
                                            <li> - If you pay for a private COVID-19 exam under the Test to Release scheme,
                                                you could be able to get out of quarantine sooner.
                                            </li>
                                        </ul><br/>
                                        <p style="font-size:18px;"> The amber list isn't all-inclusive. You should not presume that a country or
                                            territory is on the green or red list if it is not on this list.

                                        </p>

                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A RED COUNTRY?</span></div>
                                    <div class="text">

                                        <p style="font-size:18px;"> These are the things you must do if you visited a nation or territory on the red
                                            list in the 10 days leading up to your arrival in England.</p>
                                        <p style="font-size:18px;"> If you have spent the previous 10 days in a country or territory on the red
                                            list, you will be allowed to enter the UK only if you are a British or Irish
                                            national or have residency rights in the UK.</p>
                                        <p style="font-size:18px;"> Even if you have been fully vaccinated, you must observe these regulations.</p>
                                        <br/>
                                        <p><b>Before Departure for England</b></p>
                                        <p style="font-size:18px;">It would help if you did the following before going to England:
                                        <ul style="font-size:18px;">
                                            <li> - COVID-19 Test</li>
                                            <li> - Book a hotel package that includes two COVID-19 examinations.</li>
                                            <li> - You should fill out a passenger locator form</li>
                                        </ul></p><br/>
                                        <p><b>When you get to England</b></p>
                                        <p>It would be best if you did the following when you arrive in England:</p>
                                        <ul style="font-size:18px;">
                                            <li>- 2 COVID-19 tests during quarantine in a managed hotel</li>
                                        </ul>

                                    </div>
                                </li>
                                <li>
                                    <div class="title" >
                                        <span>WHAT ARE THE THINGS I MUST DO IF I’M COMING FROM A GREEN COUNTRY?</span></div>
                                        <div class="text">

                                            <p style="font-size:15px;"> This section explains what you'll need to do if you're coming to England from one of the countries or territories on the green list. In the past 10 days, you must have only visited or traveled through a green list nation or the United Kingdom, Ireland, the Channel Islands, or the Isle of Man.
                                            </p>
                                                <p style="font-size:15px;">Even if you have been fully vaccinated, you must observe these regulations</p>
                                            <br/>
                                            <p> <b> Before Going to England</b></p>
                                            <p style="font-size:15px;"> It would help if you did the following before visiting England:</p>
                                            <ul style="font-size:15px;">
                                            <li>-	Take a COVID-19 test to see if you're at risk.</li>
                                                <li> -	Make a reservation and pay for a Day 2 COVID-19 test – to be taken once in England.</li>
                                                <li>  -	Fill out a passenger locator form.</li>
                                            </ul>
                                            <br/>
                                            <p> <b>When you arrive in England</b></p>
                                                <ul style="font-size:15px;">
                                                    <li> -	On or before the second day after your arrival, you must take a COVID-19 test.</li>
                                                    <li>  -	This test is not required for children under the age of four.</li>
                                                    <li>  -	Unless the test result is positive, you do not need to quarantine.</li>
                                                    <li>  -	If NHS Test & Trace informs you that you traveled to England with someone who tested positive for COVID-19, you must quarantine.</li>
                                                </ul>
                                            <p style="font-size:15px;">    If you've visited one of the countries or territories on the red list, or If you visited or passed through a nation or territory on the red list in the ten days leading up to your arrival in England, you must adhere to the red list requirements.</p>
                                            <p style="font-size:15px;">  If you have been in or through an amber list nation or territory in the ten days leading up to your arrival in England and have not visited a red list country, you must observe the amber list guidelines.</p>
                                            <p style="font-size:15px;"> A country or territory can be changed from the green list to the amber or red list if conditions change.</p>
                                                <p style="font-size:15px;">If a country or territory on the green list is on the verge of being demoted to amber, it will be added to the green watch list.</p>
                                            <p style="font-size:15px;"> A country or territory may be shifted between lists without warning if situations change suddenly.</p>

                                        </div>
                                    </div>
                                </li>
                            </ul><!--end of accordion-->

                        </div>

                    </div><!--end of row-->
                </div>
            </section>
        @endif
</div>
@endsection
@section('script')
    <script>
        //  function show() {
        //        console.log(1);
        //         $("#country-section").show();
        //    }

        $(".cart_btn").on("click", function(e) {
            e.preventDefault();
            const btn = $(this);
            btn.attr("disabled", true);
            const product_id = btn.attr("data-product_id");
            const vendor_id = btn.attr("data-vendor_id");
            if (product_id && vendor_id) {
                var url = '/add/cart/' + product_id + '/' + vendor_id;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "get",
                    url: url,
                    data: null,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        toastr.success(data.message)
                        btn.html(data.btn_text)
                        btn.css({
                            "backgroundColor": data.btn_color
                        });
                        btn.removeAttr("disabled");
                        $(".cart_count_item").html(data.cart_items);
                    },
                    error: function(error) {
                        toastr.error('Error', 'Unable to process request')
                        console.log(error);
                        btn.removeAttr("disabled");
                    }
                });
            }
        })

        function addCart(product_id, vendor_id) {

            var url = '/add/cart/' + product_id + '/' + vendor_id;
            $("#show-result")
                .find('p')
                .remove()
                .end();
            $.get(url, function(data) {

                var holder = document.getElementById("show-result");
                var newNode = document.createElement('p');
                var close = document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss", "alert")
                $("#show-result p").addClass('alert alert-info')
            });
        }
    </script>
@endsection
