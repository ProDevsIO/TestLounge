@extends('layouts.home')
@section('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="/css/booking.css">

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
                                    <small class="text-muted" style="color:red"> Please provide only ONE email address
                                    </small>
                                    @if(isset($voucher))
                                    <input type="text" name="email" value="{{ $voucher->email }}" required/>

                                    @else

                                    <input type="text" name="email" value="{{ old('email') }}" required/>
                                    @endif

                                </div>
                                <div class="col-md-12 " style="margin-top: 20px">
                                    <label>Phone number<span class="show_required"> *</span></label>
                                    <input id="phone" style="" type="text" value="{{ old('phone_no') }}" name="phone_no"
                                           class=" pr-5" placeholder="Phone No" required>
                                           <input id="hidden_phone" type="hidden" name="phone_full">
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
                                           value="{{ old('isolation_address') }}" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Address2: </label>
                                    <input class="" type="text" name="isolation_address2"
                                           id="isolation_address2"
                                           value="{{ old('isolation_address2') }}"/>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                    <input class="" type="text" name="isolation_town"
                                           value="{{ old('isolation_town') }}" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Postcode: <span class="show_required"> *</span></label>
                                    <input class="" type="text" name="isolation_postal_code"
                                           value="{{ old('isolation_postal_code') }}" required/>
                                </div>
                                <div class="col-md-6">
                                    <label>Isolation Country: <span class="show_required"> *</span></label>
                                    <select style="width: 100%;" class="select-2"
                                            name="isolation_country_id" required readonly>
                                        <option value="">Make a selection</option>

                                        <option value="225" selected
                                        >UNITED KINGDOM
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Country travelled from: <span
                                                class="show_required"> *</span></label>
                                    <select class="select-2 select2 country_id__"
                                            name="country_travelling_from_id" autocomplete="off"
                                            id="travel_from"  onselect="selectCountry()">
                                        <option value="">Make a selection</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}"
                                                    @if(old('country_travelling_from_id') == $country->id)
                                                    selected
                                                    @endif>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
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
                                           value="{{ old('arrival_date') }}" required>
                                </div>

                                @if(isset($_GET['ref']))
                                    <input type="hidden" name="ref" value="{{ $_GET['ref'] }}">
                                @endif

                                <div class="col-md-12">
                                    <div style="margin-top: 10px">
                                        <label class="">Select a Payment Method</label>
                                        @if(isset($voucher))
                                        <div class="color-3"> Kindly click on the payment method(PAY WITH VOUCHER)</div>
                                        @else
                                        <div class="color-8"> Kindly choose your payment method</div>
                                        @endif
                                        <div class="radio-group">
                                            @if(isset($voucher))
                                                <div class='radio'
                                                    style="background:none;border:none;padding: 25px 40px;height: 86px;border-radius:25px"
                                                    data-value="voucher" onclick ="voucherOption()">
                                                    <img src="https://img.icons8.com/fluency/32/000000/ticket-purchase.png"
                                                        style="padding-bottom: 0px;"/> <span><label> Pay with <b>voucher</b></label></span>

                                                </div>
                                            @else
                                            <div class='radio'
                                                 style="background:none;border:none;padding: 0px 20px;height: 86px;border-radius:25px;"
                                                 data-value="flutterwave" onclick ="run()">
                                                <img src="{{ url('/img/Flutterwave.png') }}"
                                                     style="padding-bottom: 0px;width: 200px;">
                                            </div>

                                            

                                            {{--<div class='radio'--}}
                                                 {{--style="background:none;border:none;padding: 8px 40px;height: 86px;border-radius:25px"--}}
                                                 {{--data-value="vastech" onclick ="run()">--}}
                                                {{--<img src="{{ url('/img/vas.svg') }}"--}}
                                                     {{--style="padding-bottom: 0px;margin-left: -38px"/> <span><label>--}}

                                            {{--</div>--}}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="form-section">
                                    <div class="voucher_input" style="margin-top:20px;display:none;" >
                                        <label>Voucher Number<span class="show_required"> *</span></label>
                                        <small class="text-muted" style="color:red"> Please provide a valid voucher number given to you by an agent
                                        </small>
                                        @if(isset($voucher))
                                        <input class="" type="text" name="voucher" value="{{ $voucher->voucher }}" readonly/>
                                        @else
                                        <input class="" type="text" name="voucher" value="{{ old('voucher') }}" />
                                        @endif
                                    </div>
                                    <div id="card" style="margin-top:20px;display:none;">
                                        <label>Select Card types <span class="show_required"> *</span></label>
                                        <small class="text-muted" style="color:red"><b>Please select a card payment
                                                option</b></small>
                                        <select class="select-2 card_type" autocomplete="off" name="card_type">

                                        </select>
                                    </div>

                                    <div class="col-md-12 color-9">
                                        <label>Consent to Test <span class="color-10">*</span></label>
                                        <div class="color-8"><input type="checkbox" name="consent" value="1"
                                                                    class="bg-1"/>
                                            I consent to this test being done, or if this test
                                            is for a child, I confirm I am a legal guardian of the child and consent to
                                            this test being done.

                                        </div>
                                    </div>
                                    <br/><br/>
                                    <span
                                            class="color-10" style="margin-left: 17px;margin-top: 10px">Bookings can’t be cancelled or refunded</span>

                                </div>
                                <input type="hidden" name="payment_method" value="flutterwave" id="payment_method"/>

                                <input type="submit" class="btn btn-primary pull-right" style="margin-top: 0px;" value="Make Payment">


                            </form>

                        @else
                            <div class="alert alert-danger text-center">
                                <h1>
                                    Oops!</h1>
                                <h2>
                                    No Item has been selected</h2><br/>
                                <div class="error-details">
                                    Kindly add an item to you cart to continue
                                </div><br/>
                                <div class="error-actions">
                                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg"><span
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

@endsection

@section('script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
            integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
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

        function voucherOption()
        {
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
                $card.append($("<option></option>").attr("value", 1).text("Nigerian Card"));
                $card.append($("<option></option>").attr("value", 2).text("Non-Nigerian Card"));
                $("#card").show();
                $vouch.hide();
            } else {
                $("#card").hide();
                $vouch.hide();
            }


        }

    </script>


@endsection