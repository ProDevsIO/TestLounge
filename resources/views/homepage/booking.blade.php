@extends('layouts.home')
@section('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/css/booking.css">
    <style>
        #disclamer {
            font-size: 16px;
            font-weight: normal;
            line-height: 25px;
            margin-bottom: 5px;
        }

        #under {
            font-size: 12px !important;
            color: red !important;
        }

        video {
            max-width: 100%;
            height: auto;
        }
        .mt-2{
            margin-top: 5px;
        }

        #glow {
            box-shadow: inset 0 0 100px #1E50A0,
            inset -10px 0 50px #f0f;
        }

        @media screen and (max-width: 468px) {
            #glow {
                margin-left: 15px;
            }

            footer.short-2 .align-vertical {
                padding-top: 0px !important;
            }
        }
    </style>
@endsection
@section('content')

    <div class="main-container" style="margin-top: 0px">
        <section class="contact-photo">
            <section class="content">
                <div class="form-page ">
                    <div class="header">
                        <!-- <div class="fw-700 fs-28 text-center">Travel Information</div> -->

                        @include('errors.showerrors')
                        @if($carts_count > 0 || isset($voucher))

                            <form action="{{ url('/post/booking') }}" method="post"
                                  class="bg-white">
                                @csrf

                                <h5>Fill the Booking form Below</h5>
                                @if(isset($voucher))
                                    <div>
                                        <span id="glow" class="badge badge-danger">{{optional(optional(optional($voucher)->voucherCount)->product)->name}} x {{$voucher->quantity}} </span>
                                    </div>


                                @elseif($carts_count > 0)
                                    <div>
                                        <span id="glow" class="badge badge-danger">{{optional(optional(optional($cart)->vendorProduct)->product)->name}} x {{$cart->quantity}}  </span>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <label>First Name <span class="show_required"> *</span>
                                    </label>
                                    <input type="text" placeholder="First name"
                                           name="first_name"
                                           value="{{ old('first_name') }}" style="margin-bottom:0px;" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Surname <span class="show_required"> *</span></label>
                                    <input type="text" placeholder="Surname"
                                           name="last_name"
                                           value="{{ old('last_name') }}" required>
                                </div>
                                <div class="col-md-12" style="margin-top: 20px">
                                    <label>Contact Email: <span class="show_required"> *</span></label>

                                    </small>
                                    @if(isset($voucher))
                                        <input type="text" name="email" readonly value="{{ $voucher->email }}"
                                               id="email" required/>

                                    @else

                                        <input type="text" name="email" value="{{ old('email') }}" id="email" required/>
                                    @endif
                                    <small class="text-muted" style="color:red"> Please provide only ONE email address
                                </div>
                                <div class="col-md-12" style="margin-top: 20px">
                                    <label>Confirm Email: <span class="show_required"> *</span></label>
                                    <div class="answer">

                                    </div>
                                    </small>


                                    <input type="text" id="verify_email" onkeyUp="veriy()" name="verify_email"
                                           value="{{ old('verify_email') }}" autocomplete="off" required/>


                                </div>
                                <div class="col-md-12 " style="margin-top: 20px">
                                    <label>Phone number<span class="show_required"> *</span></label>
                                    <br>

                                    <input id="phone" style="" type="text" value="{{ old('phone_no') }}" name="phone_no"
                                           class=" pr-5" placeholder="Phone No" required>
                                    <input id="hidden_phone" type="hidden" name="phone_full">
                                    <span id="under">Please indicate your internation dailing country code and then enter the rest of the number</span>
                                </div>
                                <div class="col-md-6"
                                     style="margin-bottom: 20px">
                                    <label>Sex <span class="show_required"> *</span></label>
                                    <select class="select-2" name="sex" required>
                                        <option value="">Make a selection</option>
                                        <option value="1" @if(old('sex') == "1")
                                        selected
                                            @endif>Male
                                        </option>
                                        <option value="2" @if(old('sex') == "2")
                                        selected
                                            @endif>Female
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Date of Birth <span class="show_required"> *</span>
                                    </label>
                                    <input class="date_picker" type="text"
                                           placeholder="Date of Birth"
                                           name="dob"
                                           value="{{ old('dob') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Ethnicity <span class="show_required"> *</span></label>
                                    <select class="select-2" name="ethnicity" required>
                                        <option value="">Make a selection</option>
                                        <option value="1" @if(old('ethnicity') == "1")
                                        selected
                                            @endif>White
                                        </option>
                                        <option value="2" @if(old('ethnicity') == "2")
                                        selected
                                            @endif>Mixed/Multiple Ethnic groups
                                        </option>
                                        <option value="3" @if(old('ethnicity') == "3")
                                        selected
                                            @endif>Asian/Asian British
                                        </option>
                                        <option value="4" @if(old('ethnicity') == "4")
                                        selected
                                            @endif>
                                            Black/African/Caribbean/Black British
                                        </option>
                                        <option value="5" @if(old('ethnicity') == "5")
                                        selected
                                            @endif>Other Ethnic group
                                        </option>

                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Isolation Address1: <span class="show_required"> *</span> </label>

                                    <input class="" type="text" name="isolation_address"
                                           placeholder="apartment, building, block, street"
                                           value="{{ old('isolation_address') }}" required/>
                                    <span id="under">This is the address where you will be during isolation</span>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Address2: </label>

                                    <input class="" type="text" name="isolation_address2"
                                           id="isolation_address2" placeholder="apartment, building, block, street"
                                           value="{{ old('isolation_address2') }}"/>
                                    <span id="under">This is the address where you will be during isolation</span>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                    <br>
                                    <input class="" type="text" name="isolation_town"
                                           value="{{ old('isolation_town') }}" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Postcode: <span class="show_required"> *</span></label>

                                    <input class="" type="text" name="isolation_postal_code"
                                           value="{{ old('isolation_postal_code') }}" required/>
                                    <span id="under">Your sampling package will be posted here, kindly ensure you put in the correct post code</span>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Country: <span class="show_required"> *</span></label>
                                    <select style="width: 100%;" class="select-2"
                                            name="isolation_country_id" required readonly>
                                        <option value="">Make a selection</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    @if(old('isolation_country_id') == $country->id)
                                                    selected
                                                @endif>{{ $country->name }}</option>
                                        @endforeach
                                        
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Country travelled from: <span
                                            class="show_required"> *</span></label><br>
                                    <select class="select-2 select2 country_id__"
                                            name="country_travelling_from_id" autocomplete="off"
                                            id="travel_from" onselect="selectCountry()">
                                        <option value="">Make a selection</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    @if(old('country_travelling_from_id') == $country->id)
                                                    selected
                                                @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    <span
                                        id="under">Please indicate the country/territory where you are travelling from</span>
                                </div>

                                <div class="col-md-6">
                                    <label> Departure Date: <span
                                            class="show_required"> *</span></label>
                                    <input class="date_picker" type="text"
                                           placeholder="Departure Date in UK"
                                           name="departure_date"
                                           value="{{ old('departure_date') }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                    <input class="date_picker1" type="text"
                                           placeholder="Arrival Date in UK"
                                           name="arrival_date"
                                           value="{{ old('arrival_date') }}" id="arrive" required>
                                </div>

                               

                                @if(!$locations == null)
                                <div class="col-md-6">
                                    <label>Date of test in the UK: <span class="show_required"> *</span></label>
                                    <input class="date_picker1" type="text"
                                           placeholder="Date of test in UK"
                                           name="test_date"
                                           value="{{ old('arrival_date') }}" id="test_date"  onclick="gettime()" required>
                                </div>
                                    <div class="col-md-6">
                                        <label>Test Location: <span class="show_required"> *</span></label>
                                        <select class="select-2 select2"
                                                name="test_location[]" id="test_location" onchange="gettime()" autocomplete="off"
                                                required>
                                            <option value="">Make a selection</option>
                                            @foreach($locations as $location)
                                                @php
                                                    $value = [
                                                                'location' => $location->locationid,
                                                                'address' => json_encode($location->address),
                                                                'room' => json_encode($location->rooms['0'])
                                                              ];
                                                @endphp
                                                <option value="{{json_encode($value)}}"
                                                        selected>{{ $location->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <div id="dam_time" class="form-section" style="margin-top:20px;display:none">
                                            <label>Select time slots <span class="show_required"> *</span></label>
                                          
                                            <select class="select-2 get_dam_time" autocomplete="off" name="dam_time" required>

                                            </select>
                                        </div>
                                    </div>
                                @endif

                                @if(isset($_GET['ref']))
                                    <input type="hidden" name="ref" value="{{ $_GET['ref'] }}">
                                @endif


                                @if(isset($voucher))

                                    @if($voucher->voucherCount->product_id != 15)

                                        <div class="col-md-12" style="display:none">
                                            <?php $decode = json_decode($voucher->test_kit); ?>

                                            @for($x =0; $x < $voucher->quantity; $x++)


                                                @if($voucher->quantity > 1)
                                                    <label>Test kit number {{$x + 1}}</label>
                                                @else
                                                    <label>Test kit number</label>
                                                @endif
                                            <!-- <div class="input-group mb-3"> -->

                                                @if($decode != null)
                                                    <input class="" type="text" name="test_kit{{$x}}"
                                                           value="{{ $decode[$x] }}" readonly required><br>
                                                @else
                                                <!-- <input class="" type="text" name="test_kit{{$x}}" value="{{ old('test_kit'.$x) }}" ><br> -->
                                                @endif
                                            <!-- <div class="input-group-append" data-toggle="modal" data-target="#myModal">
                                                        <span class="input-group-text">Scan barcode</span>
                                                    </div>
                                                </div> -->

                                            @endfor
                                        </div>
                                    @endif

                                @endif

                                <div class="col-md-12">
                                    <div style="margin-top: 10px">
                                        <label class="">Select a Payment Method</label>
                                        @if(isset($voucher))
                                            <div class="color-3"> Kindly click on the payment method(PAY WITH VOUCHER)
                                            </div>
                                        @else
                                            <div class="color-8"> Kindly choose your payment method</div>
                                        @endif
                                        <div class="radio-group">
                                            @if(isset($voucher))
                                                <div class='radio'
                                                     style="background:none;border:none;padding: 25px 40px;height: 86px;border-radius:25px"
                                                     data-value="voucher" onclick="voucherOption()">
                                                    <img
                                                        src="https://img.icons8.com/fluency/32/000000/ticket-purchase.png"
                                                        style="padding-bottom: 0px;"/>
                                                    <span><label> Pay with <b>voucher</b></label></span>

                                                </div>
                                            @else
                                            <!-- <div class='radio'
                                                 style="background:none;border:none;padding: 0px 20px;height: 86px;border-radius:25px;"
                                                 data-value="flutterwave" onclick ="run()">
                                                <img src="{{ url('/img/Flutterwave.png') }}"
                                                     style="padding-bottom: 0px;width: 200px;">
                                            </div> -->

                                                <div class='radio'
                                                     style="background:none;border:none;padding: 25px ;height: 86px;border-radius:25px"
                                                     data-value="voucher" onclick="voucherOption()">
                                                    <img
                                                        src="{{ url('/img/voucher.png') }}"
                                                        style="padding-bottom: 0px;"/>
                                                    <span><label> Pay with <b>voucher</b></label></span>

                                                </div>
                                                <div class='radio'
                                                     style="background:none;border:none;padding: 25px ;height: 86px;border-radius:25px"
                                                     data-value="paystack" onclick="run()">
                                                    <img
                                                        src="{{ url('/img/paystack.png') }}"
                                                        style="padding-bottom: 0px;height: 30px;"/>
                                                    <span><label> Pay with <b>Paystack</b></label></span>


                                                </div>
                                            <!-- <div class='radio'
                                                 style="background:none;border:none;padding: 8px 80px;height: 86px;border-radius:25px; width:300px;"
                                                 data-value="stripe" onclick ="run()">
                                                 <img  style="padding-bottom: 0px;width:100%;" src="{{ url('/img/stripe.png') }}" />

                                            </div> -->

                                                <div class='radio'
                                                     style="background:none;border:none;padding:25px;height: 86px;border-radius:25px"
                                                     data-value="vastech" onclick="run()">
                                                              <img
                                                                  src="{{ url('/img/vastech.png') }}"
                                                                  style="padding-bottom: 0px;height: 30px;"/>
                                                    <span><label> Pay with <b>Smartpay</b></label></span>


                                                </div>

                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="voucher_input" style="margin-top:20px;display:none;">
                                        <label>Voucher Number<span class="show_required"> *</span></label>
                                        <small class="text-muted" style="color:red"> Please input a valid voucher number
                                        </small>
                                        @if(isset($voucher))
                                            <input class="" type="text" style="font-weight:bold;font-size:20px;"
                                                   name="voucher" value="{{ $voucher->voucher }}" readonly/>
                                        @else
                                            <input class="" type="text" style="font-weight:bold;font-size:20px;"
                                                   name="voucher" value="{{ old('voucher') }}"/>
                                        @endif
                                    </div>
                                    <div id="card" class="form-section" style="margin-top:20px;display:none;">
                                        <label>Select Card types <span class="show_required"> *</span></label>
                                        <small class="text-muted" style="color:red"><b>Please select a card payment
                                                option</b></small>
                                        <select class="select-2 card_type" autocomplete="off" name="card_type">

                                        </select>
                                    </div>


                                    <div class="col-md-12 color-9">
                                        <p id="disclamer">
                                            I understand that I am purchasing this service in line with the Government's
                                            travel requirements because</p>

                                        <div class="color-8  mt-2"><label class="text-muted" id="disclamer"><input type="radio"
                                                                                                         name="vaccinated"
                                                                                                         value="fully"
                                                                                                         class="bg-1"/>
                                                I am fully vaccinated </label>
                                        </div>

                                        <div class="color-8 mt-2"><label class="text-muted" id="disclamer"><input type="radio"
                                                                                                         name="vaccinated"
                                                                                                         value="yes"
                                                                                                         class="bg-1"/>
                                                I am fully vaccinated but unable to show evidence of this</label>
                                        </div>

                                        <div class="color-8 mt-2"><label class="text-muted" id="disclamer"><input type="radio"
                                                                                                         name="vaccinated"
                                                                                                         value="no"
                                                                                                         class="bg-1"/>
                                                I am not fully vaccinated</label>

                                        </div>
                                        <br>
                                        <p id="disclamer">I understand that this service I am about to purchase is non
                                            refundable and I am about to purchase it of my own free will.</p>

                                    </div>

                                    <div class="col-md-12 color-9">
                                        <label>Consent to Test <span class="color-10">*</span></label>
                                        <div class="color-8"><label class="text-muted" id="disclamer"><input type="checkbox"
                                                                                                         name="consent"
                                                                                                         value="1"
                                                                                                         class="bg-1"
                                                                                                         required/>
                                                I consent to this test being done, or if this test
                                                is for a child, I confirm I am a legal guardian of the child and consent
                                                to
                                                this test being done.</label>
                                            <div class="color-8"><label class="text-muted" id="disclamer"><input
                                                        type="checkbox" name="terms" required
                                                        class="bg-1"/>
                                                    By submitting the form, I consent to the <a href="/terms"
                                                                                                target="_blank"
                                                                                                class="text-info"> terms
                                                        and conditions</a> of purchasing this product.</label>

                                            </div>
                                        </div>
                                    </div>

                                    <br/><br/>
                                    <span
                                        class="color-10" style="margin-left: 17px;margin-top: 10px">Bookings can’t be cancelled or refunded</span>


                                </div>

                                <input type="hidden" name="payment_method" value="paystack" id="payment_method"/>

                                <input type="submit" class="btn btn-primary pull-right" style="margin-top: -25px;"
                                       value="Make a booking">


                            </form>

                        @else
                            <div class="alert alert-danger text-center">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    No Item has been selected</h2><br/>
                                <div class="error-details">
                                    Kindly add an item to you cart to continue
                                </div>
                                <br/>
                                <div class="error-actions">
                                    <a target="_blank" href="{{ url('/') }}" class="btn btn-primary btn-lg"><span
                                            class="glyphicon glyphicon-home"></span>
                                        Take Me Home </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

        </section>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Scan your barcode</h4>
                </div>
                <div class="modal-body">
                    <video id="preview"></video>

                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" value="1" autocomplete="off" checked> Front Camera
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" value="2" autocomplete="off" checked> Back Camera
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
        integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" rel="nofollow"></script> -->
    <script type="text/javascript">


        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            preferredCountries: ['GB', 'NG', 'GH', 'US'],
            initialCountry: "gb",
            separateDialCode: true,
            utilsScript: "/js/phone_lib/js/utils.js",
            hiddenInput: "hidden_phone",
            nationalMode: false,

        });


        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
            var payment_method = $(this).data();
            $("#payment_method").val(payment_method.value);
        });

        $(function () {
            $('.date_picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('.date_picker1').datetimepicker({
                format: 'MM/DD/YYYY'
            });

        });


        function vaccination_check() {
            var check = $("#vaccination_status").val();
            console.log(check);

            if (check == 2 || check == 3) {
                $("#vaccination_type_div").show();
                $("#vaccination_date_div").show();
            } else if (check == 1 || !check) {
                $("#vaccination_type_div").hide();
                $("#vaccination_date_div").hide();
            }
        }

        function voucherOption() {
            var $card = $("#card");
            var $vouch = $(".voucher_input");
            $card.hide();
            $vouch.show();
        }

        function run() {

            var nationality = document.getElementById("travel_from").value;
            var $vouch = $(".voucher_input");

            if (nationality == 156) {
                var $card = $(".card_type");

                $card.empty(); // remove old options
                $card.append($("<option value=''>Select type of card</option>"));
                $card.append($("<option></option>").attr("value", 1).text("Local Card"));
                $card.append($("<option></option>").attr("value", 2).text("International Card"));
                $("#card").show();
                $vouch.hide();
            } else {
                $("#card").hide();
                $vouch.hide();
            }


        }
        
        function gettime()
        {
            var info = document.getElementById('test_location').value;
            var date = document.getElementById('test_date').value;
           
            var $el = $(".get_dam_time");
            var $v = $('#dam_time')
        
            if (info !== '' && date !== '') {

                const obj = JSON.parse(info);
                const room = JSON.parse(obj.room);
                @if($carts_count > 0)
                 const product = "{!! optional(optional($cart)->vendorProduct)->walk_product_id !!}";
                @else
                    const product = "{!! $walkin !!}";
                @endif
                const location = obj.location;
                const room_id = room.roomid;
                

                console.log(obj.location);
                console.log(obj);
                console.log(room.roomid);
                console.log(product);

                var url = '/check/time/damlocation/'+location+'/'+room_id+'/'+product+'?from='+ date;
                $v.show();
                    $.get(url, function (data) {
                        
                        $el.empty(); // remove old options
                        
                        $el.append($("<option value=''>Select an available time </option>"));

                        $.each(data, function (key, value) {

                            $el.append($("<option></option>")
                                .attr("value", value.name).text(value.name));
                        });

                    });
                console.log('yes');
            } else {
                $el.empty();
                $v.hide();
                console.log('no');
            }
        }


        function veriy() {
            var email = document.getElementById('email').value;
            var email2 = document.getElementById('verify_email').value;
            var answer = $(".answer");
            console.log(email, email2);
            if (email == email2) {
                answer.empty();
                answer.append($("<small class='text-muted' style='color:green'>CORRECT! THE EMAILS MATCH</small>"));
                $answer.show();
            } else {
                answer.empty();
                answer.append($("<small class='text-muted' style='color:red'>INCORRECT! THE EMAILS DO NOT MATCH</small>"));
                answer.show();
            }
        }

    </script>


@endsection
