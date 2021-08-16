@extends('layouts.login')
@section('style')

@endsection
@section('content')
<style>
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
        <div class="position-relative" >
            <!--login form-->
            <div class="login-form " style="padding-top:0">
                <h2 class="text-center">
                    
                    <a href="/">
                        <img src="/img/logo-dark.png" srcset="/img/logo-dark.png" style="height: 80px;" alt="Uk Travel test">
                    </a>
                </h2>
            
                <p class="text-center">Register to create an Account</p>
                @include('errors.showerrors')
                <form action="{{ url('/register') }}" method="post" enctype="multipart/form-data">
                    @csrf
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
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group mb-4">
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                        <small class="text-muted">Please let us know what name you would like displayed on the UK Travel Test portal.  </small>
                       <input type="text" value="{{ old('platform_name') }}" name="platform_name" class="form-control" id="exampleInputEmail1" placeholder="Name on platform">
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('company') }}" name="company" class="form-control" id="exampleInputEmail1" placeholder="Name of organization" required>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{ old('director') }}" name="director" class="form-control" id="exampleInputEmail1" placeholder="Name of managing director" required>
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
                    
                        <small class="tezt-muted" style="color:red">An IATA number is not a prerequisite to  completing your registration and inclusion to the network.</small>
                        <p><small>if IATA certified</small></p>
                       <input type="text" value="{{ old('certified_no') }}" name="certified_no" class="form-control" id="exampleInputEmail1" placeholder="please fill in your IATA number">
                    </div>
                    
                   
                    
                        <p>Already have an account? <a href="/login"> Login</a></p>
                    
                    <div class="form-group clearfix">
                        <button type="submit" class="btn btn-purple btn-pill float-right">Register</button>
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

</script>

@endsection