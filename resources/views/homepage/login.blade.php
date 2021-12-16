@extends('layouts.login')

@section('content')
<style>
    #backbutton{
        margin-bottom:190px;
    }
    @media screen and (max-width: 800px) {
        #backbutton{
            margin-bottom:90px;
         }
    }
    @media screen and (max-width: 600px) {
        #backbutton{
            margin-bottom:50px;
         }
    }
    @media (max-width: 768px){
        .leftHalf {
            min-height: 300px;
        }
        .rightHalf{
            padding: 0 5%;
        }
    }


    @media (min-width: 768px){
        .leftHalf {
            min-height: 300px;
        }
        .login_information{
            margin-top: ;
        }
        .login_information p{
            font-size: 20px;
        }
    }
</style>
<!-- <div class="leftHalf" style="background-image: url('/img/travel.jpeg')">
        
        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton"style="width:100%;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
            <br>
            </div>
            <div class="container-fluid"  style="width:70%">
                <h2>Are you a travel agent looking to grow your network of travelers</h2>
            </div>
        </div>
    </div> -->
    <div class="leftHalf" style="background-image: url('/img/banner.jpg');">
           
        <div class="login-promo-txt" style="height:100%; top:0; width:100%">
            <div class="container-fluid" id="backbutton"style="width:100%; margin-left: -20px;
    margin-top: 10px;">
                <a href="/" class="btn btn-purple btn-pill float-left">Home page</a>
                <br>
            </div>
          <div class="container-fluid text-left"  style="width:80%; padding: 5px;">
              <div class="login_information">
                     <p style="text-align: justify"><b>Are you a Travel Agent, a company Travel Manager or a frequent traveller? You can join our partnership network which gives you access to discounts and value added services. <a href="#">Learn More</a></b></p>
              </div>
            
         </div>
        </div>
    </div>

    <div class="rightHalf">
        <div class="position-relative">
            <!--login form-->
            <div class="login-form">
               
                <h2 class="text-center mb-1">
                    <a href="/">
                        <img src="/images/logo2.png" srcset="/images/logo2.png" style="height: 80px;" alt="Uk Travel test">
                    </a>
                </h2>
                <h4 class="text-uppercase- text-purple mb-1 text-center">Login into your account</h4>
                <!-- <p class="text-center">Are you trying to make a booking? Kindly click this <a href="/booking">link</a> to book</p> -->
                @include('errors.showerrors')
                <form action="{{ url('/login') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group mb-4">
                    <div class="input-group">
                                 <span class="input-group-addon p-2 "  style="border:1px solid #ced4da; border-radius:10px 0px 0px 10px;cursor: pointer;" onclick="myFunction()"> <i><img src="https://img.icons8.com/ios-glyphs/20/000000/visible.png"/></i></span>
                                <input type="password" class="form-control" name="password" id="exampleInputPassword1"
                                   placeholder="Enter Password" style="border-radius:0px 10px 10px 0px" required>
                            </div>
                       
                    </div>
                    <!-- <p class="text-center">Don't have an account? <a href="/register/agent"> Register Now</a></p> -->
                    <div class="form-group clearfix">
                        <button type="submit" class="btn btn-purple btn-pill float-right">LOGIN</button>
                    </div>
                    <!-- <a href="/forgot/password">Forgot password?</a> -->
                </form>
            </div>
            <!--/login form-->
           
        </div>
    </div>
@endsection
@section('script')
    <script>
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