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
            float:none;
        }

    .iti--allow-dropdown{
        width:100%;
    }
    #backbutton{
        margin-bottom:190px;
    }
    .login_information p{
        font-weight: bolder;
    }
    @media screen and (max-width: 800px) {
        #backbutton{
            margin-bottom:90px;
         }
    }
    @media screen and (max-width: 600px) {
        #backbutton{
            margin-bottom:70px;
         }
        .rightHalf{
            padding: 0 5%;
        }
    }

    @media (max-width: 1500px) {
      .leftHalf{
          height:1000px;
      }
    }
    @media (max-width: 800px) {
      .leftHalf{
          height:60px;
      }
    }

    @media (min-width: 768px){
        .login_information{
            margin-top: 30%;
        }
        .login_information p{
            font-size: 30px;
        }
    }
</style>

    <div class="leftHalf" style="background-image: url('/img/travel.jpeg');background-size: cover;background-position: center; " s>
        
        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton"style="width:100%; margin-left: -20px;
    margin-top: 10px;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
            <br>
            </div>
            <div class="container-fluid"  style="width:70%;padding: 5px;">
                <div class="login_information">
                    <p style="text-align: justify;"><b>Are you a travel agent looking to grow your network of travelers?</b></p>
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
                        <img src="/img/logo-dark.png" srcset="/img/logo-dark.png" style="height: 80px;" alt="Uk Travel test">
                    </a>
                </h2>
            
                <p class="text-center">Register to create an Account</p>
                @include('errors.showerrors')
                <form action="{{ url('/register') }}" method="post" id="regForm" enctype="multipart/form-data">
                    @csrf
                    <div class="tab"><h5>Personal Infomation</h5>
                        <div class="form-group">
                            <input type="text" value="{{ old('first_name') }}" name="first_name" class="form-control" placeholder="First Name" required>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('last_name') }}" name="last_name" class="form-control"  placeholder="Last Name" required>
                        </div>
                        <div class="form-group">
                            <input id="phone" style="width:100%;margin-right:0px" type="text" value="{{ old('phone_no') }}" name="phone_no" class="form-control pr-5"  placeholder="Phone No" required>
                        </div>
                        <div class="form-group">
                                <label class="text-center"  style="width:100%">Country of residence</label>
                                <select class="form-control select2 country_id__"
                                    name="country" autocomplete="off"
                                    id="travel_from" onchange="run()" onselect="selectCountry()" required>
                                    <option value="">Make a selection</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->iso }}"
                                            @if(old('country_travelling_from_id') == $country->id) selected
                                            @endif>{{ $country->name }}
                                        </option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" required>
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" required>
                        </div>
                    </div>
                    <div class="tab"><h5>Business Information</h5>
                        <div class="form-group">
                            <small class="text-muted">Please let us know what name you would like displayed on the UK Travel Test portal.  </small>
                        <input type="text" value="{{ old('platform_name') }}" name="platform_name" class="form-control" id="exampleInputEmail1" placeholder="Name on platform">
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('company') }}" name="company" class="form-control" id="exampleInputEmail1" placeholder="Name of organization" required>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('director') }}" name="director" class="form-control" id="exampleInputEmail1" placeholder="Name of Managing Director" required>
                        </div> 
                        <div class="form-group">
                            <small class="text-muted">If available</small>
                            <label class="text-center " style="width:100%">Certificate of incorporation</label>
                        <input type="file"  name="file" class="form-control" >
                        </div>
                        <div class="form-group " >
                            <select name="certified" class="form-control" id="">
                                <option  class="pl-5" value="">Are you IATA certified?</option>
                                <option class="text-center" value="Yes">Yes</option>
                                <option class="text-center" value="No">No</option>
                            </select>   
                        </div>
                        <div class="form-group">
                            <small class="text-muted">if certified</small>
                            <small style="color:red;"> (An IATA number is not a prerequisite to completing your registration and inclusion to the network)</small>
            
                            <input type="text" value="{{ old('certified_no') }}" name="certified_no" class="form-control" id="exampleInputEmail1" placeholder="please fill in your IATA number">
                        </div>
                    
                   
                    
                            <p>Already have an account? <a href="/login"> Login</a></p>
                    
                        <!-- <div class="form-group clearfix">
                            <button type="submit" class="btn btn-purple btn-pill float-right">Register</button>
                        </div> -->
                    </div>

                    <div class="container-fluid mb-5">
                        <div class="text-center pb-5">
                            <button type="button" class="btn btn-purple btn-pill float-right" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                            <button type="button" class="btn btn-purple btn-pill float-right" id="nextBtn" onclick="nextPrev(1)">Next</button>
                        </div>
                    </div>

                    <!-- Circles which indicates the steps of the form: -->
                    <div class="container-fluid mt-5 text-center" style ="width:100%">
                        <span class="step"></span>
                        <span class="step"></span>
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

    var currentTab = 0; // Current tab is set to be the first tab (0)
    showTab(currentTab); // Display the current tab

    function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
        document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
        document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
    }

    function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
        //...the form gets submitted:
        document.getElementById("regForm").submit();
        return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
    }

    function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
        //   for (i = 0; i < y.length; i++) {
        //     // If a field is empty...
        //     if (y[i].value == "") {
        //       // add an "invalid" class to the field:
        //       y[i].className += " invalid";
        //       // and set the current valid status to false:
        //       valid = false;
        //     }
        //   }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    }

    function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
        x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
    }

</script>

@endsection