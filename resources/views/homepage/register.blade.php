@extends('layouts.login')
@section('style')

@endsection
@section('content')
    <style>
        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        /* Hide all steps by default: */
        .tab {
            display: none;
        }

        /* Make circles that indicate the steps of the form: */
        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        /* Mark the active step: */
        .step.active {
            opacity: 1;
        }

        /* Mark the steps that are finished and valid: */
        .step.finish {
            background-color: #04AA6D;
            float: none;
        }

        .iti--allow-dropdown {
            width: 100%;
        }

        #backbutton {
            margin-bottom: 190px;
        }

        .login_information p {
            font-weight: bolder;
        }

        @media screen and (max-width: 800px) {
            #backbutton {
                margin-bottom: 90px;
            }
        }

        @media screen and (max-width: 600px) {
            #backbutton {
                margin-bottom: 70px;
            }

            .rightHalf {
                padding: 0 5%;
            }
        }

        @media (max-width: 1500px) {
            .leftHalf {
                height: 1000px;
            }
        }

        @media (max-width: 800px) {
            .leftHalf {
                height: 60px;
            }
        }

        @media (min-width: 768px) {
            .login_information {
                margin-top: 30%;
            }

            .login_information p {
                font-size: 30px;
            }
        }
    </style>

    <div class="leftHalf"
         style="background-image: url('/img/travel.jpeg');background-size: cover;background-position: center; " s>

        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton" style="width:100%; margin-left: -20px;
    margin-top: 10px;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
                <br>
            </div>
            <div class="container-fluid" style="width:70%;padding: 5px;">
                <div class="login_information">
                    <p style="text-align: justify;"><b>Are you a travel agent looking to grow your network of
                            travelers?</b></p>
                </div>

            </div>
        </div>
    </div>

    <div class="rightHalf">
        <div class="position-relative">
            <!--login form-->
            <div class="login-form " style="padding-top:0">
                <h2 class="text-center">

                    <a href="/">
                        <img src="/images/logo2.png" srcset="/images/logo2.png" style="height: 80px;"
                             alt="Uk Travel test">
                    </a>
                </h2>


                @include('errors.showerrors')
                <form action="{{ url('/register') }}" style="margin-top: 20px" method="post" id="regForm"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h5>Basic Information</h5><br/>
                        <div class="col-lg-12 form-group" style="padding: 0px">
                            <small class="text-muted">Kindly fill the information below to proceed:</small>
                        </div>

                        <div class="col-lg-6 form-group">
                            <label>First name:</label>
                            <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control"
                                   placeholder="First Name" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Last name:</label>
                            <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"
                                   placeholder="Last Name" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Phone No:</label>
                            <input id="phone" style="width:100%;margin-right:0px" type="text"
                                   value="{{ old('phone_no') }}" name="phone_no" class="form-control pr-5"
                                   placeholder="Phone No" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label class="text-left" style="width:100%">Country of residence</label>
                            <select class="form-control select2 country_id__"
                                    name="country" autocomplete="off"
                                    id="travel_from" onchange="run()" onselect="selectCountry()" required>
                                <option value="">Make a selection</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->iso }}"
                                            @if(old('country') == $country->id) selected
                                            @endif>{{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Email:</label>
                            <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                                   id="exampleInputEmail1" placeholder="Enter Email" required>
                        </div>
                        <div class="col-lg-6 form-group mb-4">
                            <label>Password:</label>
                            <div class="input-group">
                                 <span class="input-group-addon p-2 "  style="border:1px solid #ced4da; border-radius:10px 0px 0px 10px;cursor: pointer;" onclick="myFunction()"> <i><img src="https://img.icons8.com/ios-glyphs/20/000000/visible.png"/></i></span>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                   placeholder="Enter Password" style="border-radius:0px 10px 10px 0px" required>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group" style="padding: 0px">
                            <h5>Business Information</h5>

                            <small class="text-muted">Please let us know what name you would like displayed on the UK
                                Travel Test portal.
                            </small>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Trading name: </label>
                            <input type="text" value="{{ old('platform_name') }}" name="platform_name"
                                   class="form-control" id="exampleInputEmail1" placeholder="Name on platform">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Company name: </label>
                            <input type="text" value="{{ old('company') }}" name="company" class="form-control"
                                   id="exampleInputEmail1" placeholder="Name of organization" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>Name of MD: </label>
                            <input type="text" value="{{ old('director') }}" name="director" class="form-control"
                                   id="exampleInputEmail1" placeholder="Name of Managing Director" required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label>CAC Document: </label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="col-lg-6  form-group">
                            Certification:
                            <select name="certified" class="form-control" id="" required>
                                <option class="pl-5" value="">Are you IATA certified?</option>
                                <option class="text-center" @if(old('certified') == "Yes") selected
                                        @endif value="Yes">Yes</option>
                                <option class="text-center" @if(old('certified') == "No") selected
                                        @endif value="No">No</option>
                            </select>
                        </div>
                        <div class="col-lg-12 form-group">
                            <small class="text-muted">If certified</small>
                            <small style="color:red;"> (An IATA number is not a prerequisite to completing your
                                registration and inclusion to the network)
                            </small>

                            <input type="text" value="{{ old('certified_no') }}" name="certified_no"
                                   class="form-control" id="exampleInputEmail1"
                                   placeholder="
                                   Please fill in your IATA number">
                        </div>


                        <!-- <p>Already have an account? <a href="/login"> Login</a></p> -->

                        <div class="col-lg-12 form-group clearfix">
                            <button type="submit" class="btn btn-purple btn-pill pull-right">Register</button>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "gb",
            utilsScript: "/js/phone_lib/js/utils.js",
        });

        function myFunction() {
            var x = document.getElementById("exampleInputPassword1");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>



@endsection