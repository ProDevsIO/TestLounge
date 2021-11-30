@extends('layouts.home')
@section('style')
    <link href="{{ url('/css/product.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="main-container">

        <header class="title" style="max-height: 300px !important;">
            <div class="background-image-holder parallax-background">

            </div>
            <div class="container align-bottom">
                <div class="row">
                    <div class="col-xs-12 h9_header">
                        <h5 id="h9" class="text-white">COUNTRY TESTS (UNITED KINGDOM)</h5>
                        @if($type == "Green")
                            <h5 id="h9" class="text-white">Travelling from a Green country to the UK <span class="badge"
                                                                                                           style="background-color:#258C48;padding:10px">G</span>
                            </h5>
                        @elseif($type=="Amber_v")
                            <h5 id="h9" class="text-white">Tests for fully vaccinated <span
                                        class="badge"
                                        style="color:white;padding:10px;background-color:#258C48;">G</span>
                            </h5>
                        @elseif($type == "Amber_uv")
                            <h5 id="h9" class="text-white">Tests for unvaccinated /Not fully vaccinated
                                <span class="badge" style="background-color:#efb918;padding:10px">A</span></h5>
                        @elseif($type=="Red")
                            <h5 id="h9" class="text-white"> Information for Red List countries<span class="badge"
                                                                                                    style="background-color:#E73636;padding:10px">R</span>
                            </h5>
                        @elseif($type == "UK")
                            <h5 id="h9" class="text-white">Travelling from the UK<span class="badge"
                                                                                       style="background-color:#BBBEFF;padding:10px">UK</span>
                            </h5>
                        @endif
                    </div>
                </div>
                <!--end of row-->
            </div>
            <!--end of container-->
        </header>
        <section class="content bg-white" style="padding:0;">
            <div class="jumbotron bg-white" style="padding: 0px">
                <div class="purchase">
                    <div class="header text-center">
                        <!-- <div class="fw-700 fs-28">Travelling from the UK</div> -->
                    </div>

                    @if (count($products) > 0)
                        <div class="container">
                            <div class="container" id="show-result">

                                <div class="row">
                                    <div class="container" id="show-result">

                                    </div>
                                    <br>
                                    <?php $i = 1 ?>


                                    @foreach ($products as $vproduct)

                                        <div class="col-md-4" id="con" style="">
                                            @if($type == "Green")
                                                <div class="container"
                                                     style="padding:30px;margin-bottom:20px;min-height: 378px; border-radius:10px; background-color:#258C48;">

                                                    @elseif($type=="Amber_v")
                                                        <div class="container"
                                                             style="padding:30px;margin-bottom:20px;min-height: 378px;  border-radius:10px; background-color:#258C48;">

                                                            @elseif($type == "Amber_uv")
                                                                <div class="container"
                                                                     style="padding:30px;margin-bottom:20px;min-height: 378px;  border-radius:10px; background-color:#efb918;">

                                                                    @elseif($type=="Red")
                                                                        <div class="container"
                                                                             style="padding:30px;margin-bottom:20px;min-height: 378px;  border-radius:10px;background-color:#E73636;">

                                                                            @elseif($type == "UK")
                                                                                <div class="container"
                                                                                     style="padding:30px;margin-bottom:20px;min-height: 378px;  border-radius:10px;background-color:#BBBEFF;">

                                                                                    @else
                                                                                        <div class="container"
                                                                                             style="padding:30px;margin-bottom:20px;min-height: 378px;  border-radius:10px;background-color:#1E50A0;">

                                                                                            @endif

                                                                                            <div class="row">
                                                                                                <div class="col-md-12 text-center">
                                                                                                    <h5 class="text-center"><span
                                                                                                                class="color-7 ">{{ optional(optional($vproduct)->product)->name }}</span>
                                                                                                    </h5>

                                                                                                    <p id="innerP"
                                                                                                       class="text-center"><span
                                                                                                                class="color-7 ">{{ optional(optional($vproduct)->vendor)->name }}</span>
                                                                                                    </p>

                                                                                                    <p>
                                                                                                    <span class="color-7 ">{{optional(optional($vproduct)->product)->hint}}</span></p>
                                                                                                </div>
                                                                                                <div class="col-md-12"
                                                                                                     style="padding:0;">
                                                                                                    <div class="container text-center"
                                                                                                         style="padding-top:50px; padding-left:0; padding-right:0;">
                                                                                                        {{-- <a onclick ="addCart('{{$vproduct->product->id}}', '{{$vproduct->vendor->id}}')" --}}

                                                                                                        @if ($vproduct->cartItem)
                                                                                                            <div class="input-group count_now{{ $vproduct->product->id }}">
                                                                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                                                                      data-action="remove">-</span>

                                                                                                                <input type="text"
                                                                                                                       style=""
                                                                                                                       class="form-control text-center cart_input"
                                                                                                                       id="quantity_{{ $i }}"
                                                                                                                       value="{{ $vproduct->cartItem->quantity }}"
                                                                                                                       data-cart_id="{{  $vproduct->cartItem->id }}"/>

                                                                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                                                                      data-action="add">+</span>
                                                                                                            </div>
                                                                                                            <h5 class="text-center"
                                                                                                                style="color:#616161"><span
                                                                                                                        class=" color-7"> £{{ number_format(optional($vproduct)->price / 830)}} / ${{ optional($vproduct)->price_pounds }} </span>
                                                                                                            </h5>
                                                                                                            <a id="remove_button"
                                                                                                               type="button"
                                                                                                               data-button="remove_button"
                                                                                                               data-product_id="{{ $vproduct->product->id }}"
                                                                                                               data-vendor_id="{{ $vproduct->vendor->id }}"
                                                                                                               class="btn btn-outline-info cart_btn"
                                                                                                               style="border:1px solid #1E50A0;">
                                                                                                                Remove

                                                                                                            </a>

                                                                                                        @else

                                                                                                            <div class="input-group count_now{{ $vproduct->product->id }}"
                                                                                                                 style="display: none;">
                                                                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                                                                      data-action="remove">-</span>

                                                                                                                <input type="text"
                                                                                                                       style=""
                                                                                                                       class="form-control text-center cart_input cart{{ $vproduct->product->id  }}"
                                                                                                                       id="quantity_{{ $i }}"
                                                                                                                       value="1"
                                                                                                                       data-cart_id=""/>

                                                                                                                <span class="input-group-addon cart_update_btn bg-white"
                                                                                                                      data-action="add">+</span>
                                                                                                            </div>

                                                                                                            <h5 class="text-center"
                                                                                                                style="color:#616161"><span
                                                                                                                        class="color-7">£{{ number_format(optional($vproduct)->price / 830)}} / ${{ optional($vproduct)->price_pounds }}</span>
                                                                                                            </h5>
                                                                                                            <a id="add_button"
                                                                                                               type="button"
                                                                                                               data-button="add_button"
                                                                                                               style="align:center;"
                                                                                                               data-product_id="{{ $vproduct->product->id }}"
                                                                                                               data-vendor_id="{{ $vproduct->vendor->id }}"
                                                                                                               class="btn btn-info cart_btn "
                                                                                                            >
                                                                                                                Add to
                                                                                                                cart
                                                                                                            </a>

                                                                                                        @endif
                                                                                                        <a href="/view/cart"
                                                                                                           id="add_button"
                                                                                                           class="btn btn-info">Go
                                                                                                            to cart</a>
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                @if($i % 3  == 0)
                                                                                    <div class="clearfix"></div>
                                                                                @endif

                                                                                <?php $i++; ?>
                                                                                @endforeach

                                                                        </div>
                                                                        <div class="row"
                                                                             style="margin-right:0px; margin-left:0px">

                                                                            <div class="col-sm-12 text-center"><a
                                                                                        id="go_button"
                                                                                        href="{{ url('/view/cart') }}"
                                                                                        type="button" class="btn bg-1">Go
                                                                                    to cart <img
                                                                                            src="https://img.icons8.com/fluency/20/000000/right.png"/></a>
                                                                            </div>
                                                                        </div>

                                                                    @else
                                                                        <div style="padding: 50px 50px 30px 50px">
                                                                            <h4 class="text-center">No product available
                                                                                for now</h4>
                                                                        </div>
                                                                    @endif

                                                                </div>
                                                        </div>
                                                </div>
                                        </div>
        </section>

        @if($type == "UK")

        @endif
        <section class="content bg-white" style="padding:0;">
            <div class="container">

                <div class="row rul" style="padding: 0px 200px">
                    <h4 style="font-family: Nunito;
