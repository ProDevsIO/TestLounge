@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
          integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }

        .choices__input {
            width: 100%;
            margin-bottom: 0px;
        }

        @media screen and (max-width: 800px) {
            .bs-stepper-header {
                display: block;
                align-items: center;
            }
        }

        #descript {
            margin-top: 20px;
            width: 90%;
        }


        .radio-group {
            position: relative;
            margin-bottom: 25px
        }

        .radio {
            display: inline-block;
            height: 64px;
            border-radius: 0;
            background: #eee;
            box-sizing: border-box;
            border: 1px solid lightgrey;
            cursor: pointer;
            margin: 8px 25px 8px 0px
        }

        .radio:hover {
            box-shadow: 0px 0px 0px 1px rgba(0, 0, 0, 0.2)
        }

        .radio.selected {
            box-shadow: 0px 0px 0px 4px rgba(0, 0, 0, 0.4)
        }

        @media screen and (max-width: 600px) {
            .radio {
                width: 100%
            }
        }
    </style>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css"
          integrity="sha512-DJ1SGx61zfspL2OycyUiXuLtxNqA3GxsXNinUX3AnvnwxbZ+YQxBARtX8G/zHvWRG9aFZz+C7HxcWMB0+heo3w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')

    <div class="main-container">
        <section class="contact-photo">


            <div class="container">
                <div class="row">

                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
                        <div class="card-body">
                            <h1>Book your test
                            </h1>
                            @if(isset($_GET['ref']) && isset($user))
                                @if($user->agent_show_name == 1)
                                    <div style="margin-top: -10px;"><span
                                                class="badge badge-warning">Company: {{ (isset($user->company)) ?$user->company : $user->first_name." ".$user->last_name }}</span>
                                    </div>  <br/>  
                                @endif
                            @endif
                            <p style="margin-bottom: 25px">To be allowed to board a flight to the UK, Your airline will
                                require a negative PCR Test within 72 hours of your travel date , evidence of booking
                                your UK covid tests and completion of your Passenger Locator Form.

                                Following your booking , you will immediately recieve a code on screen and via the email
                                provided .
                                This code must be inputted in the UK Passenger Locator Form</p>
                        </div>
                    </div>
                </div><!--end of row-->
                @include('errors.showerrors')
                <div class="photo-form-wrapper clearfix">
                    <div style="margin: auto;padding: 10px;">
                        <div class="bs-stepper" id="stepperForm">
                            <div class="bs-stepper-header" role="tablist">
                                <!-- your steps here -->
                                <div class="step" data-target="#products-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="products-part"
                                            id="products-part-trigger">
                                        <span class="bs-stepper-circle">1</span>
                                        <span class="bs-stepper-label">Product</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#logins-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="logins-part"
                                            id="logins-part-trigger">
                                        <span class="bs-stepper-circle">2</span>
                                        <span class="bs-stepper-label">Basic Information</span>
                                    </button>
                                </div>
                                <div class="line"></div>
                                <div class="step" data-target="#information-part">
                                    <button type="button" class="step-trigger" role="tab"
                                            aria-controls="information-part" id="information-part-trigger">
                                        <span class="bs-stepper-circle">3</span>
                                        <span class="bs-stepper-label">Address Information</span>
                                    </button>
                                </div>

                                <div class="line"></div>
                                <div class="step" data-target="#travel-part">
                                    <button type="button" class="step-trigger" role="tab" aria-controls="travel-part"
                                            id="travel-part-trigger">
                                        <span class="bs-stepper-circle">4</span>
                                        <span class="bs-stepper-label">Travel information/Payments</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bs-stepper-content" style="margin-top: 20px">
                           
                                <form class="needs-validation" method="post" action="/post/booking" autocomplete="off">
                                    <!-- your steps content here -->
                                    <div id="products-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="logins-part-trigger">

                                        <div class="col-md-12">
                                            <label>Country travelled from: <span
                                                        class="show_required"> *</span></label>
                                            <select class="form-control select2 country_id__"
                                                    name="country_travelling_from" autocomplete="off"
                                                    id="travel_from" onchange="run()" onselect="selectCountry()">
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('country_travelling_from_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="product_id" class="test_type_"/>
                                        <input type="hidden" name="country_travelling_from_id" class="country_id_"/>
                                        <div class="col-md-12" id="test" style="margin-top:20px;">
                                            <label>Select Test types <span class="show_required"> *</span></label> <small class="text-muted" style="color:red"> <b>Bookings can’t be cancelled or refunded</b> </small>
                                            <select class="form-control test_type" autocomplete="off"
                                                    onchange="test_type_select()"
                                                    name="product_id_"
                                            >

                                            </select>
                                        </div>
                                        <br/>
                                        <br>

                                        <div class="container p-2">
                                            <div class="col-md-12 bg-success" id="descript">

                                            </div>
                                        </div>


                                        <button class="btn btn-primary pull-right" style="margin-top: 30px"
                                                onclick="stepperForm.next()">Next
                                        </button>
                                    </div>
                                    
                                    <div id="logins-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="logins-part-trigger">
                                    
                                        <div class="col-md-6 ">
                                        <label>First Name <span class="show_required"> * <b>Children aged 4 and under don’t require COVID-19 travel tests. <a target="_blank" href="https://www.gov.uk/guidance/how-to-quarantine-when-you-arrive-in-england#rules-for-children-and-young-people">Learn more</a></b></span> 
                                       </label>
                                            <input class="form-control" type="text" placeholder="First name"
                                                   name="first_name"
                                                   value="{{ old('first_name') }}"  style="margin-bottom:0px;" required>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label>Surname <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" placeholder="Surname"
                                                   name="last_name"
                                                   value="{{ old('last_name') }}" required>
                                        </div>

                                        <div class="col-md-6"
                                             style="margin-bottom: 20px">
                                            <label>Sex <span class="show_required"> *</span></label>
                                            <select class="form-control" name="sex" required>
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
                                            <input class="form-control date_picker" type="text"
                                                   placeholder="Date of Birth"
                                                   name="dob"
                                                   value="{{ old('dob') }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Ethnicity <span class="show_required"> *</span></label>
                                            <select class="form-control" name="ethnicity" required>
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

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>NHS Number (If known and applicable): </label>
                                            <input class="form-control" type="text" name="nhs_number" id="nhs"
                                                   value="{{ old('nhs_number') }}"/>
                                        </div>


                                        <div class="col-md-12">
                                            <label>Vaccination Status: <span class="show_required"> *</span></label>
                                            <select class="form-control" id="vaccination_status"
                                                    name="vaccination_status" onchange="vaccination_check()" required>
                                                <option value="">Make a selection</option>
                                                <option value="1">Not been vaccinated</option>

                                                <option value="2">Received the first dose, but not the second
                                                </option>

                                                <option value="3">Received both first and second dose
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-12" id="vaccination_type_div"
                                             style="margin-top: 30px;display: none;">
                                            <label>Vaccination Type:</label>
                                            <select class="form-control" id="vaccination_type" name="vaccination_type">
                                                <option value="">Make a selection</option>
                                                <option value="Janssen vaccine">Janssen Vaccine</option>
                                                <option value="Pfizer">Pfizer</option>
                                                <option value="Moderna">Moderna</option>
                                                <option value="Oxford/AZ">Oxford/AZ</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12" id="vaccination_date_div"
                                             style="margin-top: 20px;display: none;">
                                            <label>Vaccination Date:</label>
                                            <input class="form-control date_picker" id="vaccination_date" type="text"
                                                   placeholder="Vaccination date"
                                                   name="vaccination_date"
                                                   value="{{ old('vaccination_date') }}">
                                        </div>
                                        <div class="col-md-6" style="margin-top: 20px">
                                            <label>Contact Phone Number(In the UK): <span
                                                        class="show_required"> *</span></label><br/>

                                            <input style="width: 100%;" class="form-control" id="phone" type="text"
                                                   name="uk_phone_no"
                                                   value="{{ old('uk_phone_no') }}" required/>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 20px">
                                            <label>Contact Phone Number(In country of origin): <span
                                                        class="show_required"> *</span></label><br/>

                                            <input style="width: 100%;" class="form-control" id="phone2" type="text"
                                                   name="phone_no"
                                                   value="{{ old('phone_no') }}" required/>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>Contact Email: <span class="show_required"> *</span></label> <small class="text-muted" style="color:red"> Please provide only ONE email address</small>
   
                                            <input class="form-control" type="email" name="email" value="{{ old('email') }}" required/>
                                        </div>
                                        <button class="btn btn-primary pull-right" onclick="stepperForm.next()">Next
                                        </button>
                                        <button class="btn btn-primary pull-right"
                                                onclick="stepperForm.previous()">Previous
                                        </button>
                                    </div>
                                    <div id="information-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="information-part-trigger">
                                        <h3>
                                            Home Address
                                        </h3>

                                        <p>
                                            This is the address where you reside
                                        </p>


                                        <div class="col-md-12">
                                            <label>Home Address 1: <span class="show_required"> *</span> </label>
                                            <input class="form-control" type="text" name="address_1"
                                                   value="{{ old('address_1') }}" required/>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Home Address 2: </label>
                                            <input class="form-control" type="text" name="address_2" id="address2"
                                                   value="{{ old('address_2') }}"/>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Home City/Town: <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="home_town"
                                                   value="{{ old('home_town') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Home Postcode: <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="post_code"
                                                   value="{{ old('post_code') }}" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Home Country: <span class="show_required"> *</span></label>
                                            <select style="width: 100%;" class="form-control select2"
                                                    name="home_country_id" id="nationality"
                                                    required>
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('home_country_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div style="margin-top: 20px;margin-bottom: 20px" class="col-md-12">
                                            <h3>
                                                Isolation Address
                                            </h3>
                                            <br>
                                            <p>
                                                Your Test Package will be sent to this address
                                            </p>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Isolation Address1: <span class="show_required"> *</span> </label>
                                            <input class="form-control" type="text" name="isolation_address"
                                                   value="{{ old('isolation_address') }}" required/>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Isolation Address2: </label>
                                            <input class="form-control" type="text" name="isolation_address2"
                                                   id="isolation_address2"
                                                   value="{{ old('isolation_address2') }}"/>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="isolation_town"
                                                   value="{{ old('isolation_town') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Isolation Postcode: <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="isolation_postal_code"
                                                   value="{{ old('isolation_postal_code') }}" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Isolation Country: <span class="show_required"> *</span></label>
                                            <select style="width: 100%;" class="form-control select2"
                                                    name="isolation_country_id" required readonly>
                                                <option value="">Make a selection</option>

                                                <option value="225" selected
                                                        >UNITED KINGDOM
                                                </option>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary pull-right" style="margin-top: 20px"
                                                onclick="stepperForm.next()">Next
                                        </button>
                                        <button class="btn btn-primary pull-right" style="margin-top: 20px"
                                                onclick="stepperForm.previous()">Previous
                                        </button>
                                    </div>
                                    <div id="travel-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="information-part-trigger">
                                        <div style="margin-top: 20px;margin-bottom: 20px" class="col-md-12">
                                            <h3>
                                                Travel Details
                                            </h3>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>Travel Document ID/Passport Number: <span
                                                        class="show_required"> *</span> </label>
                                            <input class="form-control" type="text" name="document_id"
                                                   value="{{ old('document_id') }}" required/>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>City you are departing from: <span
                                                        class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="city_from"
                                                   value="{{ old('city_from') }}" required/>
                                        </div>

                                        <div class="col-md-12">
                                            <label> Departure Date(from country of origin): <span class="show_required"> *</span></label>
                                            <input class="form-control date_picker1" type="text"
                                                   placeholder="Arrival Date in UK"
                                                   name="departure_date"
                                                   value="{{ old('departure_date') }}" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                            <input class="form-control date_picker1" type="text"
                                                   placeholder="Arrival Date in UK"
                                                   name="arrival_date"
                                                   value="{{ old('arrival_date') }}" required>
                                        </div>


                                       

                                        <div class="col-md-12">
                                            <label> Last day you were in a country/territory that was not in a travel
                                                corridor
                                                arrangement with the UK: <span class="show_required"> *</span><br/>
                                                <span class="field-description">You can find the current list <a
                                                            href='https://www.gov.uk/guidance/red-amber-and-green-list-rules-for-entering-england'
                                                            target="_blank">here</a>:</span>
                                            </label>
                                            <input class="form-control date_picker1" type="text"
                                                   placeholder=""
                                                   name="last_day_travel"
                                                   value="{{ old('last_day_travel') }}" required>
                                        </div>


                                        <div class="col-md-6">
                                            <label> What method of transport will you be entering the UK on: <span
                                                        class="show_required"> *</span></label>
                                            <select class="form-control" name="method_of_transportation" required>
                                                <option value="">Make a selection</option>
                                                <option value="1" @if(old('method_of_transportation') == "1")
                                                selected
                                                        @endif>Airplane
                                                </option>

                                                <option value="2" @if(old('method_of_transportation') == "2")
                                                selected
                                                        @endif>Vessel
                                                </option>

                                                <option value="3" @if(old('method_of_transportation') == "3")
                                                selected
                                                        @endif>Train
                                                </option>

                                                <option value="4" @if(old('method_of_transportation') == "4")
                                                selected
                                                        @endif>Road Vehicle
                                                </option>

                                                <option value="5" @if(old('method_of_transportation') == "5")
                                                selected
                                                        @endif>Other
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Flight Number / Coach Number / Vessel Name / Airline: <span
                                                        class="show_required"> *</span></label>
                                            <input class="form-control" type="text" required name="transport_no"
                                                   value="{{ old('transport_no') }}"/>
                                        </div>

                                        <div class="col-md-12">
                                            <label>Choose Payment Method: <span
                                                        class="show_required"> *</span></label>
                                            <div class="alert alert-warning">
                                                * All cardholders are advised to use Flutterwave
                                            </div>
                                            <div class="radio-group">
                                                <input type="hidden" name="payment_method" id="payment_method"/>
                                                <!-- <div class='radio' data-value="stripe" style="margin-top: 10px"><img
                                                            src="{{ url('/img/stripe.png') }}"
                                                            height="60px"></div> -->
                                                <div class='radio' data-value="flutterwave" style="margin-top: 10px">
                                                    <img
                                                            src="{{ url('/img/Flutterwave.png') }}"
                                                            height="60px"></div>
                                                <br>
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-12" id="card" style="margin-top:20px;">
                                            <label>Select Card types <span class="show_required"> *</span></label> <small class="text-muted" style="color:red"> <b>please select your local or international card</b> </small>
                                            <select class="form-control card_type" autocomplete="off" name="card_type">

                                            </select>
                                        </div>
                                        <br>
                                        <div class="col-md-12">
                                            <label>Consent to Test: <span class="show_required"> *</span></label><br/>
                                            <p class="field-description" style="font-size: 15px;">I consent to this test
                                                being done, or if this test is for a child, I confirm I am a legal
                                                guardian of the child and consent to this test being done.</p>

                                            <input style="width:20px" class="pull-left" required type="checkbox"
                                                   name="consent" value="1"
                                            />
                                            <small class="text-muted" style="color:red"> Bookings can’t be cancelled or refunded </small>
                                        </div>
                                        @if(isset($_GET['ref']))
                                            <input type="hidden" name="ref" value="{{ $_GET['ref'] }}">
                                        @endif


                                        <br/>


                                        <!-- <h3 class="pull-left price_li" style="padding: 0px 20px;color: red;margin-top: 30px;"></h3> -->

                                        <button type="submit" class="sub_btn btn btn-primary pull-right"
                                                style="margin-top: 20px">Make Payment
                                        </button>

                                        <button class="btn btn-primary pull-right" style="margin-top: 20px"
                                                onclick="stepperForm.previous()">Previous
                                        </button>

                                    </div>

                                    @csrf
                                </form>
                            </div>
                        </div>

                    </div>
                </div><!--end of photo form wrapper-->


                <!--end of container-->
            </div>
        </section>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
            integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"
            integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/js/bootstrap-multiselect.min.js"
            integrity="sha512-ljeReA8Eplz6P7m1hwWa+XdPmhawNmo9I0/qyZANCCFvZ845anQE+35TuZl9+velym0TKanM2DXVLxSJLLpQWw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "gb",
            utilsScript: "/js/phone_lib/js/utils.js",
        });

        var input2 = document.querySelector("#phone2");
        window.intlTelInput(input2, {
            initialCountry: "gb",
            utilsScript: "/js/phone_lib/js/utils.js",
        });

        $(document).ready(function () {
            var stepper = new Stepper($('.bs-stepper')[0])
        })


        var stepperFormEl = document.querySelector('#stepperForm')
        window.stepperForm = new Stepper(stepperFormEl);

        var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
        var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
        var inputMailForm = document.getElementById('inputMailForm')
        var inputPasswordForm = document.getElementById('inputPasswordForm')
        var form = stepperFormEl.querySelector('.bs-stepper-content form')

        btnNextList.forEach(function (btn) {
            btn.addEventListener('click', function () {
                window.stepperForm.next()
            })
        })

        stepperFormEl.addEventListener('show.bs-stepper', function (event) {
            form.classList.remove('was-validated');
            var nextStep = event.detail.indexStep;
            var currentStep = nextStep;

            if (currentStep > 0) {
                currentStep--
            }

            var stepperPan = stepperPanList[currentStep];


            var form1 = $("#logins-part input").filter(function () {
                if (this.id == "nhs" || this.id == "vaccination_date") {
                } else {
                    return $.trim($(this).val()).length == 0
                }
            }).length == 0;


            var form1_select = $("#logins-part select").filter(function () {
                if (this.id == "vaccination_type") {

                } else {
                    return $.trim($(this).val()).length == 0
                }
            }).length == 0;

            var form2 = $("#information-part input").filter(function () {
                if (this.id == "address2" || this.id == "isolation_address2") {

                } else {
                    return $.trim($(this).val()).length == 0
                }
            }).length == 0;


            var form2_select = $("#information-part select").filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;

            var form3_select = $("#products-part select").filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;


            if ((stepperPan.getAttribute('id') === 'logins-part' && (!form1)) ||
                (stepperPan.getAttribute('id') === 'logins-part' && (!form1_select)) ||
                (stepperPan.getAttribute('id') === 'information-part' && (!form2)) ||
                (stepperPan.getAttribute('id') === 'information-part' && (!form2_select)) ||
                (stepperPan.getAttribute('id') === 'products-part' && (!form3_select))
            ) {
                event.preventDefault()

                form.classList.add('was-validated')
            }

        });


        $(function () {
            $('.date_picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('.date_picker1').datetimepicker({
                format: 'MM/DD/YYYY'
            });

        });

        $(document).ready(function () {
            $('.select2').select2({
                closeOnSelect: true
            });
        });


        function run() {
            var nationality = document.getElementById("travel_from").value;

            var url = '/check/' + nationality + '/price';

            $.get(url, function (data) {
                var $el = $(".test_type");
                $el.empty(); // remove old options
                $el.append($("<option value=''>Select a Product</option>"));

                $.each(data, function (key, value) {
                    $el.append($("<option></option>")
                        .attr("value", value.product_id).text(value.name + "(" + value.price + ")"));
                });

            });

            if( nationality == 156){
                var $card = $(".card_type");
                $card.empty(); // remove old options
                $card.append($("<option value=''>Select type of card</option>"));
                $card.append($("<option></option>").attr("value", 1).text("Local Card"));
                $card.append($("<option></option>").attr("value", 2).text("International Card"));

            }


        }

        function test_type_select() {
            var d = $(".test_type").val();
            $(".test_type_").val(d);
        }

        $('.country_id__').on('select2:select', function (e) {
            var data = e.params.data;
            // console.log(data);
            $(".country_id_").val(data.id);
        });
        $('.radio-group .radio').click(function () {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
            var payment_method = $(this).data();
            $("#payment_method").val(payment_method.value);
        });
    </script>
    <script>


        function descript() {
            var product_id = $("#product_id_").val();
            var url = '/product/descript/' + product_id;
            $("#descript")
                .find('p')
                .remove()
                .end();
            $.get(url, function (data) {

                var holder = document.getElementById("descript");
                var newNode = document.createElement('p');
                newNode.innerHTML = data;
                holder.appendChild(newNode);
                $("#descript p").addClass('alert alert-success')
            });
        }

        function vaccination_check() {
            var check = $("#vaccination_status").val();

            if (check == 2 || check == 3) {
                $("#vaccination_type_div").show();
                $("#vaccination_date_div").show();
            } else if (check == 1 || !check) {
                $("#vaccination_type_div").hide();
                $("#vaccination_date_div").hide();
            }
        }

    </script>

@endsection