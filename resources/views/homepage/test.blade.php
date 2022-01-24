@extends('layouts.home')
@section('style')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
          integrity="sha512-bYPO5jmStZ9WI2602V2zaivdAnbAhtfzmxnEGh9RwtlI00I9s8ulGe4oBa5XxiC6tCITJH/QG70jswBhbLkxPw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .mb-3 {
            margin-bottom: 1em;
        }

        .mb-5 {
            margin-bottom: 2em;
        }
    </style>
@endsection
@section('content')
    <div class="page-header">
        <!--page-header-->
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
                    <h1 class="page-description">Register your @php

                            if(isset($_GET['type']) && $_GET['type'] == "pcr"){
                                echo "PCR";
                            }else if(isset($_GET['type']) && $_GET['type'] == "lateral"){
echo "Lateral Flow";
                            }

                        @endphp Test Kit</h1>


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
                        <li class="active">Register your @php

                                if(isset($_GET['type']) && $_GET['type'] == "pcr"){
                                    echo "PCR";
                                }else if(isset($_GET['type']) && $_GET['type'] == "lateral"){
    echo "Lateral Flow";
                                }

                            @endphp Test Kit
                        </li>

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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 30px">
                    <div class="sidebar">

                        <!--/.sidenav-->
                        <div class="appointment-block">
                            <!--appointment-block-->

                            <div class="bg-default widget-appointments">

                                <div class=" ">
                                    <h3 class="mb40" style="font-size: 30px">Register your @php

                                            if(isset($_GET['type']) && $_GET['type'] == "pcr"){
                                                echo "PCR";
                                            }else if(isset($_GET['type']) && $_GET['type'] == "lateral"){
                echo "Lateral Flow";
                                            }

                                        @endphp Test</h3>
                                </div>
                                @include('errors.showerrors')
                                <form action="{{ url('submit/test') }}" method="post" id="patient-form"
                                      enctype="multipart/form-data" >


                                    <div class="row mb-3">
                                        <div class="col-sm-6 form-group mb-2">
                                            <label>Barcode
                                                number (Please check)</label>
                                            <input type="text"
                                                   name="barcode"
                                                   required
                                                   value="{{ old('barcode') }}"
                                                   class="form-control"
                                            >
                                        </div>
                                        <div class="col-sm-6 form-group mb-2"><label
                                                for="home_kit_registry_specimentId_second">Confirm
                                                Barcode number</label><input type="text"
                                                                             name="barcode_confirm"
                                                                             class="form-control"
                                                                             value="{{ old('barcode_confirm') }}"
                                                                             required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-12">
                                            <div class="form-group mb-2"><label for="home_kit_registry_specimentAt"
                                                >Date and time of
                                                    sampling</label>
                                                <input
                                                    class="form-control form-control input" value="{{ old('date_of_sampling') }}" name="date_of_sampling"  id="datetimepicker"
                                                    tabindex="0" type="text"></div>
                                        </div>
                                    </div>


                                    <div class="row mb-5">
                                        <div class="col-sm-12">
                                            <br/>
                                            <label class="col-form-label">Results observed</label>
                                            <p class="my-2">Please check the instructions included with your test
                                                kit to interpret the outcome of your analysis cassette.</p>
                                            <select class="form-control" name="result_observed" required>
                                                <option value="">Select your Result</option>
                                                <option @if(old('result_observed') && old('result_observed') == "positive")
                                                        selected
                                                        @endif value="positive">Positive</option>
                                                <option @if(old('result_observed') && old('result_observed') == "negative")
                                                        selected
                                                        @endif value="negative">Negative</option>
                                                <option @if(old('result_observed') && old('result_observed') == "inconclusive")
                                                        selected
                                                        @endif value="inconclusive">Inconclusive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-5">
                                        <div class="col-sm-12">
                                            <label for="home_kit_registry_resultPicture">Picture of the
                                                result *</label>
                                            <div class="clearfix"></div>
                                            <div class=" my-2 col-12 col-md-7">
                                                Please upload a picture clearly showing the following:
                                                <ul>
                                                    <li class="px-4">Your cassette (lateral flow device) showing the
                                                        test
                                                        result with your date of birth written on it
                                                    </li>
                                                    <li class="px-4">The box in which your test came, showing your
                                                        unique
                                                        barcode
                                                    </li>
                                                    <li class="px-4">Your passport, showing your picture, name, date of
                                                        birth, and passport number
                                                    </li>
                                                    <li class="px-4">All of these should appear in the same picture</li>
                                                    <li class="px-4">Make sure the picture is as clear as possible</li>
                                                </ul>
                                                <input type="file"
                                                       id="home_kit_registry_resultPicture"
                                                       name="picture"
                                                       required
                                                       class="form-control custom-file-input">
                                                <span
                                                    class="text-mutted">Only jpg/jpeg and png files are allowed!</span>
                                            </div>
                                            <div class="col-12 col-md-5 ">
                                                <img width="100%" src="/img/picture.jpg">
                                            </div>
                                        </div>
                                    </div>


                                    <div id="documents" class="">
                                        <hr class="my-4">
                                        <div class="row mb-3">
                                            <div class="col-sm-12">
                                                <label>Reasons for testing :</label>
                                            </div>
                                        </div>
                                        <div id="home_kit_registry_reason" class="reasonObserver">
                                            <div class="form-check">
                                                <input type="radio" id="fit_to_fly"
                                                       name="type_of_test"
                                                       class="form-check-input"
                                                       @if(old('type_of_test') && old('type_of_test') == "fit_to_fly")
                                                       checked
                                                       @endif
                                                       value="fit_to_fly">
                                                <label
                                                    class="form-check-label" for="fit_to_fly" style="font-weight: normal">Fit
                                                    to Fly</label>
                                            </div>
                                            <div class="form-check" @php
                                                if(isset($_GET['type']) && $_GET['type'] == "lateral"){
                   echo "style='display: none'";
                                               }
                                            @endphp>
                                                <input type="radio"
                                                       id="fit_to_release"
                                                       name="type_of_test"
                                                       class="form-check-input"
                                                       @if(old('type_of_test') && old('type_of_test') == "fit_to_release")
                                                       checked
                                                       @endif
                                                       value="fit_to_release">
                                                <label
                                                    class="form-check-label" for="fit_to_release" style="font-weight: normal">Test
                                                    to Release</label>
                                            </div>
                                            <div class="form-check" @php
                                                if(isset($_GET['type']) && $_GET['type'] == "lateral"){
                   echo "style='display: none'";
                                               }
                                            @endphp>
                                                <input type="radio"
                                                       id="day_2"
                                                       name="type_of_test"
                                                       @if(old('type_of_test') && old('type_of_test') == "day_2")
                                                       checked
                                                       @endif
                                                       class="form-check-input" value="day_2">
                                                <label
                                                    class="form-check-label" for="day_2" style="font-weight: normal">Travel
                                                    Package : Day 2</label>
                                            </div>
                                            <div class="form-check" @php
                                                if(isset($_GET['type']) && $_GET['type'] == "lateral"){
                   echo "style='display: none'";
                                               }
                                            @endphp>
                                                <input type="radio"
                                                       id="day_8"
                                                       name="type_of_test"
                                                       @if(old('type_of_test') && old('type_of_test') == "day_8")
                                                       checked
                                                       @endif
                                                       class="form-check-input" value="day_8">
                                                <label
                                                    class="form-check-label" for="day_8" style="font-weight: normal">Travel
                                                    Package : Day 8</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="radio" id="non_travel"
                                                       name="type_of_test"
                                                       class="form-check-input"
                                                       @if(old('type_of_test') && old('type_of_test') == "non_travel")
                                                       checked
                                                       @endif
                                                       value="non_travel">
                                                <label
                                                    class="form-check-label" for="non_travel" style="font-weight: normal">Diagnostic:
                                                    Non travel</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="display: none" id="greenCountryConsentDiv">
                                        <hr class="my-4">
                                        <div class="col-sm-6 text-left">
                                            <label class="" for="home_kit_registry_greenCountryConsent">I confirm that I
                                                came from a country classified as </label>
                                        </div>
                                        <div class="col-sm-6 text-left">
                                            <select id="home_kit_registry_greenCountryConsent"
                                                    name="greenCountryConsent"
                                                    class="greenCountryConsent form-control form-select">
                                                <option value=""></option>
                                                <option value="3" @if(old('greenCountryConsent') && old('greenCountryConsent') == "3")
                                                selected
                                                    @endif>Red List</option>
                                                <option value="4" @if(old('greenCountryConsent') && old('greenCountryConsent') == "4")
                                                selected
                                                    @endif>Non Red List</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <h3>Your information :</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2"><label
                                                    for="home_kit_registry_contact_firstname" class="">First
                                                    Name</label><input type="text"
                                                                       id="home_kit_registry_contact_firstname"
                                                                       name="first_name"
                                                                       value="{{ old('first_name') }}"
                                                                       required maxlength="255"
                                                                       class="form-control"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2"><label for="home_kit_registry_contact_lastname"
                                                                                class="">Last Name</label><input
                                                    type="text" id="home_kit_registry_contact_lastname"
                                                    name="last_name" required
                                                    value="{{ old('last_name') }}"
                                                    maxlength="255" class="text-uppercase form-control"></div>
                                        </div>
                                    </div>
                                    <div class="form-group mb-2"><label for="home_kit_registry_contact_address"
                                                                        class="">Address</label><input
                                            type="text" id="home_kit_registry_contact_address"
                                            name="address" required
                                            value="{{ old('address') }}"
                                            maxlength="255" class="patient_contact_address form-control"></div>
                                    <div class="form-group mb-2">
                                        <label for="home_kit_registry_contact_flatNumber">Flat
                                            number/Building number</label>
                                        <input type="text"
                                               id="home_kit_registry_contact_flatNumber"
                                               name="flat_number"
                                               maxlength="255"
                                               value="{{ old('flat_number') }}"
                                               class="patient_contact_flatNumber form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group mb-2"><label for="home_kit_registry_contact_zipCode"
                                                                                class="">Postal
                                                    Code</label><input type="text"
                                                                       id="home_kit_registry_contact_zipCode"
                                                                       name="postal_code"
                                                                       value="{{ old('postal_code') }}"
                                                                       maxlength="8" pattern=".{5,}" required
                                                                       class="patient_contact_zipCode text-uppercase form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="form-group mb-2"><label for="home_kit_registry_contact_city"
                                                                                class="">City</label><input
                                                    type="text" id="home_kit_registry_contact_city"
                                                    name="city" required
                                                    value="{{ old('city') }}"
                                                    maxlength="255"
                                                    class="patient_contact_city text-uppercase form-control"></div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2"><label
                                                    for="home_kit_registry_contact_mobilePhone" class="">Mobile
                                                    Phone</label><input type="text"
                                                                        id="home_kit_registry_contact_mobilePhone"
                                                                        name="phone"
                                                                        value="{{ old('phone') }}"
                                                                        required maxlength="255"
                                                                        class="phonenumber form-control"></div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-6 form-group mb-2"><label
                                                for="home_kit_registry_contact_email_first"
                                                class="">Email</label>

                                            <input
                                                type="email" id="home_kit_registry_contact_email_first"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                class="form-control">
                                        </div>
                                        <div class="col-sm-6 form-group mb-2"><label
                                                for="home_kit_registry_contact_email_second" class="">Confirm
                                                Email</label>
                                            <input
                                                type="email" id="home_kit_registry_contact_email_second"
                                                name="confirm_email"
                                                value="{{ old('confirm_email') }}"
                                                required
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                                <label class=""
                                                       for="home_kit_registry_gender">Gender</label>
                                                <select id="home_kit_registry_gender" name="gender" required
                                                    class="form-control form-select">
                                                    <option value="M"  @if(old('gender') && old('gender') == "M")
                                                    selected
                                                        @endif>Male</option>
                                                    <option value="F" @if(old('gender') && old('gender') == "F")
                                                    selected
                                                        @endif>Female</option>
                                                    <option value="N" @if(old('gender') && old('gender') == "N")
                                                    selected
                                                        @endif>Other</option>
                                                </select></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                                <label class=""
                                                       for="home_kit_registry_ethnicity">Ethnicity</label><select
                                                    id="home_kit_registry_ethnicity" name="ethnicity"
                                                    class="release form-control form-select" required>
                                                    <option value="">Make a Selection</option>
                                                    <option value="35" @if(old('ethnicity') && old('ethnicity') == "35")
                                                    selected
                                                        @endif>ANY OTHER ETHNIC CATEGORY</option>
                                                    <option value="33" @if(old('ethnicity') && old('ethnicity') == "33")
                                                    selected
                                                        @endif>ANY OTHER MIXED GROUP</option>
                                                    <option value="05" @if(old('ethnicity') && old('ethnicity') == "05")
                                                    selected
                                                        @endif>BANGLADESHI</option>
                                                    <option value="02" @if(old('ethnicity') && old('ethnicity') == "02")
                                                    selected
                                                        @endif>BLACK - AFRICAN</option>
                                                    <option value="01" @if(old('ethnicity') && old('ethnicity') == "01")
                                                    selected
                                                        @endif>BLACK - CARIBBEAN</option>
                                                    <option value="14" @if(old('ethnicity') && old('ethnicity') == "14")
                                                    selected
                                                        @endif>BLACK - OTHER</option>
                                                    <option value="06" @if(old('ethnicity') && old('ethnicity') == "06")
                                                    selected
                                                        @endif>CHINESE</option>
                                                    <option value="03" @if(old('ethnicity') && old('ethnicity') == "03")
                                                    selected
                                                        @endif>INDIAN</option>
                                                    <option value="12" @if(old('ethnicity') && old('ethnicity') == "12")
                                                    selected
                                                        @endif>ISC - UNSPECIFIED</option>
                                                    <option value="34" @if(old('ethnicity') && old('ethnicity') == "34")
                                                    selected
                                                        @endif>OTHER / MIXED</option>
                                                    <option value="04" @if(old('ethnicity') && old('ethnicity') == "04")
                                                    selected
                                                        @endif>PAKISTANI</option>
                                                    <option value="99" @if(old('ethnicity') && old('ethnicity') == "99")
                                                    selected
                                                        @endif>UNKNOWN</option>
                                                    <option value="00" @if(old('ethnicity') && old('ethnicity') == "00")
                                                    selected
                                                        @endif>WHITE</option>
                                                    <option value="32" @if(old('ethnicity') && old('ethnicity') == "32")
                                                    selected
                                                        @endif>WHITE AND ASIAN</option>
                                                    <option value="31" @if(old('ethnicity') && old('ethnicity') == "31")
                                                    selected
                                                        @endif>WHITE AND BLACK AFRICAN</option>
                                                    <option value="30" @if(old('ethnicity') && old('ethnicity') == "30")
                                                    selected
                                                        @endif>WHITE AND BLACK CARIBBEAN</option>
                                                    <option value="21" @if(old('ethnicity') && old('ethnicity') == "21")
                                                    selected
                                                        @endif>WHITE BRITISH</option>
                                                    <option value="22" @if(old('ethnicity') && old('ethnicity') == "22")
                                                    selected
                                                        @endif>WHITE IRISH</option>
                                                    <option value="23" @if(old('ethnicity') && old('ethnicity') == "23")
                                                    selected
                                                        @endif>WHITE OTHER</option>
                                                </select></div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                                <label for="home_kit_registry_birthDate"
                                                       class="">Birth
                                                    date</label>
                                                <input
                                                    class="form-control form-control input datepicker" placeholder="dd-mm-yyyy"
                                                    required name="dob" value="{{ old('dob') }}" type="text"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2">
                                                <label for="home_kit_registry_passportId">
                                                    Passport
                                                    number</label>
                                                <input type="text" id="home_kit_registry_passportId"
                                                       name="passport_number"
                                                       value="{{ old('passport_number') }}"
                                                       class="fitfly release form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <hr class="my-4">

                                    <label>Are you currently experiencing any symptoms ?</label>
                                    <div id="home_kit_registry_symptoms">
                                        <div class="form-check form-check-inline">
                                            <input type="radio"
                                                   id="home_kit_registry_symptoms_0"
                                                   name="symptoms"
                                                   required
                                                   @if(old('symptoms') && old('symptoms') == "1")
                                                   checked
                                                   @endif
                                                   class="radio-inline form-check-input"
                                                   value="1">
                                            <label
                                                class="form-check-label "
                                                for="home_kit_registry_symptoms_0">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio"
                                                   id="home_kit_registry_symptoms_1"
                                                   name="symptoms"
                                                   required
                                                   @if(old('symptoms') && old('symptoms') == "0")
                                                   checked
                                                   @endif
                                                   class="radio-inline form-check-input"
                                                   value="0">
                                            <label
                                                class="form-check-label "
                                                for="home_kit_registry_symptoms_1">No</label>
                                        </div>
                                    </div>

                                    <div class="row " style="display: none" id="travelDiv">
                                        <hr class="my-4">
                                        <div class="col-sm-12">
                                            <fieldset class="form-group mb-2">
                                                <label class="col-form-label ">Travel type</label>
                                                <select class="form-control" name="travel_type">
                                                    <option>Make a Selection</option>
                                                    <option value="flight" @if(old('travel_type') && old('travel_type') == "flight")
                                                    selected
                                                        @endif>Flight</option>
                                                    <option value="train" @if(old('travel_type') && old('travel_type') == "train")
                                                    selected
                                                        @endif>Train</option>
                                                    <option value="vessel" @if(old('travel_type') && old('travel_type') == "vessel")
                                                    selected
                                                        @endif>Vessel</option>
                                                    <option value="none" @if(old('travel_type') && old('travel_type') == "none")
                                                    selected
                                                        @endif>None</option>
                                                </select>

                                            </fieldset>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group mb-2"><label for="home_kit_registry_flightNumber">Flight
                                                    / Train / Vessel number</label><input type="text"
                                                                                          id="home_kit_registry_flightNumber"
                                                                                          name="flightNumber"
                                                                                          maxlength="255"
                                                                                          value="{{ old('flightNumber') }}"

                                                                                          class="release form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-2"><label for="home_kit_registry_arrivalDate">Arrival
                                                    date</label><input
                                                    class="release form-control form-control datepicker"  name="arrivalDate"  value="{{ old('arrivalDate') }}"
                                                    placeholder="" tabindex="0" type="text" ></div>
                                        </div>

                                        <div class="col-sm-12">
                                            <label class="" for="home_kit_registry_countryVisited-tomselected"
                                                   id="home_kit_registry_countryVisited-ts-label">The country or
                                                territory you were travelling from when you arrived in the UK (please
                                                type country separted by a comma)</label>
                                        </div>
                                        <div class="col-sm-12">
                                           <textarea class="form-control" name="countryVisited" >{{ old('countryVisited') }}</textarea>
                                        </div>

                                    </div>

                                    <div class="row" style="display: none" id="vaccinationDiv">
                                        <hr class="my-4">

                                        <div class="col-sm-8 col-md-12 row">
                                            <div class="col-12 col-md-12">
                                                <label class="col-form-label">Are you fully vaccinated ? (For more
                                                    information, please click here: <a
                                                        href="https://www.gov.uk/guidance/countries-with-approved-covid-19-vaccination-programmes-and-proof-of-vaccination"
                                                        target="_blank">Guidance Approved COVID-19 proof of
                                                        vaccination</a>)</label>
                                            </div>
                                            <div class="col-12 col-md-4">
                                                <div id="home_kit_registry_vaccination" class="vaccination">
                                                    <div class="form-check"><input type="radio"
                                                                                   id="home_kit_registry_vaccination_0"
                                                                                   name="vaccination"
                                                                                   class="form-check-input"
                                                                                   value="0"
                                                                                   @if(old('vaccination') && old('vaccination') == "0")
                                                                                   checked
                                                            @endif
                                                                                   ><label
                                                            class="form-check-label"
                                                            for="home_kit_registry_vaccination_0">No</label></div>
                                                    <div class="form-check"><input type="radio"
                                                                                   id="home_kit_registry_vaccination_1"
                                                                                   name="vaccination"
                                                                                   class="form-check-input"
                                                                                   @if(old('vaccination') && old('vaccination') == "1")
                                                                                   checked
                                                                                   @endif
                                                                                   value="1"><label
                                                            class="form-check-label"
                                                            for="home_kit_registry_vaccination_1">Yes I am fully
                                                            vaccinated</label></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-check"><input type="checkbox"
                                                                           id="home_kit_registry_termsConsent"
                                                                           name="termsConsent"
                                              required class="form-check-input"
                                                value="1"><label
                                                    class="form-check-label" style="margin-left: 10px;"
                                                    for="home_kit_registry_termsConsent">I have read and consent to the
                                                    Terms and Conditions (see link on footer).</label></div>
                                        </div>
                                    </div>


                                    <div class="row mt20">
                                        <div class="col" align="center">
                                            <div class="button">
                                                <button class="btn" id="btn-submit">Validate</button>
                                            </div>
                                        </div>
                                    </div>
                                @csrf
                                </form>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"
            integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#datetimepicker').datetimepicker();
        $('.datepicker').datetimepicker({
            timepicker:false,
        });
        $('input[name="type_of_test"]').on('change', function () {
            var val = $(this).val();

            if (val == "day_2") {
                $("#greenCountryConsentDiv").show();
            } else {
                $("#greenCountryConsentDiv").hide();
            }


            if(val == "day_2" || val == "day_8" || val == "fit_to_release"){
                $("#travelDiv").show();
                $("#vaccinationDiv").show();

            }else{
                $("#travelDiv").hide();
                $("#vaccinationDiv").hide();

            }
        });
    </script>

@endsection
