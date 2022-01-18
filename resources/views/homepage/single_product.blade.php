@extends('layouts.home')
@section('style')

@endsection
@section('content')
    <div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <!-- <h3 class="page-title">Day 2 / Book a Test</h3> -->
                    <h1 class="page-description">{{$product->name}}</h1>
                    <p><span class="badge" style="font-size: 25px;">£ {{optional($sproducts)->price_pounds}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-header-->
    <div class="page-breadcrumb">
        <!--page-breadcrumb-->
        <!-- page-breadcrumb -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/">Home</a></li>
                        <li class="active">{{$product->name}}</li>

                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--/.page-breadcrumb-->
    <div class="content">
        <!--content-->
        <div class="container">
            @include('errors.showerrors')
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <h1>{{$product->name}}</h1>
                    <p style="text-align: justify">{!! $product->description !!} </p>


                    <!--/.st-accordion-->
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px">
                    <div class="sidebar">

                        <!--/.sidenav-->
                        <div class="appointment-block">
                            <!--appointment-block-->

                            <div class="bg-default widget-appointments">
                                @if($sproducts != null)
                                    <div class=" ">
                                        <h2 class="mb20">Book Test</h2>
                                    </div>
                                    <form class="form-horizontal " method="post"
                                          action="{{ url('/post/booking') }}"">
                                    @csrf
                                <!-- Text input-->
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>First Name <span class="show_required"> *</span>
                                            </label>
                                            <input type="text" placeholder="First name" name="first_name"
                                                   value="{{ old('first_name') }}"
                                                   style="margin-bottom:0px;" class="form-control input-md" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Surname <span class="show_required"> *</span></label>
                                            <input type="text" placeholder="Surname" name="last_name"
                                                   class="form-control input-md" value="{{ old('last_name') }}"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>Contact Email: <span class="show_required"> *</span></label>

                                            <input type="text" name="email" value="{{ old('email') }}" id="email"
                                                   class="form-control input-md" required/>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12" style="margin-top: 20px">
                                            <label>Re-enter Contact Email: <span class="show_required"> *</span></label>
                                            <div class="answer">

                                            </div>
                                            <input type="text" id="verify_email" onkeyUp="veriy()" name="verify_email"
                                                   value="{{ old('verify_email') }}" autocomplete="off"
                                                   class="form-control input-md" required/>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12 " style="margin-top: 20px">
                                            <label>Phone number<span class="show_required"> *</span></label>
                                            <br>
                                            <input id="phone" type="text" value="" name="phone_no"
                                                   class="form-control input-md" placeholder="Phone No" required>
                                            <input id="hidden_phone" type="hidden" name="phone_full">
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6" style="margin-bottom: 20px">
                                            <label>Sex <span class="show_required"> *</span></label>
                                            <select class="select-2 form-control input-md" name="sex" required>
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
                                            <input class="form-control input-md" type="date" placeholder="Date of Birth"
                                                   name="dob" value="{{ old('dob') }}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label>Ethnicity <span class="show_required"> *</span></label>
                                            <select class="select-2 form-control input-md" name="ethnicity" required>
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
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label> Country travelling from:</label>
                                            <select style="width: 100%;" class="select-2 form-control input-md"
                                                    name="country_travelling_from_id" required>
                                                <option value="">Make a selection</option>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->id }}"
                                                            @if(old('country_travelling_from_id') == $country->id)
                                                            selected
                                                        @endif>{{ $country->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label>Isolation Address1: <span class="show_required"> *</span> </label>
                                            <input class="form-control input-md" type="text" name="isolation_address"
                                                   placeholder="apartment, building, block, street"
                                                   value="{{ old('isolation_address') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Isolation Address2: </label>
                                            <input class="form-control input-md" type="text" name="isolation_address2"
                                                   id="isolation_address2"
                                                   placeholder="apartment, building, block, street"
                                                   value="{{ old('isolation_address2') }}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                            <input class="form-control input-md" type="text" name="isolation_town"
                                                   value="{{ old('isolation_town') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Isolation Postcode: <span class="show_required"> *</span></label>
                                            <input class="form-control input-md" type="text"
                                                   name="isolation_postal_code"
                                                   value="{{ old('isolation_postal_code') }}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Isolation Country:</label>
                                            <select style="width: 100%;" class="select-2 form-control input-md"
                                                    name="isolation_country_id" required readonly>
                                                <option value="">Make a selection</option>

                                                <option value="225" selected>UNITED KINGDOM
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label> Departure Date: <span class="show_required"> *</span></label>
                                            <input class="date_picker form-control input-md" type="date"
                                                   placeholder="Departure Date in UK" name="departure_date"
                                                   value="{{ old('departure_date') }}"
                                                   required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                            <input class="date_picker1 form-control input-md" type="date"
                                                   placeholder="Arrival Date in UK" name="arrival_date"
                                                   value="arrival_date" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Are you currently experiencing Symptoms: <span class="show_required"> *</span></label>
                                            <select class="form-control" name="symptom">
                                                <option>Make a selection</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>

{{--                                        <div class="col-md-6">--}}
{{--                                            <label>Are you currently experiencing Symptoms: <span class="show_required"> *</span></label>--}}
{{--                                            <select class="form-control" name="symptom">--}}
{{--                                                <option>Make a selection</option>--}}
{{--                                                <option value="yes">Yes</option>--}}
{{--                                                <option value="no">No</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}

                                        <br>

                                    </div>
                                    <input type="checkbox" name="consent" value="1" id="TCs" required
                                           style="display: inline-block;">
                                    <p style="display: inline-block;">I agree to the <a href="/terms"><strong>terms and
                                                conditions</strong></a></p>
                                    <input type="hidden" value="{{$sproducts->id}}" name="vproduct">
                                    <input type="hidden" value="stripe" name="payment_method">

                                    <!-- Button -->
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button id="singlebutton" type="submit" name="singlebutton"
                                                    class="btn btn-default btn-block">Make Payment
                                                (£{{$sproducts->price_pounds}})
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                @else
                                    <h3 class="test-center" style="color:white"><b>No price available yet<b></h3>
                                @endif
                            </div>

                        </div>

                    </div>
                    <!--/.sidebar-->
                </div>
            </div>
        </div>
    </div>
    <!--/.content-->

    <!--/.full-cta-->
    @include('includes.home_footer')
    <!--/.footer-->
@endsection
@section('script')
    <script>
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "gb",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            hiddenInput: "hidden_phone",
            nationalMode: false,
        });

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