font-style: normal;
font-weight: 600;
font-size: 30px;
line-height: 55px;
color: #1E50A0;margin-bottom: 30px;margin-top: 20px;text-align: center">Product Rules & Information ____</h4>

                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php $i = 1;?>
                        @foreach ($products as $vproduct)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion"
                                           href="#collapseOne{{ $vproduct->id }}" aria-expanded="true" aria-controls="collapseOne">
                                            {{ optional(optional($vproduct)->product)->name }}
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseOne{{ $vproduct->id }}" class="panel-collapse collapse @if($i == 1)
                                        in
                                        @endif" role="tabpanel"
                                     aria-labelledby="headingOne">
                                    <div class="panel-body">
                                        {!! optional(optional($vproduct)->product)->description !!} </div>
                                </div>
                            </div>
                                <?php $i++?>
                        @endforeach
                    </div>


                </div>
            </div>

        </section>
        <br>
        @if($faq == 1)
            <section class="strip" style="background: #1E50A0;">
                <div class="container bg-1">
                    <div class="row clearfix">
                        <div class="col-md-12 col-xs-12 text-center">
                            <h5 class="text-white">If you do not know what category your country of origin belongs to ,
                                please click on this link for more information</h5>
                            <a href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england"
                               target="_blank" class="btn btn-primary btn-white">Click here</a>

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
                                <li>Run a PCR Test in your country of origin 72 hours before your trip to the UK.
                                    Evidence of a negative PCR Test is <b>MANDATORY</b> for entry into the UK. You can
                                    book your test <a href="/pick" class="">Here</a></li>
                                <br/>
                                <li> Book and Pay for your travel tests <a href="{{ url('/product/all') }}" class="">Book
                                        Now</a>. Evidence of booking and payment is <b>MANDATORY</b> before you can
                                    board a flight to the UK
                                </li>
                                <br/>
                                <li>Following Payment, you will immediately receive your Passenger locator Number and
                                    receipt of payment.
                                </li>
                                <br/>
                                <li>This number will be used to Complete your Passenger locator form <a
                                            href="https://provide-journey-contact-details.homeoffice.gov.uk/passengerLocatorFormUserAccountHolderQuestion"
                                            target="_blank">Here</a>.You must show evidence that you have completed your
                                    Passenger locator form before you will be allowed to board a flight into the UK
                                </li>
                                <br/>
                                <li>You may also need to show your receipt of payment for your test before you are
                                    allowed to board a flight to the UK; <br>
                                    Please have these documents handy at the airport ; both electronic and printed
                                    copies are accepted by airlines
                                </li>
                                <br/>
                                <li>Following your arrival into the UK, you will receive the test packages you booked
                                    for on or before the 2nd day of your arrival.
                                </li>
                                <br/>
                                <li>You must carry out a self test on your 1st or 2nd day of arrival into the UK . The
                                    directions on how to carry out a self test, how to activate your test and where to
                                    send your test samples to are all written on the pack you will receive. Click to
                                    watch video on how to carry out a self test. <a href="https://youtu.be/8lo6g-TYZ-c"
                                                                                    target="_blank">Watch</a>.
                                </li>
                                <br/>
                                <li> Following your self test, you will drop your sample at the designated points
                                    nearest to you as directed on the test pack you will recieve
                                </li>
                                <br/>
                                <li> You will also be expected to "Activate" your test by visiting the website that will
                                    be indicated on the pack you will receive and by following the simple instructions
                                    on this website. This is required to analyse your test and send your results
                                </li>
                                <br/>
                                <li> If you have purchased a Fit to Fly Test or Package, for your exit out of the UK to
                                    another country, check the country guidelines for when you are expected to carry out
                                    your PCR test before flying.
                                </li>
                            </ul>
                            <br/>
                            <p style="text-align: justify;">
                                You can also get more information about travel requirements for other countries <a
                                        href="https://calculator.prodevs.io/" target="_blank"
                                        style="color:#428bca; text-decoration:none;font-size:18px;"> here </a>. <br>
                                Follow the guidelines above on how to carry out a self test and activate your tests <br>

                                All test Results are available 24 hours from receipt of samples in the Laboratory
                                <br><br></p>
                            <div class="alert alert-warning">
                                <p style="text-align: justify;"> * Disclaimer : <br>
                                    Country guidelines change from time to time and the information provided here is a
                                    guide. Please ensure to confirm country and airline regulations with relevant
                                    authorities at your destination. Traveltestsltd will not take any responsibility for
                                    challenges that arise as a result of information provided here
                                </p></div>
                            <p style="text-align: justify">
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
                                            It is important to know what test you should do before you travel and when
                                            you arrive in the UK
                                        </p>
                                        <p style="font-size:18px;">
                                            What you do depends o whether you qualify as fully vaccinated or
                                            unvaccinated under the Uk travel rules.
                                            To avoid any delays to your travel plans, check what tests you might need
                                            <b><a class="text-info"
                                                  href="https://www.gov.uk/guidance/travel-to-england-from-another-country-during-coronavirus-covid-19"
                                                  style="text-decoration:underline">here</a></b>
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <div class="title"><span>WHO QUALIFIES AS FULLY VACCINATED?</span></div>
                                    <div class="text">
                                        <p style="font-size:18px;">
                                            From 4am Monday 4 October, you will qualify as fully vaccinated if you are
                                            vaccinated either:<br>
                                        </p>
                                        <ul style="font-size:18px;">
                                            <li>- under an <a
                                                        href="https://www.gov.uk/guidance/how-to-quarantine-when-you-arrive-in-england"
                                                        style="text-decoration:underline"> approved vaccination
                                                    programme in the UK, Europe, USA or UK vaccine programme
                                                    overseas</a></li>
                                            <li>- with a full course of the Oxford/AstraZeneca, Pfizer BioNTech, Moderna
                                                or Janssen vaccines from a relevant public health body in Australia,
                                                Antigua and Barbuda, Barbados, Bahrain, Brunei, Canada, Dominica,
                                                Israel, Japan, Kuwait, Malaysia, New Zealand, Qatar, Saudi Arabia,
                                                Singapore, South Korea, Taiwan or the United Arab Emirates (UAE)
                                                Formulations of the 4 listed vaccines, such as AstraZeneca Covishield,
                                                AstraZeneca Vaxzevria and Moderna Takeda, qualify as approved
                                                vaccines.<br>
                                            </li>
                                        </ul>
                                        <p style="font-size:18px;"><br>

                                            You must have had a complete course of an approved vaccine at least 14 days
                                            before you arrive in England.
                                        </p>
                                    </div>
                                </li>

                                <li>
                                    <div class="title"><span>WHAT ARE THE CONSTRAINTS?</span></div>
                                    <div class="text">
                                        <p style="font-size:18px;">
                                            Before entering the UK, all visitors must provide a negative test within the
                                            last 72 hours and fill out a Passenger Locator Form.</p>
                                        <p style="font-size:18px;"> In England, Scotland, Wales, and Northern Ireland, a
                                            traffic light-based
                                            transport system (red, amber, and green) is presently in operation.</p>
                                        <p style="font-size:18px;"> Non-UK residents from countries on the red list are
                                            now denied access to the
                                            United Kingdom.</p>
                                        <p style="font-size:18px;"> Residents returning from destinations on the red
                                            list, such as South Africa and
                                            India, must stay in a hotel for ten days.</p>
                                        <p style="font-size:18px;"> These passengers must purchase a "quarantine
                                            package" before arriving in the UK
                                            - which covers their stay in hotel quarantine, food, and drink while there
                                            (Personal expenses).

                                        </p>

                                    </div>
                                </li>

                                <li>
                                    <div class="title"><span>WHAT MUST I DO IF I AM FULLY VACCINATED?</span>
                                    </div>
                                    <div class="text">
                                        <p style="font-size:18px;"> Book and pay for a day 2 COVID-19 test – to be taken
                                            after arrival in England.</p>
                                        <p style="font-size:18px;"> Complete your passenger locator form – any time in
                                            the 48 hours before you arrive in England.</p>
                                        <p style="font-size:18px;"> Take a COVID-19 test on or before day 2 after you
                                            arrive in England Under the new rules, you will not need to:</p>
                                        <ul style="font-size:18px;">
                                            <li>- Take a pre-departure test.</li>
                                            <li>- Take a day 8 COVID-19 test.</li>
                                            <li>- Quarantine at home or in the place you are staying for 10 days after
                                                you arrive in England.
                                            </li>
                                        </ul>

                                        </p>
                                    </div>
                                </li>
                                <!--
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
                                </li> -->
                                <li>
                                    <div class="title">
                                        <span>WHAT TO DO IF AM NOT FULLY VACCINATED?</span></div>
                                    <div class="text">

                                        <p style="font-size:18px;"> From 4am Monday 4 October, you must follow these
                                            rules if you:.</p>

                                        <ul style="font-size:18px;">
                                            <li>- Do not qualify under the fully vaccinated rules,</li>
                                            <li>- Are partially vaccinated or .</li>
                                            <li>- Are not vaccinated.</li>

                                        </ul>
                                        <p style="font-size:18px;">Before you travel to England you must:</p>
                                        <ul style="font-size:18px;">
                                            <li>- Take a pre-departure COVID-19 test – to be taken in the 3 days before
                                                you travel to England.
                                            </li>
                                            <li>- Book and pay for day 2 and day 8 COVID-19 tests – to be taken after
                                                arrival in England.
                                            </li>
                                            <li>- Complete your passenger locator form – any time in the 48 hours before
                                                you arrive in England.
                                            </li>
                                        </ul>
                                        <p style="font-size:18px;">After you arrive in England you must:</p>
                                        <ul style="font-size:18px;">
                                            <li>- Quarantine at home or in the place you are staying for 10 days.</li>
                                            <li>- Take a COVID-19 test on or before day 2 and on or after day 8.</li>
                                            <li>- You may be able to end quarantine early if you pay for a private
                                                COVID-19 test through the Test to Release scheme.
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span>HOW DO I PROVE THAT I AM FULLY VACCINATED?</span></div>
                                    <div class="text">

                                        <p style="font-size:18px;"> You must be able to prove that you have been fully
                                            vaccinated (plus 14 days) with a document (digital or paper-based)
                                            from a national or state-level public health body that includes, as a
                                            minimum:
                                        </p>
                                        <ul style="font-size:18px;">
                                            <li>- Forename and surname(s).</li>
                                            <li>- Date of birth.</li>
                                            <li>- Vaccine brand and manufacturer.</li>
                                            <li>- Date of vaccination for every dose.</li>
                                            <li>- Country or territory of vaccination and/or certificate issuer.</li>

                                        </ul>
                                        <p style="font-size:18px;">If your document from a public health body does not
                                            include all of these, you must follow the non-vaccinated rules. If not, you
                                            may be denied boarding.</p>
                                        <br/>
                                        <p style="font-size:18px;"> If you are fully vaccinated in the USA, you will
                                            need to show a CDC card showing you’ve had a full course of an FDA-approved
                                            vaccine in the USA. You’ll also need to prove that you are a resident of the
                                            USA.</p>
                                        <p style="font-size:18px;"> If you are fully vaccinated in Europe, you will need
                                            to show an EU Digital COVID Certificate (EU DCC), showing you’ve had a full
                                            course of an EMA or Swissmedic-approved vaccine.</p>
                                        <br/>
                                        <p style="font-size:18px;">If you are fully vaccinated, but do not qualify under
                                            these fully vaccinated rules, you must follow the <a
                                                    href="https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england#not-vaccinated"
                                                    style="text-decoration:underline;color:#136480"> non-vaccinated
                                                rules.</a></p>

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

        $(".cart_btn").on("click", function (e) {
            e.preventDefault();
            const btn = $(this);
            btn.attr("disabled", true);
            const product_id = btn.attr("data-product_id");
            const vendor_id = btn.attr("data-vendor_id");
            const button = btn.attr("data-button");

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
                    success: function (data) {
                        console.log(data);
                        if (data.error == "yes") {
                            toastr.warning(data.message);
                            btn.attr("disabled", false);
                            $(".count_now" + product_id).hide();
                        } else {
                            toastr.success(data.message)
                            btn.html(data.btn_text)
                            btn.css({
                                "backgroundColor": data.btn_color,
                                "color": data.color
                            });
                            btn.removeAttr("disabled");
                            $(".cart_count_item").html(data.cart_items);
                            console.log(button);
                            if (button == "add_button") {
                                $(".cart" + product_id).attr('data-cart_id', data.cart_id);
                                btn.attr("data-button", "remove_button");
                                console.log(".count_now" + product_id);
                                $(".count_now" + product_id).show();
                            } else {
                                btn.attr("data-button", "add_button");

                                $(".count_now" + product_id).hide();
                            }
                        }
                    },
                    error: function (error) {
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
            $.get(url, function (data) {

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

        function countryQuery() {

            var country_id = document.getElementById("country").value;
            console.log(country_id);
            var url = '/country/query/' + country_id;
            $("#show-result")
                .find('p')
                .remove()
                .end();
            $.get(url, function (data) {

                var holder = document.getElementById("show-result");
                var newNode = document.createElement('p');
                var close = document.createElement('a');
                newNode.innerHTML = data;
                close.innerHTML = "X";
                holder.appendChild(newNode);
                newNode.appendChild(close);
                $("#show-result p a").addClass('close')
                $("#show-result p a").attr("data-dismiss", "alert")
                $("#show-result p").addClass('alert')
                $("#show-result p").addClass('p-2')
                $("#show-result p").attr("style", "background-color: #1E50A0;color:white;margin-bottom: 5px;")

            });
        }

        $(".cart_update_btn").on("click", function () {
            const btn = $(this);
            const input = btn.parent().find("input");
            if (input !== undefined) {
                let inputValue = $(input[0])
                const value_ = parseInt(inputValue.val());
                let value = value_
                const action = btn.attr("data-action")
                if (action == "add") {
                    value = value + 1
                } else {
                    if (value >= 2) {
                        value = value - 1
                    }
                }
                if (value_ != value) {
                    inputValue.val(value)
                    update(btn, input.attr("data-cart_id"), value);

                }
            }
        })

        function update(btn, id, quantity) {
            btn.attr("disabled", true);
            const url = "/update/cart/" + id + "/" + quantity;
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
                success: function (data) {
                    toastr.success('Successfully updated quantity in cart')
                    $("#totalCartPrice").html(data.total_price);
                    btn.removeAttr("disabled");
                    $("#cart_item_total_" + id).html(data.item_total);
                },
                error: function (error) {
                    toastr.error('Error', 'Unable to process request')
                    btn.removeAttr("disabled");
                }
            });
        }
    </script>
@endsection
