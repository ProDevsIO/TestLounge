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
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

                    <h1>{{$product->name}}</h1>
                    <p>{!! $product->description !!} </p>
                   

                    <!--/.st-accordion-->
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
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
                                                <input type="text" placeholder="First name" name="first_name" value="{{ old('first_name') }}"
                                                    style="margin-bottom:0px;" class="form-control input-md" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label>Surname <span class="show_required"> *</span></label>
                                                <input type="text" placeholder="Surname" name="last_name"
                                                    class="form-control input-md" value="{{ old('last_name') }}" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12" style="margin-top: 20px">
                                                <label>Contact Email: <span class="show_required"> *</span></label>

                                                <input type="text" name="email" value="{{ old('email') }}" id="email"
                                                    class="form-control input-md" required />

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
                                                    placeholder="apartment, building, block, street" value="{{ old('isolation_address') }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Isolation Address2: </label>
                                                <input class="form-control input-md" type="text" name="isolation_address2"
                                                    id="isolation_address2" placeholder="apartment, building, block, street"
                                                    value="{{ old('isolation_address2') }}" />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Isolation City/Town: <span class="show_required"> *</span></label>
                                                <input class="form-control input-md" type="text" name="isolation_town"
                                                    value="{{ old('isolation_town') }}" required />
                                            </div>
                                            <div class="col-md-6">
                                                <label>Isolation Postcode: <span class="show_required"> *</span></label>
                                                <input class="form-control input-md" type="text"
                                                    name="isolation_postal_code" value="{{ old('isolation_postal_code') }}" required />
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
                                                    placeholder="Departure Date in UK" name="departure_date" value="{{ old('departure_date') }}"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label>Arrival date in the UK: <span class="show_required"> *</span></label>
                                                <input class="date_picker1 form-control input-md" type="date"
                                                    placeholder="Arrival Date in UK" name="arrival_date" value="arrival_date" required>
                                            </div>

                                            <div class="col-md-6">
                                            <label>Select Card types <span class="show_required"> *</span></label>
                            
                                                <select class="select-2 form-control input-md" autocomplete="off" required name="card_type">
                                                    <option value="">Select a card type</option>
                                                    <option value="1">Local Card</option>
                                                    <option value="2">International Card</option>
                                                </select>
                                            </div>
                                           <br>
                                          
                                        </div> 

                                        <input type="hidden" value="{{$sproducts->id}}" name="vproduct">
                                        <input type="hidden" value="stripe" name="payment_method">
                                            
                                        <!-- Button -->
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button id="singlebutton" type="submit" name="singlebutton"
                                                    class="btn btn-default btn-block">Make Payment (£{{$sproducts->price_pounds}})</button>
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
    <div class="full-cta">
        <!--full-cta-->
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                    <h2 class="cta-title">Ask a Question?</h2>
                    <p class="text-white">Call us on <strong>02036334452</strong> </p>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    <a href="faq.html" class="btn btn-secondary pull-right">Frequently Asked Questions</a>
                </div>
            </div>
        </div>
    </div>
    <!--/.full-cta-->
    <div class="footer">
        <!--footer-->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="widget-footer mb60">
                        <!--widget-footer-->
                        <a href="index.html"><img src="images/logo.png" alt="" class="img-responsive"></a>
                    </div>
                    <!--/.widget-footer-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="widget-footer">
                        <!--widget-footer-->
                        <ul class="contact listnone">
                            <li><i class="fa fa-phone"></i><strong> 02036334452</strong></li>
                            <li><i class="fa fa-envelope-open-o"></i> <strong>info@thetestinglounge.com</strong></li>
                        </ul>
                    </div>
                    <!--/.widget-footer-->
                </div>
                <div class="col-lg-2 col-md-2 col-sm-3 col-xs-6">
                    <div class="widget-footer">
                        <!--widget-footer-->
                        <h3 class="widget-title">Covid Tests</h3>
                        <ul class="listnone circle-style">
                                @foreach($products as $product)
                                    <li><a href="/view/product/{{$product->slug}}" title="{{$product->name}}">{{$product->name}}</a></li>  
                                   @endforeach

                        </ul>
                    </div>
                    <!--/.widget-footer-->
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                    <div class="widget-footer">
                        <!--widget-footer-->
                        <h3 class="widget-title">Quick Links</h3>
                        <ul class="listnone circle-style">
                            <li><a href="index.html">Home </a> </li>
                            <li><a href="contact-us.html">About Us</a></li>
                            <li><a href="test-list.html">Lab Test</a></li>
                            <li><a href="contact-us.html">Blog</a></li>
                            <li><a href="contact-us.html">Contact us</a></li>
                        </ul>
                    </div>
                    <!--/.widget-footer-->
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                    <div class="widget-footer footer-social">
                        <!--widget-footer-social-->
                        <h3 class="widget-title">Connect With Us</h3>
                        <ul class="listnone">
                            <li><a href="https://www.instagram.com/thetestingloungeuk/" class="facebook-btn"
                                    target="_blank"><i class="fa fa-instagram"></i></a></li>
                        </ul>
                    </div>
                    <!--/.widget-footer-social-->
                </div>
            </div>
        </div>
    </div>
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
</script>

@endsection
