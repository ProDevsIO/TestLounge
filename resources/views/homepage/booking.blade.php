
@extends('layouts.home')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" integrity="sha512-aEe/ZxePawj0+G2R+AaIxgrQuKT68I28qh+wgLrcAJOz3rxCP+TwrK5SPN+E5I+1IQjNtcfvb96HDagwrKRdBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .iti {
            width: 100%;
        }

        .show_required {
            color: red;
        }
        @media screen and (max-width: 800px) {
            .bs-stepper-header {
                display: block;
                align-items: center;
            }
        }
        }
    </style>
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
                            <p style="margin-bottom: 25px">Before entering the UK, all visitors must
                                provide a negative test within the last 72 hours and fill out a Passenger Locator
                                Form.</p>
                        </div>
                    </div>
                </div><!--end of row-->

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
                                <form class="needs-validation" method="post" action="/post/booking">
                                    <!-- your steps content here -->
                                    <div id="products-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="logins-part-trigger">

                                        <div class="col-md-12">
                                            <label>Test type <span class="show_required"> *</span></label>
                                            <select class="form-control" id="product_id_" name="product_id" required>
                                                <option value="">Make a selection</option>
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}" @if(isset($_GET['product_id']) && $_GET['product_id'] == $product->id)
                                                        selected
                                                        @endif>{{ $product->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br/>


                                        <button class="btn btn-primary pull-right" style="margin-top: 30px" onclick="stepperForm.next()">Next
                                        </button>
                                    </div>
                                    <div id="logins-part" class="content bs-stepper-pane" role="tabpanel"
                                         aria-labelledby="logins-part-trigger">
                                        <div class="col-md-6 ">
                                            <label>First Name <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" placeholder="First name"
                                                   name="first_name"
                                                   value="{{ old('first_name') }}" required>
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
                                                <option value="1">Male</option>
                                                <option value="2">Female</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Date of Birth <span class="show_required"> *</span></label>
                                            <input class="form-control date_picker" type="text" placeholder="Date of Birth"
                                                   name="dob"
                                                   value="{{ old('dob') }}" required>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Ethnicity <span class="show_required"> *</span></label>
                                            <select class="form-control" name="ethnicity" required>
                                                <option value="">Make a selection</option>
                                                <option value="1">White</option>
                                                <option value="2">Mixed/Multiple Ethnic groups
                                                </option>
                                                <option value="3">Asian/Asian British</option>
                                                <option value="4">
                                                    Black/African/Caribbean/Black British
                                                </option>
                                                <option value="5">Other Ethnic group</option>

                                            </select>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>NHS Number (If known and applicable): </label>
                                            <input class="form-control" type="text" name="nhs_number" id="nhs"
                                                   value="{{ old('nhs_number') }}"/>
                                        </div>


                                        <div class="col-md-12">
                                            <label>Vaccination Status: <span class="show_required"> *</span></label>
                                            <select class="form-control" name="vaccination_status" required>
                                                <option value="">Make a selection</option>
                                                <option value="1">Has not been vaccinated.</option>

                                                <option value="2">Has received the first dose, but not the second.
                                                </option>

                                                <option value="3">Has received both first and second dose.
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6" style="margin-top: 20px">
                                            <label>Contact Phone Number: <span
                                                        class="show_required"> *</span></label><br/>

                                            <input style="width: 100%;" class="form-control" id="phone" type="text"
                                                   name="phone_no"
                                                   value="{{ old('phone_no') }}" required/>
                                        </div>


                                        <div class="col-md-6" style="margin-top: 20px">
                                            <label>Contact Email: <span class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="email"
                                                   value="{{ old('email') }}" required/>
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
                                            <select class="form-control" name="home_country_id" required>
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

                                            <p>
                                                This is the address where you will be during isolation
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
                                            <select class="form-control" name="isolation_country_id" required>
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('home_country_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
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
                                            <label>Document ID Number: <span class="show_required"> *</span> </label>
                                            <input class="form-control" type="text" name="document_id"
                                                   value="{{ old('document_id') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                            <input class="form-control date_picker" type="text" placeholder="Arrival Date in Uk"
                                                   name="arrival_date"
                                                   value="{{ old('arrival_date') }}" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Country travelled from: <span
                                                        class="show_required"> *</span></label>
                                            <select class="form-control" name="country_travelling_from_id" required>
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('country_travelling_from_id') == $country->id)
                                                            selected
                                                            @endif>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>City you are departing from: <span
                                                        class="show_required"> *</span></label>
                                            <input class="form-control" type="text" name="city_from"
                                                   value="{{ old('city_from') }}" required/>
                                        </div>

                                        <div class="col-md-12">
                                            <label> Departure Date: <span class="show_required"> *</span></label>
                                            <input class="form-control date_picker" type="text" placeholder="Arrival Date in Uk"
                                                   name="departure_date"
                                                   value="{{ old('departure_date') }}" required>
                                        </div>

                                        <div class="col-md-12">
                                            <label> Last day you were in a country/territory that was not in a travel
                                                corridor
                                                arrangement with the UK: <span class="show_required"> *</span><br/>
                                                <span class="field-description">You can find the current list <a
                                                            href='https://www.gov.uk/guidance/coronavirus-covid-19-travel-corridors'>here</a>:</span>
                                            </label>
                                            <input class="form-control date_picker" type="text" placeholder="Arrival Date in Uk"
                                                   name="last_day_travel"
                                                   value="{{ old('last_day_travel') }}" required>
                                        </div>


                                        <div class="col-md-6">
                                            <label> What method of transport will you be entering the UK on: <span
                                                        class="show_required"> *</span></label>
                                            <select class="form-control" name="method_of_transportation" required>
                                                <option value="">Make a selection</option>
                                                <option value="1">Airplane</option>

                                                <option value="2">Vessel</option>

                                                <option value="3">Train</option>

                                                <option value="4">Road Vehicle</option>

                                                <option value="5">Other</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Flight Number / Coach Number / Vessel Name: <span
                                                        class="show_required"> *</span></label>
                                            <input class="form-control" type="text" required name="transport_no"
                                                   value="{{ old('transport_no') }}"/>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Consent to Test: <span class="show_required"> *</span></label><br/>
                                            <span class="field-description">I consent to this test being done, or if this test is for a child, I confirm I am a legal guardian of the child and consent to this test being done.</span>

                                            <input class="pull-left" required type="checkbox" name="consent" value="1"
                                            />
                                        </div>
                                        @if(isset($_GET['ref']))
                                            <input type="hidden" name="ref" value="{{ $_GET['ref'] }}">
                                        @endif

                                        <div class="col-md-12" style="margin-top:25px;">
                                            <label>Select Vendor <span class="show_required"> *</span></label>
                                            <select class="form-control" id="vendor_id" name="vendor_id" onchange="checkPrice()" required>
                                                <option value="">Make a selection</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->id }}">{{ $vendor->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br/>

                                        <h3 class="pull-left price_li" style="padding: 0px 20px;color: red;margin-top: 30px;"></h3>

                                        <button type="button" disabled class="sub_btn_u btn btn-primary pull-right" style="margin-top: 20px;color: #fff;">Make Payment  </button>


                                        <button type="submit" class="sub_btn btn btn-primary pull-right" style="display: none;margin-top: 20px">Make Payment
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
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>

        function checkPrice(){
            var vendor_id = $("#vendor_id").val();
            var product_id = $("#product_id_").val();
            var url = '/check/price/'+ vendor_id + "/" + product_id;
            console.log(url);
            $.get(url,function(data){
                $(".sub_btn").toggle();
                $(".sub_btn_u").toggle();
                $(".price_li").html("Cost: N" + (parseInt(data.price)).toLocaleString());
            });
        }

        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
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
            form.classList.remove('was-validated')
            var nextStep = event.detail.indexStep
            var currentStep = nextStep

            if (currentStep > 0) {
                currentStep--
            }

            var stepperPan = stepperPanList[currentStep];

            var form1 = $("#logins-part input").filter(function () {
                if (this.id != "nhs") {
                    return $.trim($(this).val()).length == 0
                }
            }).length == 0;

            var form1_select = $("#logins-part select").filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;

            var form2 = $("#information-part input").filter(function () {

                if (this.id != "address2" || this.id != "isolation_address2") {
                    return $.trim($(this).val()).length == 0
                }
            }).length == 0;

            var form2_select = $("#information-part select").filter(function () {
                return $.trim($(this).val()).length == 0
            }).length == 0;

            if ((stepperPan.getAttribute('id') === 'logins-part' && (!form1 && !form1_select)) ||
                (stepperPan.getAttribute('id') === 'information-part' && (!form2 && !form2_select))) {
                event.preventDefault()

                form.classList.add('was-validated')
            }
        });


        $(function () {
            $('.date_picker').datetimepicker({
                format: 'MM/DD/YYYY'
            });
        });
    </script>
@endsection