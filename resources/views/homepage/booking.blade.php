@extends('layouts.home')

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
                    <div style="margin: auto;width: 500px;">
                        <form class="email-form">
                            <div class="row">
                                <div class="col-md-6 ">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" placeholder="First name" name="first_name"
                                           value="{{ old('first_name') }}" required>
                                </div>
                                <div class="col-md-6 ">
                                    <label>Surname</label>
                                    <input class="form-control" type="text" placeholder="Surname" name="last_name"
                                           value="{{ old('last_name') }}" required>
                                </div>

                                <div class="col-md-6"
                                     style="margin-bottom: 20px">
                                    <label>Sex</label>
                                    <select class="form-control" name="sex" required>
                                        <option value="">Make a selection</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Date of Birth</label>
                                    <input class="form-control" type="date" placeholder="Date of Birth" name="dob"
                                           value="{{ old('dob') }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label>Ethnicity </label>
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
                                    <input class="form-control" type="text" name="nhs_number"
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


                                <div class="col-md-12" style="margin-top: 20px">
                                    <label>Document ID Number: <span class="show_required"> *</span> </label>
                                    <input class="form-control" type="text" name="document_id"
                                           value="{{ old('document_id') }}" required/>
                                </div>
                                <div style="margin-bottom: 20px" class="col-md-12">

                                <h3>
                                    Home Address
                                </h3>

                                <p>
                                    This is the address where you reside
                                </p>
                                </div>

                                <div class="col-md-12" >
                                    <label>Home Address 1: <span class="show_required"> *</span> </label>
                                    <input class="form-control" type="text" name="address_1"
                                           value="{{ old('address_1') }}" required/>
                                </div>

                                <div class="col-md-12">
                                    <label>Home Address 2: </label>
                                    <input class="form-control" type="text" name="address_1"
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
                                <div style="margin-top: 20px;margin-bottom: 20px" class="col-md-12">
                                <h3>
                                    Travel Details
                                </h3>
                                </div>
                                <div class="col-md-6">
                                    <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                    <input class="form-control" type="date" placeholder="Arrival Date in Uk"
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

                                <div class="col-md-12">
                                    <label>City you are departing from: <span class="show_required"> *</span></label>
                                    <input class="form-control" type="text" name="city_from"
                                           value="{{ old('city_from') }}"  required/>
                                </div>

                                <div class="col-md-12">
                                    <label> Departure Date: <span class="show_required"> *</span></label>
                                    <input class="form-control" type="date" placeholder="Arrival Date in Uk"
                                           name="departure_date"
                                           value="{{ old('departure_date') }}" required>
                                </div>

                                <div class="col-md-12">
                                    <label> Last day you were in a country/territory that was not in a travel corridor
                                        arrangement with the UK: <span class="show_required"> *</span><br/>
                                        <span class="field-description">You can find the current list <a
                                                    href='https://www.gov.uk/guidance/coronavirus-covid-19-travel-corridors'>here</a>:</span>
                                    </label>
                                    <input class="form-control" type="date" placeholder="Arrival Date in Uk"
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

                                <div style="margin-top: 20px;margin-bottom: 20px" class="col-md-12">

                                <h3>
                                    Contact Details
                                </h3>
                                </div>
                                
                                <div class="col-md-6">
                                    <label>Contact Phone Number: <span class="show_required"> *</span></label><br/>

                                    <input class="form-control" id="phone" type="text" name="phone_no"
                                           value="{{ old('phone_no') }}" required/>
                                </div>


                                <div class="col-md-6">
                                    <label>Contact Email: <span class="show_required"> *</span></label>
                                    <input class="form-control" type="text" name="email"
                                           value="{{ old('email') }}" required/>
                                </div>

                                <div class="col-md-12">
                                    <label>Consent to Test: <span class="show_required"> *</span></label><br/>
                                    <span class="field-description">I consent to this test being done, or if this test is for a child, I confirm I am a legal guardian of the child and consent to this test being done.</span>

                                    <input class="pull-left" required type="checkbox" name="consent" value="1"
                                           />
                                </div>
                                <br/>
                                <br/>
                                <input type="submit" class="btn btn-primary pull-right" style="background: #1a8bb3"/>
                            </div>
                        </form>
                    </div>
                </div><!--end of photo form wrapper-->


            </div><!--end of container-->

        </section>
    </div>

@endsection

@section('script')
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "gb",
            utilsScript: "/js/phone_lib/js/utils.js",
        });
    </script>
@endsection